<?php 
require 'connection.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = htmlspecialchars($_POST['username']);

    $queryLogin = "SELECT * FROM login WHERE username = '$username'";
    $hasil = mysqli_query($conn, $queryLogin);

    if($hasil->num_rows == 1){
        $_SESSION['username'] = $username;
        header("Location: main.php");
        exit();
    }else{
        $queryInsert = "INSERT INTO login (username) VALUES ('$username')";
        if(mysqli_query($conn, $queryInsert)){
            $_SESSION['username'] = $username;
            echo "<script>alert('Registrasi berhasil');</script>";
            header("Location: main.php");
            exit();
        }else{
            echo "<script>alert('Gagal Registrasi');</script>";
        }
    }
}

if(isset($_SESSION["username"])){
    header("Location: main.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Santap Lokal Login</title>
</head>
<body>
    <div class="wrapper">
        <img src="logo.png" alt="logo">
        <form method="post" action="" enctype="multipart/form-data" autocomplete="off">
            <label for="">LOGIN</label>
            <input type="text" name="username" id="username" required>
            <label for="">Password</label>
            <input type="password" name="password" required>
            <input type="submit" value="Save">
        </form>
    </div>
</body>
</html>



<style>
    *{
        padding: 0;
        margin: 0;
    }

    body{
        width: 100%;
        height: 100vh;
        display: flex;
        align-items: center;
        background-image: url(login.jpg);
        background-position: center;
        background-size: cover;
    }

    .wrapper{
        display: flex;
        margin: auto;
        border-radius: 20px;
        background-color: #F7E6C4;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 400px;
        height: 500px;

        img{
            width: 300px;
        }
    }

    form{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 5px;

        input{
            margin-top: 10px;
            width: 90%; 
            padding: 10px; 
            border-radius: 5px; 
            border: 1px solid #876647; 
            font-size: 16px;
        }
        button {
            width: fit-content;
            margin-top: 15px;
            background-color: #876647;
            color: white;
            border-radius: 50px;
            padding: 10px 5px;
            cursor: pointer;
        }
    }
    
    input[type="submit"] {
        background-color: #AAB396;
        color: black;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    input[type="submit"]:hover {
        background-color: #9BAE58;
    }
</style>