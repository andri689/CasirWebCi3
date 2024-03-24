<?= $this->session->flashdata('notif') ?>
<div class="mt-1 mb-4 ">
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
    Tambah Produk
  </button>

  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#printModal">
    Print
  </button>

  <!-- Modal -->
  <div class="modal fade" id="basicModal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Tambah Produk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="<?= base_url('produk/simpan') ?>" method="post">
          <div class="modal-body">
            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama" placeholder="Nama" required>
              </div>
            </div>
            <div class="row g-2">
              <div class="col mb-0">
                <label class="form-label">Stok</label>
                <input type="number" class="form-control" name="stok" placeholder="Stok" required>
              </div>
              <div class="col mb-0">
                <label for="dobBasic" class="form-label">Harga</label>
                <input type="number" class="form-control" name="harga" placeholder="Harga" required>
              </div>
            </div>
            <div class="row g-2">
              <div class="col mb-0">
                <label class="form-label">Kode Produk</label>
                <input type="text" class="form-control" name="kode_produk" placeholder="kodeproduk" required>
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
          <th>Kode Produk</th>
          <th>Stok</th>
          <th>Harga</th>
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
              <?= $row['kode_produk'] ?>
            </td>
            <td>
              <?= $row['stok'] ?>
            </td>
            <td>RP.
               <?= number_format($row['harga']) ?>
            </td>
            <td>
              <a onclick="return confirm('Apakah anda yakin ingin menghapus ini')"
                href="<?= base_url('produk/hapus/' . $row['id_produk']) ?>" class="btn btn-danger">Hapus</a>
              <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                data-bs-target="#modaledit<?= $row['id_produk'] ?>">
                Edit
              </button>
              <!-- Modal Edit -->
              <div class="modal fade" id="modaledit<?= $row['id_produk'] ?>" tabindex="-1" style="display: none;"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <form action="<?= base_url('produk/update')?>" method="post">
                    <input type="hidden" name="id_produk" value="<?= $row['id_produk'] ?>" >
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Edit Produk</h5>
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
                            <label class="form-label">Stok</label>
                            <input type="number" class="form-control" value="<?= $row['stok'] ?>" name="stok"
                              placeholder="Stok">
                          </div>
                          <div class="col mb-0">
                            <label for="dobBasic" class="form-label">Harga</label>
                            <input type="number" class="form-control" name="harga" value="<?= $row['harga'] ?>" placeholder="Harga" required>
                        </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label class="form-label">Kode Produk</label>
                                <input type="text" class="form-control" name="kode_produk" value="<?= $row['kode_produk'] ?>" placeholder="Kode produk" required>
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


  <!-- Modal Print Produk -->
  <div class="modal fade" id="printModal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Laporan Produk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="<?= base_url('produk/print') ?>" method="get" target="_blank" >
          <div class="modal-body">
            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Stok</label>
                <select name="status" class="form-control">
                  <option value="Ada">Ada</option>
                  <option value="Habis">Habis</option>
                  <option value="Semua">Semua</option>
                </select>
              </div>
            </div>
          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Close
              </button>
              <button type="submit" class="btn btn-primary">Print</button>
            </div>
        </form>
      </div>
    </div>
  </div>