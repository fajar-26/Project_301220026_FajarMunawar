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
        $this->load->model('Admin_user_model');
        $this->load->model('User_model'); // Added User_model
        $data['title'] = 'User Management - Admin';
        $data['user'] = array(
            'name' => $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'),
            'email' => $this->session->userdata('email'),
            'role' => $this->session->userdata('role')
        );
        $search = $this->input->get('search') ?? '';
        $page = max(1, (int)($this->input->get('page') ?? 1));
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $data['search'] = $search;
        $data['page'] = $page;
        $data['limit'] = $limit;
        $data['total'] = $this->Admin_user_model->count_all_users($search);
        $data['users'] = $this->Admin_user_model->get_all_users($search, $limit, $offset);

        // Handle aktivasi/deaktivasi
        if ($this->input->post('toggle_active')) {
            $uid = $this->input->post('user_id');
            $active = $this->input->post('is_active') == '1' ? 1 : 0;
            $this->Admin_user_model->update_status($uid, $active);
            redirect(current_url().'?search='.urlencode($search).'&page='.$page);
        }
        // Handle reset password
        if ($this->input->post('reset_password')) {
            $uid = $this->input->post('user_id');
            $this->Admin_user_model->reset_password($uid);
            $this->session->set_flashdata('success', 'Password user berhasil direset ke: user12345');
            redirect(current_url().'?search='.urlencode($search).'&page='.$page);
        }

        // Handle tambah user
        if ($this->input->post('add_user')) {
            $user_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'role' => $this->input->post('role'),
                'investment_experience' => $this->input->post('investment_experience'),
                'birth_date' => $this->input->post('birth_date'),
                'phone' => $this->input->post('phone'),
            );
            // Jika admin, cek company code
            if ($user_data['role'] === 'admin' && $this->input->post('company_code') !== '868686') {
                $this->session->set_flashdata('error', 'Kode perusahaan untuk admin salah!');
                redirect(current_url().'?search='.urlencode($search).'&page='.$page);
            }
            // Validasi sederhana (bisa dikembangkan)
            if (!$user_data['first_name'] || !$user_data['last_name'] || !$user_data['email'] || !$user_data['username'] || !$user_data['password']) {
                $this->session->set_flashdata('error', 'Semua field wajib diisi!');
                redirect(current_url().'?search='.urlencode($search).'&page='.$page);
            }
            // Cek email/username unik
            if ($this->User_model->email_exists($user_data['email'])) {
                $this->session->set_flashdata('error', 'Email sudah terdaftar!');
                redirect(current_url().'?search='.urlencode($search).'&page='.$page);
            }
            if ($this->User_model->username_exists($user_data['username'])) {
                $this->session->set_flashdata('error', 'Username sudah terdaftar!');
                redirect(current_url().'?search='.urlencode($search).'&page='.$page);
            }
            $user_id = $this->User_model->register($user_data);
            if ($user_id) {
                $this->session->set_flashdata('success', 'User baru berhasil ditambahkan!');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambah user.');
            }
            redirect(current_url().'?search='.urlencode($search).'&page='.$page);
        }

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