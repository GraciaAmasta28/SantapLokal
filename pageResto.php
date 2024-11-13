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
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <link rel="stylesheet" href="global.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title><?php echo $resto['nama']; ?></title>
</head>

<body>
<div class="header sticky-top">
        <img class="gambar" src="logo.png" alt="logo">

        <div class="explore">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: larger; background-color: #5c3d00; color: white;">
                Explore
            </button>
            <ul class="dropdown-menu">
                <?php if($sessionMitra == 1): ?>
                <li><a class="dropdown-item" href="formMitra.php">Bermitra</a></li>
                    <?php else: ?>
                        
                <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#exampleModal">Daftar Mitra</a></li>
                <?php endif; ?>
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
        </div>

    </div>
    <main>
        <div class="wrapper">
            <div class="resto">
                <div class="info">
                    <p class="judul"><?php echo $resto['nama']; ?></p>
                    <p class="alamat"><?php echo $resto['alamat']; ?></p>
                    <p class="harga">Start From: <?php echo 'Rp' . number_format($resto['min_price'], 0, ',', '.'); ?> - <?php echo 'Rp' . number_format($resto['max_price'], 0, ',', '.'); ?></p>
                </div>
                <img src="<?php echo $resto['foto']; ?>" alt="<?php echo $resto['nama']; ?>">
            </div>
            <div class="garis"></div>
            <?php if ($menus && $menus->num_rows > 0): ?>
                <div class="wrapper-menu">
                    <?php foreach ($menus as $menu): ?>
                        <div class="card">
                            <img src="<?php echo $menu['foto']; ?>" alt="<?php echo $resto['nama']; ?>">
                            <p class="menu"><?php echo $menu['nama']; ?></p>
                            <p class="harga">Harga: <?php echo 'Rp' . number_format($menu['harga'], 0, ',', '.'); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>Tidak ada menu di resto ini</p>
            <?php endif; ?>
        </div>
    </main>
</body>

</html>

<style>
    .header {
        background-color: #AAB396;
        border-bottom: 1px solid #AAB396;
        margin-bottom: 5px;
        width: 100%;
        height: 150px;
        display: flex;
        padding-bottom: 15px;
        position: sticky;
    }

    .gambar{
        display: flex;
        margin: auto;
        width: 15%;
        height: auto;
    }

    .explore{
        position: fixed;
        left: 50px;
        top: 100px;
    }

    main {
        width: 100%;
        margin: 10px auto;
        background-color: #AAB396;

        .wrapper {
            width: 80%;
            margin: 20px auto;

            .resto{
                display: flex;
                width: 100%;
                height: 500px;
                background-color: #d9d9d9;
                justify-content: space-evenly;
                align-items: center;

                .info{
                    width: 600px;
                    /* background-color: aqua; */
                    word-wrap: break-word;

                    .judul{
                        font-size: 32px;
                        font-weight: 700;
                        margin: 10px 0px;
                    }
                    .alamat{
                        font-size: 32px;
                        margin: 10px 0px;
                    }
                    .harga{
                        font-size: 24px;
                    }
                }

                img{
                    width: 400px;
                    height: 400px;
                    background-position: center;
                    background-size: cover;
                }

            }
            .garis{
                height: 5px;
                width: 100%;
                background-color: #d9d9d9;
                margin: 50px 0px;
            }

            .wrapper-menu{
                width: 100%;
                display: grid;
                margin: 0px auto;
                grid-template-columns: repeat(7, 1fr);
                gap: 20px;

                .card{
                    text-align: center;
                    width: 250px;
                    background-color: #d9d9d9;
                    padding: 20px;
                    border-radius: 10px;
                    display: flex;
                    align-items: center;

                    img{
                        align-items: center;
                        width: 200px;
                        height: 200px;
                        object-fit: cover;
                        background-position: center;
                        background-size: cover;
                    }
                    .menu{
                        font-size: 24px;
                        font-weight: 600;
                    }
                    .harga{
                        font-size: 20px;
                        font-weight: 500;
                    }
                }
            }

        }


    }
</style>