<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // Cek login dan role admin
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'admin') {
            redirect('auth');
        }
    }

    public function index() {
        $data['title'] = 'Admin Dashboard - Money Mentor Pro';
        $data['user'] = array(
            'name' => $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'),
            'email' => $this->session->userdata('email'),
            'role' => $this->session->userdata('role')
        );
        $this->load->view('admin/header', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('admin/footer');
    }

    public function content() {
        $data['title'] = 'Content Management - Admin';
        $data['user'] = array(
            'name' => $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'),
            'email' => $this->session->userdata('email'),
            'role' => $this->session->userdata('role')
        );
        $this->load->view('admin/header', $data);
        $this->load->view('admin/content', $data);
        $this->load->view('admin/footer');
    }

    public function users() {
        $data['title'] = 'User Management - Admin';
        $data['user'] = array(
            'name' => $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'),
            'email' => $this->session->userdata('email'),
            'role' => $this->session->userdata('role')
        );
        $this->load->view('admin/header', $data);
        $this->load->view('admin/users', $data);
        $this->load->view('admin/footer');
    }

    public function reporting() {
        $data['title'] = 'Reporting - Admin';
        $data['user'] = array(
            'name' => $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'),
            'email' => $this->session->userdata('email'),
            'role' => $this->session->userdata('role')
        );
        $this->load->view('admin/header', $data);
        $this->load->view('admin/reporting', $data);
        $this->load->view('admin/footer');
    }
} 