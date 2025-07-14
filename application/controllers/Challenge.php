<?php
class Challenge extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Challenge_model');
    }
    public function index() {
        $this->load->view('challenge/index');
    }
    public function quiz() {
        $this->load->view('challenge/quiz');
    }
    public function leaderboard() {
        $this->load->view('challenge/leaderboard');
    }
    public function result() {
        $this->load->view('challenge/result');
    }
} 