<?php
require 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

$sessionUsername = $_SESSION['username'];
$userId = $_SESSION['users_id'];

$queryMitra = "select * from resto where added_by = '$userId'";

$hasil = $conn->query($queryMitra);
$i = 1;


// fungsi hapus resto
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $queryDelete = "delete from resto where id = '$id'";

    if ($conn->query($queryDelete)) {
        echo "<script>alert('Resto berhasil dihapus dari database!');
        window.location.href = '/pageMitra.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Mitra | <?php echo $sessionUsername ?></title>
</head>

<body>
    <?php include 'header.php'; ?>

    <<div class="container mt-5">
        <h1 class="mb-4">List Restoran</h1>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Restoran</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Menu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($hasil as $i => $baris): ?>
                        <tr>
                            <th scope="row"><?php echo $i + 1; ?></th>
                            <td><img src="<?php echo $baris['foto']; ?>" alt="<?php echo $baris['nama']; ?>" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;"></td>
                            <td><?php echo $baris['nama']; ?></td>
                            <td><?php echo $baris['alamat']; ?></td>
                            <td>
                                <a href="updateResto.php?id=<?php echo $baris['id']; ?>" class="btn btn-warning btn-sm">Update</a>
                                <a href="pageMitra.php?delete=<?php echo $baris['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        </div>

        <footer class="py-4 bg-dark text-white text-center" style="margin-top: auto;">
            <p class="mb-0">© 2024 SantapLokal. All rights reserved.</p>
        </footer>
</body>

</html>

<style>
    td,
    th {
        vertical-align: middle;
        height: 100%;
        text-align: center;
    }

    html,
    body {
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column;
        background-color: #F7F5F2;
    }

    body>footer {
        margin-top: auto;
    }
</style>