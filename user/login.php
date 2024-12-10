<?php
session_start();
if (isset($_POST["username"])) {
    include '../db.php';

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars(md5($_POST["password"]));

    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);


    if (mysqli_num_rows($result) > 0) {
        // mengabil data user 
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user'] = $user['username'];
        $_SESSION['id'] = $user['id'];
        header('Location: ../index.php');
        exit;

    } else {
        $error = "Username atau password salah!";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/png" href="../img/logoGili.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/style_login.css">
</head>

<body>

    <div class="login-content">
        <div class="container">
            <div class="card">
                <h2>Login</h2>
                <?php if (isset($error)): ?>
                    <p class="error-message"><?= $error ?></p>
                <?php endif; ?>
                <form action="" method="POST">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" required>
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" required>
                    <button type="submit" class="btn btn-primary" name="login">Login</button>
                    <button name="kembali"  onclick="location.href='../index.php'" class="btn btn-secondary">Kembali</button>
                </form>
                <p class="text-center mt-3">Belum punya akun? <a href="register.php">Daftar sekarang</a></p>
            </div>
        </div>
    </div>
</body>

</html>
