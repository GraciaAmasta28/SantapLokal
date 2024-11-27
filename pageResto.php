<?php
require 'connection.php';

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

$sessionUsername = $_SESSION['username'];
$sessionMitra = $_SESSION['is_mitra'];

if (isset($_GET['id'])) {
    $resto_id = $_GET['id'];

    $queryResto = "select * from resto where id = '$resto_id'";

    $hasil = $conn->query($queryResto);

    if ($hasil->num_rows > 0) {
        $resto = $hasil->fetch_assoc();

        $queryMenu = "select * from menu where resto_id = '$resto_id'";
        $menus = $conn->query($queryMenu);
    } else {
        echo "<script>alert('Restoran tidak ditemukan.');</script>";
        echo "<script>window.location.href='main.php';</script>";
    }
} else {
    echo "<script>alert('ID Restoran tidak valid.');</script>";
    echo "<script>window.location.href='main.php';</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="global.css">
    <title>SantapLokal | <?php echo $resto['nama']; ?></title>
</head>

<body style="background-color: #F7F5F2;">

    <?php require 'header.php' ?>

    <main>
        <div class="container py-5">
            <!-- Informasi Restoran -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h1 class="display-4"><?php echo $resto['nama']; ?></h1>
                    <p class="lead"><?php echo $resto['alamat']; ?></p>
                    <p class="h5">Start From: <?php echo 'Rp' . number_format($resto['min_price'], 0, ',', '.'); ?> - <?php echo 'Rp' . number_format($resto['max_price'], 0, ',', '.'); ?></p>
                </div>
                <div class="col-md-6">
                    <!-- Gambar Restoran -->
                    <img src="<?php echo $resto['foto']; ?>" class="img-fluid rounded resto-img" alt="<?php echo $resto['nama']; ?>">
                </div>
            </div>

            <hr class="my-5">

            <!-- Daftar Menu -->
            <?php if ($menus && $menus->num_rows > 0): ?>
                <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
                    <?php foreach ($menus as $menu): ?>
                        <div class="col">
                            <div class="card shadow-sm border-light">
                                <!-- Gambar Menu -->
                                <img src="<?php echo $menu['foto']; ?>" class="card-img-top menu-img" alt="<?php echo $resto['nama']; ?>">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?php echo $menu['nama']; ?></h5>
                                    <p class="card-text"><?php echo 'Rp' . number_format($menu['harga'], 0, ',', '.'); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-center">Tidak ada menu di resto ini</p>
            <?php endif; ?>
        </div>

        <footer class="py-4 bg-dark text-white text-center" style="margin-top: auto;">
            <p class="mb-0">© 2024 SantapLokal. All rights reserved.</p>
        </footer>
    </main>

</body>

</html>

<style>
    .resto-img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        /* Gambar akan mengisi area tanpa distorsi */
        object-position: center;
        /* Menjaga gambar tetap di tengah */
    }

    /* Styling untuk gambar menu */
    .menu-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        /* Gambar akan mengisi area tanpa distorsi */
        object-position: center;
        /* Menjaga gambar tetap di tengah */
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

    /* main {
        width: 100%;
        margin: 10px auto;
        background-color: #AAB396;
    }

    .wrapper {
        width: 80%;
        margin: 20px auto;
    }

    .resto {
        display: flex;
        width: 100%;
        height: auto;
        background-color: #d9d9d9;
        justify-content: space-between;
        align-items: center;
        padding: 20px 0;
        border-radius: 10px;
    }

    .resto .info {
        width: 50%;
        word-wrap: break-word;
    }

    .resto .info .judul {
        font-size: 32px;
        font-weight: 700;
        margin: 10px 0;
    }

    .resto .info .alamat {
        font-size: 32px;
        margin: 10px 0;
    }

    .resto .info .harga {
        font-size: 24px;
    }

    .resto img {
        width: 400px;
        height: 400px;
        background-position: center;
        background-size: cover;
        object-fit: cover;
    }

    .garis {
        height: 5px;
        width: 100%;
        background-color: #d9d9d9;
        margin: 50px 0;
    }

    .wrapper-menu {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
    }

    .card {
        text-align: center;
        background-color: #d9d9d9;
        padding: 20px;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .card img {
        width: 200px;
        height: 200px;
        object-fit: cover;
        background-position: center;
        background-size: cover;
        border-radius: 10px;
    }

    .menu {
        font-size: 24px;
        font-weight: 600;
        margin-top: 10px;
    }

    .harga {
        font-size: 20px;
        font-weight: 500;
        margin-top: 10px;
    }

    /* Responsive Styles */
    /* @media (max-width: 768px) {
        .resto {
            flex-direction: column;
            align-items: center;
            height: auto;
        }

        .resto .info {
            width: 100%;
            text-align: center;
        }

        .resto img {
            width: 300px;
            height: 300px;
            margin-top: 20px;
        }

        .wrapper-menu {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        }
    } */
</style>