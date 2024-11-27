<?php
require 'connection.php';
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}

$sessionMitra = $_SESSION['is_mitra'];
$sessionUsername = $_SESSION['username'];
$sessionId = $_SESSION['users_id'];

$i = 1;
$queryTampil = "select * from resto";
$baris = mysqli_query($conn, $queryTampil);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome, <?php echo $sessionUsername ?>!</title>
</head>

<body>
    <?php require 'header.php' ?>

    <main class="container my-5">
        <div class="row g-4">
            <?php foreach ($baris as $list): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card resto-card">
                        <a href="pageResto.php?id=<?php echo $list['id']; ?>">
                            <img src="<?php echo $list['foto']; ?>" class="card-img-top" alt="<?php echo $list['foto']; ?>">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $list['nama']; ?></h5>
                            <p class="card-text"><?php echo $list['alamat']; ?></p>
                            <p class="card-price">
                                Start From: <?php echo 'Rp' . number_format($list['min_price'], 0, ',', '.'); ?> - <?php echo 'Rp' . number_format($list['max_price'], 0, ',', '.'); ?>
                            </p>
                            <a href="simpanResto.php?id=<?php echo $list['id']; ?>" class="btn btn-save">Simpan</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <footer class="py-4 bg-dark text-white text-center" style="margin-top: auto;">
        <p class="mb-0">© 2024 SantapLokal. All rights reserved.</p>
    </footer>
</body>

</html>


<style>
    /* Global Styles */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #F7F5F2;
        margin: 0;
        padding: 0;
        color: #333;
    }

    /* Konten Utama */
    main {
        padding: 20px 0;
    }

    /* Card Styles */
    .resto-card {
        border: none;
        border-radius: 10px;
        background-color: #FFF;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .resto-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .resto-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .card-body {
        padding: 15px;
        text-align: center;
    }

    .card-title {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .card-text {
        font-size: 14px;
        color: #666;
        margin-bottom: 15px;
    }

    .card-price {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 15px;
        color: #AAB396;
    }

    .btn-save {
        background-color: #AAB396;
        color: white;
        padding: 10px 15px;
        border-radius: 20px;
        text-transform: uppercase;
        font-weight: bold;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .btn-save:hover {
        background-color: #9BAE58;
    }

    /* Footer */
    .footer {
        background-color: #AAB396;
        color: white;
    }

    body>footer {
        margin-top: auto;
    }

    html,
    body {
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column;
    }
</style>