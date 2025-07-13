<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h4><i class="fas fa-user-shield"></i> Admin Dashboard</h4>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <h5>Selamat datang, <strong><?= $user['name'] ?></strong>!</h5>
                    <p>Anda login sebagai <strong>Admin</strong>.</p>
                    <p>Email: <?= $user['email'] ?></p>
                </div>
                <hr>
                <h5>Fitur Admin (contoh):</h5>
                <ul>
                    <li><a href="#">Kelola User</a></li>
                    <li><a href="#">Kelola Artikel</a></li>
                    <li><a href="#">Kelola Webinar</a></li>
                    <li><a href="#">Laporan & Statistik</a></li>
                </ul>
            </div>
        </div>
    </div>
</div> 