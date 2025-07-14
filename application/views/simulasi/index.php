<a href="/Project_301220026_FajarMunawar/dashboard" class="btn btn-outline-secondary mb-3"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard</a>
<div class="mb-4">
    <h2 class="fw-bold mb-2"><i class="fas fa-calculator"></i> Simulasi Investasi</h2>
    <p class="text-muted">Gunakan kalkulator di bawah untuk menghitung estimasi hasil investasi berdasarkan produk yang kamu pilih.</p>
</div>
<div class="row mb-4">
    <div class="col-lg-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <form method="post">
                    <div class="mb-2">
                        <label class="form-label">Dana Awal (Rp)</label>
                        <input type="number" name="dana_awal" class="form-control" min="0" required value="<?= set_value('dana_awal', 1000000) ?>">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Investasi Bulanan (Rp)</label>
                        <input type="number" name="investasi_bulanan" class="form-control" min="0" required value="<?= set_value('investasi_bulanan', 1000000) ?>">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Durasi (bulan)</label>
                        <input type="number" name="durasi" class="form-control" min="1" max="360" required value="<?= set_value('durasi', 12) ?>">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Produk Investasi</label>
                        <select name="produk_id" class="form-select" required>
                            <option value="">Pilih Produk</option>
                            <?php foreach($products as $p): ?>
                                <option value="<?= $p->id ?>" <?= set_select('produk_id', $p->id) ?>><?= htmlspecialchars($p->name) ?> (Estimasi <?= $p->expected_return ?>%/tahun)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button name="hitung" class="btn btn-success w-100" type="submit"><i class="fas fa-calculator"></i> Hitung Simulasi</button>
                </form>
            </div>
        </div>
        <?php if($result): ?>
        <div class="alert alert-info mt-3">
            <h5 class="fw-bold">Hasil Simulasi</h5>
            <ul class="mb-2">
                <li><b>Produk:</b> <?= htmlspecialchars($result['produk']->name) ?></li>
                <li><b>Durasi:</b> <?= $result['durasi'] ?> bulan</li>
                <li><b>Dana Awal:</b> Rp<?= number_format($result['awal'],0,',','.') ?></li>
                <li><b>Investasi Bulanan:</b> Rp<?= number_format($result['bulanan'],0,',','.') ?></li>
                <li><b>Estimasi Return:</b> <?= $result['rate'] ?>% / tahun</li>
            </ul>
            <h4 class="text-success">Estimasi Hasil Akhir: Rp<?= number_format($result['total'],0,',','.') ?></h4>
            <div class="text-muted">Keuntungan: <b>Rp<?= number_format($result['keuntungan'],0,',','.') ?></b></div>
        </div>
        <?php endif; ?>
    </div>
    <div class="col-lg-6">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-coins"></i> Daftar Produk Investasi</h5>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <?php foreach($products as $p): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <b><?= htmlspecialchars($p->name) ?></b><br>
                            <span class="text-muted small">Tipe: <?= $p->type ?> | Risiko: <?= $p->risk_level ?></span>
                        </div>
                        <span class="badge bg-success">~<?= $p->expected_return ?>%/thn</span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div> 