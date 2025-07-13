<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-11">
        <div class="card shadow-lg border-0 mb-4" style="border-radius: 18px;">
            <div class="card-header bg-dark text-white" style="border-radius: 18px 18px 0 0;">
                <h4 class="mb-0"><i class="fas fa-user-shield"></i> Admin Dashboard</h4>
            </div>
            <div class="card-body bg-light" style="border-radius: 0 0 18px 18px;">
                <div class="alert alert-info d-flex align-items-center mb-4" style="font-size:1.1rem;">
                    <i class="fas fa-user-tie fa-2x me-3"></i>
                    <div>
                        <strong>Selamat datang, <span style="color:#2980b9;">admin perusahaan!</span></strong><br>
                        Anda login sebagai <b>Admin</b>.<br>
                        <span class="text-muted">Email: <?= $user['email'] ?></span>
                    </div>
                </div>
                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm" style="background:linear-gradient(135deg,#e0eafc 0%,#cfdef3 100%);">
                            <div class="card-body">
                                <h5 class="fw-bold mb-3 text-primary"><i class="fas fa-folder-open me-2"></i>Content Management</h5>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2"><i class="fas fa-newspaper text-primary me-2"></i>Tambah/Edit/Hapus Artikel</li>
                                    <li class="mb-2"><i class="fas fa-video text-primary me-2"></i>Upload Video Tutorial</li>
                                    <li class="mb-2"><i class="fas fa-tags text-primary me-2"></i>Kelola Kategori</li>
                                    <li><i class="fas fa-chalkboard-teacher text-primary me-2"></i>Kelola Webinar</li>
                                </ul>
                                <a href="#" class="btn btn-primary btn-sm mt-3 w-100">Kelola Konten</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm" style="background:linear-gradient(135deg,#fceabb 0%,#f8b500 100%);">
                            <div class="card-body">
                                <h5 class="fw-bold mb-3 text-warning"><i class="fas fa-users-cog me-2"></i>User Management</h5>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2"><i class="fas fa-users text-warning me-2"></i>Daftar Semua User</li>
                                    <li class="mb-2"><i class="fas fa-user-check text-warning me-2"></i>Aktivasi/Deaktivasi User</li>
                                    <li><i class="fas fa-key text-warning me-2"></i>Reset Password User</li>
                                </ul>
                                <a href="#" class="btn btn-warning btn-sm mt-3 w-100 text-white">Kelola User</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm" style="background:linear-gradient(135deg,#c2e9fb 0%,#81a4fd 100%);">
                            <div class="card-body">
                                <h5 class="fw-bold mb-3 text-info"><i class="fas fa-chart-line me-2"></i>Reporting</h5>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2"><i class="fas fa-chart-pie text-info me-2"></i>Statistik Website</li>
                                    <li class="mb-2"><i class="fas fa-user-clock text-info me-2"></i>User Activity</li>
                                    <li><i class="fas fa-fire text-info me-2"></i>Popular Content</li>
                                </ul>
                                <a href="#" class="btn btn-info btn-sm mt-3 w-100 text-white">Lihat Laporan</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <span class="text-muted small">&copy; <?= date('Y') ?> Money Mentor Pro Admin Panel</span>
                </div>
            </div>
        </div>
    </div>
</div> 