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
    </div>
</div>
<?php $this->load->view('dashboard/footer'); ?> 