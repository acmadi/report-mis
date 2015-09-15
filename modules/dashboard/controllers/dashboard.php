<?php

class Dashboard extends Front_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('dashboard_model');
	}

	public function index(){
		if($this->session->userdata('logged_in'))
		{

			$this->template->set('menu_title', 'Dashboard')
						   			 ->set('menu_description', 'Welcome to Amartha Investor Reporting System (IRS). You can monitor your funding here.')
						   			 ->set('menu_dashboard', 'active')
						   			 ->build('dashboard');
		}
		else
		{
			redirect('login', 'refresh');
		}
	}

}
