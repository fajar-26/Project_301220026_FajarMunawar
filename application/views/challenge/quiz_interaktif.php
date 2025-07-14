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
    <div class="text-center mt-4 mb-5 d-none" id="sertifikat-btn-area">
        <button class="btn btn-outline-success" id="downloadSertifikat"><i class="fas fa-certificate"></i> Download Sertifikat</button>
    </div>
    <div id="sertifikat-area" style="visibility:hidden;position:absolute;left:-9999px;"></div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
const questions = <?= json_encode($questions) ?>;
let current = 0;
let answers = Array(questions.length).fill(null);
let score = 0;
let statusLulus = false;

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
        score = 0;
        let review = '';
        for(let i=0; i<questions.length; i++) {
            if(answers[i] === questions[i].answer) score++;
        }
        statusLulus = score >= 5;
        review += `<div class='alert alert-success'>Skor Anda: <b>${score} / ${questions.length}</b></div>`;
        review += `<div class='mb-2'><b>Status: </b> <span class='badge bg-${statusLulus ? 'success' : 'danger'}'>${statusLulus ? 'Lulus' : 'Tidak Lulus'}</span></div>`;
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
        document.getElementById('quizForm').classList.add('d-none');
        document.getElementById('result-area').classList.remove('d-none');
        document.getElementById('result-area').innerHTML = review;
        document.getElementById('sertifikat-btn-area').classList.remove('d-none');
    };
    document.getElementById('downloadSertifikat').onclick = function() {
        // Generate sertifikat
        let nama = <?= json_encode(isset($user['name']) ? $user['name'] : 'Guest') ?>;
        let tgl = new Date().toLocaleDateString('id-ID');
        let html = `<div style='width:600px;min-height:350px;border:8px double #4caf50;padding:32px 24px;text-align:center;font-family:sans-serif;background:#fff;'>`+
            `<h2 style='color:#4caf50;margin-bottom:0;'>SERTIFIKAT KELULUSAN</h2>`+
            `<div style='font-size:18px;margin-bottom:16px;'>Quiz Literasi Keuangan & Investasi</div>`+
            `<div style='margin:24px 0 16px 0;'>Diberikan kepada</div>`+
            `<div style='font-size:28px;font-weight:bold;margin-bottom:8px;'>${nama}</div>`+
            `<div style='margin-bottom:16px;'>Atas partisipasi dan pencapaian skor <b>${score} / ${questions.length}</b></div>`+
            `<div style='margin-bottom:16px;'>Status: <span style='color:${statusLulus ? '#388e3c' : '#d32f2f'};font-weight:bold;'>${statusLulus ? 'Lulus' : 'Tidak Lulus'}</span></div>`+
            `<div style='margin-bottom:16px;'>Tanggal: ${tgl}</div>`+
            `<div style='font-size:14px;color:#888;'>Money Mentor Pro</div>`+
            `</div>`;
        document.getElementById('sertifikat-area').innerHTML = html;
        setTimeout(function() {
            html2pdf(document.getElementById('sertifikat-area'), {margin:0, filename:'Sertifikat_Quiz_Literasi.pdf', html2canvas:{scale:2}, jsPDF:{orientation:'landscape'}});
        }, 300);
    };
});
</script>
<?php $this->load->view('dashboard/footer'); ?> 