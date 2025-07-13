<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_user_model extends CI_Model {
    protected $table = 'users';

    public function get_all_users($search = '', $limit = 20, $offset = 0) {
        if ($search) {
            $this->db->group_start();
            $this->db->like('first_name', $search);
            $this->db->or_like('last_name', $search);
            $this->db->or_like('email', $search);
            $this->db->or_like('username', $search);
            $this->db->group_end();
        }
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get($this->table, $limit, $offset)->result();
    }

    public function count_all_users($search = '') {
        if ($search) {
            $this->db->group_start();
            $this->db->like('first_name', $search);
            $this->db->or_like('last_name', $search);
            $this->db->or_like('email', $search);
            $this->db->or_like('username', $search);
            $this->db->group_end();
        }
        return $this->db->count_all_results($this->table);
    }

    public function update_status($user_id, $is_active) {
        return $this->db->where('id', $user_id)->update($this->table, ['is_active' => $is_active]);
    }

    public function reset_password($user_id, $new_password = 'user12345') {
        $hash = password_hash($new_password, PASSWORD_DEFAULT);
        return $this->db->where('id', $user_id)->update($this->table, ['password' => $hash]);
    }
} 