<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index() {
        $data['title'] = 'Dashboard - Money Mentor Pro';
        $data['user'] = array(
            'name' => $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'),
            'email' => $this->session->userdata('email'),
            'experience' => $this->session->userdata('investment_experience')
        );
        
        // Load dashboard view
        $this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('dashboard/footer');
    }
} 