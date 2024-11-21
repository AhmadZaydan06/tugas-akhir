<?php
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi login (hardcoded)
    if ($username === "guru" && $password === "guru123") {
        $_SESSION['loggedin'] = true;
        header("Location: dashboard.php");
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
    <title>Login Guru</title>
    <link rel="stylesheet" href="style.css">
    <style>
       /* Style login form */
       .login-container {
           width: 300px;
           margin: 100px auto;
           padding: 20px;
           border: 1px solid #ccc;
           border-radius: 10px;
           box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
           text-align: center;
           background-color: #ffffff;
       }

       .login-container h1 {
           font-size: 24px;
           margin-bottom: 20px;
           color: #333;
       }

       .login-container .form-group {
           margin-bottom: 15px;
           text-align: left;
       }

       .login-container label {
           display: block;
           font-weight: bold;
           margin-bottom: 5px;
           color: #555;
       }

       .login-container input[type="text"],
       .login-container input[type="password"] {
           width: calc(100% - 20px); /* Sesuaikan lebar dengan margin */
           padding: 10px;
           margin-top: 5px;
           border: 1px solid #ccc;
           border-radius: 5px;
           box-sizing: border-box;
       }

       .login-container input[type="text"]:focus,
       .login-container input[type="password"]:focus {
           border-color: #007bff;
           outline: none;
           background-color: #f8f9fa;
       }

       .login-container .error {
           color: red;
           font-size: 14px;
           margin-bottom: 15px;
       }

       .login-container button {
           width: 100%;
           padding: 10px;
           background-color: #007bff;
           color: white;
           border: none;
           border-radius: 5px;
           cursor: pointer;
           font-size: 16px;
           font-weight: bold;
       }

       .login-container button:hover {
           background-color: #0056b3;
       }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login Guru</h1>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password" required>
            </div>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>
