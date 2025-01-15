<?php

include_once("config.php");

if (isset($_POST['submit'])) {
    $nama_karyawan = $_POST['nama_karyawan'];
    $posisi = $_POST['posisi'];
    $tahun_bergabung = $_POST['tahun_bergabung'];
    $departemen = $_POST['departemen'];

    // Insert data ke database
    $result = mysqli_query($mysqli, "INSERT INTO karyawan(nama_karyawan, posisi, tahun_bergabung, departemen) VALUES('$nama_karyawan', '$posisi', '$tahun_bergabung', '$departemen')");

    // Redirect ke halaman index
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Karyawan</title>
    <style>
        /* Global styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f9ff; /* Light blue background */
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Center the add employee form */
        .add-container {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .add-form {
            background-color: white;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            width: 100%;
            max-width: 450px;
            text-align: center;
        }

        .add-form h2 {
            color: #1E90FF; /* Dodger Blue */
            margin-bottom: 20px;
        }

        .add-form input[type="text"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .add-form input[type="submit"] {
            background-color: #1E90FF; /* Dodger Blue */
            color: white;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .add-form input[type="submit"]:hover {
            background-color: #1565C0; /* Darker blue on hover */
        }

        .back-link {
            margin-top: 20px;
            text-align: center;
        }

        .back-link a {
            color: #1E90FF; /* Dodger Blue */
            font-weight: bold;
            text-decoration: none;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .add-form {
                padding: 20px;
                max-width: 90%;
            }
        }
    </style>
</head>
<body>

<div class="add-container">
    <div class="add-form">
        <h2>Tambah Karyawan</h2>

        <form method="post" action="add.php">
            <input type="text" name="nama_karyawan" placeholder="Nama Karyawan" required><br>
            <input type="text" name="posisi" placeholder="Posisi" required><br>
            <input type="text" name="tahun_bergabung" placeholder="Tahun Bergabung" required><br>
            <input type="text" name="departemen" placeholder="Departemen" required><br>
            <input type="submit" name="submit" value="Tambah">
        </form>

        <div class="back-link">
            <p><a href="index.php">Kembali ke Daftar Karyawan</a></p>
        </div>
    </div>
</div>

</body>
</html>
