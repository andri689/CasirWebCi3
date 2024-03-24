<?= $this->session->flashdata('notifikasi'); ?>
<div class="row">
    <div class="col-md-4" >
        <!-- Bagian pemilihan produk -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Pilih produk yang akan dijual</h5>
                <small class="text-muted float-end">(Pastikan produk yang dipilih benar)</small>
            </div>
            <div class="card-body">
            <div class="mb-3">
                    <label class="form-label" for="basic-default-company">Nota</label>
                    <input type="text" class="form-control" name="kode_penjualan" value="<?= $nota ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nama Pelanggan</label>
                    <input type="text" class="form-control" name="namapelanggan" value="<?= $namapelanggan ?>" readonly>
                </div>
                <form action="<?= base_url('penjualan/tambahkeranjang')?>" method="post">
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Produk</label>
                    <input type="hidden" name="kode_penjualan" value="<?= $nota ?>">
                    <select name="id_produk" class="form-control">
                        <?php foreach($produk as $aa) { ?>
                        <option value="<?= $aa['id_produk']?>"><?= $aa['nama']?> - <?= $aa['kode_produk']?>(<?= $aa['stok']?>)</option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-company">Jumlah</label>
                    <input type="number" class="form-control" name="jumlah" placeholder="Jumlah yang dijual" required>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Keranjang</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8" >
        <!-- Bagian tabel detail penjualan/produk apa saja yang dibeli -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Produk Yang Di Pilih</h5>
                <small class="text-muted float-end">(Pastikan produk yang dipilih benar)</small>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php $total=0; $no=1; foreach($detail as $row){ ?>
                            <tr>
                                <td><?= $no;?></td>
                                <td><?= $row['kode_produk'] ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['jumlah'] ?></td>
                                <td>Rp. <?= number_format($row['harga']) ?></td>
                                <td>Rp. <?= number_format($row['jumlah']*$row['harga']) ?></td>
                                <td>
                                    <a onclick="return confirm('Apakah Anda yakin ingin menghapus produk dari keranjang?')"
                                    href="<?= base_url('penjualan/hapus/'.$row['id_detail'].'/'.$row['id_produk'])?>" type="" class="btn-sm btn-danger">Hapus</a>
                                </td>
                            </tr>
                            <?php $total=$total+$row['jumlah']*$row['harga']; $no++; } ?>
                            <tr>
                                <td colspan=5>Total Harga</td>
                                <td>Rp. <?= number_format($total); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('penjualan/bayar') ?>" method="post">
                    <input type="hidden" name="id_pelanggan" value="<?= $id_pelanggan; ?>">
                    <input type="hidden" name="kode_penjualan" value="<?= $nota; ?>">
                    <input type="hidden" name="total_harga" value="<?= $total; ?>">
                    <?php if($detail<>NULL) { ?>
                    <button type="submit" class="btn btn-primary">Bayar</button>
                    <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>