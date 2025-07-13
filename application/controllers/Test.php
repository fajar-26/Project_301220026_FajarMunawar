<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        echo "<h1>Money Mentor Pro - Database Connection Test</h1>";
        
        // Test database connection
        if ($this->db->simple_query('SELECT 1')) {
            echo "<p style='color: green;'>✅ Database connection successful!</p>";
            
            // Test if tables exist
            $tables = $this->db->list_tables();
            echo "<h3>Available Tables:</h3>";
            echo "<ul>";
            foreach ($tables as $table) {
                echo "<li>📋 " . $table . "</li>";
            }
            echo "</ul>";
            
            // Test users table
            $users_count = $this->db->count_all('users');
            echo "<p>👥 Total users in database: <strong>" . $users_count . "</strong></p>";
            
            // Test categories table
            $categories_count = $this->db->count_all('categories');
            echo "<p>📂 Total categories in database: <strong>" . $categories_count . "</strong></p>";
            
            // Test articles table
            $articles_count = $this->db->count_all('articles');
            echo "<p>📄 Total articles in database: <strong>" . $articles_count . "</strong></p>";
            
        } else {
            echo "<p style='color: red;'>❌ Database connection failed!</p>";
            echo "<p>Error: " . $this->db->error()['message'] . "</p>";
        }
        
        // Test session
        echo "<h3>Session Test:</h3>";
        $this->session->set_userdata('test_session', 'Hello from Money Mentor Pro!');
        $session_data = $this->session->userdata('test_session');
        if ($session_data) {
            echo "<p style='color: green;'>✅ Session working: " . $session_data . "</p>";
        } else {
            echo "<p style='color: red;'>❌ Session not working!</p>";
        }
        
        echo "<hr>";
        echo "<p><strong>🎉 Money Mentor Pro is ready to use!</strong></p>";
        echo "<p><a href='" . base_url() . "'>Go to Homepage</a></p>";
    }
} 