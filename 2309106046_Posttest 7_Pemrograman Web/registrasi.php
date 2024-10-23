<?php
require "koneksi.php";
if (isset($_POST['register'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $role = htmlspecialchars($_POST['role']);
    
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "Username sudah terdaftar.";
        header('Location: registrasi.php?error=' . urlencode($error));
        exit();
    } else {
        // Insert data baru ke database
        $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $username, $password_hashed, $role);

        if ($stmt->execute()) {
            header('Location: login.php');
            exit();
        } else {
            $error = "Gagal mendaftarkan pengguna.";
            header('Location: registrasi.php?error=' . urlencode($error)); 
            exit();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" href="styles/registrasi.css">
</head>
<body>
<h2>Form Registrasi</h2>

<section class="form">
    <form action="registrasi.php" method="post">
        <?php
            if (isset($_GET['error'])) {
                echo '<p style="color:red; font-size:0.75rem; margin-bottom: 1rem">' . htmlspecialchars($_GET['error']) . '</p>';
            }
        ?>
        <label for="name">Nama</label><br>
        <input type="text" name="username" id="username" placeholder="username" required><br>

        <label for="password">Password</label><br>
        <input type="password" name="password" id="password" placeholder="password" required><br>

        <label for="role">Role</label><br>
        <select name="role" id="role" required>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select><br>

        <button type="submit" value="register" name="register">Submit</button>
        <p style="text-align: center; margin-top: 2rem;" >Sudah punya akun? <a href="registrasi.php" style="color: #0284c7; text-decoration: none;">Login sekarang!</a></p>
    </form>
</section>

</body>
</html>
