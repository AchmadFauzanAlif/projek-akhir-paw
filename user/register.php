<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h2>Daftar Akun</h2>
    <form action="save_register.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <label for="tel">No. Telp:</label>
        <input type="text" name="tel" id="tel" required>
        <button type="submit">Daftar</button>
    </form>
</body>
</html>
