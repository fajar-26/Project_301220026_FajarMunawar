<div class="mb-4">
    <h2 class="fw-bold mb-2"><i class="fas fa-trophy"></i> Challenge & Quiz</h2>
    <p class="text-muted">Sistem gamification untuk belajar investasi dan literasi finansial. Ikuti challenge bulanan, kerjakan quiz, raih skor tertinggi, dan menangkan hadiah menarik!</p>
</div>
<div class="row mb-4">
    <div class="col-md-6 mb-3">
        <div class="card shadow-sm h-100">
            <div class="card-body d-flex flex-column justify-content-between">
                <div>
                    <h4 class="fw-bold"><i class="fas fa-flag-checkered"></i> Challenge Bulanan</h4>
                    <p>Ikuti challenge investasi virtual bulanan, kumpulkan poin, dan raih peringkat di leaderboard. Hadiah menarik menanti pemenang!</p>
                </div>
                <a href="<?= site_url('challenge/leaderboard') ?>" class="btn btn-success mt-2"><i class="fas fa-trophy"></i> Lihat Leaderboard</a>
                <a href="<?= site_url('challenge/quiz') ?>" class="btn btn-primary mt-2"><i class="fas fa-play"></i> Ikuti Challenge</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card shadow-sm h-100">
            <div class="card-body d-flex flex-column justify-content-between">
                <div>
                    <h4 class="fw-bold"><i class="fas fa-question-circle"></i> Quiz Literasi Finansial</h4>
                    <p>Kerjakan pertanyaan multiple choice dengan timer, dapatkan skor, review jawaban salah, dan raih sertifikat jika lulus!</p>
                </div>
                <a href="<?= site_url('challenge/quiz') ?>" class="btn btn-primary mt-2"><i class="fas fa-play"></i> Mulai Quiz Literasi</a>
            </div>
        </div>
    </div>
</div> 