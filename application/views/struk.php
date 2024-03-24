<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    =============================<br>
    Kasir Web Solution <br>
    Jln. Jendral Sudirman 50 <br>
    Telp. 890822227896 <br>
    ============================= <br>
    <table>
        <tr>
            <td>No. Nota</td>
            <td> : <?= $nota ?></td>
        </tr>
        <tr>
            <td>Pelanggan</td>
            <td> : <?= $penjualan->nama ?></td>
        </tr>
    </table>
    ============================= <br>
    <table>
        <?php $item=0; $total=0; $no=1; foreach($detail as $row) { ?>
        <tr>
            <td colspan="3"> <?= $row['nama']; ?> </td>
        </tr>
        <tr>
            <td> <?= $row['jumlah'] ?> PCS </td>
            <td style="text-align: right;" > Rp. <?= number_format($row['harga']) ?> </td>
            <td style="text-align: right;" > Rp. <?= number_format($row['jumlah']*$row['harga']) ?> </td>
        </tr>
        <?php $item=$item+$row['jumlah']; $total=$total+$row['jumlah']*$row['harga']; $no++; } ?>
    </table>
    ============================= <br>
    <table>
        <tr>
            <td>Total Tagihan : </td>
            <td style="text-align: right;">  Rp. <?= number_format($total); ?> </td>
        </tr>
    </table>
    ============================= <br>
    Jumlah Item :  <?= $item ?> <br>
    ============================= <br>
    ----------- Terima Kasih --------- <br>
</body>
<script>
    window.print();
</script>
</html>