<?php $this->load->view('dashboard/header'); ?>
<div class="mb-4">
    <h2 class="fw-bold mb-2"><i class="fas fa-question-circle"></i> Quiz Literasi Keuangan & Investasi</h2>
    <p class="text-muted">Kerjakan soal-soal berikut untuk menguji pengetahuanmu tentang literasi keuangan dan investasi.</p>
</div>
<div id="quiz-app">
    <form id="quizForm">
        <div class="card mb-4">
            <div class="card-body">
                <div id="question-area"></div>
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-secondary" id="prevBtn" disabled>Sebelumnya</button>
                    <button type="button" class="btn btn-primary" id="nextBtn">Selanjutnya</button>
                    <button type="submit" class="btn btn-success d-none" id="submitBtn">Selesai & Lihat Skor</button>
                </div>
            </div>
        </div>
    </form>
    <div id="result-area" class="d-none"></div>
</div>
<script>
const questions = <?= json_encode($questions) ?>;
let current = 0;
let answers = Array(questions.length).fill(null);

function renderQuestion(idx) {
    const q = questions[idx];
    let html = `<b>Soal ${idx+1} dari ${questions.length}</b><br><div class='mt-2 mb-2'>${q.question}</div>`;
    q.choices.forEach((c, i) => {
        html += `<div class='form-check'>
            <input class='form-check-input' type='radio' name='q' id='q${i}' value='${i}' ${answers[idx] == i ? 'checked' : ''}>
            <label class='form-check-label' for='q${i}'>${c}</label>
        </div>`;
    });
    document.getElementById('question-area').innerHTML = html;
    document.getElementById('prevBtn').disabled = idx === 0;
    document.getElementById('nextBtn').classList.toggle('d-none', idx === questions.length-1);
    document.getElementById('submitBtn').classList.toggle('d-none', idx !== questions.length-1);
}

document.addEventListener('DOMContentLoaded', function() {
    renderQuestion(current);
    document.getElementById('prevBtn').onclick = function() {
        if(current > 0) { current--; renderQuestion(current); }
    };
    document.getElementById('nextBtn').onclick = function() {
        if(current < questions.length-1) { current++; renderQuestion(current); }
    };
    document.getElementById('question-area').addEventListener('change', function(e) {
        if(e.target.name === 'q') answers[current] = parseInt(e.target.value);
    });
    document.getElementById('quizForm').onsubmit = function(e) {
        e.preventDefault();
        // Hitung skor
        let score = 0;
        let review = '';
        for(let i=0; i<questions.length; i++) {
            if(answers[i] === questions[i].answer) score++;
        }
        review += `<div class='alert alert-success'>Skor Anda: <b>${score} / ${questions.length}</b></div>`;
        review += '<h5>Review Jawaban:</h5><ol>';
        for(let i=0; i<questions.length; i++) {
            let benar = answers[i] === questions[i].answer;
            review += `<li>${questions[i].question}<br>`;
            review += `<span class='${benar ? 'text-success' : 'text-danger'}'>Jawaban Anda: ${answers[i] !== null ? questions[i].choices[answers[i]] : '<i>Belum dijawab</i>'}</span><br>`;
            if(!benar) {
                review += `<span class='text-success'>Kunci Jawaban: ${questions[i].choices[questions[i].answer]}</span>`;
            }
            review += '</li>';
        }
        review += '</ol>';
        if(score === questions.length) {
            review += `<div class='alert alert-info'><i class='fas fa-certificate'></i> Selamat! Anda lulus dan berhak mendapatkan sertifikat.</div>`;
        }
        document.getElementById('quizForm').classList.add('d-none');
        document.getElementById('result-area').classList.remove('d-none');
        document.getElementById('result-area').innerHTML = review;
    };
});
</script>
<?php $this->load->view('dashboard/footer'); ?> 