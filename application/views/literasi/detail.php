<div class="mb-3 d-flex justify-content-between align-items-center">
    <a href="<?= base_url('literasi') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali ke Daftar Artikel</a>
    <?php if($is_logged_in): ?>
    <form method="post" class="d-inline">
        <button name="bookmark" class="btn btn-<?= $is_bookmarked ? 'warning' : 'outline-warning' ?>" type="submit">
            <i class="fas fa-bookmark"></i> <?= $is_bookmarked ? 'Bookmarked' : 'Bookmark' ?>
        </button>
    </form>
    <?php endif; ?>
</div>
<div class="card shadow-sm mb-4">
    <?php if($article->featured_image): ?>
        <img src="<?= htmlspecialchars($article->featured_image) ?>" class="card-img-top" alt="Gambar Artikel" style="max-height:300px;object-fit:cover;">
    <?php endif; ?>
    <div class="card-body">
        <span class="badge bg-secondary mb-2">Kategori: <?= htmlspecialchars($article->category_name ?? '-') ?></span>
        <h2 class="card-title fw-bold mb-2"><?= htmlspecialchars($article->title) ?></h2>
        <p class="text-muted mb-2">
            <i class="fas fa-clock"></i> <?= $article->reading_time ?? 5 ?> menit baca
            &nbsp;|&nbsp;
            <i class="fas fa-calendar-alt"></i> <?= date('d M Y', strtotime($article->created_at)) ?>
        </p>
        <!-- Share -->
        <div class="mb-3">
            <span class="me-2">Bagikan:</span>
            <a href="https://wa.me/?text=<?= urlencode(current_url()) ?>" target="_blank" class="btn btn-sm btn-success"><i class="fab fa-whatsapp"></i></a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(current_url()) ?>" target="_blank" class="btn btn-sm btn-primary"><i class="fab fa-facebook-f"></i></a>
            <a href="https://twitter.com/intent/tweet?url=<?= urlencode(current_url()) ?>" target="_blank" class="btn btn-sm btn-info"><i class="fab fa-twitter"></i></a>
            <button class="btn btn-sm btn-secondary" onclick="navigator.clipboard.writeText('<?= current_url() ?>');alert('Link disalin!')"><i class="fas fa-link"></i></button>
        </div>
        <!-- Rating -->
        <div class="mb-3">
            <?php if($is_logged_in): ?>
            <form method="post" class="d-inline">
                <span class="me-2">Rating:</span>
                <?php for($i=1;$i<=5;$i++): ?>
                    <button name="rating" value="<?= $i ?>" class="btn btn-sm <?= $user_rating>=$i?'text-warning':'text-secondary' ?> p-0" style="font-size:1.3em;" type="submit">
                        <i class="fas fa-star"></i>
                    </button>
                <?php endfor; ?>
                <span class="ms-2 text-muted">(<?= $avg_rating ?> / 5)</span>
            </form>
            <?php else: ?>
                <span class="text-muted">Login untuk memberi rating</span>
                <span class="ms-2 text-muted">(<?= $avg_rating ?> / 5)</span>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <?= $article->content ?>
        </div>
        <!-- Komentar -->
        <div class="mt-4" id="komentar">
            <h5 class="mb-3"><i class="fas fa-comments"></i> Komentar</h5>
            <?php if($is_logged_in): ?>
            <form method="post" class="mb-3">
                <div class="input-group">
                    <input type="text" name="comment" class="form-control" placeholder="Tulis komentar..." required>
                    <button name="add_comment" class="btn btn-primary" type="submit">Kirim</button>
                </div>
            </form>
            <?php else: ?>
                <div class="alert alert-info py-2">Login untuk menulis komentar.</div>
            <?php endif; ?>
            <?php if(empty($comments)): ?>
                <div class="text-muted">Belum ada komentar.</div>
            <?php else: foreach($comments as $c): ?>
                <div class="border rounded p-2 mb-2">
                    <strong><?= htmlspecialchars($c->first_name.' '.$c->last_name) ?></strong>
                    <span class="text-muted small ms-2"><?= date('d M Y H:i', strtotime($c->created_at)) ?></span>
                    <div><?= nl2br(htmlspecialchars($c->comment)) ?></div>
                </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
</div> 