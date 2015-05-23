<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Register extends CI_Controller {
  function __construct() {
  parent::__construct();
  $this->load->helper('form');
  $this->load->helper('url');
  $this->load->helper('security');
  $this->load->helper('file');
  $this->load->model('Register_model');
  $this->load->library('encrypt');
  $this->lang->load('en_admin', 'english');   
  $this->load->library('form_validation');
  $this->form_validation->set_error_delimiters('<div class="alert alert-warning" role="alert">', '</div>');         
  }

  public function index() {
      
    // Set validation rules
    //$this->form_validation->set_rules('captcha', 'Captcha', 'callback_validate_captcha');
    $this->form_validation->set_rules('usr_fname', $this->lang->line('first_name'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_lname', $this->lang->line('last_name'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_email', $this->lang->line('email'), 'required|min_length[1]|max_length[255]|valid_email|is_unique[users.usr_email]');

    // Begin validation 
    if ($this->form_validation->run() == FALSE) { // First load, or problem with form
      $this->load->view('common/header');
      $this->load->view('nav/top_nav');
      $this->load->view('users/register'); 
      $this->load->view('common/footer');    
      
      
      
    } else { 
      // Create hash from user password 
      //$password = random_string('alnum', 8); 
      //$hash = $this->encrypt->sha1($password);  
       
      $data = array( 
        'usr_fname' => $this->input->post('usr_fname'), 
        'usr_lname' => $this->input->post('usr_lname'), 
        'usr_email' => $this->input->post('usr_email'), 
        'usr_is_active' => 1,
        'usr_access_level' => 1,
        'usr_hash' => 'testen'
      ); 

      if ($this->Register_model->register_user($data)) {
        
        redirect(base_url('signin'));
      } else {
        redirect(base_url('register'));
      }
    } 
  }
} 
