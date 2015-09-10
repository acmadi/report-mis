<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Summary extends Front_Controller {

    public function __construct(){
      parent::__construct();
      $this->load->model('summary_model');
    }

    public function index(){
        if($this->session->userdata('logged_in'))
        {
          $this->template->set('menu_title', 'Summary')
                         ->set('menu_description', '')
                         ->set('menu_dashboard', 'active')
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
