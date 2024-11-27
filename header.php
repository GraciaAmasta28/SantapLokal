<?php
require 'connection.php';
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}

$sessionMitra = $_SESSION['is_mitra'];
$sessionUsername = $_SESSION['username'];
$sessionId = $_SESSION['users_id'];

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

?>

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=arrow_back" />
</head>

<div class="navbar navbar-expand-lg bg-light shadow-sm sticky-top">
    <div class="container">

        <a class="navbar-brand d-flex align-items-center" href="main.php">
            <img src="logo.png" alt="logo" width="100" class="me-2">
            <span class="fw-bold fs-4" style="color: #5c3d00;">SantapLokal</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="exploreDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Explore
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="exploreDropdown">
                        <li><a class="dropdown-item" href="main.php">Beranda</a></li>
                        <?php if ($sessionMitra == 1): ?>
                            <li><a class="dropdown-item" href="formMitra.php">Daftarkan Resto</a></li>
                            <li><a class="dropdown-item" href="pageMitra.php">Kelola Restoran</a></li>
                        <?php else: ?>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Daftar Mitra</a></li>
                        <?php endif; ?>
                        <li><a class="dropdown-item" href="pageTersimpan.php">Resto Favorit</a></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>



<!-- modal bermitra -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="display: grid;
    align-items: center;margin-top: 50%;">
            <div class="modal-header" style="margin: auto;">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Apakah anda yakin untuk bermitra?</h1>
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

<style>
    .navbar-brand {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
    }

    .navbar-brand img {
        width: 100px;
        height: auto;
    }

    .navbar-brand span {
        color: #5c3d00;
        font-size: 1.5rem;
        font-weight: 700;
    }

    .nav-link {
        color: #5c3d00;
        font-weight: 500;
    }

    .nav-link:hover {
        color: #AAB396;
    }

    .dropdown-menu {
        background-color: #f7e6c4;
        border: none;
    }

    .dropdown-item {
        color: #5c3d00;
    }

    .dropdown-item:hover {
        background-color: #AAB396;
        color: white;
    }
</style>