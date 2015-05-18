<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->helper('form');
    $this->load->helper('url');
    $this->load->helper('security');
    $this->lang->load('en_admin', 'english'); 
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="alert alert-warning" role="alert">', '</div>'); 


    }
        
    public function index(){
        $data['title']="Home Page";

        $this->load->view('common/header',$data);
        $this->load->view('nav/top_nav');
        $this->load->view('home/home');
        $this->load->view('common/footer');
    }
   
}