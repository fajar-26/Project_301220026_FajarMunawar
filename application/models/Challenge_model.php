<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Challenge_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    // Simpan hasil quiz bulanan ke leaderboard
    public function save_leaderboard($user_id, $user_name, $score, $total_questions) {
        $this->db->insert('challenge_leaderboard', [
            'user_id' => $user_id,
            'user_name' => $user_name,
            'score' => $score,
            'total_questions' => $total_questions
        ]);
    }
    // Ambil data leaderboard (top skor, urutkan skor dan waktu)
    public function get_leaderboard($limit = 20) {
        return $this->db->order_by('score', 'DESC')
                        ->order_by('submitted_at', 'ASC')
                        ->limit($limit)
                        ->get('challenge_leaderboard')
                        ->result();
    }
} 