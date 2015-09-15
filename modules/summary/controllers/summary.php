<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Summary extends Front_Controller {

    public function __construct(){
      parent::__construct();
      $this->load->model('summary_model');
      $this->load->model('financial_stats_model');
      $this->load->model('overview/overview_model');
    }

    public function customer_portfolio(){
        if($this->session->userdata('logged_in'))
        {
            $one_month_ago      = date('Y-m-d', strtotime('previous month'));
            $two_months_ago     = date('Y-m-d', strtotime('two months ago'));
            $three_months_ago   = date('Y-m-d', strtotime('three months ago'));
            $four_months_ago    = date('Y-m-d', strtotime('four months ago'));

            $total_anggota                   = $this->overview_model->count_all_anggota_by_investor( $this->session->userdata('investor_id') );
            $total_anggota_last_month        = $this->overview_model->count_all_anggota_by_investor( $this->session->userdata('investor_id'), $one_month_ago );
            $total_anggota_last_two_month    = $this->overview_model->count_all_anggota_by_investor( $this->session->userdata('investor_id'), $two_months_ago );
            $total_anggota_last_three_month  = $this->overview_model->count_all_anggota_by_investor( $this->session->userdata('investor_id'), $three_months_ago );
            $total_anggota_last_four_month   = $this->overview_model->count_all_anggota_by_investor( $this->session->userdata('investor_id'), $four_months_ago );
            $persentase_kenaikan_anggota     = round( (($total_anggota - $total_anggota_last_month)/$total_anggota_last_month ) * 100);

            $total_majelis               = $this->overview_model->count_all_majelis_by_investor( $this->session->userdata('investor_id') );
            $total_majelis_last_month    = $this->overview_model->count_all_majelis_by_investor( $this->session->userdata('investor_id'), $one_month_ago );
            $persentase_kenaikan_majelis = round( (($total_majelis->client_group - $total_majelis_last_month->client_group)/$total_majelis_last_month->client_group ) * 100);
            
            $total_cabang  = $this->overview_model->count_all_cabang_by_investor(  $this->session->userdata('investor_id') );
            $total_officer = $this->overview_model->count_all_officer_by_investor( $this->session->userdata('investor_id') );

            $total_anggota_aktif_pembiayaan = $this->financial_stats_model->count_anggota_aktif_pembiayaan_per_investor( $this->session->userdata('investor_id') );
            $total_anggota_aktif_menabung   = $this->financial_stats_model->count_anggota_aktif_menabung_per_investor( $this->session->userdata('investor_id') );
            $total_anggota_keluar           = $this->financial_stats_model->count_anggota_keluar_per_investor( $this->session->userdata('investor_id') );       
            $total_monitoring               = $this->financial_stats_model->count_monitoring_pembiayaan_per_investor( $this->session->userdata('investor_id') );

            $this->template->set('menu_title', 'Customer Portofolios')
                           ->set('menu_description', 'A Quick Overview of Your Portofolios.')
                           ->set('menu_dashboard', 'active')
                           ->set('total_anggota', $total_anggota)
                           ->set('total_anggota_last_month', $total_anggota_last_month)
                           ->set('total_anggota_last_two_month', $total_anggota_last_two_month)
                           ->set('total_anggota_last_three_month', $total_anggota_last_three_month)
                           ->set('total_anggota_last_four_month', $total_anggota_last_four_month)
                           ->set('persentase_kenaikan_anggota', $persentase_kenaikan_anggota)
                           ->set('total_majelis', $total_majelis)
                           ->set('total_majelis_last_month', $total_majelis_last_month)
                           ->set('persentase_kenaikan_majelis', $persentase_kenaikan_majelis)
                           ->set('total_anggota_aktif_pembiayaan', $total_anggota_aktif_pembiayaan)
                           ->set('total_anggota_aktif_menabung', $total_anggota_aktif_menabung)
                           ->set('total_anggota_keluar', $total_anggota_keluar)
                           ->set('total_monitoring', $total_monitoring)
                           ->set('total_cabang',  $total_cabang)
                           ->set('total_officer', $total_officer)
                           ->build('summary');
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
            $two_months_ago     = date('Y-m-d', strtotime('two months ago'));
            $three_months_ago   = date('Y-m-d', strtotime('three months ago'));
            $four_months_ago    = date('Y-m-d', strtotime('four months ago'));

            $total_anggota                   = $this->overview_model->count_all_anggota_by_investor( $this->session->userdata('investor_id') );
            $total_anggota_last_month        = $this->overview_model->count_all_anggota_by_investor( $this->session->userdata('investor_id'), $one_month_ago );
            $total_anggota_last_two_month    = $this->overview_model->count_all_anggota_by_investor( $this->session->userdata('investor_id'), $two_months_ago );
            $total_anggota_last_three_month  = $this->overview_model->count_all_anggota_by_investor( $this->session->userdata('investor_id'), $three_months_ago );
            $total_anggota_last_four_month   = $this->overview_model->count_all_anggota_by_investor( $this->session->userdata('investor_id'), $four_months_ago );
            $persentase_kenaikan_anggota     = round( (($total_anggota - $total_anggota_last_month)/$total_anggota_last_month ) * 100);

            $total_majelis               = $this->overview_model->count_all_majelis_by_investor( $this->session->userdata('investor_id') );
            $total_majelis_last_month    = $this->overview_model->count_all_majelis_by_investor( $this->session->userdata('investor_id'), $one_month_ago );
            $persentase_kenaikan_majelis = round( (($total_majelis->client_group - $total_majelis_last_month->client_group)/$total_majelis_last_month->client_group ) * 100);
            
            $total_cabang  = $this->overview_model->count_all_cabang_by_investor(  $this->session->userdata('investor_id') );
            $total_officer = $this->overview_model->count_all_officer_by_investor( $this->session->userdata('investor_id') );

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
                           ->set('persentase_kenaikan_anggota', $persentase_kenaikan_anggota)
                           ->set('total_majelis', $total_majelis)
                           ->set('total_majelis_last_month', $total_majelis_last_month)
                           ->set('persentase_kenaikan_majelis', $persentase_kenaikan_majelis)
                           ->set('total_cabang',  $total_cabang)
                           ->set('total_officer', $total_officer)
                           //->set_partial('graph-anggota', 'partials/graph-anggota', $data_anggota)
                           ->build('summary');
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
