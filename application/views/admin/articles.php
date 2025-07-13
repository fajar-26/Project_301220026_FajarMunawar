<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="<?= base_url('admin/content') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addArticleModal"><i class="fas fa-plus"></i> Tambah Artikel</button>
    <h4 class="mb-0"><i class="fas fa-newspaper"></i> Daftar Artikel</h4>
</div>
<!-- Modal Tambah Artikel -->
<div class="modal fade" id="addArticleModal" tabindex="-1" aria-labelledby="addArticleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" action="<?= base_url('admin/articles') ?>">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="addArticleModalLabel"><i class="fas fa-newspaper"></i> Tambah Artikel Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="add_article" value="1">
          <div class="row">
            <div class="col-md-8">
              <div class="mb-2">
                <label class="form-label">Judul Artikel</label>
                <input type="text" name="title" class="form-control" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-2">
                <label class="form-label">Kategori</label>
                <select name="category_id" class="form-select">
                  <option value="">Pilih Kategori</option>
                  <?php if(isset($categories)) foreach($categories as $category): ?>
                    <option value="<?= $category->id ?>"><?= htmlspecialchars($category->name) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="mb-2">
            <label class="form-label">Konten Artikel</label>
            <textarea name="content" class="form-control" rows="8" required placeholder="Tulis konten artikel di sini..."></textarea>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-2">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                  <option value="draft">Draft</option>
                  <option value="published">Published</option>
                  <option value="archived">Archived</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-2">
                <label class="form-label">Featured Image URL</label>
                <input type="url" name="featured_image" class="form-control" placeholder="https://example.com/image.jpg">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-2">
                <label class="form-label">Reading Time (menit)</label>
                <input type="number" name="reading_time" class="form-control" value="5" min="1" max="60">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-2">
                <div class="form-check mt-4">
                  <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="isFeatured">
                  <label class="form-check-label" for="isFeatured">
                    Featured Article
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($articles)): ?>
                    <tr><td colspan="5" class="text-center text-muted">Belum ada artikel.</td></tr>
                <?php else: foreach($articles as $i => $a): ?>
                    <tr>
                        <td><?= $i+1 ?></td>
                        <td><?= htmlspecialchars($a->title) ?></td>
                        <td><?= htmlspecialchars($a->category_name ?? '-') ?></td>
                        <td><?= htmlspecialchars($a->status) ?></td>
                        <td><?= date('d/m/Y', strtotime($a->created_at)) ?></td>
                    </tr>
                <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div> 