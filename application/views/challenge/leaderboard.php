<?php $this->load->view('dashboard/header'); ?>
<div class="mb-4">
    <h2 class="fw-bold mb-2"><i class="fas fa-trophy"></i> Leaderboard Challenge Bulanan</h2>
    <p class="text-muted">Lihat ranking peserta challenge bulanan dan raih posisi teratas untuk memenangkan hadiah!</p>
</div>
<a href="<?= base_url('challenge/quiz') ?>" class="btn btn-outline-primary mb-3"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard Quiz</a>
<a href="<?= base_url('challenge/quiz_bulanan') ?>" class="btn btn-success mb-3"><i class="fas fa-flag-checkered"></i> Mulai Challenge Bulanan</a>
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
                    <th>Waktu Submit</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($leaderboard)): $rank=1; foreach($leaderboard as $row): ?>
                <tr<?= $rank==1 ? ' class="table-success"' : ($rank==2 ? ' class="table-secondary"' : ($rank==3 ? ' class="table-warning"' : '')) ?>>
                    <td><?= $rank++ ?></td>
                    <td><b><?= htmlspecialchars($row->user_name) ?></b></td>
                    <td><?= $row->score ?> / <?= $row->total_questions ?></td>
                    <td><?= date('d-m-Y H:i', strtotime($row->submitted_at)) ?></td>
                </tr>
                <?php endforeach; else: ?>
                <tr><td colspan="4" class="text-center">Belum ada peserta.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $this->load->view('dashboard/footer'); ?> 