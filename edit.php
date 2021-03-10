<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}


require 'functions.php';

// ambil data di url
$id=$_GET["id"];
// query data siswa berdasarkan id dari function
$swa = query("SELECT * FROM siswa WHERE  id= $id")[0];

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {


    // cek apakah data berhasil diedit atau tidak
    if (edit($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil diedit');
                document.location.href='index.php';
            </script>
        ";
    } else {
        echo "
        <script>
            alert('data gagal diedit');
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
    <title>Edit data siswa</title>
</head>

<body>

    <h1>Edit data siswa</h1>

    <form action="" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?= $swa["id"];?>">
        <input type="hidden" name= "gambarlama" value="<?= $swa["gambar"];?>">

        <ul>
            <li>
                <label for="nama">Nama : </label>
                <input type="text" name="nama" id="nama" required 
                value="<?=$swa["nama"]; ?>">
            </li>
            <li>
                <label for="NIS">NIS : </label>
                <input type="text" name="NIS" id="NIS" required
                value="<?=$swa["NIS"]; ?>">
            </li>

            <li>
                <label for="jurusan">Jurusan : </label>
                <input type="text" name="jurusan" id="jurusan" required 
                value="<?=$swa["jurusan"]; ?>">
            </li>
            <li>
                <label for="email">Email : </label>
                <input type="text" name="email" id="email" required 
                value="<?=$swa["email"]; ?>">
            </li> 
            <li>
                <label for="gambar">Gambar : </label><br>
                <img src="img/<?= $swa['gambar']; ?>" width="40"><br>
                <input type="file" name="gambar" id="gambar">
            </li>
            <br>
            <button type="submit" name="submit">Save</button>

        </ul>
    </form>

</body>

</html>