<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Summary extends Front_Controller {

    public function __construct(){
      parent::__construct();
      $this->load->model('summary_model');
      $this->load->model('financial_stats_model');
      $this->load->model('overview/overview_model');
    }

    public function portfolio_at_risk(){
        if($this->session->userdata('logged_in'))
        {
            $total_anggota_dijamin   = $this->overview_model->count_all_anggota_by_investor( $this->session->userdata('investor_id') );

            //PORTO PEMBIAYAAN
            for($i=0; $i<5; $i++){
              $total_pembiayaan_aktif[$i]  = $this->financial_stats_model->count_pembiayaan_aktif_ke_per_investor( $this->session->userdata('investor_id'), $i+1 );
              $amount_pembiayaan_aktif[$i] = $this->financial_stats_model->sum_pembiayaan_aktif_ke_per_investor( $this->session->userdata('investor_id'), $i+1 );
            }

             //PAR
            $total_par_lancar = array_sum($total_pembiayaan_aktif);
            $total_par_macet  = 0;
            for($i=1;$i<=12;$i++){
              $total_par[$i]        = $this->financial_stats_model->count_par_per_investor( $this->session->userdata('investor_id'), $i);
              $total_amount_par[$i] = $this->financial_stats_model->sum_par_per_investor( $this->session->userdata('investor_id'), $i );
              //Because $total_par[0] supposed to be valid containing total_par_lancar BUT it turns out INVALID,
              //we will just take (1 total par lancar) total pembiayaan - total par from 1-12, then later 13+
              //                  (2 total par macet) sum total par from 1-12, then later 13+
              $total_par_lancar   = $total_par_lancar - $total_par[$i]; //1st
              $total_par_macet    = $total_par_macet  + $total_par[$i];
            }
            $total_par[13]          = $this->financial_stats_model->count_par_13_per_investor( $this->session->userdata('investor_id'), 13);
            $total_amount_par[13]   = $this->financial_stats_model->sum_par_13_per_investor( $this->session->userdata('investor_id'), 13 );
            //Update again PAR Lancar & Macet
            $total_par_lancar   = $total_par_lancar - $total_par[13];//2nd
            $total_par_macet    = $total_par_macet  + $total_par[13];

            //NOMINAL PAR
            $par_nominal = $this->financial_stats_model->get_pembiayaan_par_per_investor( $this->session->userdata('investor_id') );
            foreach($par_nominal as $p){
              for($i=1;$i<=12;$i++){
                if($p->data_par == $i){
                  $sisa_angsuran         = (50 - $p->data_angsuranke) * ($p->data_plafond / 50);
                  $par_sisaangsuran[$i] += $sisa_angsuran;
                }
              }
            }

            $par_nominal_13 = $this->financial_stats_model->get_pembiayaan_par_13_per_investor( $this->session->userdata('investor_id') );
            foreach($par_nominal_13 as $p){
              if($p->data_par >= 13){
                $sisa_angsuran = (50 - $p->data_angsuranke) * ($p->data_plafond / 50);
                $par_sisaangsuran[13] += $sisa_angsuran;
              }
            }
             $this->template->set('menu_title', 'Portfolios at Risk (PAR)')
                            ->set('menu_description', "A Quick Overview of Your Portfolios' PAR.")
                            ->set('menu_dashboard', 'active')
                            ->set('total_anggota', $total_anggota_dijamin)
                            ->set('total_pembiayaan_aktif', $total_pembiayaan_aktif)
                            ->set('amount_pembiayaan_aktif', $amount_pembiayaan_aktif)
                            ->set('total_par', $total_par)
                            ->set('total_par_lancar', $total_par_lancar)
                            ->set('total_par_macet', $total_par_macet)
                            ->set('total_amount_par', $total_amount_par)
                            ->set('par_sisaangsuran', $par_sisaangsuran)
                            ->build('portfolio_at_risk');
        }
        else
        {
            redirect('login', 'refresh');
        }
    }

    public function financing_sector(){
        if($this->session->userdata('logged_in'))
        {
             //portfolio sektor pembiayaan
            $total_sektor=0;
            for($i=1;$i<=9;$i++){
              $total_sektor_pembiayaan[$i] = $this->financial_stats_model->count_sektor_pembiayaan_per_investor( $this->session->userdata('investor_id'), $i );
              $total_sektor += $total_sektor_pembiayaan[$i];
            }

            for($i=1;$i<=9;$i++){
              $total_sektor_pembiayaan_persen[$i] = ($total_sektor_pembiayaan[$i] / $total_sektor) * 100;
            }

            $sektor = $this->financial_stats_model->list_sektor_pembiayaan();

             $this->template->set('menu_title', 'Financing Sector')
                            ->set('menu_description', 'A Quick Overview of Your Portfolios.')
                            ->set('menu_dashboard', 'active')
                            ->set('sektor', $sektor)
                            ->set('total_sektor_pembiayaan', $total_sektor_pembiayaan)
                            ->set('total_sektor_pembiayaan_persen', $total_sektor_pembiayaan_persen)
                            ->build('financing_sector');
        }
        else
        {
            redirect('login', 'refresh');
        }
    }

    public function financing_portfolio(){
        if($this->session->userdata('logged_in'))
        {
            $total_anggota_dijamin  = $this->overview_model->count_all_anggota_by_investor( $this->session->userdata('investor_id') );
            //Portfolio Pembiayaan
            for($i=0; $i<5; $i++){
              $total_pembiayaan_aktif[$i]  = $this->financial_stats_model->count_pembiayaan_aktif_ke_per_investor( $this->session->userdata('investor_id'), $i+1 );
              $amount_pembiayaan_aktif[$i] = $this->financial_stats_model->sum_pembiayaan_aktif_ke_per_investor( $this->session->userdata('investor_id'), $i+1 );
            }
            for($i=1; $i<=5; $i++){
              $list_par_per_pembiayaan[$i] = $this->financial_stats_model->get_nth_pembiayaan_par_per_investor( $this->session->userdata('investor_id'), $i );
            }

            for($i=1; $i<=5; $i++) {
              for($n=0; $n<count($list_par_per_pembiayaan[$i]); $n++){
                // accessing the variables, e.g. echo $list_par_per_pembiayaan[$i][$n]->data_jangkawaktu;

                // $list_par_per_pembiayaan[$n]->data_jangkawaktu-$list_par_per_pembiayaan[$n]->data_angsuranke ----> SISA ANGSURAN n KALI
                // $list_par_per_pembiayaan[$n]->data_plafond / $list_par_per_pembiayaan[$n]->data_jangkawaktu -----> $list_par_per_pembiayaan[$n]->data_angsuranpokok
                $total_sisa_angsuran_yg_par_per_pembiayaan = ($list_par_per_pembiayaan[$i][$n]->data_jangkawaktu-$list_par_per_pembiayaan[$i][$n]->data_angsuranke) * ($list_par_per_pembiayaan[$i][$n]->data_plafond / $list_par_per_pembiayaan[$i][$n]->data_jangkawaktu);
                $par_per_pembiayaan[$i]                    = $par_per_pembiayaan[$i] + $total_sisa_angsuran_yg_par_per_pembiayaan;
              }
              $persen_par_per_pembiayaan[$i] = $par_per_pembiayaan[$i]/array_sum($amount_pembiayaan_aktif) * 100;
            }

            $this->template->set('menu_title', 'Financing Portfolios')
                           ->set('menu_description', 'A Quick Overview of Your Portfolios.')
                           ->set('menu_dashboard', 'active')
                           ->set('total_anggota_dijamin', $total_anggota_dijamin)
                           ->set('total_pembiayaan_aktif', $total_pembiayaan_aktif)
                           ->set('amount_pembiayaan_aktif', $amount_pembiayaan_aktif)
                           ->set('list_par_per_pembiayaan', $list_par_per_pembiayaan)
                           ->set('par_per_pembiayaan', $par_per_pembiayaan)
                           ->set('persen_par_per_pembiayaan', $persen_par_per_pembiayaan)
                           ->build('financing_portfolio');
        }
        else
        {
            redirect('login', 'refresh');
        }
    }

    public function customer_portfolio(){
        if($this->session->userdata('logged_in'))
        {
            $one_month_ago      = date('Y-m-d', strtotime('previous month'));
            $two_months_ago     = date('Y-m-d', strtotime('-2 months'));
            $three_months_ago   = date('Y-m-d', strtotime('-3 months'));
            $four_months_ago    = date('Y-m-d', strtotime('-4 months'));

            $total_anggota_aktif_pembiayaan = $this->financial_stats_model->count_anggota_aktif_pembiayaan_per_investor( $this->session->userdata('investor_id') );
            $total_anggota_aktif_menabung   = $this->financial_stats_model->count_anggota_aktif_menabung_per_investor( $this->session->userdata('investor_id') );
            $total_anggota_keluar           = $this->financial_stats_model->count_anggota_keluar_per_investor( $this->session->userdata('investor_id') );
            $total_monitoring               = $this->financial_stats_model->count_monitoring_pembiayaan_per_investor( $this->session->userdata('investor_id') );

            $this->template->set('menu_title', 'Customer Portfolios')
                           ->set('menu_description', 'A Quick Overview of Your Portfolios.')
                           ->set('menu_dashboard', 'active')
                           ->set('total_anggota_aktif_pembiayaan', $total_anggota_aktif_pembiayaan)
                           ->set('total_anggota_aktif_menabung', $total_anggota_aktif_menabung)
                           ->set('total_anggota_keluar', $total_anggota_keluar)
                           ->set('total_monitoring', $total_monitoring)
                           ->build('customer_portfolio');
        }
        else
        {
            redirect('login', 'refresh');
        }
    }

    public function graphics(){
        if($this->session->userdata('logged_in'))
        {
            $one_month_ago      = date('Y-m-d', strtotime('previous month'));
            $two_months_ago     = date('Y-m-d', strtotime('-2 months'));
            $three_months_ago   = date('Y-m-d', strtotime('-3 months'));
            $four_months_ago    = date('Y-m-d', strtotime('-4 months'));

            $total_anggota                   = $this->overview_model->count_all_anggota_by_investor( $this->session->userdata('investor_id') );
            $total_anggota_last_month        = $this->overview_model->count_all_anggota_by_investor( $this->session->userdata('investor_id'), $one_month_ago );
            $total_anggota_last_two_month    = $this->overview_model->count_all_anggota_by_investor( $this->session->userdata('investor_id'), $two_months_ago );
            $total_anggota_last_three_month  = $this->overview_model->count_all_anggota_by_investor( $this->session->userdata('investor_id'), $three_months_ago );
            $total_anggota_last_four_month   = $this->overview_model->count_all_anggota_by_investor( $this->session->userdata('investor_id'), $four_months_ago );


            //echo date('Y-m-d', strtotime('first day of previous month')).'/';
            //echo date('Y-m-d', strtotime('last day of previous month')).'/';
            //echo date('Y-m-d', strtotime('first day of -2 months')).'/';
            //echo date('Y-m-d', strtotime('last day of -2 months')).'/';
            //echo date('Y-m-d', strtotime('last day of -1 months')).'/';
            //echo date('Y-m-d', strtotime('first day of -0 months')).'-';
            //echo date('Y-m-d', strtotime('last day of -0 months')).'';
            //echo intval(NULL);
            //die();

            for($i=0; $i<5; $i++){
              $start = 'first day of -'.$i.' months'; $end = 'last day of -'.$i.' months';
              $presence_h[$i]  = $this->summary_model->count_presence( $this->session->userdata('investor_id'), "h", date('Y-m-d', strtotime($start)), date('Y-m-d', strtotime($end)) );
              $presence_s[$i]  = $this->summary_model->count_presence( $this->session->userdata('investor_id'), "s", date('Y-m-d', strtotime($start)), date('Y-m-d', strtotime($end)) );
              $presence_c[$i]  = $this->summary_model->count_presence( $this->session->userdata('investor_id'), "c", date('Y-m-d', strtotime($start)), date('Y-m-d', strtotime($end)) );
              $presence_i[$i]  = $this->summary_model->count_presence( $this->session->userdata('investor_id'), "i", date('Y-m-d', strtotime($start)), date('Y-m-d', strtotime($end)) );
              $presence_a[$i]  = $this->summary_model->count_presence( $this->session->userdata('investor_id'), "a", date('Y-m-d', strtotime($start)), date('Y-m-d', strtotime($end)) );

              $persentase_hadir[$i] = $presence_h[$i] / ($presence_h[$i] + $presence_s[$i] + $presence_c[$i] + $presence_i[$i] + $presence_a[$i]) * 100;
            }

            //var_dump($persentase_hadir); die();
            //$data_anggota = array(
            //      'jumlah_4' => $total_anggota_last_four_month,
            //      'jumlah_3' => $total_anggota_last_three_month,
            //      'jumlah_2' => $total_anggota_last_two_month,
            //      'jumlah_1' => $total_anggota_last_month,
            //      'jumlah_0' => $total_anggota
            //);

            //var_dump($data_anggota); die();

            $this->template->set('menu_title', 'Graphical Summary')
                           ->set('menu_description', 'An Intuitive Summary of Your Investment.')
                           ->set('menu_dashboard', 'active')
                           ->set('total_anggota', $total_anggota)
                           ->set('total_anggota_last_month', $total_anggota_last_month)
                           ->set('total_anggota_last_two_month', $total_anggota_last_two_month)
                           ->set('total_anggota_last_three_month', $total_anggota_last_three_month)
                           ->set('total_anggota_last_four_month', $total_anggota_last_four_month)
                           ->set('presence_h', $presence_h)
                           ->set('persentase_hadir', $persentase_hadir)
                           //->set_partial('graph-anggota', 'partials/graph-anggota', $data_anggota)
                           ->build('summary-chart');
        }
        else
        {
            redirect('login', 'refresh');
        }
    }

    public function index(){
        if($this->session->userdata('logged_in'))
        {
            $one_month_ago      = date('Y-m-d', strtotime('previous month'));

            $total_anggota                   = $this->overview_model->count_all_anggota_by_investor( $this->session->userdata('investor_id') );
            $total_anggota_last_month        = $this->overview_model->count_all_anggota_by_investor( $this->session->userdata('investor_id'), $one_month_ago );
            $persentase_kenaikan_anggota     = round( (($total_anggota - $total_anggota_last_month)/$total_anggota_last_month ) * 100);

            $total_majelis               = $this->overview_model->count_all_majelis_by_investor( $this->session->userdata('investor_id') );
            $total_majelis_last_month    = $this->overview_model->count_all_majelis_by_investor( $this->session->userdata('investor_id'), $one_month_ago );
            $persentase_kenaikan_majelis = round( (($total_majelis->client_group - $total_majelis_last_month->client_group)/$total_majelis_last_month->client_group ) * 100);

            $total_cabang  = $this->overview_model->count_all_cabang_by_investor(  $this->session->userdata('investor_id') );
            $total_officer = $this->overview_model->count_all_officer_by_investor( $this->session->userdata('investor_id') );

            $this->template->set('menu_title', 'Summary')
                           ->set('menu_description', 'A Quick Overview of Your Portofolios.')
                           ->set('menu_dashboard', 'active')
                           ->set('total_anggota', $total_anggota)
                           ->set('total_anggota_last_month', $total_anggota_last_month)
                           ->set('persentase_kenaikan_anggota', $persentase_kenaikan_anggota)
                           ->set('total_majelis', $total_majelis)
                           ->set('total_majelis_last_month', $total_majelis_last_month)
                           ->set('persentase_kenaikan_majelis', $persentase_kenaikan_majelis)
                           ->set('total_cabang',  $total_cabang)
                           ->set('total_officer', $total_officer)
                           //->set_partial('right-sidepanel', 'partials/right-sidepanel')
                           //->set_partial('right-sidepanel-button', 'partials/right-sidepanel-button')
                           ->build('summary');
        }
        else
        {
          redirect('login', 'refresh');
        }
    }

}

?>
