<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        
        // Redirect jika sudah login
        if ($this->session->userdata('user_id') && $this->router->fetch_method() != 'logout') {
            redirect('dashboard');
        }
    }

    // =====================================================
    // LOGIN METHODS
    // =====================================================

    /**
     * Halaman login
     */
    public function index() {
        $data['title'] = 'Login - Money Mentor Pro';
        $data['page'] = 'login';
        
        $this->load->view('auth/header', $data);
        $this->load->view('auth/login');
        $this->load->view('auth/footer');
    }

    /**
     * Proses login
     */
    public function login() {
        // Validasi input
        $this->form_validation->set_rules('email', 'Email/Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $remember = $this->input->post('remember');

            // Coba login
            $user = $this->User_model->login($email, $password);

            if ($user) {
                // Set session data
                $session_data = array(
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'email' => $user->email,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'investment_experience' => $user->investment_experience,
                    'is_admin' => ($user->username == 'admin'),
                    'logged_in' => TRUE
                );

                $this->session->set_userdata($session_data);

                // Set remember me cookie
                if ($remember) {
                    $this->session->set_userdata('remember_me', TRUE);
                }

                // Redirect ke dashboard
                $this->session->set_flashdata('success', 'Selamat datang kembali, ' . $user->first_name . '!');
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'Email/Username atau password salah!');
                redirect('auth');
            }
        }
    }

    // =====================================================
    // REGISTER METHODS
    // =====================================================

    /**
     * Halaman register
     */
    public function register() {
        $data['title'] = 'Register - Money Mentor Pro';
        $data['page'] = 'register';
        
        $this->load->view('auth/header', $data);
        $this->load->view('auth/register');
        $this->load->view('auth/footer');
    }

    /**
     * Proses register
     */
    public function register_process() {
        // Validasi input
        $this->form_validation->set_rules('first_name', 'Nama Depan', 'required|trim|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('last_name', 'Nama Belakang', 'required|trim|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[3]|max_length[50]|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('phone', 'Nomor Telepon', 'trim|min_length[10]|max_length[15]');
        $this->form_validation->set_rules('birth_date', 'Tanggal Lahir', 'trim');
        $this->form_validation->set_rules('investment_experience', 'Pengalaman Investasi', 'required|in_list[beginner,intermediate,advanced]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|trim|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->register();
        } else {
            // Prepare user data
            $user_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'birth_date' => $this->input->post('birth_date') ? $this->input->post('birth_date') : null,
                'investment_experience' => $this->input->post('investment_experience'),
                'password' => $this->input->post('password')
            );

            // Register user
            $user_id = $this->User_model->register($user_data);

            if ($user_id) {
                $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login dengan akun Anda.');
                redirect('auth');
            } else {
                $this->session->set_flashdata('error', 'Terjadi kesalahan saat registrasi. Silakan coba lagi.');
                redirect('auth/register');
            }
        }
    }

    // =====================================================
    // FORGOT PASSWORD METHODS
    // =====================================================

    /**
     * Halaman forgot password
     */
    public function forgot_password() {
        $data['title'] = 'Lupa Password - Money Mentor Pro';
        $data['page'] = 'forgot_password';
        
        $this->load->view('auth/header', $data);
        $this->load->view('auth/forgot_password');
        $this->load->view('auth/footer');
    }

    /**
     * Proses forgot password
     */
    public function forgot_password_process() {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->forgot_password();
        } else {
            $email = $this->input->post('email');
            
            // Generate reset token
            $reset_data = $this->User_model->generate_reset_token($email);

            if ($reset_data) {
                // Kirim email reset password (implementasi email akan dibuat nanti)
                $reset_link = base_url('auth/reset_password/' . $reset_data['token']);
                
                // Untuk sementara, tampilkan link reset
                $this->session->set_flashdata('success', 'Link reset password telah dikirim ke email Anda. 
                    <br>Link: <a href="' . $reset_link . '">' . $reset_link . '</a>');
                redirect('auth');
            } else {
                $this->session->set_flashdata('error', 'Email tidak ditemukan dalam sistem.');
                redirect('auth/forgot_password');
            }
        }
    }

    /**
     * Halaman reset password
     */
    public function reset_password($token = null) {
        if (!$token) {
            redirect('auth');
        }

        // Verify token
        $user = $this->User_model->verify_reset_token($token);
        if (!$user) {
            $this->session->set_flashdata('error', 'Token reset password tidak valid atau sudah kadaluarsa.');
            redirect('auth');
        }

        $data['title'] = 'Reset Password - Money Mentor Pro';
        $data['page'] = 'reset_password';
        $data['token'] = $token;
        $data['user'] = $user;
        
        $this->load->view('auth/header', $data);
        $this->load->view('auth/reset_password', $data);
        $this->load->view('auth/footer');
    }

    /**
     * Proses reset password
     */
    public function reset_password_process() {
        $token = $this->input->post('token');
        $password = $this->input->post('password');
        $confirm_password = $this->input->post('confirm_password');

        // Validasi
        $this->form_validation->set_rules('password', 'Password Baru', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|trim|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->reset_password($token);
        } else {
            // Verify token
            $user = $this->User_model->verify_reset_token($token);
            if (!$user) {
                $this->session->set_flashdata('error', 'Token reset password tidak valid atau sudah kadaluarsa.');
                redirect('auth');
            }

            // Update password
            if ($this->User_model->update_password($user->id, $password)) {
                // Clear reset token
                $this->User_model->clear_reset_token($user->id);
                
                $this->session->set_flashdata('success', 'Password berhasil diubah! Silakan login dengan password baru.');
                redirect('auth');
            } else {
                $this->session->set_flashdata('error', 'Terjadi kesalahan saat mengubah password.');
                redirect('auth/reset_password/' . $token);
            }
        }
    }

    // =====================================================
    // LOGOUT METHOD
    // =====================================================

    /**
     * Logout user
     */
    public function logout() {
        // Clear session
        $this->session->sess_destroy();
        
        // Clear remember me cookie
        delete_cookie('remember_me');
        
        $this->session->set_flashdata('success', 'Anda berhasil logout.');
        redirect('auth');
    }

    // =====================================================
    // AJAX METHODS
    // =====================================================

    /**
     * Check email availability (AJAX)
     */
    public function check_email() {
        $email = $this->input->post('email');
        $exists = $this->User_model->email_exists($email);
        
        echo json_encode(array('exists' => $exists));
    }

    /**
     * Check username availability (AJAX)
     */
    public function check_username() {
        $username = $this->input->post('username');
        $exists = $this->User_model->username_exists($username);
        
        echo json_encode(array('exists' => $exists));
    }
} 