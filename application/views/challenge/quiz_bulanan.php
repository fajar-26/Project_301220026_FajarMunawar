<?php $this->load->view('dashboard/header'); ?>
<div class="mb-4">
    <h2 class="fw-bold mb-2"><i class="fas fa-flag-checkered"></i> Challenge Bulanan - Quiz Investasi</h2>
    <p class="text-muted">Kerjakan soal-soal berikut untuk ikut challenge bulanan. Raih skor tertinggi dan menangkan hadiah di leaderboard!</p>
</div>
<div id="quiz-bulanan-app">
    <form id="quizBulananForm">
        <div class="card mb-4">
            <div class="card-body">
                <div id="question-bulanan-area"></div>
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-secondary" id="prevBulananBtn" disabled>Sebelumnya</button>
                    <button type="button" class="btn btn-primary" id="nextBulananBtn">Selanjutnya</button>
                    <button type="submit" class="btn btn-success d-none" id="submitBulananBtn">Selesai & Lihat Skor</button>
                </div>
            </div>
        </div>
    </form>
    <div id="result-bulanan-area" class="d-none"></div>
</div>
<script>
const questionsBulanan = <?= json_encode($questions) ?>;
let currentB = 0;
let answersB = Array(questionsBulanan.length).fill(null);
let scoreB = 0;

document.addEventListener('DOMContentLoaded', function() {
    renderQuestionBulanan(currentB);
    document.getElementById('prevBulananBtn').onclick = function() {
        if(currentB > 0) { currentB--; renderQuestionBulanan(currentB); }
    };
    document.getElementById('nextBulananBtn').onclick = function() {
        if(currentB < questionsBulanan.length-1) { currentB++; renderQuestionBulanan(currentB); }
    };
    document.getElementById('question-bulanan-area').addEventListener('change', function(e) {
        if(e.target.name === 'qB') answersB[currentB] = parseInt(e.target.value);
    });
    document.getElementById('quizBulananForm').onsubmit = function(e) {
        e.preventDefault();
        scoreB = 0;
        let review = '';
        for(let i=0; i<questionsBulanan.length; i++) {
            if(answersB[i] === questionsBulanan[i].answer) scoreB++;
        }
        review += `<div class='alert alert-success'>Skor Anda: <b>${scoreB} / ${questionsBulanan.length}</b></div>`;
        review += `<div class='mb-2'><b>Status: </b> <span class='badge bg-${scoreB >= 4 ? 'success' : 'danger'}'>${scoreB >= 4 ? 'Peluang Menang!' : 'Coba Lagi Bulan Depan'}</span></div>`;
        review += '<h5>Review Jawaban:</h5><ol>';
        for(let i=0; i<questionsBulanan.length; i++) {
            let benar = answersB[i] === questionsBulanan[i].answer;
            review += `<li>${questionsBulanan[i].question}<br>`;
            review += `<span class='${benar ? 'text-success' : 'text-danger'}'>Jawaban Anda: ${answersB[i] !== null ? questionsBulanan[i].choices[answersB[i]] : '<i>Belum dijawab</i>'}</span><br>`;
            if(!benar) {
                review += `<span class='text-success'>Kunci Jawaban: ${questionsBulanan[i].choices[questionsBulanan[i].answer]}</span>`;
            }
            review += '</li>';
        }
        review += '</ol>';
        if(scoreB >= 4) {
            review += `<div class='alert alert-info'>Skor Anda tinggi! Cek leaderboard untuk melihat ranking Anda.</div>`;
        }
        document.getElementById('quizBulananForm').classList.add('d-none');
        document.getElementById('result-bulanan-area').classList.remove('d-none');
        document.getElementById('result-bulanan-area').innerHTML = review;
    };
});
function renderQuestionBulanan(idx) {
    const q = questionsBulanan[idx];
    let html = `<b>Soal ${idx+1} dari ${questionsBulanan.length}</b><br><div class='mt-2 mb-2'>${q.question}</div>`;
    q.choices.forEach((c, i) => {
        html += `<div class='form-check'>
            <input class='form-check-input' type='radio' name='qB' id='qB${i}' value='${i}' ${answersB[idx] == i ? 'checked' : ''}>
            <label class='form-check-label' for='qB${i}'>${c}</label>
        </div>`;
    });
    document.getElementById('question-bulanan-area').innerHTML = html;
    document.getElementById('prevBulananBtn').disabled = idx === 0;
    document.getElementById('nextBulananBtn').classList.toggle('d-none', idx === questionsBulanan.length-1);
    document.getElementById('submitBulananBtn').classList.toggle('d-none', idx !== questionsBulanan.length-1);
}
</script>
<?php $this->load->view('dashboard/footer'); ?> 