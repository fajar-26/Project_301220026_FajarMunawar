<?php
class Challenge extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Challenge_model');
    }
    public function index() {
        $user = $this->session->userdata('user');
        $title = 'Challenge & Quiz - Money Mentor Pro';
        $this->load->view('challenge/index', ['user' => $user, 'title' => $title]);
    }
    public function quiz() {
        $user = $this->session->userdata('user');
        $title = 'Quiz Literasi Finansial - Money Mentor Pro';
        $this->load->view('challenge/quiz', ['user' => $user, 'title' => $title]);
    }
    public function leaderboard() {
        $user = $this->session->userdata('user');
        $leaderboard = $this->Challenge_model->get_leaderboard(20);
        $title = 'Leaderboard Challenge Bulanan - Money Mentor Pro';
        $this->load->view('challenge/leaderboard', ['user' => $user, 'leaderboard' => $leaderboard, 'title' => $title]);
    }
    public function result() {
        $user = $this->session->userdata('user');
        $title = 'Hasil Quiz - Money Mentor Pro';
        $this->load->view('challenge/result', ['user' => $user, 'title' => $title]);
    }
    public function quiz_interaktif() {
        $user = $this->session->userdata('user');
        $title = 'Quiz Literasi Keuangan & Investasi - Money Mentor Pro';
        $questions = [
            [
                'question' => 'Suppose you had $100 in a savings account and the interest rate was 2% per year. After five years, how much do you think you would have in the account if you left the money to grow?',
                'choices' => [
                    'A. More than $102',
                    'B. Exactly $102',
                    'C. Less than $102',
                    'D. Do not know',
                    'E. Refuse to answer',
                ],
                'answer' => 0
            ],
            [
                'question' => 'Imagine that the interest rate on your savings account was 1% per year and inflation was 2% per year. After one year, how much would you be able to buy with the money in this account?',
                'choices' => [
                    'A. More than today',
                    'B. Exactly the same',
                    'C. Less than today',
                    'D. Do not know',
                    'E. Refuse to answer',
                ],
                'answer' => 2
            ],
            [
                'question' => 'Please tell me whether this statement is true or false: “Buying a single company’s stock usually provides a safer return than a stock mutual fund.”',
                'choices' => [
                    'A. True',
                    'B. False',
                    'C. Do not know',
                    'D. Refuse to answer',
                ],
                'answer' => 1
            ],
            [
                'question' => 'If interest rates rise, what will typically happen to bond prices?',
                'choices' => [
                    'A. They will rise',
                    'B. They will fall',
                    'C. They will stay the same',
                    'D. There is no relationship',
                    'E. Don’t know',
                ],
                'answer' => 1
            ],
            [
                'question' => 'A 15-year mortgage typically requires higher monthly payments than a 30-year mortgage, but the total interest paid over the life of the loan will be less. True or False?',
                'choices' => [
                    'A. True',
                    'B. False',
                    'C. Don’t know',
                ],
                'answer' => 0
            ],
            [
                'question' => 'Suppose you owe $1,000 on a loan and the interest rate you are charged is 20% per year compounded annually. If you didn’t pay anything off, at this interest rate, how many years would it take for the amount you owe to double?',
                'choices' => [
                    'A. Less than 2 years',
                    'B. 2 to 4 years',
                    'C. 5 to 9 years',
                    'D. 10 or more years',
                ],
                'answer' => 1
            ],
            [
                'question' => 'Which of the following indicates the highest probability of getting a particular disease?',
                'choices' => [
                    'A. 25 out of every 1,000 people will get the disease',
                    'B. There is a one-in-twenty chance of getting the disease',
                    'C. 2% of the population will get the disease',
                ],
                'answer' => 1
            ],
        ];
        $this->load->view('challenge/quiz_interaktif', ['user' => $user, 'questions' => $questions, 'title' => $title]);
    }
    public function quiz_bulanan() {
        $user = $this->session->userdata('user');
        $title = 'Challenge Bulanan - Quiz Investasi - Money Mentor Pro';
        $questions = [
            [
                'question' => 'Jika kamu berinvestasi Rp1.000.000 di reksa dana saham dengan return 10% per tahun, berapa estimasi dana kamu setelah 1 tahun?',
                'choices' => [
                    'A. Rp1.100.000',
                    'B. Rp1.010.000',
                    'C. Rp1.200.000',
                    'D. Rp1.900.000',
                ],
                'answer' => 0
            ],
            [
                'question' => 'Manakah yang termasuk risiko utama investasi saham?',
                'choices' => [
                    'A. Harga naik terus',
                    'B. Harga turun drastis',
                    'C. Tidak ada risiko',
                    'D. Selalu untung',
                ],
                'answer' => 1
            ],
            [
                'question' => 'Jika kamu ingin investasi dengan risiko paling rendah, produk apa yang sebaiknya dipilih?',
                'choices' => [
                    'A. Saham',
                    'B. Reksa Dana Campuran',
                    'C. Obligasi Pemerintah',
                    'D. Bitcoin',
                ],
                'answer' => 2
            ],
            [
                'question' => 'Apa tujuan utama melakukan diversifikasi investasi?',
                'choices' => [
                    'A. Memaksimalkan risiko',
                    'B. Mengurangi risiko',
                    'C. Mengurangi keuntungan',
                    'D. Membayar pajak',
                ],
                'answer' => 1
            ],
            [
                'question' => 'Jika kamu ikut challenge bulanan dan mendapat skor tertinggi, apa yang kamu dapatkan?',
                'choices' => [
                    'A. Sertifikat',
                    'B. Hadiah & Ranking di Leaderboard',
                    'C. Tidak dapat apa-apa',
                    'D. Dapat hutang',
                ],
                'answer' => 1
            ],
        ];
        $this->load->view('challenge/quiz_bulanan', ['user' => $user, 'questions' => $questions, 'title' => $title]);
    }
    public function submit_quiz_bulanan() {
        if ($this->input->method() === 'post') {
            $user = $this->session->userdata('user');
            $user_id = isset($user['id']) ? $user['id'] : null;
            $user_name = isset($user['name']) ? $user['name'] : $this->input->post('user_name', true);
            $score = (int)$this->input->post('score');
            $total_questions = (int)$this->input->post('total_questions');
            if ($user_name && $score >= 0 && $total_questions > 0) {
                $this->Challenge_model->save_leaderboard($user_id, $user_name, $score, $total_questions);
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Data tidak lengkap']);
            }
        } else {
            show_404();
        }
    }
} 