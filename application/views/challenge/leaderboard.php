<?php $this->load->view('dashboard/header'); ?>
<div class="mb-4">
    <h2 class="fw-bold mb-2"><i class="fas fa-trophy"></i> Leaderboard Challenge Bulanan</h2>
    <p class="text-muted">Lihat ranking peserta challenge bulanan dan raih posisi teratas untuk memenangkan hadiah!</p>
</div>
<div class="mb-3">
    <a href="#" class="btn btn-success disabled"><i class="fas fa-flag-checkered"></i> Ikuti Challenge (Coming Soon)</a>
</div>
<div class="card mb-4">
    <div class="card-header bg-warning text-dark">
        <b>Hadiah untuk Top 3 Pemenang!</b> <span class="ms-2">🏅🏅🏅</span>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>Peringkat</th>
                    <th>Nama Peserta</th>
                    <th>Skor</th>
                </tr>
            </thead>
            <tbody>
                <tr class="table-success">
                    <td>1</td>
                    <td><b>Fajar Munawar</b></td>
                    <td>980</td>
                </tr>
                <tr class="table-secondary">
                    <td>2</td>
                    <td>Rina Sari</td>
                    <td>920</td>
                </tr>
                <tr class="table-warning">
                    <td>3</td>
                    <td>Budi Santoso</td>
                    <td>900</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Andi Wijaya</td>
                    <td>850</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Siti Aminah</td>
                    <td>800</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php $this->load->view('dashboard/footer'); ?> 