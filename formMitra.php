<?php
require 'connection.php';
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}

$sessionUsername = $_SESSION['username'];
$sessionMitra = $_SESSION['is_mitra'];
$sessionUserId = $_SESSION['users_id'];



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
                      VALUES ('$sessionUserId', '$resto', '$alamat', '$minPrice', '$maxPrice', '$target_file')";

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
</head>

<body>

    <?php include 'header.php' ?>

    <div class="container mt-5">
        <section class="form-section p-4">
            <h2 class="text-center mb-4">FORM BERMITRA</h2>
            <form method="post" enctype="multipart/form-data" autocomplete="off">
                <!-- Nama Kedai -->
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Kedai/Resto:</label>
                    <input type="text" class="form-control" id="nama" name="resto" placeholder="Masukkan nama kedai" required>
                </div>

                <!-- Alamat -->
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat:</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat kedai" required></textarea>
                </div>

                <!-- Harga -->
                <div class="mb-3">
                    <label for="min-price" class="form-label">Harga Terendah:</label>
                    <input type="number" class="form-control" id="min-price" name="min-price" placeholder="Masukkan harga terendah" required>
                </div>
                <div class="mb-3">
                    <label for="max-price" class="form-label">Harga Tertinggi:</label>
                    <input type="number" class="form-control" id="max-price" name="max-price" placeholder="Masukkan harga tertinggi" required>
                </div>

                <!-- Foto -->
                <div class="mb-4">
                    <label for="foto" class="form-label">Foto Restoran:</label>
                    <input class="form-control" type="file" id="foto" name="foto" accept=".jpg, .jpeg, .png" required>
                </div>

                <!-- Data Menu -->
                <h3 class="mb-3">Data Menu</h3>
                <div id="menu-container">
                    <!-- Menu inputs will be dynamically added here -->
                </div>
                <div class="row mb-4">
                    <div class="col-6">
                        <button type="button" class="btn btn-secondary w-100" id="add-menu-button">Tambah Menu (Max 7)</button>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-danger w-100" id="del-menu-button">Batalkan Menu</button>
                    </div>
                </div>


                <div class="row mb-4">
                    <div class="col-6">
                        <input type="submit" class="btn btn-success w-100" value="Submit">
                    </div>
                    <div class="col-6">
                        <a href="/main.php" class="btn btn-warning w-100 text-center">Kembali</a>
                    </div>
                </div>
            </form>
        </section>
    </div>

    <footer class="mt-5 py-4 bg-dark text-white text-center" style="margin-top: auto;">
        <p class="mb-0">© 2024 SantapLokal. All rights reserved.</p>
    </footer>

    <script>
        let menuCount = 0;
        document.getElementById('add-menu-button').addEventListener('click', function() {
            if (menuCount < 7) {
                menuCount++;
                const menuDiv = document.createElement('div');
                menuDiv.classList.add('menu-item');
                menuDiv.setAttribute('id', `menu-${menuCount}`);
                menuDiv.innerHTML = `
                    <h5>Menu ${menuCount}</h5>
                    <div class="mb-3">
                        <label for="menu_name_${menuCount}" class="form-label">Nama Menu:</label>
                        <input type="text" class="form-control" name="menu_name[]" required>
                    </div>
                    <div class="mb-3">
                        <label for="price_${menuCount}" class="form-label">Harga:</label>
                        <input type="number" class="form-control" name="price[]" required>
                    </div>
                    <div class="mb-3">
                        <label for="photo_${menuCount}" class="form-label">Foto Menu:</label>
                        <input class="form-control" type="file" name="photo[]" accept=".jpg, .jpeg, .png" required>
                    </div>
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
                menuCount--;
            } else {
                alert('Belum ada menu yang ditambahkan!');
            }
        });
    </script>
</body>

</html>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #F7F5F2;
        color: #333;
    }

    .form-section {
        background-color: #aab396;
        color: white;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    h2 {
        font-size: 28px;
        font-weight: bold;
        text-align: center;
    }

    label {
        font-size: 16px;
        margin-bottom: 5px;
        font-weight: 500;
    }

    input,
    textarea {
        background-color: #f9f7f3;
        border: 1px solid #7c2f1b;
        border-radius: 5px;
    }

    button:hover {
        opacity: 0.9;
    }

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