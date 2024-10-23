<?php
require "koneksi.php";

session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header('Location: login.php');
    exit();
}

$data = [];

if (isset($_GET['search'])) {
    $search = $_GET['search'];

    $sql = "SELECT * FROM produk WHERE nama LIKE ?";
    $stmt = $conn->prepare($sql);
    $search_param = "%" . $search . "%";
    $stmt->bind_param("s", $search_param);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Produk</title>
    <link rel="stylesheet" href="styles/lihatdata.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <h1>Cari Produk</h1>
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Masukkan nama produk" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" autocomplete="off" required>
        <button type="submit">Cari</button>
    </form>

    <?php if (isset($_GET['search'])): ?>
        <h2>Hasil Pencarian:</h2>
        <?php if (!empty($data)): ?>
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
                    <?php foreach ($data as $item): ?>
                        <tr>
                            <td><?php echo $item['id']; ?></td>
                            <td><?php echo $item['nama']; ?></td>
                            <td><?php echo $item['deskripsi']; ?></td>
                            <td><img src="images/<?php echo $item['foto']; ?>" alt="foto produk" width="100"></td>
                            <td><?php echo $item['harga']; ?></td>
                            <td><?php echo $item['stok']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
        <?php else: ?>
            <p>Produk tidak ditemukan</p>
        <?php endif; ?>
    <?php endif; ?>
</body>

</html>