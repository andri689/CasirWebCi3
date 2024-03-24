<?= $this->session->flashdata('notif') ?>
<div class="mt-1 mb-4 ">
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
    Tambah Pengguna
  </button>

  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#laporanModal">
    Laporan
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
                  foreach ($pelanggan as $row) { ?>
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
                        <a href="<?= base_url('penjualan/transaksi/' . $row['id_pelanggan']) ?>" class="btn-sm btn-warning">Pilih</a>
                      </td>
                    </tr>
                    <?php $no++;
                  } ?>
                </tbody>
              </table>
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
  <h5 class="card-header">Penjualan Hari Ini</h5>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>No Nota</th>
          <th>Nominal</th>
          <th>Pelanggan</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
          <?php $total=0; $no=1; foreach($user as $row){ ?>
          <tr>
              <td><?= $no;?></td>
              <td><?= $row['kode_penjualan'] ?></td>
              <td style="text-align: right" >Rp. <?= number_format($row['total_harga']) ?></td>
              <td><?= $row['nama'] ?></td>
              <td>
                  <a href="<?= base_url('penjualan/print/'.$row['kode_penjualan'])?>" type="" class="btn-sm btn-warning">Cek</a>
              </td>
          </tr>
          <?php $total=$total+$row['total_harga']; $no++; } ?>
          <tr>
              <td colspan="2">Total</td>
              <td>Rp. <?= number_format($total); ?></td>
          </tr>
      </tbody>
    </table>
  </div>
</div>

  <!-- Modal Laporan  -->
  <div class="modal fade" id="laporanModal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Laporan Penjualan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="<?= base_url('penjualan/laporan') ?>" method="get" target="_blank" >
          <div class="modal-body">
            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Dari</label>
                <input type="date" class="form-control" name="tanggal1" required >
              </div>
            </div>
            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Sampai</label>
                <input type="date" class="form-control" name="tanggal2" required >
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