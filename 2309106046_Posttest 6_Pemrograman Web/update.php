<?php
require "koneksi.php";
require "header.php";

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$id = $_GET['id'];
$sql = mysqli_query($conn, "SELECT * FROM produk WHERE id = $id");
$item = mysqli_fetch_assoc($sql);

if (isset($_POST['update'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    $harga = htmlspecialchars($_POST['harga']);
    $stok = htmlspecialchars($_POST['stok']);
    $foto_lama = $item['foto'];

    // Jika ada file baru yang diupload
    if ($_FILES['foto']['name']) {
        $tmp_name= $_FILES['foto']['tmp_name'];
        $file_name = $_FILES['foto']['name'];
        
        $validExtensions = ['png', 'jpg', 'jpeg'];
        $fileExtension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $newFileName = date("Y-m-d H.i.s") .".". $fileExtension;
        if (!in_array($fileExtension, $validExtensions)) {
            echo "<script>alert('Tolong upload file gambar!');</script>";
        } else {
            if (move_uploaded_file($tmp_name, 'images/' . $newFileName)) {
                // Hapus file lama jika ada
                unlink('images/' . $foto_lama);
                $foto = $newFileName;
            }
        }
    } else {
        $foto = $foto_lama; // Tetap gunakan foto lama jika tidak ada foto baru
    }

    $sql = "UPDATE produk SET nama='$nama', deskripsi='$deskripsi', foto='$foto', harga='$harga', stok='$stok' WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Berhasil memperbarui produk!'); document.location.href = 'dashboard.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui produk!');</script>";
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
    <h1>Edit Data Produk</h1>
    <section class="form">
        <form action="" method="post" enctype = "multipart/form-data">
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
                <button type="submit" value="update" name="update">Submit</button>
        </form>
    </section>
</body>
</html>