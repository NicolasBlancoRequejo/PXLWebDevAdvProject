<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum extends MY_Controller {
    function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->helper('form');
    $this->load->helper('url');
    $this->load->helper('security');
    $this->lang->load('en_admin', 'english'); 
    $this->load->library('form_validation');
    $this->load->model('Forum_model');

    $this->form_validation->set_error_delimiters('<div class="alert alert-warning" role="alert">', '</div>');
    }

    public function index() {
        if ($this->uri->segment(3)) {
            $filter = $this->uri->segment(4);
            $direction = $this->uri->segment(5);
            $page_data['dir'] = $this->uri->segment(5);
        } else {
            $filter = null;
            $direction = null;
            $page_data['dir'] = 'ASC';
        }

        $page_data['query'] = $this->Forum_model->fetch_discussions($filter,$direction);
        
        $data['title']="Forum";
        
        $this->load->view('common/header',$data);
        $this->load->view('nav/top_nav');
        $this->load->view('forum/discussions');
        $this->load->view('common/footer');
    }
    
    public function create() {
        $this->form_validation->set_rules('usr_name', $this->lang->line('discussion_usr_name'), 'required|min_length[1]|max_length[255]');
        $this->form_validation->set_rules('usr_email', $this->lang->line('discussion_usr_email'), 'required|min_length[1]|max_length[255]');
        $this->form_validation->set_rules('ds_title', $this->lang->line('discussion_ds_title'), 'required|min_length[1]|max_length[255]');
        $this->form_validation->set_rules('ds_body', $this->lang->line('discussion_ds_body'), 'required|min_length[1]|max_length[5000]');

        if ($this->form_validation->run() == FALSE) { 
            $this->load->view('common/header');
            $this->load->view('nav/top_nav');
            $this->load->view('discussions/new');
            $this->load->view('common/footer');         
        } else {
            $data = array('usr_name' => $this->input->post('usr_name'),
                          'usr_email' => $this->input->post('usr_email'),
                          'ds_title' => $this->input->post('ds_title'),
                          'ds_body' =>  $this->input->post('ds_body')
                          );

            if ($ds_id = $this->Forum_model->create($data)) {
                redirect('comments/index/'.$ds_id);
            } else {
                // error
                // load view and flash sess error
            }
        }      
    }

}