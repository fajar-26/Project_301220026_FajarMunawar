<div class="mb-4">
    <h2 class="fw-bold mb-2"><i class="fas fa-book-open"></i> Literasi Finansial</h2>
    <p class="text-muted">Pusat pembelajaran tentang keuangan dan investasi. Pilih kategori atau cari artikel yang ingin kamu pelajari!</p>
</div>
<form class="row g-2 mb-3" method="get">
    <div class="col-md-4">
        <input type="text" name="q" class="form-control" placeholder="Cari artikel..." value="<?= htmlspecialchars($search) ?>">
    </div>
    <div class="col-md-4">
        <select name="kategori" class="form-select">
            <option value="">Semua Kategori</option>
            <?php foreach($categories as $cat): ?>
                <option value="<?= $cat->id ?>" <?= $selected_category==$cat->id?'selected':'' ?>><?= htmlspecialchars($cat->name) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-2">
        <button class="btn btn-primary w-100" type="submit"><i class="fas fa-search"></i> Cari</button>
    </div>
</form>
<div class="row g-4">
    <?php if (empty($articles)): ?>
        <div class="col-12 text-center text-muted">Belum ada artikel ditemukan.</div>
    <?php else: foreach($articles as $a): ?>
    <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm">
            <?php if($a->featured_image): ?>
                <img src="<?= htmlspecialchars($a->featured_image) ?>" class="card-img-top" alt="Gambar Artikel" style="max-height:180px;object-fit:cover;">
            <?php endif; ?>
            <div class="card-body">
                <span class="badge bg-secondary mb-2">Kategori: <?= htmlspecialchars($a->category_name ?? '-') ?></span>
                <h5 class="card-title fw-bold"><?= htmlspecialchars($a->title) ?></h5>
                <p class="card-text small text-muted mb-2">
                    <i class="fas fa-clock"></i> <?= $a->reading_time ?? 5 ?> menit baca
                </p>
                <p class="card-text"> <?= htmlspecialchars(mb_strimwidth(strip_tags($a->content),0,100,'...')) ?> </p>
                <a href="#" class="btn btn-outline-primary btn-sm">Baca Selengkapnya</a>
            </div>
        </div>
    </div>
    <?php endforeach; endif; ?>
</div> 