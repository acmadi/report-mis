<?php

class Dashboard extends Front_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('dashboard_model');
	}

	public function index(){
		if($this->session->userdata('logged_in'))
		{
			//$last_day_last_month = date('Y-m-d', strtotime('last day of previous month'));
            $one_month_ago         = date('Y-m-d', strtotime('previous month'));

            $total_anggota               = $this->overview_model->count_all_anggota_by_investor( $this->session->userdata('investor_id') );
            $total_anggota_last_month    = $this->overview_model->count_all_anggota_by_investor( $this->session->userdata('investor_id'), $one_month_ago );
            $persentase_kenaikan_anggota = round( (($total_anggota - $total_anggota_last_month)/$total_anggota_last_month ) * 100);

            $total_majelis               = $this->overview_model->count_all_majelis_by_investor( $this->session->userdata('investor_id') );
            $total_majelis_last_month    = $this->overview_model->count_all_majelis_by_investor( $this->session->userdata('investor_id'), $one_month_ago );
            $persentase_kenaikan_majelis = round( (($total_majelis->client_group - $total_majelis_last_month->client_group)/$total_majelis_last_month->client_group ) * 100);

            $total_cabang  = $this->overview_model->count_all_cabang_by_investor(  $this->session->userdata('investor_id') );
            $total_officer = $this->overview_model->count_all_officer_by_investor( $this->session->userdata('investor_id') );

			$this->template->set('menu_title', 'Dashboard')
						   ->set('menu_description', 'Welcome, Monitor your funding via Amartha Investor Reporting System (IRS).')
						   ->set('menu_dashboard', 'active')
						   ->set('total_anggota', $total_anggota)
                           ->set('total_anggota_last_month', $total_anggota_last_month)
                           ->set('persentase_kenaikan_anggota', $persentase_kenaikan_anggota)
                           ->set('total_majelis', $total_majelis)
                           ->set('total_majelis_last_month', $total_majelis_last_month)
                           ->set('persentase_kenaikan_majelis', $persentase_kenaikan_majelis)
                           ->set('total_cabang',  $total_cabang)
                           ->set('total_officer', $total_officer)
						   ->build('dashboard');
		}
		else
		{
			redirect('login', 'refresh');
		}
	}

}
