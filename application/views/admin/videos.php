<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="<?= base_url('admin/content') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addVideoModal"><i class="fas fa-plus"></i> Tambah Video</button>
    <h4 class="mb-0"><i class="fas fa-video"></i> Daftar Video</h4>
</div>
<!-- Modal Tambah Video -->
<div class="modal fade" id="addVideoModal" tabindex="-1" aria-labelledby="addVideoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" action="<?= base_url('admin/videos') ?>">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title" id="addVideoModalLabel"><i class="fas fa-video"></i> Tambah Video Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="add_video" value="1">
          <div class="mb-2">
            <label class="form-label">Judul Video</label>
            <input type="text" name="title" class="form-control" required>
          </div>
          <div class="mb-2">
            <label class="form-label">Kategori</label>
            <select name="category_id" class="form-select">
              <option value="">Pilih Kategori</option>
              <?php if(isset($categories)) foreach($categories as $category): ?>
                <option value="<?= $category->id ?>"><?= htmlspecialchars($category->name) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-2">
            <label class="form-label">URL Video</label>
            <input type="url" name="video_url" class="form-control" required placeholder="https://youtube.com/...">
          </div>
          <div class="mb-2">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
          </div>
          <div class="mb-2">
            <label class="form-label">Thumbnail URL</label>
            <input type="url" name="thumbnail" class="form-control" placeholder="https://example.com/thumb.jpg">
          </div>
          <div class="mb-2">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
              <option value="draft">Draft</option>
              <option value="published">Published</option>
              <option value="archived">Archived</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-success">
                    <tr>
                        <th>#</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($videos)): ?>
                    <tr><td colspan="5" class="text-center text-muted">Belum ada video.</td></tr>
                <?php else: foreach($videos as $i => $v): ?>
                    <tr>
                        <td><?= $i+1 ?></td>
                        <td><?= htmlspecialchars($v->title) ?></td>
                        <td><?= htmlspecialchars($v->category_name ?? '-') ?></td>
                        <td><?= htmlspecialchars($v->status) ?></td>
                        <td><?= date('d/m/Y', strtotime($v->created_at)) ?></td>
                    </tr>
                <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div> 