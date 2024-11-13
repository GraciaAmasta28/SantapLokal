<?php
require 'connection.php';
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}

$sessionMitra = $_SESSION['is_mitra'];
$sessionUsername = $_SESSION['username'];
$sessionId = $_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $queryMitra = "update users set is_mitra = 1 where id = '$sessionId'";

    if (mysqli_query($conn, $queryMitra)) {
        $sessionMitra = 1;
        echo "<script>alert('Anda sekarang menjadi mitra!');</script>";
        header("Location : main.php");
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }
}


$i = 1;
$queryTampil = "select * from resto";
$baris = mysqli_query($conn, $queryTampil);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Santap Lokal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Untitled-1.css">
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

    <div class="wrapper">

        <?php foreach($baris as $list): ?>
        <a href="pageResto.php?id=<?php echo $list['id']; ?>">
            <div class="card">
                <div class="konteks">
                    <p class="judul"><?php echo $list['nama']; ?></p>
                    <p><?php echo $list['alamat']; ?></p>
                    <p>Start From: <?php echo 'Rp' . number_format($list['min_price'], 0, ',', '.'); ?> - <?php echo 'Rp' . number_format($list['max_price'], 0, ',', '.'); ?></p>
                </div>
                <img src="<?php echo $list['foto']; ?>" alt="<?php echo $list['foto']; ?>">
            </div>
        </a>
        <?php endforeach; ?>


    </div>

    <!-- modal bermitra -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="display: grid;
    align-items: center;margin-top: 50%;">
            <div class="modal-header" style="margin: auto;">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Apakah anda yakin untuk bermitra?</h1>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-footer" style="display: flex; margin: auto; gap: 15px;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                <form method="post">
                    <input value="Ya" type="submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>



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

    .judul {
        font-size: 25px;
        font-weight: 700;
    }

    .explore{
        position: absolute;
        top: 100px;
        left: 10px;
    }

    .gambar {
        margin: auto;
        justify-content: center;
        align-items: center;
        width: 220px;
        height: auto;
    }

    .wrapper {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        margin: auto;
        width: 95%;
        gap: 20px;
        margin-top: 50px;
        padding-top: 15px;
        justify-content: space-around;
    }

    .card {
        background-color: #F7E6C4;
        display: flex;
        margin: auto;
        border-radius: 20px;
        margin-top: 15px;
        flex-direction: row;
        justify-content: space-around;
        gap: 0px;
        align-items: center;
        width: 100%;
        height: 40vh;

        img {
            margin-right: 25px;
            width: 220px;
            height: 220px;
            border-radius: 25px;
        }
    }
    a{
        text-decoration: none;
    }

</style>