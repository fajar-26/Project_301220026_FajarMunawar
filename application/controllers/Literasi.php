<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Literasi extends CI_Controller {
    public function index() {
        $this->load->model('Admin_content_model');
        $search = $this->input->get('q') ?? '';
        $category = $this->input->get('kategori') ?? '';
        $data['title'] = 'Literasi Finansial';
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
} 