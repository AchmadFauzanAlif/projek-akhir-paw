<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek database
    $query = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $query->execute([$username, $password]);
    $user = $query->fetch();

    if ($user) {
        $_SESSION['user'] = $user['username'];
        header('Location: index.php');
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #000000, #3533cd, #3533cd);
            /* Gradien biru gelap */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #000;
        }

        .login-container {
            background: #f2f2f2;
            border-radius: 15px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            padding: 30px 40px;
            width: 350px;
            text-align: center;
        }

        .logo-form {
            display: flex;
        }

        .label {
            text-align: left;
        }

        .login-container img {
            width: 50px;
            height: 50px;
        }

        .login-container h1 {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 20px;
            color: #000;
        }

        .login-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 1rem;
        }

        .login-container .btn {
            width: 48%;
            padding: 10px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-register {
            background: #5c727a;
            color: #fff;
        }

        .btn-login {
            background: #5c727a;
            color: #fff;
        }

        .footer {
            margin-top: 10px;
            font-size: 1.2rem;
            color: #333;
            font-family: Verdana;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="logo-form">
        <img src="../img/logoGili.png" alt="Gili Labak Logo">
        </div>
        <h1>Daftar Akun</h1>
        <hr>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>
        <form action="index.php" method="POST">
            <div class="label">
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="Username" required>
                <br><br>
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Password" required>
                <br><br>
                <label for="telp">Nomor Telpohne</label>
                <input type="number" name="telp" id="telp" placeholder="Nomor Telephone">
                <br><br>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Email">
            </div>
            <div style="display: flex; justify-content: space-between; margin-top: 10px;">
                <a href="register.php"><button type="button" class="btn btn-register">Daftar Akun</button></a>
                <button type="submit" class="btn btn-login">Masuk</button>
            </div>
        </form>
    </div>
</body>

</html>