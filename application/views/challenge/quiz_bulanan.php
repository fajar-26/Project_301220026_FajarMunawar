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
    <div class="text-center mt-4 mb-5 d-none" id="btn-kembali-quiz">
        <a href="<?= base_url('challenge/quiz') ?>" class="btn btn-outline-primary"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard Quiz</a>
    </div>
    <div id="input-nama-area" class="d-none mt-4">
        <div class="card card-body">
            <label>Masukkan Nama Anda untuk Leaderboard:</label>
            <input type="text" id="input-nama-user" class="form-control mb-2" maxlength="100" required>
            <button class="btn btn-success" id="submit-nama-user">Submit</button>
        </div>
    </div>
</div>
<script>
const questionsBulanan = <?= json_encode($questions) ?>;
let currentB = 0;
let answersB = Array(questionsBulanan.length).fill(null);
let scoreB = 0;
let userName = <?= json_encode(isset($user['name']) ? $user['name'] : null) ?>;

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
        for(let i=0; i<questionsBulanan.length; i++) {
            if(answersB[i] === questionsBulanan[i].answer) scoreB++;
        }
        if(!userName) {
            document.getElementById('input-nama-area').classList.remove('d-none');
            document.getElementById('result-bulanan-area').classList.add('d-none');
            document.getElementById('quizBulananForm').classList.add('d-none');
        } else {
            submitLeaderboard(userName);
        }
    };
    document.getElementById('submit-nama-user').onclick = function() {
        const nama = document.getElementById('input-nama-user').value.trim();
        if(nama.length < 2) {
            alert('Nama harus diisi minimal 2 karakter');
            return;
        }
        userName = nama;
        submitLeaderboard(userName);
    };
});
function submitLeaderboard(nama) {
    fetch('<?= base_url('challenge/submit_quiz_bulanan') ?>', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `user_name=${encodeURIComponent(nama)}&score=${scoreB}&total_questions=${questionsBulanan.length}`
    })
    .then(res => res.json())
    .then(data => {
        let review = `<div class='alert alert-success'>Skor Anda: <b>${scoreB} / ${questionsBulanan.length}</b></div>`;
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
        if(data.success) {
            review += `<div class='alert alert-success mt-3'>Hasil Anda berhasil disimpan ke leaderboard!</div>`;
        } else {
            review += `<div class='alert alert-danger mt-3'>Gagal menyimpan ke leaderboard. ${data.error ? data.error : ''}</div>`;
        }
        document.getElementById('quizBulananForm').classList.add('d-none');
        document.getElementById('input-nama-area').classList.add('d-none');
        document.getElementById('result-bulanan-area').classList.remove('d-none');
        document.getElementById('result-bulanan-area').innerHTML = review;
        document.getElementById('btn-kembali-quiz').classList.remove('d-none');
    });
}
</script>
<?php $this->load->view('dashboard/footer'); ?> 