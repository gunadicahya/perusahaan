<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");  // Redirect ke halaman login jika belum login
    exit;
}

include_once("config.php");

$result = mysqli_query($mysqli, "SELECT * FROM karyawan ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Karyawan</title>
    <style>
        /* Global styles */
        body, h1, p, table {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f9ff; /* Light blue background */
            color: #333;
        }

        /* Header Styles */
        header {
            background-color: #1E90FF; /* Dodger Blue */
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        header a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 16px;
            font-weight: bold;
        }

        header a:hover {
            text-decoration: underline;
        }

        /* Container for content */
        .container {
            width: 85%;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        /* Heading in container */
        h2 {
            text-align: center;
            color: #1E90FF; /* Dodger Blue */
            margin-bottom: 20px;
        }

        /* Table Wrapper */
        .table-wrapper {
            overflow-x: auto;
            margin-top: 20px;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #1E90FF; /* Dodger Blue */
            color: white;
            font-size: 18px;
        }

        tr:nth-child(even) {
            background-color: #e6f2ff; /* Light blue background for even rows */
        }

        tr:hover {
            background-color: #b3d1ff; /* Lighter blue when hovering */
        }

        /* Action Links (Edit/Delete) */
        .action-links a {
            text-decoration: none;
            color: #4682B4; /* Steel Blue */
            font-weight: bold;
            margin: 0 10px;
        }

        .action-links a:hover {
            color: #1C3D6D; /* Darker steel blue on hover */
        }

        /* Logout Button */
        .logout-link {
            text-align: center;
            margin-top: 20px;
        }

        .logout-link a {
            text-decoration: none;
            background-color: #1E90FF; /* Dodger Blue */
            color: white;
            padding: 12px 30px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
        }

        .logout-link a:hover {
            background-color: #1565C0; /* Darker blue on hover */
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            table, th, td {
                font-size: 14px;
            }

            header a {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>Data Karyawan Perusahaan</h1>
    <a href="add.php">Tambah Karyawan</a>
    <a href="logout.php">Logout</a>
</header>

<div class="container">
    <h2>Daftar Karyawan</h2>

    <div class="table-wrapper">
        <table>
            <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Posisi</th>
                <th>Tahun Bergabung</th>
                <th>Departemen</th>
                <th>Aksi</th>
            </tr>

            <?php  
            $i = 1;
            while ($employee_data = mysqli_fetch_array($result)) {         
                echo "<tr>";
                echo "<td>" . $i . "</td>";
                echo "<td>" . $employee_data['nama_karyawan'] . "</td>";
                echo "<td>" . $employee_data['posisi'] . "</td>";
                echo "<td>" . $employee_data['tahun_bergabung'] . "</td>";    
                echo "<td>" . $employee_data['departemen'] . "</td>";    
                echo "<td class='action-links'>
                        <a href='edit.php?id=$employee_data[id]'>Edit</a> | 
                        <a href='delete.php?id=$employee_data[id]'>Delete</a>
                    </td>";
                echo "</tr>"; 
                $i++;       
            }
            ?>
        </table>
    </div>

    <div class="logout-link">
        <a href="logout.php">Logout</a>
    </div>
</div>

</body>
</html>
