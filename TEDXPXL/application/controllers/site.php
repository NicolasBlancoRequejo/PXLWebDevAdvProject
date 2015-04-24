<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {
    public function index(){
        $this->home();
    }
    
    public function home(){
              
        $data['title']="Home Page";

        $this->load->view("site_header",$data);
        $this->load->view("site_nav");
        $this->load->view("content_home",$data);
        $this->load->view("site_footer");

    }
    
    
    
}

