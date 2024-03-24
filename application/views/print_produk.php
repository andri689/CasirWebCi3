<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        th, td {
            padding: 3px;
        }
    </style>
</head>
<body>
    <center>
    <div class="card">
    <h3> Data Produk <?= $status; ?></h3>
    <table border="1">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Kode Produk</th>
          <th>Stok</th>
          <th>Harga</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        <?php $no = 1;
        foreach ($produk as $row) { ?>
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
            <td style="text-align: right" >
              <?= $row['stok'] ?>
            </td>
            <td style="text-align: right" >RP.
               <?= number_format($row['harga']) ?>
            </td>
          </tr>
          <?php $no++;
        } ?>
      </tbody>
    </table>
    </center>
    <script>
        window.print();
    </script>
</body>
</html>