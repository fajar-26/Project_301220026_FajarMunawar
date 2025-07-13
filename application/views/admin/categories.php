<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="<?= base_url('admin/content') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    <button class="btn btn-warning text-white" data-bs-toggle="modal" data-bs-target="#addCategoryModal"><i class="fas fa-plus"></i> Tambah Kategori</button>
    <h4 class="mb-0"><i class="fas fa-tags"></i> Daftar Kategori</h4>
</div>
<!-- Modal Tambah Kategori -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" action="<?= base_url('admin/categories') ?>">
        <div class="modal-header bg-warning text-dark">
          <h5 class="modal-title" id="addCategoryModalLabel"><i class="fas fa-tags"></i> Tambah Kategori Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="add_category" value="1">
          <div class="mb-2">
            <label class="form-label">Nama Kategori</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="mb-2">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi kategori..."></textarea>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-2">
                <label class="form-label">Icon (Font Awesome)</label>
                <input type="text" name="icon" class="form-control" placeholder="fas fa-tag">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-2">
                <label class="form-label">Warna</label>
                <input type="color" name="color" class="form-control" value="#3498db">
              </div>
            </div>
          </div>
          <div class="mb-2">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" checked>
              <label class="form-check-label" for="isActive">
                Kategori Aktif
              </label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-warning text-white">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-warning">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($categories)): ?>
                    <tr><td colspan="5" class="text-center text-muted">Belum ada kategori.</td></tr>
                <?php else: foreach($categories as $i => $c): ?>
                    <tr>
                        <td><?= $i+1 ?></td>
                        <td><?= htmlspecialchars($c->name) ?></td>
                        <td><?= htmlspecialchars($c->slug) ?></td>
                        <td><?= $c->is_active ? 'Aktif' : 'Nonaktif' ?></td>
                        <td><?= date('d/m/Y', strtotime($c->created_at)) ?></td>
                    </tr>
                <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div> 