<?php $this->load->view('dashboard/header'); ?>
<div class="mb-4">
    <h2 class="fw-bold mb-2"><i class="fas fa-question-circle"></i> Quiz Literasi Finansial</h2>
    <p class="text-muted">Kerjakan pertanyaan multiple choice, dapatkan skor, dan review jawabanmu di akhir quiz.</p>
</div>
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <b>Daftar Quiz</b>
    </div>
    <div class="card-body">
        <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Quiz Dasar Investasi
                <a href="<?= base_url('challenge/quiz_interaktif') ?>" class="btn btn-success btn-sm">Mulai</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Quiz Risiko & Return
                <a href="<?= base_url('challenge/quiz_interaktif') ?>" class="btn btn-success btn-sm">Mulai</a>
            </li>
        </ul>
        <div class="alert alert-info mb-0">Fitur quiz interaktif akan segera tersedia di sini.<br>Contoh tampilan quiz:<br>
            <b>Soal 1 dari 3</b> <span class="badge bg-secondary">Timer: 00:30</span><br>
            <div class="mt-2">
                <b>Apa itu investasi?</b><br>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="q1" id="q1a" disabled>
                    <label class="form-check-label" for="q1a">A. Menyimpan uang di bawah bantal</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="q1" id="q1b" disabled>
                    <label class="form-check-label" for="q1b">B. Menanamkan dana untuk memperoleh keuntungan</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="q1" id="q1c" disabled>
                    <label class="form-check-label" for="q1c">C. Membelanjakan seluruh penghasilan</label>
                </div>
            </div>
            <button class="btn btn-primary btn-sm mt-3" disabled>Selanjutnya</button>
            <hr>
            <b>Setelah submit:</b><br>
            <div class="alert alert-success">Skor Anda: <b>100</b></div>
            <div class="alert alert-warning">Jawaban salah: Soal 1 (A), Soal 3 (C)</div>
            <a href="#" class="btn btn-outline-success btn-sm disabled"><i class="fas fa-certificate"></i> Download Sertifikat (Dummy)</a>
        </div>
    </div>
</div>
<?php $this->load->view('dashboard/footer'); ?> 