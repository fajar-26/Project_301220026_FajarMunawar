<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'users';
    }

    // =====================================================
    // AUTHENTICATION METHODS
    // =====================================================

    /**
     * Login user dengan email/username dan password
     */
    public function login($email_or_username, $password) {
        $this->db->where('(email = ? OR username = ?)', array($email_or_username, $email_or_username));
        $this->db->where('is_active', 1);
        $user = $this->db->get($this->table)->row();

        if ($user && password_verify($password, $user->password)) {
            // Update last login
            $this->db->where('id', $user->id);
            $this->db->update($this->table, array('last_login' => date('Y-m-d H:i:s')));
            
            return $user;
        }
        return false;
    }

    /**
     * Register user baru
     */
    public function register($data) {
        // Hash password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        
        // Set default values
        $data['is_active'] = 1;
        $data['is_verified'] = 0;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        // Insert user
        if ($this->db->insert($this->table, $data)) {
            $user_id = $this->db->insert_id();
            
            // Create user preferences
            $this->create_user_preferences($user_id);
            
            return $user_id;
        }
        return false;
    }

    /**
     * Cek apakah email sudah terdaftar
     */
    public function email_exists($email, $exclude_id = null) {
        if ($exclude_id) {
            $this->db->where('id !=', $exclude_id);
        }
        $this->db->where('email', $email);
        return $this->db->get($this->table)->num_rows() > 0;
    }

    /**
     * Cek apakah username sudah terdaftar
     */
    public function username_exists($username, $exclude_id = null) {
        if ($exclude_id) {
            $this->db->where('id !=', $exclude_id);
        }
        $this->db->where('username', $username);
        return $this->db->get($this->table)->num_rows() > 0;
    }

    /**
     * Get user by ID
     */
    public function get_user_by_id($id) {
        return $this->db->where('id', $id)->get($this->table)->row();
    }

    /**
     * Get user by email
     */
    public function get_user_by_email($email) {
        return $this->db->where('email', $email)->get($this->table)->row();
    }

    /**
     * Update user data
     */
    public function update_user($id, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    /**
     * Update password
     */
    public function update_password($id, $new_password) {
        $data = array(
            'password' => password_hash($new_password, PASSWORD_DEFAULT),
            'updated_at' => date('Y-m-d H:i:s')
        );
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    /**
     * Create user preferences
     */
    private function create_user_preferences($user_id) {
        $preferences = array(
            'user_id' => $user_id,
            'preferred_categories' => json_encode(array()),
            'investment_goals' => json_encode(array()),
            'risk_tolerance' => 'medium',
            'notification_email' => 1,
            'notification_push' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        return $this->db->insert('user_preferences', $preferences);
    }

    /**
     * Get user preferences
     */
    public function get_user_preferences($user_id) {
        return $this->db->where('user_id', $user_id)->get('user_preferences')->row();
    }

    /**
     * Update user preferences
     */
    public function update_user_preferences($user_id, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->where('user_id', $user_id)->update('user_preferences', $data);
    }

    /**
     * Generate reset token
     */
    public function generate_reset_token($email) {
        $user = $this->get_user_by_email($email);
        if (!$user) return false;

        $token = bin2hex(random_bytes(32));
        $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $data = array(
            'reset_token' => $token,
            'reset_expires' => $expires,
            'updated_at' => date('Y-m-d H:i:s')
        );

        if ($this->update_user($user->id, $data)) {
            return array(
                'user' => $user,
                'token' => $token,
                'expires' => $expires
            );
        }
        return false;
    }

    /**
     * Verify reset token
     */
    public function verify_reset_token($token) {
        $this->db->where('reset_token', $token);
        $this->db->where('reset_expires >', date('Y-m-d H:i:s'));
        return $this->db->get($this->table)->row();
    }

    /**
     * Clear reset token
     */
    public function clear_reset_token($user_id) {
        $data = array(
            'reset_token' => null,
            'reset_expires' => null,
            'updated_at' => date('Y-m-d H:i:s')
        );
        return $this->db->where('id', $user_id)->update($this->table, $data);
    }

    /**
     * Get user statistics
     */
    public function get_user_stats($user_id) {
        $stats = array();
        
        // Articles read
        $stats['articles_read'] = $this->db->where('user_id', $user_id)
                                          ->where('content_type', 'article')
                                          ->count_all_results('reading_history');
        
        // Bookmarks
        $stats['bookmarks'] = $this->db->where('user_id', $user_id)
                                      ->count_all_results('bookmarks');
        
        // Simulations
        $stats['simulations'] = $this->db->where('user_id', $user_id)
                                        ->count_all_results('simulations');
        
        // Quiz attempts
        $stats['quiz_attempts'] = $this->db->where('user_id', $user_id)
                                          ->count_all_results('quiz_attempts');
        
        return $stats;
    }
} 