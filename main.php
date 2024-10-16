<?php
require 'connection.php';
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                <li><a class="dropdown-item" href="formMitra.php">Bermitra</a></li>
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
        </div>

    </div>

    <div class="wrapper">

        <a href="AndreCakwe.html">
            <div class="card">
                <div class="konteks">
                    <p class="judul">Warung Andre Cakwe</p>
                    <p>Jl. Margosari Gg. III, RT.02/RW.01, Salatiga,<br>Kec. Sidorejo, Kota Salatiga, Jawa Tengah 5071</p>
                    <p>Start From: 5.000 - 35.000</p>
                </div>
                <img src="andre.png" alt="andre">
            </div>
        </a>

        <a href="formrestoallmixjuice.html">
        <div class="card">
            <div class="konteks">
                <p class="judul">Allmix Juice and Chocolate</p>
                <p>Jl. Kemiri Raya No.6, Kec. Sidorejo, Kota Salatiga,<br>Jawa Tengah 5071</p>
                <p>Start From: 6.000 - 15.000</p>
            </div>
            <img src="juice.png" alt="juice">
        </div>
        </a>

        
        <a href="formrestomieperahu.html">
            <div class="card">
                <div class="konteks">
                    <p class="judul">Mie Ayam Perahu</p>
                    <p>Jl. Perahu No.4, Kalicacing, Kec. Sidomukti, <br>Kota Salatiga, Jawa Tengah 5071</p>
                    <p>Start From: 8.500 - 30.000</p>
                </div>
                <img src="prahu.png" alt="prahu">
            </div>
        </a>

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