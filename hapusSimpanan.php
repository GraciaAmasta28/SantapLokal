<?php
require 'connection.php';

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

$sessionUsername = $_SESSION['username'];
$sessionId = $_SESSION['users_id'];

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $queryHapusSimpanan = "delete from simpan_resto where user_id = '$sessionId' and resto_id = '$id'";

    if ($conn->query($queryHapusSimpanan)) {
        echo "
        <script>
        alert('Resto berhasil dihapus dari daftar tersimpan');
        window.location.href='pageTersimpan.php';
        </script>";
    }
}
