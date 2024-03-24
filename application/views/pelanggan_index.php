<?= $this->session->flashdata('notif') ?>
<div class="mt-1 mb-4 ">
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
    Tambah Pelanggan
  </button>

  <!-- Modal -->
  <div class="modal fade" id="basicModal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Tambah Pelanggan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="<?= base_url('pelanggan/simpan') ?>" method="post">
          <div class="modal-body">
            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama" placeholder="Nama" required>
              </div>
            </div>
            <div class="row g-2">
              <div class="col mb-0">
                <label class="form-label">Alamat</label>
                <input type="text" class="form-control" name="alamat" placeholder="Alamat" required>
              </div>
              <div class="col mb-0">
                <label for="dobBasic" class="form-label">Telepon</label>
                <input type="number" class="form-control" name="telp" placeholder="Telepon" required>
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
  <h5 class="card-header">Produk</h5>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Alamat</th>
          <th>Telepon</th>
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
              <?= $row['nama'] ?>
            </td>
            <td>
              <?= $row['alamat'] ?>
            </td>
            <td>
              <?= $row['telp'] ?>
            </td>
            <td>
              <a onclick="return confirm('Apakah anda yakin ingin menghapus ini')"
                href="<?= base_url('pelanggan/hapus/' . $row['id_pelanggan']) ?>" class="btn btn-danger">Hapus</a>
              <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                data-bs-target="#modaledit<?= $row['id_pelanggan'] ?>">
                Edit
              </button>
              <!-- Modal Edit -->
              <div class="modal fade" id="modaledit<?= $row['id_pelanggan'] ?>" tabindex="-1" style="display: none;"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <form action="<?= base_url('pelanggan/update')?>" method="post">
                    <input type="hidden" name="id_pelanggan" value="<?= $row['id_pelanggan'] ?>" >
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Edit Pelanggan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" value="<?= $row['nama'] ?>" name="nama" placeholder="Nama" >
                          </div>
                        </div>
                        <div class="row g-2">
                          <div class="col mb-0">
                            <label class="form-label">Alamat</label>
                            <input type="text" class="form-control" value="<?= $row['alamat'] ?>" name="alamat"
                              placeholder="Alamat">
                          </div>
                          <div class="col mb-0">
                            <label for="dobBasic" class="form-label">Telepon</label>
                            <input type="number" class="form-control" name="telp" value="<?= $row['telp'] ?>" placeholder="Telepon" required>
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