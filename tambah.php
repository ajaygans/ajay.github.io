<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {





    // cek apakah data berhasil ditambah atau tidak
    if (tambah($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil ditambahkan');
                document.location.href='index.php';
            </script>
        ";
    } else {
        echo "
        <script>
            alert('data gagal ditambahkan');
            document.location.href='index.php';
        </script>
    ";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah data siswa</title>
</head>

<body>

    <h1>Tambah data siswa</h1>

    <form action="" method="POST" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="nama">Nama : </label>
                <input type="text" name="nama" id="nama" required autocomeplete="off">
            </li>
            <li>
                <label for="NIS">NIS : </label>
                <input type="text" name="NIS" id="NIS" required autocomeplete="off">
            </li>

            <li>
                <label for="jurusan">Jurusan : </label>
                <input type="text" name="jurusan" id="jurusan" required autocomeplete="off">
            </li>
            <li>
                <label for="email">Email : </label>
                <input type="text" name="email" id="email" required autocomeplete="off">
            </li>
            <li>
                <label for="gambar">Gambar : </label>
                <input type="file" name="gambar" id="gambar">
            </li>
            <br>
            <button type="submit" name="submit">Save</button>

        </ul>
    </form>

</body>

</html>