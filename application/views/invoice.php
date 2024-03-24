<div class="card m-8 p-4">
    <h2><strong>Invoice pembelian</strong></h2>
    <div class="row align-items-start mt-2 ">
        <div class="col-4">
            <span>From :</span>
            <h4><strong><?= $this->session->userdata('nama') ?></strong></h4>
            <h4>Jl.Sudirman no 20,kra</h4>
            <h4>087767676767</h4>
        </div>
        <div class="col-4">
            <span>To :</span>
            <h4><strong><?= $penjualan->nama ?></strong></h4>
            <h4><?= $penjualan->alamat ?></h4>
            <h4>No Telp: <?= $penjualan->telp ?></h4>
        </div>
        <div class="col-4">
            <span>No nota : </span>
            <h4><strong><?= $penjualan->kode_penjualan ?></strong></h4>
        </div>
    </div>

    <div class="table-responsive mt-2 ">
        <span>Detail produk :</span>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kode produk</th>
                    <th scope="col">Produk</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                $total = 0;
                foreach ($detail as $detail) { ?>
                    <tr>
                        <th><?= $no ?></th>
                        <th><?= $detail['kode_produk']  ?></th>
                        <th><?= $detail['nama']  ?></th>
                        <th><?= $detail['jumlah']  ?></th>
                        <th>Rp.<?= number_format($detail['harga'])  ?></th>
                        <th>Rp.<?= number_format($detail['harga'] * $detail['jumlah'])  ?></th>
                    </tr>
                <?php $no++;
                    $total = $total + $detail['harga'] * $detail['jumlah'];
                } ?>
                <tr>
                    <td colspan="5">Total harga : </td>
                    <td>Rp.<?= number_format($total) ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="row no-print">
        <div class="col-md-3 mt-3">
                <a href="<?= base_url('penjualan/print/'.$nota); ?>" class="btn btn-danger" target="_blank" > Print
            </a>
        </div>
    </div>
</div>
    <!-- <div class="card m-8 p-4"> -->
    <!-- Konten Nota -->
    <!-- <div class="row no-print">
        <div class="col-md-3 mt-3">
            <button onclick="cetakNota()" class="btn btn-danger">
                Print
            </button>
        </div>
    </div> -->
    <!-- Script untuk pencetakan -->
    <!-- <script>
        function cetakNota() {
            window.print();
        }
    </script>
</div> -->
