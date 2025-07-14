<?php if ($this->session->userdata('is_admin')): ?>
<div class="mb-3">
    <a href="<?= base_url('admin') ?>" class="btn btn-dark">
        <i class="fas fa-user-shield"></i> Ke Admin Panel
    </a>
</div>
<?php endif; ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-tachometer-alt"></i> Dashboard</h4>
            </div>
            <div class="card-body">
                <div class="alert alert-success">
                    <h5><i class="fas fa-check-circle"></i> Login Berhasil!</h5>
                    <p>Selamat datang di Money Mentor Pro, <strong><?= $user['name'] ?></strong>!</p>
                    <hr>
                    <p><strong>Email:</strong> <?= $user['email'] ?></p>
                    <p><strong>Pengalaman Investasi:</strong> <?= ucfirst($user['experience']) ?></p>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="card bg-primary text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-book fa-3x mb-3"></i>
                                <h5>Literasi Finansial</h5>
                                <p>Belajar tentang investasi dan keuangan</p>
                                <a href="<?= base_url('literasi') ?>" class="btn btn-light">Mulai Belajar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-success text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-calculator fa-3x mb-3"></i>
                                <h5>Simulasi Investasi</h5>
                                <p>Hitung potensi keuntungan investasi</p>
                                <a href="<?= base_url('simulasi') ?>" class="btn btn-light">Coba Simulasi</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-warning text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-trophy fa-3x mb-3"></i>
                                <h5>Challenge & Quiz</h5>
                                <p>Uji pengetahuan dan dapat hadiah</p>
                                <a href="#" class="btn btn-light">Ikuti Challenge</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 