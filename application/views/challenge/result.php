<?php $this->load->view('dashboard/header'); ?>
<div class="mb-4">
    <h2 class="fw-bold mb-2"><i class="fas fa-star"></i> Hasil Quiz</h2>
    <p class="text-muted">Lihat skor, review jawaban, dan download sertifikat jika lulus.</p>
</div>
<div class="alert alert-info">Hasil quiz akan segera tersedia di sini.</div>
<div class="text-center mt-4 mb-5">
    <a href="<?= base_url('challenge/quiz') ?>" class="btn btn-outline-primary"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard Quiz</a>
</div>
<?php $this->load->view('dashboard/footer'); ?> 