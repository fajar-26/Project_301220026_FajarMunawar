<?php
class Challenge extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Challenge_model');
    }
    public function index() {
        $user = $this->session->userdata('user');
        $this->load->view('challenge/index', ['user' => $user]);
    }
    public function quiz() {
        $user = $this->session->userdata('user');
        $this->load->view('challenge/quiz', ['user' => $user]);
    }
    public function leaderboard() {
        $user = $this->session->userdata('user');
        $this->load->view('challenge/leaderboard', ['user' => $user]);
    }
    public function result() {
        $user = $this->session->userdata('user');
        $this->load->view('challenge/result', ['user' => $user]);
    }
} 