<?php
require 'connection.php';
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}

$sessionUsername = $_SESSION['username'];
$sessionMitra = $_SESSION['is_mitra'];



if ($_SERVER["REQUEST_METHOD"] == 'POST') {


    $resto = htmlspecialchars($_POST['resto']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $minPrice = htmlspecialchars($_POST['min-price']);
    $maxPrice = htmlspecialchars($_POST['max-price']);

    // validasi harga
    if ($minPrice > $maxPrice) {
        echo "
    <script>
    alert('Harga terendah tidak boleh melebihi harga tertinggi, silahkan ulangi proses');
    window.location.href = 'formMitra.php';
    </script>
    ";
        exit;
    }

    $target_dir = "image/";
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $uploadOk = 1;

    // Validasi apakah file yang diupload adalah gambar
    $check = getimagesize($_FILES["foto"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "<script>alert('File bukan gambar!');</script>";
        $uploadOk = 0;
    }

    // Cek jika file sudah ada
    if (file_exists($target_file)) {
        echo "<script>alert('File sudah ada.');</script>";
        $uploadOk = 0;
    }

    // Batasi ukuran file (misalnya maksimal 10MB)
    if ($_FILES["foto"]["size"] > 10000000) {
        echo "<script>alert('Ukuran file terlalu besar!');</script>";
        $uploadOk = 0;
    }

    // Batasi tipe file yang bisa diupload
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "<script>alert('Hanya file JPG, JPEG, dan PNG yang diperbolehkan!');</script>";
        $uploadOk = 0;
    }

    // Cek apakah uploadOk 0 karena ada error
    if ($uploadOk == 0) {
        echo "<script>alert('File tidak bisa diupload!');</script>";
    } else {
        // Jika semua validasi ok, pindahkan file ke folder tujuan
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            // Insert data restoran ke database
            $query = "INSERT INTO resto (added_by, nama, alamat, min_price, max_price, foto) 
                      VALUES ('$sessionUsername', '$resto', '$alamat', '$minPrice', '$maxPrice', '$target_file')";

            if (mysqli_query($conn, $query)) {

                $resto_id = mysqli_insert_id($conn);

                $ambilSession = "select nama from resto where id = '$resto_id'";

                $hasil = mysqli_query($conn, $ambilSession);

                if ($hasil->num_rows > 0) {
                    $row = $hasil->fetch_assoc();

                    $nama_resto = $row['nama'];

                    $_SESSION['resto_id'] = $resto_id;
                    $_SESSION['nama_resto'] = $nama_resto;
                }

                echo "<script>alert('Restoran berhasil ditambahkan!');</script>";
                echo "<script>window.location.href='main.php';</script>";

                // Sekarang lakukan input menu menggunakan $resto_id
                $menu_names = $_POST['menu_name'];
                $prices = $_POST['price'];
                $photos = $_FILES['photo'];

                for ($i = 0; $i < count($menu_names); $i++) {
                    $menu_name = $menu_names[$i];
                    $price = $prices[$i];
                    $photo_name = $photos['name'][$i];
                    $photo_tmp_name = $photos['tmp_name'][$i];

                    // Upload foto menu ke folder "menuImg"
                    $upload_dir = "menuImg/";
                    $photo_path = $upload_dir . basename($photo_name);

                    if (move_uploaded_file($photo_tmp_name, $photo_path)) {
                        // Masukkan data menu ke database menggunakan $resto_id
                        $sql = "INSERT INTO menu (resto_id, nama, harga, foto) VALUES ('$resto_id', '$menu_name', '$price', '$photo_path')";
                        if ($conn->query($sql) === FALSE) {
                            die("Error: " . $sql . "<br>" . $conn->error);
                        }
                    } else {
                        die("Error uploading file " . $photo_name);
                    }
                }
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "<script>alert('Terjadi kesalahan saat upload gambar.');</script>";
        }
    }
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
            <form method="post" enctype="multipart/form-data" autocomplete="off">
                <label for="nama">NAMA KEDAI/RESTO:</label>
                <input type="text" id="nama" name="resto">

                <label for="alamat">ALAMAT:</label>
                <textarea id="alamat" name="alamat"></textarea>

                <label for="harga">HARGA TERENDAH:</label>
                <input type="text" id="harga" name="min-price">

                <label for="harga">HARGA TERTINGGI:</label>
                <input type="text" id="harga" name="max-price">

                <label for="foto">FOTO RESTORAN</label>
                <input type="file" name="foto" id="foto" accept=".jpg, .jpeg, .png">

                <h3>Data Menu</h3>
            <div id="menu-container">
                <!-- Tempat input menu akan di sini -->
            </div>

            <button type="button" id="add-menu-button">Tambah Menu (Max 7)</button><br>
            <button type="button" id="del-menu-button">Batalkan Menu</button><br>
            <input type="submit" value="Submit">
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

<script>
    let menuCount = 0;
    document.getElementById('add-menu-button').addEventListener('click', function() {
        if (menuCount < 7) {
            menuCount++;
            const menuDiv = document.createElement('div');
            menuDiv.setAttribute('id', `menu-${menuCount}`);
            menuDiv.innerHTML = `
                    <h4>Menu ${menuCount}</h4>
                    <label for="menu_name_${menuCount}">Nama Menu:</label>
                    <input type="text" name="menu_name[]" required><br>
                    <label for="price_${menuCount}">Harga:</label>
                    <input type="number" name="price[]" step="0.01" required><br>
                    <label for="photo_${menuCount}">Foto Menu:</label>
                    <input type="file" name="photo[]" accept=".jpg, .jpeg, .png" required><br>
                `;
            document.getElementById('menu-container').appendChild(menuDiv);
        } else {
            alert("Maksimal 7 menu dapat ditambahkan.");
        }
    });
    document.getElementById('del-menu-button').addEventListener('click', function() {
        if (menuCount > 0) {
            const lastMenu = document.getElementById(`menu-${menuCount}`);
            document.getElementById('menu-container').removeChild(lastMenu);
            menuCount -= 1;
        } else {
            alert('Anda belum menambahkan Menu!');
        }
    });
</script>