<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="<?= base_url('admin') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    <h4 class="mb-0"><i class="fas fa-chart-bar"></i> Reporting & Statistik</h4>
</div>
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <i class="fas fa-users fa-2x text-primary mb-2"></i>
                <h5 class="fw-bold mb-0"><?= $stat_users ?></h5>
                <div class="text-muted">Total User</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <i class="fas fa-newspaper fa-2x text-success mb-2"></i>
                <h5 class="fw-bold mb-0"><?= $stat_articles ?></h5>
                <div class="text-muted">Total Artikel</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <i class="fas fa-video fa-2x text-warning mb-2"></i>
                <h5 class="fw-bold mb-0"><?= $stat_videos ?></h5>
                <div class="text-muted">Total Video</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <i class="fas fa-chalkboard-teacher fa-2x text-info mb-2"></i>
                <h5 class="fw-bold mb-0"><?= $stat_webinars ?></h5>
                <div class="text-muted">Total Webinar</div>
            </div>
        </div>
    </div>
</div>
<!-- Tambahan: bisa ditambah tabel aktivitas terbaru, grafik, dsb --> 