<?php
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars(password_hash($_POST['password'], PASSWORD_BCRYPT));
    $is_mitra = $_POST['is_mitra'] ? 1 : 0;

    $queryRegis = "insert into users (username, password, is_mitra) values ('$username', '$password', '$is_mitra')";

    $cekUser = "select * from users where username = '$username'";

    $hasilCek = $conn->query($cekUser);

    if ($hasilCek->num_rows > 0) {
        echo "
        <script>
        alert('Username sudah terdaftar, gunakan username lain.');
        window.location.href='registrasi.php';
        </script>
        ";
    } else {
        $conn->query($queryRegis);
        echo "<script>
        alert('Registrasi Berhasil! Anda akan diarahkan ke halaman Login.')
        window.location.href ='login.php';
        </script>";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=arrow_back_ios" />
</head>

<body class="bg-light">
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="card shadow-lg p-4" style="width: 400px; border-radius: 15px;">
            <!-- Logo -->
            <div class="text-center mb-4">
                <img src="logo.png" alt="Santap Lokal" width="120">
                <h4 class="mt-3" style="color: #5c3d00;">Registrasi</h4>
            </div>
            <!-- Form -->
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="username" class="form-label fw-bold">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="isMitra" name="is_mitra" value="1">
                    <label class="form-check-label" for="isMitra">Bermitra dengan kami?</label>
                </div>
                <button type="submit" class="btn w-100 text-white" style="background-color: #AAB396;">Daftar</button>
            </form>
            <!-- Back -->
            <div class="text-center mt-3">
                <a href="/" class="text-decoration-none" style="color: #5c3d00;">
                    <i class="bi bi-arrow-left-circle"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">Syarat dan Ketentuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Dengan mendaftar sebagai mitra, Anda menyetujui semua syarat dan ketentuan kami.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelButton">Batal</button>
                    <button type="button" class="btn btn-primary" id="agreeButton">Setuju</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const isMitraCheckbox = document.getElementById('isMitra');
        const agreeButton = document.getElementById('agreeButton');
        const cancelButton = document.getElementById('cancelButton');

        // Tangkap elemen modal menggunakan Bootstrap
        const modalElement = document.getElementById('termsModal');
        const modalInstance = new bootstrap.Modal(modalElement);

        // Tampilkan modal ketika checkbox di klik
        isMitraCheckbox.addEventListener('change', () => {
            if (isMitraCheckbox.checked) {
                modalInstance.show();
            }
        });

        // Setujui syarat dan tutup modal
        agreeButton.addEventListener('click', () => {
            isMitraCheckbox.checked = true; // Pastikan checkbox tetap tercentang
            modalInstance.hide(); // Tutup modal
        });

        // Batalkan dan ubah checkbox menjadi tidak dicentang
        cancelButton.addEventListener('click', () => {
            isMitraCheckbox.checked = false; // Ubah checkbox menjadi tidak dicentang
            modalInstance.hide(); // Tutup modal
        });
    </script>
</body>

</html>




<style>
    body {
        background-color: #F7E6C4;
        /* Warna latar belakang lembut */
    }

    .card {
        border: none;
        border-radius: 15px;
        background-color: #ffffff;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .btn:hover {
        background-color: #9BAE58;
        /* Warna hover tombol */
    }

    a {
        font-weight: 600;
        font-size: 14px;
    }
</style>