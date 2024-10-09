<?php
    require "koneksi.php";
    require "header.php";
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit();
    }


    $sql = mysqli_query($conn, "SELECT * FROM produk");

    $produk = [];

    while ($row = mysqli_fetch_assoc($sql)) {
        $produk[] = $row;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>
<body>
<h3>Daftar Produk</h3>
    <table>
        <thead>
            <tr>
                <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Deskripsi</th>
                <th>Foto</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produk as $item): ?>
            <tr>
                <td><?php echo $item['id']; ?></td>
                <td><?php echo $item['nama']; ?></td>
                <td><?php echo $item['deskripsi']; ?></td>
                <td><img src="images/<?php echo $item['foto']; ?>" alt="foto produk" width="100"></td>
                <td><?php echo $item['harga']; ?></td>
                <td><?php echo $item['stok']; ?></td>
                <td class="aksi">
                    <a href="update.php?id=<?php echo $item['id']; ?>" class="btn-edit"><i class="fas fa-edit"></i> Edit</a>
                    <a href="delete.php?id=<?php echo $item['id']; ?>" class="btn-delete" onclick="return confirm('Apakah Anda yakin?')"><i class="fas fa-trash-alt"></i> Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
