<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        th, td {
            padding: 5px;
        }
    </style>
</head>

<body>
    <center>
        <h3>Laporan Penjualan
            <?= date_format(date_create($tanggal1), "d M Y"); ?> Sampai
            <?= date_format(date_create($tanggal2), "d M Y"); ?>
        </h3>
        <table border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Nota</th>
                    <th>Tanggal</th>
                    <th>Nominal</th>
                    <th>Pelanggan</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php $total = 0;
                $no = 1;
                foreach ($penjualan as $row) { ?>
                    <tr>
                        <td>
                            <?= $no; ?>
                        </td>
                        <td>
                            <?= $row['kode_penjualan'] ?>
                        </td>
                        <td>
                        <?= date_format(date_create($row['tanggal']), "d M Y"); ?>
                        </td>
                        <td style="text-align: right" >Rp.
                            <?= number_format($row['total_harga']) ?>
                        </td>
                        <td>
                            <?= $row['nama'] ?>
                        </td>
                    </tr>
                    <?php $total = $total + $row['total_harga'];
                    $no++;
                } ?>
                <tr>
                    <td colspan="3">Total</td>
                    <td style="text-align: right" >Rp.
                        <?= number_format($total); ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </center>
<script>
    window.print();
</script>
</body>

</html>