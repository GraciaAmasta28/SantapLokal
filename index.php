<?php require 'globalcss.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SantapLokal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body style="background-color: #F9F6EE;">
  <nav class="navbar navbar-expand-lg navbar-light bg-light py-3 shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold" href="/">SantapLokal</a>
      <img src="logo.png" alt="Logo" width="100">
    </div>
  </nav>

  <div class="container mt-5 text-center">
    <div class="row align-items-center">
      <div class="col-lg-6 text-lg-start">
        <h1 class="display-4 fw-bold">Jelajahi Kuliner Lokal<br> Santap dengan Gaya</h1>
        <p class="mt-3 text-muted">Temukan makanan lokal terbaik di Salatiga hanya dengan beberapa klik.</p>
        <div class="d-flex justify-content-center justify-content-lg-start gap-3 mt-4">
          <a href="login.php" class="btn btn-dark px-4 py-2">Login</a>
          <a href="registrasi.php" class="btn btn-outline-dark px-4 py-2">Registrasi</a>
        </div>
      </div>
      <div class="col-lg-6 mt-4 mt-lg-0">
        <img src="Food.png" alt="Kuliner Lokal" class="img-fluid rounded shadow-lg">
      </div>
    </div>
  </div>

  <div class="container mt-5 py-5 bg-light rounded shadow">
    <h2 class="text-center fw-bold">Tentang SantapLokal</h2>
    <p class="text-center text-muted mt-3">
      SantapLokal adalah platform kuliner yang menghubungkan pengguna dengan berbagai pilihan makanan lokal dari restoran, warung, atau kedai makanan di sekitar mereka.
      Kami mendukung usaha kecil dan memperkenalkan cita rasa khas daerah Salatiga kepada lebih banyak orang.
    </p>
  </div>

  <footer class="py-4 bg-dark text-white text-center" style="margin-top: auto;">
    <p class="mb-0">© 2024 SantapLokal. All rights reserved.</p>
  </footer>

</body>

</html>

<style>
  html,
  body {
    height: 100%;
    margin: 0;
    display: flex;
    flex-direction: column;
  }

  body>footer {
    margin-top: auto;
  }
</style>