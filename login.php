<?php
require 'connection.php';
require 'globalcss.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = htmlspecialchars($_POST['username']); // Sanitasi input
    $password = htmlspecialchars($_POST['password']);

    $queryLogin = "select * from users where username = '$username'";

    $hasil = mysqli_query($conn, $queryLogin);

    if ($hasil->num_rows > 0) {
        $row = $hasil->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            // set session username, id, dan informasi mitra
            $_SESSION['username'] = $row['username'];
            $_SESSION['is_mitra'] = $row['is_mitra'];
            $_SESSION['users_id'] = $row['id'];

            header("Location: main.php");
        } else {
            echo "Password Salah";
        }
    } else {
        echo "<script>alert('Username Tidak ditemukan');
        window.location.href = 'login.php';
        </script>
        ";
    }


    $conn->close();
}
if (isset($_SESSION["username"])) {
    header("Location: main.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=arrow_back_ios" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Santap Lokal Login</title>
</head>

<body>
    <!-- Wrapper Utama -->
    <div class="d-flex align-items-center justify-content-center vh-100 bg-light">
        <div class="card shadow-lg" style="width: 400px; border-radius: 15px;">
            <div class="card-body text-center p-4">
                <!-- Logo -->
                <img src="logo.png" alt="SantapLokal" width="120" class="mb-4">
                <h4 class="mb-3" style="color: #5c3d00; font-weight: 700;">Login ke SantapLokal</h4>
                <!-- Form Login -->
                <form method="post" action="" autocomplete="off" class="mt-3">
                    <div class="mb-3">
                        <label for="username" class="form-label fw-bold">Username</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
                    </div>
                    <button type="submit" class="btn w-100 text-white" style="background-color: #AAB396;">Masuk</button>
                </form>
                <!-- Link Kembali -->
                <a href="/" class="text-decoration-none mt-3 d-block" style="color: #5c3d00;">
                    <i class="bi bi-arrow-left-circle"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</body>

</html>



<style>
    * {
        padding: 0;
        margin: 0;
    }

    body {
        background-color: #F7E6C4;
        /* Warna latar belakang yang konsisten */
    }

    .card {
        border: none;
        /* Hapus border default kartu */
    }

    .card-body {
        border-radius: 15px;
        /* Menjaga sudut membulat */
        background: #ffffff;
        /* Warna putih untuk form */
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        /* Efek bayangan */
    }

    .form-control {
        border-radius: 5px;
        /* Atur radius input */
        border: 1px solid #876647;
        /* Warna border sesuai tema */
    }

    .btn:hover {
        background-color: #9BAE58;
        /* Warna hover tombol */
    }

    a {
        font-size: 14px;
        font-weight: 600;
    }
</style>