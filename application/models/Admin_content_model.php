<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_content_model extends CI_Model {
    // Ambil daftar artikel
    public function get_articles($limit = 20, $offset = 0) {
        $this->db->select('articles.*, categories.name as category_name');
        $this->db->from('articles');
        $this->db->join('categories', 'categories.id = articles.category_id', 'left');
        $this->db->order_by('articles.created_at', 'DESC');
        return $this->db->get('', $limit, $offset)->result();
    }
    public function count_articles() {
        return $this->db->count_all('articles');
    }
    // Ambil daftar video
    public function get_videos($limit = 20, $offset = 0) {
        $this->db->select('videos.*, categories.name as category_name');
        $this->db->from('videos');
        $this->db->join('categories', 'categories.id = videos.category_id', 'left');
        $this->db->order_by('videos.created_at', 'DESC');
        return $this->db->get('', $limit, $offset)->result();
    }
    public function count_videos() {
        return $this->db->count_all('videos');
    }
    // Ambil daftar kategori
    public function get_categories($limit = 20, $offset = 0) {
        $this->db->order_by('name', 'ASC');
        return $this->db->get('categories', $limit, $offset)->result();
    }
    public function count_categories() {
        return $this->db->count_all('categories');
    }
    // Ambil daftar webinar
    public function get_webinars($limit = 20, $offset = 0) {
        $this->db->order_by('webinar_date', 'DESC');
        return $this->db->get('webinars', $limit, $offset)->result();
    }
    public function count_webinars() {
        return $this->db->count_all('webinars');
    }
} 