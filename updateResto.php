<?php
require 'connection.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

$sessionUsername = $_SESSION['username'];

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $tampilResto = "select * from resto where id = '$id'";
    $hasil = $conn->query($tampilResto);

    if ($hasil->num_rows > 0) {
        $resto = $hasil->fetch_assoc();
        $tampilMenu = "select * from menu where resto_id = '$id'";
        $hasilMenu = $conn->query($tampilMenu);
        $menus = $hasilMenu->fetch_all(MYSQLI_ASSOC);
    } else {
        echo "<script>alert('Restoran tidak ditemukan');
        window.location.href = 'main.php';
        </script>";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $restoNama = $_POST['resto'];
    $alamat = $_POST['alamat'];
    $minPrice = $_POST['min-price'];
    $maxPrice = $_POST['max-price'];

    if ($_FILES['foto']['name']) {
        $fotoResto = $_FILES['foto']['name'];
        $fotoRestoTmp = $_FILES['foto']['tmp_name'];
        $fotoRestoPath = "image/" . $fotoResto;
        move_uploaded_file($fotoRestoTmp, $fotoRestoPath);

        $updateResto = "update resto set nama='$restoNama', alamat='$alamat', min_price='$minPrice', max_price='$maxPrice', foto='$fotoRestoPath' where id='$id'";
    } else {
        $updateResto = "update resto set nama='$restoNama', alamat='$alamat', min_price='$minPrice', max_price='$maxPrice' where id='$id'";
    }
    $conn->query($updateResto);

    if (isset($_POST['menu'])) {
        $updateMenu = $_POST['menu'];
        foreach ($updateMenu as $menuId => $menuData) {
            $menuNama = $menuData['nama'];
            $menuHarga = $menuData['harga'];

            if ($_FILES['menu']['name'][$menuId]['foto']) {
                $fotoMenu = $_FILES['menu']['name'][$menuId]['foto'];
                $fotoMenuTmp = $_FILES['menu']['tmp_name'][$menuId]['foto'];
                $fotoMenuPath = "menuImg/" . $fotoMenu;
                move_uploaded_file($fotoMenuTmp, $fotoMenuPath);

                $updateMenu = "update menu set nama='$menuNama', harga='$menuHarga', foto='$fotoMenuPath' where id='$menuId'";
            } else {
                $updateMenu = "update menu set nama='$menuNama', harga='$menuHarga' where id='$menuId'";
            }
            $conn->query($updateMenu);
        }
    }

    if (isset($_POST['new_menu'])) {
        $menu_baru = $_POST['new_menu'];
        foreach ($menu_baru as $newMenuData) {
            $newMenuNama = $newMenuData['nama'];
            $newMenuHarga = $newMenuData['harga'];

            if (isset($_FILES['new_menu']['name']) && !empty($_FILES['new_menu']['name'])) {
                $newFotoMenu = $_FILES['new_menu']['name']['foto'];
                $newFotoMenuTmp = $_FILES['new_menu']['tmp_name']['foto'];
                $newFotoMenuPath = "menuImg/" . $newFotoMenu;
                move_uploaded_file($newFotoMenuTmp, $newFotoMenuPath);

                $insertMenu = "insert into menu (resto_id, nama, harga, foto) values ('$id', '$newMenuNama', '$newMenuHarga', '$newFotoMenuPath')";
            } else {
                $insertMenu = "insert into menu (resto_id, nama, harga) values ('$id', '$newMenuNama', '$newMenuHarga')";
            }
            $conn->query($insertMenu);
        }
    }

    echo "<script>alert('Data restoran berhasil diperbarui');
    window.location.href = 'pageMitra.php';
    </script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Resto</title>
</head>

<body>

    <?php include 'header.php'; ?>

    <div class="container mt-5">
        <section class="form-section p-4">
            <h2 class="text-center mb-4">UPDATE RESTO</h2>
            <form method="post" enctype="multipart/form-data" autocomplete="off">
                <h3 class="mb-3">Data Restoran</h3>
                <!-- Nama Restoran -->
                <div class="mb-3">
                    <label for="resto" class="form-label">Nama Restoran:</label>
                    <input type="text" name="resto" value="<?php echo $resto['nama']; ?>" class="form-control" required>
                </div>

                <!-- Alamat -->
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat:</label>
                    <textarea name="alamat" class="form-control" required><?php echo $resto['alamat']; ?></textarea>
                </div>

                <!-- Harga Terendah -->
                <div class="mb-3">
                    <label for="min-price" class="form-label">Harga Terendah:</label>
                    <input type="number" name="min-price" value="<?php echo $resto['min_price']; ?>" class="form-control">
                </div>

                <!-- Harga Tertinggi -->
                <div class="mb-3">
                    <label for="max-price" class="form-label">Harga Tertinggi:</label>
                    <input type="number" name="max-price" value="<?php echo $resto['max_price']; ?>" class="form-control">
                </div>

                <!-- Foto Restoran -->
                <div class="mb-4">
                    <label for="foto" class="form-label">Foto Restoran:</label>
                    <input type="file" name="foto" accept=".jpg, .jpeg, .png" class="form-control">
                </div>

                <h3 class="mb-3">Data Menu</h3>
                <div id="menu-container">
                    <?php if (!empty($menus)): ?>
                        <?php foreach ($menus as $menu): ?>
                            <div class="menu-item">
                                <label for="menu-<?php echo $menu['id']; ?>" class="form-label">Nama Menu:</label>
                                <input type="text" name="menu[<?php echo $menu['id']; ?>][nama]" value="<?php echo $menu['nama']; ?>" class="form-control" required>

                                <label for="price-<?php echo $menu['id']; ?>" class="form-label">Harga Menu:</label>
                                <input type="number" name="menu[<?php echo $menu['id']; ?>][harga]" value="<?php echo $menu['harga']; ?>" class="form-control" required>

                                <label for="foto-<?php echo $menu['id']; ?>" class="form-label">Ganti Foto Menu:</label>
                                <input type="file" name="menu[<?php echo $menu['id']; ?>][foto]" accept=".jpg, .jpeg, .png" class="form-control">

                                <button type="button" class="delete-menu" data-id="<?php echo $menu['id']; ?>">Hapus Menu</button>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Tidak ada menu di resto ini</p>
                    <?php endif; ?>
                </div>

                <div class="d-flex justify-content-between mb-4">
                    <button type="button" class="btn btn-secondary" id="add-menu-button">Tambah Menu (Max 7)</button>
                    <button type="button" class="btn btn-danger" id="del-menu-button">Batalkan Menu</button>
                </div>

                <!-- Submit & Kembali -->
                <div class="d-flex justify-content-between mt-3">
                    <input type="submit" class="btn btn-success w-48" value="Update">
                    <a href="/pageMitra.php" class="btn btn-warning w-48">Kembali</a>
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
                menuDiv.setAttribute('id', `menu-${menuCount}`);
                menuDiv.classList.add('menu-item');
                menuDiv.innerHTML = `
                    <h5>Menu ${menuCount}</h5>
                    <div class="mb-3">
                        <label for="menu_name_${menuCount}" class="form-label">Nama Menu:</label>
                        <input type="text" name="new_menu[${menuCount}][nama]" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="price_${menuCount}" class="form-label">Harga:</label>
                        <input type="number" name="new_menu[${menuCount}][harga]" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="photo_${menuCount}" class="form-label">Foto Menu:</label>
                        <input type="file" name="new_menu[${menuCount}][foto]" class="form-control" accept=".jpg, .jpeg, .png">
                    </div>
                    <button type="button" class="delete-menu">Hapus Menu</button>
                `;
                document.getElementById('menu-container').appendChild(menuDiv);
            } else {
                alert("Maksimal 7 menu dapat ditambahkan.");
            }
        });

        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('delete-menu')) {
                const menuItem = event.target.closest('.menu-item');
                menuItem.remove();
                menuCount--;
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
        padding: 30px;
    }

    h2,
    h3 {
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

    .btn-container {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
    }

    .btn {
        /* background-color: #7c2f1b;
        color: white; */
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 5px;
        width: 48%;
    }

    .menu-item {
        margin-bottom: 20px;
    }

    .delete-menu {
        background-color: #d9534f;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
    }

    .delete-menu:hover {
        background-color: #c9302c;
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