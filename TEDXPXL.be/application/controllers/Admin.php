<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('string');
        $this->load->library('form_validation');
        $this->load->model('Admin_model');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>'); 
    }

    public function index() {
        if ($this->session->userdata('logged_in') == FALSE) {
            redirect('admin/login');
        } 

        redirect('admin/dashboard');
    }

    public function dashboard() {
        if ($this->session->userdata('logged_in') == FALSE) {
            redirect(base_url('signin'));
        } 

        $page_data['comment_query'] = $this->Admin_model->dashboard_fetch_comments();
        $page_data['discussion_query'] = $this->Admin_model->dashboard_fetch_discussions();

        $this->load->view('common/header');
        $this->load->view('nav/top_nav');
        $this->load->view('admin/dashboard',$page_data);
        $this->load->view('common/footer');         
    }

    public function update_item() {
        if ($this->session->userdata('logged_in') == FALSE) {
            redirect('admin/login');
        } 

        if ($this->uri->segment(4) == 'allow') {
            $is_active = 1;
        } else {
            $is_active = 0;
        }

        if ($this->uri->segment(3) == 'ds') {
            $result = $this->Admin_model->update_discussions($is_active, $this->uri->segment(5));
        } else {
            $result = $this->Admin_model->update_comments($is_active, $this->uri->segment(5));
        }

        redirect('admin');
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */