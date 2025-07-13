<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="<?= base_url('admin/content') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    <button class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#addWebinarModal"><i class="fas fa-plus"></i> Tambah Webinar</button>
    <h4 class="mb-0"><i class="fas fa-chalkboard-teacher"></i> Daftar Webinar</h4>
</div>
<!-- Modal Tambah Webinar -->
<div class="modal fade" id="addWebinarModal" tabindex="-1" aria-labelledby="addWebinarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" action="<?= base_url('admin/webinars') ?>">
        <div class="modal-header bg-info text-white">
          <h5 class="modal-title" id="addWebinarModalLabel"><i class="fas fa-chalkboard-teacher"></i> Tambah Webinar Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="add_webinar" value="1">
          <div class="mb-2">
            <label class="form-label">Judul Webinar</label>
            <input type="text" name="title" class="form-control" required>
          </div>
          <div class="mb-2">
            <label class="form-label">Pembicara</label>
            <input type="text" name="speaker_name" class="form-control" required>
          </div>
          <div class="mb-2">
            <label class="form-label">Tanggal & Waktu</label>
            <input type="datetime-local" name="webinar_date" class="form-control" required>
          </div>
          <div class="mb-2">
            <label class="form-label">Durasi (menit)</label>
            <input type="number" name="duration" class="form-control" min="1" required>
          </div>
          <div class="mb-2">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
              <option value="upcoming">Upcoming</option>
              <option value="live">Live</option>
              <option value="completed">Completed</option>
              <option value="cancelled">Cancelled</option>
            </select>
          </div>
          <div class="mb-2">
            <label class="form-label">Link Meeting</label>
            <input type="url" name="meeting_link" class="form-control">
          </div>
          <div class="mb-2">
            <label class="form-label">Recording URL</label>
            <input type="url" name="recording_url" class="form-control">
          </div>
          <div class="mb-2">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-info text-white">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-info">
                    <tr>
                        <th>#</th>
                        <th>Judul</th>
                        <th>Pembicara</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($webinars)): ?>
                    <tr><td colspan="5" class="text-center text-muted">Belum ada webinar.</td></tr>
                <?php else: foreach($webinars as $i => $w): ?>
                    <tr>
                        <td><?= $i+1 ?></td>
                        <td><?= htmlspecialchars($w->title) ?></td>
                        <td><?= htmlspecialchars($w->speaker_name) ?></td>
                        <td><?= htmlspecialchars($w->status) ?></td>
                        <td><?= date('d/m/Y', strtotime($w->webinar_date)) ?></td>
                    </tr>
                <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div> 