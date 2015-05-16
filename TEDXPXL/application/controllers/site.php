<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

    public function index() {
        $this->home();
    }

    public function home() {

        $data['title'] = "Home Page";

        $this->load->view("site_header", $data);
        $this->load->view("site_nav");
        $this->load->view("content_home", $data);
        $this->load->view("site_footer");
    }

    public function members() {
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('members');
        } else {
            redirect('site/restricted');
        }
    }

    public function restricted() {
        $this->load->view('restricted');
    }

    public function signup() {
        $this->load->view('signup');
    }

    public function login_validation() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|callback_validate_credentials');
        $this->form_validation->set_rules('password', 'Password', 'required|md5|trim');

        if ($this->form_validation->run()) {
            $data = array(
                'email' => $this->input->post('email'),
                'is_logged_in' => 1
            );
            $this->session->set_userdata($data);
            redirect('site/members');
        } else {
            $this->home();
        }
    }

    public function signup_validation() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');

        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[password]');

        $this->form_validation->set_message('is_unique', 'This email is already in use.');

        if ($this->form_validation->run()) {

            //E-mail zenden werkt nog niet, bug nog niet gefixt

            $key = md5(uniqid());

            $config = Array(
                'protocol' => 'mail',
                'smtp_host' => 'localhost',
                'smtp_port' => 25,
                'smtp_user' => 'teddy.pxl@gmail.com', // change it to yours
                'smtp_pass' => 'pxlazerty', // change it to yours
                'mailtype' => 'html',
            );

            $this->load->library('email', $config);
            $this->load->model('model_users');

            $this->email->from('tedpxl@mailinator.com', "PXL");
            $this->email->to($this->input->post('email'));
            $this->email->subject("Bevestig je TED PXL account.");

            $message = "<p>Thank you for signing up!</p>";
            $message .="<p><a href='" . base_url() . "site/register_user/$key'>Click here</a> "
                    . "to confirm your account</p>";

            $this->email->message($message);
            if ($this->model_users->add_temp_user($key)) {
                if ($this->email->send()) {
                    echo "The email has been send!";
                } else {
                    echo "The email has not been send.";
                }
            } else {
                echo "Problem adding to database.";
            }
        } else {
            $this->load->view('signup');
        }
    }

    public function validate_credentials() {
        $this->load->model('model_users');

        if ($this->model_users->can_log_in()) {
            return true;
        } else {
            $this->form_validation->set_message('validate_credentials', 'Incorrect username/password');
            return false;
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('site/login');
    }
    
    public function register_user($key){
        $this->load->model('model_users');
        if($this->model_users->is_key_valid($key)){
            if($newemail = $this->model_users->add_user($key)){
                
                $data = array(
                    'email' => $newemail,
                    'is_logged_in' => 1
                );
                
                $this->session->set_userdata($data);
                redirect('site/members');
                
            }else echo "Failed to add user, please try again.";
        }else echo "Unvalid key or key already used, please try again with a valid key.";
    }

}
