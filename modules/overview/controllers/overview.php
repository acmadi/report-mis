<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Overview extends Front_Controller {
    private $total_anggota;
    private $total_anggota_last_month;
    private $persentase_kenaikan_anggota;

    private $total_majelis;
    private $total_majelis_last_month;
    private $persentase_kenaikan_majelis;

    private $total_cabang;
    private $total_officer;

    public function __construct(){
      parent::__construct();
      $this->load->model('overview_model');
    }

    public function group($id=''){
        if($this->session->userdata('logged_in'))
        { 
            $this->summary();
            if($id!='')
            {
              $all_anggota_majelis_per_investor = $this->overview_model->list_all_anggota_by_majelis_by_investor( $id, $this->session->userdata('investor_id') )
              $this->template->set('menu_title', 'Group Overview')
                             ->set('menu_description', 'A Quick Overview of Group under Your Portfolios.')
                             ->set('menu_dashboard', 'active')
                             ->set('total_anggota', $this->total_anggota)
                             ->set('total_anggota_last_month', $this->total_anggota_last_month)
                             ->set('persentase_kenaikan_anggota', $this->persentase_kenaikan_anggota)
                             ->set('total_majelis', $this->total_majelis)
                             ->set('total_majelis_last_month', $this->total_majelis_last_month)
                             ->set('persentase_kenaikan_majelis', $this->persentase_kenaikan_majelis)
                             ->set('total_cabang',  $this->total_cabang)
                             ->set('total_officer', $this->total_officer)
                             //
                             ->set('all_majelis_per_investor', $all_anggota_majelis_per_investor)
                             ->build('group');
            }
            else
            {
              $all_majelis_per_investor = $this->overview_model->list_all_majelis_by_investor($this->session->userdata('investor_id'));
              $this->template->set('menu_title', 'Group Overview')
                             ->set('menu_description', 'A Quick Overview of Group under Your Portfolios.')
                             ->set('menu_dashboard', 'active')
                             ->set('total_anggota', $this->total_anggota)
                             ->set('total_anggota_last_month', $this->total_anggota_last_month)
                             ->set('persentase_kenaikan_anggota', $this->persentase_kenaikan_anggota)
                             ->set('total_majelis', $this->total_majelis)
                             ->set('total_majelis_last_month', $this->total_majelis_last_month)
                             ->set('persentase_kenaikan_majelis', $this->persentase_kenaikan_majelis)
                             ->set('total_cabang',  $this->total_cabang)
                             ->set('total_officer', $this->total_officer)
                             //
                             ->set('all_majelis_per_investor', $all_majelis_per_investor)
                             ->build('group');
            }
        }
        else
        {
            redirect('login', 'refresh');
        }
    }

    public function member($id=''){
        if($this->session->userdata('logged_in'))
        {
            $this->summary();
            if($id!='')
            { 
                $all_anggota_per_investor = $this->overview_model->list_all_anggota_by_investor($this->session->userdata('investor_id'));
                $this->template->set('menu_title', 'Member Overview')
                               ->set('menu_description', 'A Quick Overview of Members/Customers under Your Portfolios.')
                               ->set('menu_dashboard', 'active')
                               ->set('total_anggota', $this->total_anggota)
                               ->set('total_anggota_last_month', $this->total_anggota_last_month)
                               ->set('persentase_kenaikan_anggota', $this->persentase_kenaikan_anggota)
                               ->set('total_majelis', $this->total_majelis)
                               ->set('total_majelis_last_month', $this->total_majelis_last_month)
                               ->set('persentase_kenaikan_majelis', $this->persentase_kenaikan_majelis)
                               ->set('total_cabang',  $this->total_cabang)
                               ->set('total_officer', $this->total_officer)
                               //
                               ->set('all_anggota_per_investor', $all_anggota_per_investor)
                               ->build('member');
            }
            else
            {
                $all_anggota_per_investor = $this->overview_model->list_all_anggota_by_investor($this->session->userdata('investor_id'));
                $this->template->set('menu_title', 'Member Overview')
                               ->set('menu_description', 'A Quick Overview of Members/Customers under Your Portfolios.')
                               ->set('menu_dashboard', 'active')
                               ->set('total_anggota', $this->total_anggota)
                               ->set('total_anggota_last_month', $this->total_anggota_last_month)
                               ->set('persentase_kenaikan_anggota', $this->persentase_kenaikan_anggota)
                               ->set('total_majelis', $this->total_majelis)
                               ->set('total_majelis_last_month', $this->total_majelis_last_month)
                               ->set('persentase_kenaikan_majelis', $this->persentase_kenaikan_majelis)
                               ->set('total_cabang',  $this->total_cabang)
                               ->set('total_officer', $this->total_officer)
                               //
                               ->set('all_anggota_per_investor', $all_anggota_per_investor)
                               ->build('member');
            }
        }else
        {
            redirect('login', 'refresh');
        }
    }

    public function customer(){
        if($this->session->userdata('logged_in'))
        {
            $this->template->set('menu_title', 'Single Customer Overview')
                           ->set('menu_description', 'A Comprehensive Overview of Single Customer under Your Portfolios.')
                           ->set('menu_dashboard', 'active')
                           ->build('overview');
        }else
        {
            redirect('login', 'refresh');
        }
    }

    public function index()
    {
        if($this->session->userdata('logged_in'))
        {
            //$last_day_last_month = date('Y-m-d', strtotime('last day of previous month'));
            $one_month_ago         = date('Y-m-d', strtotime('previous month'));
            //$three_months_ago    = date('Y-m-d', strtotime('three months ago'));

            $total_anggota               = $this->overview_model->count_all_anggota_by_investor( $this->session->userdata('investor_id') );
            $total_anggota_last_month    = $this->overview_model->count_all_anggota_by_investor( $this->session->userdata('investor_id'), $one_month_ago );
            $persentase_kenaikan_anggota = round( (($total_anggota - $total_anggota_last_month)/$total_anggota_last_month ) * 100);

            $total_majelis               = $this->overview_model->count_all_majelis_by_investor( $this->session->userdata('investor_id') );
            $total_majelis_last_month    = $this->overview_model->count_all_majelis_by_investor( $this->session->userdata('investor_id'), $one_month_ago );
            $persentase_kenaikan_majelis = round( (($total_majelis->client_group - $total_majelis_last_month->client_group)/$total_majelis_last_month->client_group ) * 100);
            
            $total_cabang  = $this->overview_model->count_all_cabang_by_investor(  $this->session->userdata('investor_id') );
            $total_officer = $this->overview_model->count_all_officer_by_investor( $this->session->userdata('investor_id') );

            $this->template->set('menu_title', 'Overview')
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
                           ->build('overview');
        }
        else
        {
          redirect('login', 'refresh');
        }
    }

    private function summary()
    {
      $one_month_ago = date('Y-m-d', strtotime('previous month'));

      $this->total_anggota               = $this->overview_model->count_all_anggota_by_investor( $this->session->userdata('investor_id') );
      $this->total_anggota_last_month    = $this->overview_model->count_all_anggota_by_investor( $this->session->userdata('investor_id'), $one_month_ago );
      $this->persentase_kenaikan_anggota = round( (($total_anggota - $total_anggota_last_month)/$total_anggota_last_month ) * 100);
      $this->total_majelis               = $this->overview_model->count_all_majelis_by_investor( $this->session->userdata('investor_id') );
      $this->total_majelis_last_month    = $this->overview_model->count_all_majelis_by_investor( $this->session->userdata('investor_id'), $one_month_ago );
      $this->persentase_kenaikan_majelis = round( (($total_majelis->client_group - $total_majelis_last_month->client_group)/$total_majelis_last_month->client_group ) * 100);
      $this->total_cabang  = $this->overview_model->count_all_cabang_by_investor(  $this->session->userdata('investor_id') );
      $this->total_officer = $this->overview_model->count_all_officer_by_investor( $this->session->userdata('investor_id') );
    }
}

?>
