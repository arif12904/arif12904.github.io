<?php
session_start();


$admin_username = 'admin';
$admin_password = '123'; 

if (isset($_POST['login'])) {
    $username = htmlspecialchars($_POST['username']);
    $password =  htmlspecialchars($_POST['password']);

    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['username'] = $username;
        header('Location: dashboard.php'); 
        exit();  
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
    </form>
</section>

</body>
</html>
