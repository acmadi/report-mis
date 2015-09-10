<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Overview extends Front_Controller {

    public function __construct(){
      parent::__construct();
      $this->load->model('overview_model');
    }

    public function index(){
      $this->template->set('menu_title', 'Overview')
                     ->set('menu_description', '')
                     ->set('menu_dashboard', 'active')
                     //->set('total_anggota', $total_anggota)
                     //->set('total_majelis', $total_majelis)
                     //->set('total_cabang', $total_cabang)
                     //->set('total_officer', $total_officer)
                     //->set_partial('right-sidepanel', 'partials/right-sidepanel')
                     //->set_partial('right-sidepanel-button', 'partials/right-sidepanel-button')
                     ->build('overview');
    }

}

?>
