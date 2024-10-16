<?php
require "koneksi.php"; 


session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sqlGetImage = "SELECT foto FROM produk WHERE id = ?";
    $stmtGetImage = $conn->prepare($sqlGetImage);
    $stmtGetImage->bind_param("i", $id);
    $stmtGetImage->execute();
    $stmtGetImage->bind_result($foto);
    $stmtGetImage->fetch();
    $stmtGetImage->close();

    $uploadDirectory = 'images/';

    if ($foto && file_exists($uploadDirectory . $foto)) {
        unlink($uploadDirectory . $foto);
    }

    $sql = "DELETE FROM produk WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "
            <script>
                alert('Produk berhasil dihapus!');
                document.location.href = 'dashboard.php'; // Arahkan kembali ke halaman dashboard
            </script>";
    } else {
        echo "
            <script>
                alert('Gagal menghapus produk!');
                document.location.href = 'dashboard.php'; // Arahkan kembali ke halaman dashboard
            </script>";
    }

    $stmt->close(); // Menutup statement
}

$conn->close(); // Menutup koneksi
?>
