<?php
session_start();
include_once("config.php");

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek apakah username dan password valid
    $result = mysqli_query($mysqli, "SELECT * FROM users WHERE username='$username'");
    $user = mysqli_fetch_array($result);

    if ($user && password_verify($password, $user['password'])) {
        // Jika login berhasil, buat session untuk pengguna
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");  // Redirect ke halaman utama
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
    <style>
        /* Global styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f9ff; /* Light blue background */
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Center the login form */
        .login-container {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-form {
            background-color: white;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-form h2 {
            color: #1E90FF; /* Dodger Blue */
            margin-bottom: 20px;
        }

        .login-form input[type="text"], .login-form input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .login-form input[type="submit"] {
            background-color: #1E90FF; /* Dodger Blue */
            color: white;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .login-form input[type="submit"]:hover {
            background-color: #1565C0; /* Darker blue on hover */
        }

        /* Error message styling */
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .login-form {
                padding: 20px;
                max-width: 90%;
            }
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-form">
        <h2>Login</h2>

        <?php
        if (isset($error)) {
            echo "<p class='error-message'>$error</p>";
        }
        ?>

        <form method="post" action="login.php">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="submit" name="login" value="Login">
        </form>
    </div>
</div>

</body>
</html>
