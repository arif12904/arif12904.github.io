<?php
require "koneksi.php";
session_start();

if (isset($_SESSION['username'])) {
    header('Location: dashboard.php'); 
    exit();
}

if (isset($_POST['login'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    
    $stmt = $conn->prepare("SELECT password, role FROM users WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password']; 
        $role = $row['role'];

        if (password_verify($password, $hashed_password)) {
            // Pengecekan role
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;

            if ($role == 'admin') {
                header('Location: dashboard.php'); 
                exit();
            } elseif ($role == 'user') {
                header('Location: lihat_data.php'); 
                exit();
            }
        } else {
            $error = "Username atau password salah.";
            header('Location: login.php?error=' . urlencode($error));  
            exit();
        }
    } else {
        $error = "Username atau password salah.";
        header('Location: login.php?error=' . urlencode($error));  
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="styles/login.css">
</head>
<body>
<h2>Login Admin</h2>

<section class="form">
    <form action="" method="post">
            <?php
                if (isset($_GET['error'])) {
                    echo '<p style="color:red; font-size:0.75rem; margin-bottom: 1rem">' . htmlspecialchars($_GET['error']) . '</p>';
                }
                ?>
            <label for="name">Nama</label><br>
            <input type="text" name="username" id="username" placeholder="username" required><br>
            <label for="password">Password</label><br>
            <input type="password" name="password" id="password" placeholder="password" required><br>
            <button type="submit" value="login" name="login">Submit</button>
            <p style="text-align: center; margin-top: 2rem;" >Tidak punya akun? <a href="registrasi.php" style="color: #0284c7; text-decoration: none;">registrasi sekarang!</a></p>
    </form>
</section>

</body>
</html>
