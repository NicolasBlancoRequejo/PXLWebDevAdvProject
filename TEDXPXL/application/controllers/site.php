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
	
		
    public function members(){
            if($this->session->userdata('is_logged_in')){
                    $this->load->view('members');
            }
            else {
                    redirect('site/restricted');
            }
    }

    public function restricted(){
            $this->load->view('restricted');
    }

    public function login_validation(){
            $this->load->library('form_validation');

            $this->form_validation->set_rules('email', 'Email', 
            'required|trim|xss_clean|callback_validate_credentials');
            $this->form_validation->set_rules('password', 'Password', 'required|md5|trim');

            if($this->form_validation->run()) {
                    $data = array(
                            'email' => $this->input->post('email'),
                            'is_logged_in' => 1
                    );
                    $this->session->set_userdata($data);
                    redirect('site/members');
            }
            else {
                 $this->home();
            }

    }  

    public function validate_credentials(){
            $this->load->model('model_users');

            if ($this->model_users->can_log_in()){
                    return true;
            }
            else {
                    $this->form_validation->set_message('validate_credentials', 'Incorrect username/password');
                    return false;
            }
    }

    public function logout(){
            $this->session->sess_destroy();
            redirect('site/login');
    }
    
}

