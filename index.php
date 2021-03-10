<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

$siswa = query("SELECT * FROM siswa ");

// tombol cari ditekan
if (isset($_POST["cari"])) {
    $siswa = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <style>
        .loader {
            width: 90px;
            position: absolute;
            top: 107px;
            left:230px;
            z-index: -1;
            display: none;
        }

        @media print {
            .logout, .tambah, .cari, .aksi {
                display: none;
            }
        }
    </style>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>
</head>

<body>

    <a href="logout.php" class="logout">Logout</a>

    <h1>Daftar Siswa</h1>

    <a href="tambah.php" class="tambah">Tambah data siswa</a>
    <br><br>

    <form action="" method="POST" class="cari">

        <input type="text" name="keyword" size="30" autofocus 
        placeholder="Pencarian.." autocomeplete="off" id="keyword">
        <button type="submit" name="cari" id="tombol-cari">Search</button>

        <img src="img/loader.gif" alt="" class="loader">

    </form>

    <br>

    <div id="container">

    <table border="1" cellpadding="10" cellspacing="0">

        <tr>
            <th>No.</th>
            <th class="aksi">Aksi</th>
            <th>Photo Profile</th>
            <th>NIS</th>
            <th>Nama Siswa</th>
            <th>Jurusan</th>
            <th>Email</th>
        </tr>


        <?php $i = 1; ?>

        <?php foreach ($siswa as $row) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td class="aksi">
                    <a href="edit.php?id=<?=$row["id"]; ?>">Edit</a> |
                    <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?');">hapus</a>
                </td>
                <td><img src="img/<?= $row["gambar"]; ?>" width="50"></td>
                <td><?= $row["NIS"]; ?></td>
                <td><?= $row["nama"]; ?></td>
                <td><?= $row["jurusan"]; ?></td>
                <td><?= $row["email"]; ?></td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>

    </table>
    </div>



</body>

</html>