<?php
require 'connection.php';

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

$sessionUsername = $_SESSION['username'];
$sessionUserId = $_SESSION['users_id'];

if (isset($_GET['id'])) {
    $resto_id = $_GET['id'];

    $querySimpan = "insert into simpan_resto (user_id, resto_id) values ('$sessionUserId', '$resto_id')";

    $queryCheck = "select resto_id from simpan_resto where user_id = '$sessionUserId'";

    $cek = $conn->query($queryCheck);

    if ($cek->num_rows > 0) {
        echo "
        <script>alert('Restoran sudah tersimpan!');
        window.location.href = 'main.php';</script>
        ";
    } else {
        if (mysqli_query($conn, $querySimpan)) {
            echo "<script>alert('Restoran berhasil disimpan!');
            window.location.href ='main.php';
            </script>";
        } else {
            echo "Terjadi kesalahan " . $conn->error;
        }
    }
}
?>