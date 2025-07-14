<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Literasi extends CI_Controller {
    public function index() {
        $this->load->model('Admin_content_model');
        $search = $this->input->get('q') ?? '';
        $category = $this->input->get('kategori') ?? '';
        $data['title'] = 'Literasi Finansial';
        $data['user'] = array(
            'name' => $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'),
            'email' => $this->session->userdata('email'),
            'experience' => $this->session->userdata('investment_experience')
        );
        $data['categories'] = $this->Admin_content_model->get_categories(100, 0);
        // Filter artikel
        $this->db->select('articles.*, categories.name as category_name');
        $this->db->from('articles');
        $this->db->join('categories', 'categories.id = articles.category_id', 'left');
        if ($search) {
            $this->db->like('articles.title', $search);
            $this->db->or_like('articles.content', $search);
        }
        if ($category) {
            $this->db->where('categories.id', $category);
        }
        $this->db->where('articles.status', 'published');
        $this->db->order_by('articles.created_at', 'DESC');
        $data['articles'] = $this->db->get()->result();
        $data['selected_category'] = $category;
        $data['search'] = $search;
        $this->load->view('dashboard/header', $data);
        $this->load->view('literasi/index', $data);
        $this->load->view('dashboard/footer');
    }

    public function detail($id) {
        $this->load->model('Admin_content_model');
        $this->load->model('Literasi_model');
        $data['title'] = 'Detail Artikel';
        $data['user'] = array(
            'name' => $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'),
            'email' => $this->session->userdata('email'),
            'experience' => $this->session->userdata('investment_experience'),
            'id' => $this->session->userdata('user_id')
        );
        $user_id = $this->session->userdata('user_id');
        $is_logged_in = $user_id ? true : false;
        $this->db->select('articles.*, categories.name as category_name');
        $this->db->from('articles');
        $this->db->join('categories', 'categories.id = articles.category_id', 'left');
        $this->db->where('articles.id', $id);
        $this->db->where('articles.status', 'published');
        $article = $this->db->get()->row();
        if (!$article) {
            show_404();
        }
        // Handle bookmark
        if ($is_logged_in && $this->input->post('bookmark')) {
            if ($this->Literasi_model->is_bookmarked($user_id, $id)) {
                $this->Literasi_model->remove_bookmark($user_id, $id);
            } else {
                $this->Literasi_model->add_bookmark($user_id, $id);
            }
            redirect(current_url());
        }
        // Handle rating
        if ($is_logged_in && $this->input->post('rating')) {
            $rating = (int)$this->input->post('rating');
            if ($rating >= 1 && $rating <= 5) {
                $this->Literasi_model->set_rating($user_id, $id, $rating);
            }
            redirect(current_url());
        }
        // Handle komentar
        if ($is_logged_in && $this->input->post('add_comment')) {
            $comment = trim($this->input->post('comment'));
            if ($comment) {
                $this->Literasi_model->add_comment($user_id, $id, $comment);
            }
            redirect(current_url().'#komentar');
        }
        $data['article'] = $article;
        $data['is_bookmarked'] = $is_logged_in ? $this->Literasi_model->is_bookmarked($user_id, $id) : false;
        $data['avg_rating'] = $this->Literasi_model->get_rating($id);
        $data['user_rating'] = $is_logged_in ? $this->Literasi_model->get_user_rating($user_id, $id) : 0;
        $data['comments'] = $this->Literasi_model->get_comments($id);
        $data['is_logged_in'] = $is_logged_in;
        $this->load->view('dashboard/header', $data);
        $this->load->view('literasi/detail', $data);
        $this->load->view('dashboard/footer');
    }
} 