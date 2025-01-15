<?php
session_start();
include_once("config.php");

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi password dan konfirmasi password
    if ($password !== $confirm_password) {
        $error = "Password dan konfirmasi password tidak cocok!";
    } else {
        // Cek apakah username sudah terdaftar
        $result = mysqli_query($mysqli, "SELECT * FROM users WHERE username='$username'");
        if (mysqli_num_rows($result) > 0) {
            $error = "Username sudah terdaftar!";
        } else {
            // Enkripsi password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert data pengguna baru ke database
            $result = mysqli_query($mysqli, "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')");

            if ($result) {
                header("Location: login.php");  // Redirect ke halaman login setelah registrasi berhasil
                exit;
            } else {
                $error = "Terjadi kesalahan saat mendaftar. Silakan coba lagi.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Pengguna</title>
    <style>
        /* Global styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f9ff; /* Light blue background */
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Center the registration form */
        .register-container {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .register-form {
            background-color: white;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .register-form h2 {
            color: #1E90FF; /* Dodger Blue */
            margin-bottom: 20px;
        }

        .register-form input[type="text"], .register-form input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .register-form input[type="submit"] {
            background-color: #1E90FF; /* Dodger Blue */
            color: white;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .register-form input[type="submit"]:hover {
            background-color: #1565C0; /* Darker blue on hover */
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }

        .login-link {
            margin-top: 20px;
            text-align: center;
        }

        .login-link a {
            color: #1E90FF; /* Dodger Blue */
            font-weight: bold;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .register-form {
                padding: 20px;
                max-width: 90%;
            }
        }
    </style>
</head>
<body>

<div class="register-container">
    <div class="register-form">
        <h2>Registrasi Pengguna</h2>

        <?php
        if (isset($error)) {
            echo "<p class='error-message'>$error</p>";
        }
        ?>

        <form method="post" action="register.php">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="password" name="confirm_password" placeholder="Konfirmasi Password" required><br>
            <input type="submit" name="register" value="Daftar">
        </form>

        <div class="login-link">
            <p>Sudah memiliki akun? <a href="login.php">Login di sini</a></p>
        </div>
    </div>
</div>

</body>
</html>
