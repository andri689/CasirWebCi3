<?= $this->session->flashdata('notif') ?>
<div class="mt-1 mb-4 ">
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
    Tambah Pengguna
  </button>

  <!-- Modal -->
  <div class="modal fade" id="basicModal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Tambah Pengguna</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="<?= base_url('pengguna/simpan') ?>" method="post">
          <div class="modal-body">
            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username" placeholder="Username">
              </div>
            </div>
            <div class="row g-2">
              <div class="col mb-0">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama" placeholder="Nama">
              </div>
              <div class="col mb-0">
                <label for="dobBasic" class="form-label">Level</label>
                <select name="level" class="form-control">
                  <option value="admin">Admin</option>
                  <option value="kasir">Kasir</option>
                </select>
              </div>
            </div>
            <div class="row g-2">
              <div class="col mb-0">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" placeholder="xxxx@xxx.xx">
              </div>
            </div>
          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Close
              </button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <h5 class="card-header">Pengguna</h5>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Username</th>
          <th>Nama</th>
          <th>Level</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        <?php $no = 1;
        foreach ($user as $row) { ?>
          <tr>
            <td>
              <?= $no ?>
            </td>
            <td>
              <?= $row['username'] ?>
            </td>
            <td>
              <?= $row['nama'] ?>
            </td>
            <td>
              <?= $row['level'] ?>
            </td>
            <td>
              <a onclick="return confirm('Apakah anda yakin ingin menghapus ini')"
                href="<?= base_url('pengguna/hapus/' . $row['id_user']) ?>" class="btn btn-danger">Hapus</a>
              <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                data-bs-target="#modaledit<?= $row['id_user'] ?>">
                Edit
              </button>
              <!-- Modal Edit -->
              <div class="modal fade" id="modaledit<?= $row['id_user'] ?>" tabindex="-1" style="display: none;"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <form action="<?= base_url('pengguna/update')?>" method="post">
                    <input type="hidden" name="id_user" value="<?= $row['id_user'] ?>" >
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Edit Pengguna</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" value="<?= $row['username'] ?>" readonly>
                          </div>
                        </div>
                        <div class="row g-2">
                          <div class="col mb-0">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" value="<?= $row['nama'] ?>" name="nama"
                              placeholder="Nama">
                          </div>
                          <div class="col mb-0">
                            <label for="dobBasic" class="form-label">Level</label>
                            <select name="level" class="form-control">
                              <option value="admin" <?= ($row['level'] == 'admin') ? 'selected' : '' ?>>Admin</option>
                              <option value="kasir" <?= ($row['level'] == 'kasir') ? 'selected' : '' ?>>Kasir</option>
                            </select>
                          </div>
                        </div>
                        <div class="row g-2">
                          <div class="col mb-0">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" value="<?= $row['password'] ?>" name="password" placeholder="xxxx@xxx.xx">
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                          Close
                        </button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </td>
          </tr>
          <?php $no++;
        } ?>
      </tbody>
    </table>
  </div>
</div>