<div class="row justify-content-center">
    <div class="col-lg-11">
        <div class="card shadow-lg border-0 mb-4" style="border-radius: 18px;">
            <div class="card-header bg-warning text-dark" style="border-radius: 18px 18px 0 0;">
                <h4 class="mb-0"><i class="fas fa-users-cog"></i> User Management</h4>
            </div>
            <div class="card-body bg-light" style="border-radius: 0 0 18px 18px;">
                <?php if($this->session->flashdata('success')): ?>
                    <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= $this->session->flashdata('success') ?></div>
                <?php endif; ?>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="<?= base_url('admin') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal"><i class="fas fa-user-plus"></i> Tambah User</button>
                </div>
                <!-- Modal Tambah User -->
                <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <form method="post" action="<?= base_url('admin/users') ?>">
                        <div class="modal-header bg-success text-white">
                          <h5 class="modal-title" id="addUserModalLabel"><i class="fas fa-user-plus"></i> Tambah User Baru</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <input type="hidden" name="add_user" value="1">
                          <div class="mb-2">
                            <label class="form-label">Nama Depan</label>
                            <input type="text" name="first_name" class="form-control" required>
                          </div>
                          <div class="mb-2">
                            <label class="form-label">Nama Belakang</label>
                            <input type="text" name="last_name" class="form-control" required>
                          </div>
                          <div class="mb-2">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                          </div>
                          <div class="mb-2">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" required>
                          </div>
                          <div class="mb-2">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required minlength="6">
                          </div>
                          <div class="mb-2">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-select" id="roleSelect" required onchange="document.getElementById('companyCodeField').style.display = this.value=='admin' ? 'block' : 'none';">
                              <option value="user">User</option>
                              <option value="admin">Admin</option>
                            </select>
                          </div>
                          <div class="mb-2" id="companyCodeField" style="display:none;">
                            <label class="form-label">Company Code (Admin)</label>
                            <input type="text" name="company_code" class="form-control">
                          </div>
                          <div class="mb-2">
                            <label class="form-label">Pengalaman Investasi</label>
                            <select name="investment_experience" class="form-select" required>
                              <option value="beginner">Beginner</option>
                              <option value="intermediate">Intermediate</option>
                              <option value="advanced">Advanced</option>
                            </select>
                          </div>
                          <div class="mb-2">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" name="birth_date" class="form-control">
                          </div>
                          <div class="mb-2">
                            <label class="form-label">No. Telepon</label>
                            <input type="text" name="phone" class="form-control">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-success">Tambah</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <form class="row g-2 mb-3" method="get">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama/email/username..." value="<?= htmlspecialchars($search) ?>">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-warning text-white" type="submit"><i class="fas fa-search"></i> Cari</button>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle bg-white">
                        <thead class="table-warning">
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Terdaftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (empty($users)): ?>
                            <tr><td colspan="8" class="text-center text-muted">Tidak ada user ditemukan.</td></tr>
                        <?php else: foreach($users as $i => $u): ?>
                            <tr>
                                <td><?= ($page-1)*$limit + $i + 1 ?></td>
                                <td><?= htmlspecialchars($u->first_name.' '.$u->last_name) ?></td>
                                <td><?= htmlspecialchars($u->email) ?></td>
                                <td><?= htmlspecialchars($u->username) ?></td>
                                <td><span class="badge bg-<?= $u->role=='admin'?'danger':'secondary' ?>"><?= $u->role ?></span></td>
                                <td>
                                    <form method="post" class="d-inline">
                                        <input type="hidden" name="user_id" value="<?= $u->id ?>">
                                        <input type="hidden" name="is_active" value="<?= $u->is_active ? 0 : 1 ?>">
                                        <button name="toggle_active" class="btn btn-sm btn-<?= $u->is_active ? 'success' : 'secondary' ?>" type="submit">
                                            <?= $u->is_active ? 'Aktif' : 'Nonaktif' ?>
                                        </button>
                                    </form>
                                </td>
                                <td><span class="text-muted small"><?= date('d/m/Y', strtotime($u->created_at)) ?></span></td>
                                <td>
                                    <form method="post" class="d-inline">
                                        <input type="hidden" name="user_id" value="<?= $u->id ?>">
                                        <button name="reset_password" class="btn btn-sm btn-outline-primary" type="submit" onclick="return confirm('Reset password user ini ke: user12345?')">
                                            <i class="fas fa-key"></i> Reset Password
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <?php if ($total > $limit): $total_pages = ceil($total/$limit); ?>
                <nav>
                    <ul class="pagination justify-content-center">
                        <?php for($p=1;$p<=$total_pages;$p++): ?>
                        <li class="page-item <?= $p==$page?'active':'' ?>">
                            <a class="page-link" href="?search=<?= urlencode($search) ?>&page=<?= $p ?>"><?= $p ?></a>
                        </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div> 