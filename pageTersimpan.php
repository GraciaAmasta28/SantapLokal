<?php
require 'connection.php';

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

$sessionUsername = $_SESSION['username'];
$sessionUserId = $_SESSION['users_id'];


$queryTersimpan = "select resto.id, resto.nama, resto.alamat, resto.min_price, resto.max_price, resto.foto 
from simpan_resto
join resto on simpan_resto.resto_id = resto.id 
where simpan_resto.user_id = '$sessionUserId'";

$hasil = $conn->query($queryTersimpan);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tersimpan</title>
</head>

<body>
    <?php require 'header.php' ?>

    <main class="container py-5">
        <h2 class="mb-4">Resto favorit kamu</h2>

        <?php if ($hasil->num_rows > 0): ?>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php foreach ($hasil as $list) : ?>
                    <div class="col">
                        <div class="card resto-card shadow-sm border-light h-100">
                            <a href="pageResto.php?id=<?php echo $list['id']; ?>">
                                <img src="<?php echo $list['foto']; ?>" class="card-img-top" alt="<?php echo $list['foto']; ?>">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $list['nama']; ?></h5>
                                <p class="card-text"><?php echo $list['alamat']; ?></p>
                                <p class="card-text">Start From: <?php echo 'Rp' . number_format($list['min_price'], 0, ',', '.'); ?> - <?php echo 'Rp' . number_format($list['max_price'], 0, ',', '.'); ?></p>
                            </div>
                            <div class="card-footer text-center">
                                <a class="btn btn-danger btn-sm" href="hapusSimpanan.php?delete=<?php echo $list['id']; ?>">Hapus</a>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center" role="alert">Belum ada restoran tersimpan</div>
        <?php endif; ?>
    </main>

    <footer class="py-4 bg-dark text-white text-center" style="margin-top: auto;">
        <p class="mb-0">© 2024 SantapLokal. All rights reserved.</p>
    </footer>
</body>

</html>

<style>
    body>footer {
        margin-top: auto;
    }

    html,
    body {
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column;
        background-color: #F7F5F2;
    }

    /* Menambahkan animasi pada card */
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
        /* Mengangkat card saat hover */
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        /* Menambahkan bayangan lebih tajam saat hover */
    }

    /* Mengatur ukuran gambar pada card */
    .resto-card img {
        width: 100%;
        height: 180px;
        /* Menetapkan tinggi gambar */
        object-fit: cover;
        /* Memastikan gambar menutupi area yang disediakan */
    }


    /* main {
        background-color: beige;
        width: 95%;
        height: auto;
        margin: 10px auto;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .container-resto {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        width: 100%;
    }

    .card {
        background-color: #F7E6C4;
        display: flex;
        border-radius: 20px;
        margin: 15px auto;
        flex-direction: column;
        justify-content: space-around;
        align-items: center;
        width: 100%;
        height: 35vh;

        .konteks {

            .judul {
                font-size: 25px;
                font-weight: 700;
            }
        }

        img {
            margin-right: 25px;
            width: 220px;
            height: 220px;
            border-radius: 25px;
            object-fit: cover;
            background-position: center;
            background-size: cover;
        }

        .del-button {
            background-color: #FF6347;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            cursor: pointer;
            margin-top: 10px;
            text-decoration: none;
        }

        .del-button:hover {
            opacity: 80%;
        }
    }

    a.resto-link {
        text-decoration: none;
        width: 100%;
        color: inherit;
        display: flex;
        justify-content: space-around;
        align-items: center;

    } */
</style>