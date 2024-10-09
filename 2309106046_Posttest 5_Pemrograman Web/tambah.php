<?php
require "koneksi.php";
require "header.php";

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['tambah'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    $harga = htmlspecialchars($_POST['harga']);
    $stok = htmlspecialchars($_POST['stok']);
    
    $tmp_name = $_FILES['foto']['tmp_name'];
    $file_name = $_FILES['foto']['name'];

    $validExtensions = ['png', 'jpg', 'jpeg'];
    $fileExtension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    
    if (!in_array($fileExtension, $validExtensions)) {
        echo "<script>alert('Tolong upload file gambar!');</script>";
    } else {
        if (move_uploaded_file($tmp_name, 'images/' . $file_name)) {
            $sql = "INSERT INTO produk (nama, deskripsi, foto, harga, stok) VALUES ('$nama', '$deskripsi', '$file_name', '$harga', '$stok')";
            $result = mysqli_query($conn, $sql);
            
            if ($result) {
                echo "<script>alert('Berhasil menambah produk!'); document.location.href = 'dashboard.php';</script>";
            } else {
                echo "<script>alert('Gagal menambah produk!');</script>";
            }
        } else {
            echo "<script>alert('File tidak valid!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="styles/tambah.css">
</head>
<body>
    <h1>Tambah Data Produk</h1>
    <section class="form">
        <form action="" method="post" enctype = "multipart/form-data">
                <?php
                    if (isset($_GET['error'])) {
                        echo '<p style="color:red; font-size:0.75rem; margin-bottom: 1rem">' . htmlspecialchars($_GET['error']) . '</p>';
                    }
                    ?>
                <label for="nama">Nama Produk</label><br>
                <input type="text" name="nama" placeholder="Nama Produk" required><br>
                <label for="deskriosi">Deskripsi</label>
                <textarea name="deskripsi" placeholder="Deskripsi" required></textarea>
                <label for="harga">harga</label><br>
                <input type="number" name="harga" id="harga" placeholder="Harga" required><br>
                <label for="stok">Stok</label><br>
                <input type="number" name="stok" id="stok" placeholder="Stok" required><br>
                <label for="foto">Upload foto</label><br>
                <input type="file" name="foto" id="foto" placeholder="Upload Foto" required><br>
                <button type="submit" value="tambah" name="tambah">Submit</button>
        </form>
    </section>
</body>
</html>