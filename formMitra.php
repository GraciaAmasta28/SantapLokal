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
    <title>Form Bermitra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styleMitra.css">
</head>
<body>
    <div class="container">
        <header>
            <img src="Screenshot_2024-09-26_073909-removebg-preview.png" alt="Santaplokal Logo" class="logo">
        </header>

        <section class="form-section">
            <h2>FORM BERMITRA:</h2>
            <form>
                <label for="nama">NAMA KEDAI/RESTO:</label>
                <input type="text" id="nama" name="nama">

                <label for="alamat">ALAMAT:</label>
                <textarea id="alamat" name="alamat"></textarea>

                <label for="harga">RANGE HARGA:</label>
                <input type="text" id="harga" name="harga">

                <label for="deskripsi">DESKRIPSI KEDAI/RESTO:</label>
                <textarea id="deskripsi" name="deskripsi"></textarea>

                <label for="menu">MENU ANDALAN DI RESTO ANDA (MAKSIMAL 7 MENU):</label>
                <textarea id="deskripsi" name="deskripsi"></textarea>

                <label for="foto">UPLOAD FOTO MENU YANG AKAN DITAMPILKAN(1 Foto resto dan 7 foto menu andalan):</label>
                <textarea id="deskripsi" name="deskripsi"></textarea>

                <button type="submit">Submit</button>
            </form>
        </section>
    </div>

    <footer style="background-color: #AAB396; color: white;" class="mt-5 w-screen">
        <div class="container">
            <div class="row text-md-left">
                <div class="col-sm-12 col-lg-3 col-md-6 mb-4">
                    <p>Jelajahi Kuliner Lokal Dengan Gaya</p>
                </div>

                <div class="col-sm-12 col-lg-3 col-md-6 mb-4">
                    <p>Created by Gracia Amasta Devanti, Christina Sun, Clarista Quinny Majesty S</p>
                </div>

                <div class="col-md-6 col-lg-3 d-flex justify-content-center">
                    <div>
                      <h6 class="mb-4">Link</h6>
                      <p class="lh-1">
                        <a href="#" class="text-reset">Santap Lokal</a>
                      </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 text-end">
                    <div class="row">
                         <div class="col-12">
                            <img src="Screenshot_2024-09-26_073909-removebg-preview.png" alt="Santaplokal Logo" class="footer-logo float-end">
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>