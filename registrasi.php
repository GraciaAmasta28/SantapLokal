<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form dengan Syarat dan Ketentuan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="logo.png" alt="logo">
        </div>
        <form method="POST" action="">
            <label for="username">USERNAME</label>
            <input type="text" id="username" name="username" placeholder="Masukkan username">

            <label for="password">PASSWORD</label>
            <input type="password" id="password" name="password" placeholder="Masukkan password">

            Aakah Ingin Bermitra?

            <div class="checkbox-label" >
                <input type="checkbox" id="termsCheckbox" name="terms" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <label for="termsCheckbox">Ya</label>
            </div>

            <input type="submit" value="Save">
        </form>
    </div>




    <!--

    <script>
        const termsCheckbox = document.getElementById('termsCheckbox');
        const submitBtn = document.getElementById('submitBtn');

        termsCheckbox.addEventListener('change', function(){
            if (this.checked){
                window.open('snk.html', '_blank', 'width=600, height=400');
            }
        })
    </script> -->
</body>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" id="closeButton" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        INI SYARAT DAN KETENTUAN
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="cancelButton" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="yesButton" data-bs-dismiss="modal">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
        const termsCheckbox = document.getElementById('termsCheckbox');
        const cancelButton = document.getElementById('cancelButton');
        const closeButton = document.getElementById('closeButton');
        const yesButton = document.getElementById('yesButton');
        // Reset checkbox ketika tombol cancel di modal ditekan
        cancelButton.addEventListener('click', () => {
            termsCheckbox.checked = false; // Set checkbox tidak tercentang
        });
        closeButton.addEventListener('click', () => {
            termsCheckbox.checked = false; // Set checkbox tidak tercentang
        });
        yesButton.addEventListener('click', () => {
            termsCheckbox.checked = true; // Set checkbox tidak tercentang
        });
    </script>

</html>




<style>
    body{
        width: 100%;
        height: 100vh;
        display: flex;
        align-items: center;
        background-image: url(login.jpg);
        background-position: center;
        background-size: cover;
    }

    .container {
        background-color: #F7E6C4;
        width: 400px;
        padding: 20px;
        margin: 50px auto;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        align-items: center;
    }
    
    .logo{
        display: flex;
        justify-content: center;
        margin-bottom: 20px;

        img{
            width: 300px;
        }
    }

    form {
        display: flex;
        flex-direction: column;
    }

    label {
        margin-bottom: 8px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .checkbox-label {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .checkbox-label input {
        margin-right: 10px;
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