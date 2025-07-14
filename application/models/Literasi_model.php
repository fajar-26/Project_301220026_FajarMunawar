<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Literasi_model extends CI_Model {
    // Bookmark
    public function is_bookmarked($user_id, $article_id) {
        return $this->db->where('user_id', $user_id)->where('article_id', $article_id)->get('bookmarks')->num_rows() > 0;
    }
    public function add_bookmark($user_id, $article_id) {
        return $this->db->insert('bookmarks', [
            'user_id' => $user_id,
            'article_id' => $article_id
        ]);
    }
    public function remove_bookmark($user_id, $article_id) {
        return $this->db->where('user_id', $user_id)->where('article_id', $article_id)->delete('bookmarks');
    }
    // Rating
    public function get_rating($article_id) {
        $this->db->select_avg('rating', 'avg_rating');
        $this->db->where('article_id', $article_id);
        $row = $this->db->get('article_ratings')->row();
        return $row ? round($row->avg_rating,1) : 0;
    }
    public function get_user_rating($user_id, $article_id) {
        $row = $this->db->where('user_id', $user_id)->where('article_id', $article_id)->get('article_ratings')->row();
        return $row ? $row->rating : 0;
    }
    public function set_rating($user_id, $article_id, $rating) {
        if ($this->get_user_rating($user_id, $article_id)) {
            $this->db->where('user_id', $user_id)->where('article_id', $article_id)->update('article_ratings', ['rating' => $rating]);
        } else {
            $this->db->insert('article_ratings', [
                'user_id' => $user_id,
                'article_id' => $article_id,
                'rating' => $rating
            ]);
        }
    }
    // Komentar
    public function get_comments($article_id) {
        $this->db->select('article_comments.*, users.first_name, users.last_name');
        $this->db->from('article_comments');
        $this->db->join('users', 'users.id = article_comments.user_id', 'left');
        $this->db->where('article_id', $article_id);
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get()->result();
    }
    public function add_comment($user_id, $article_id, $comment) {
        return $this->db->insert('article_comments', [
            'user_id' => $user_id,
            'article_id' => $article_id,
            'comment' => $comment
        ]);
    }
} 