<?php
require "koneksi.php"; 


session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];

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
