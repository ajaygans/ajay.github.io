<?php
require '../functions.php';

$keyword=$_GET["keyword"];

$query="SELECT * FROM siswa WHERE 
        nama LIKE '%$keyword%' OR
        NIS LIKE '%$keyword%' OR
        jurusan LIKE '%$keyword%' OR
        email LIKE '%$keyword%' 
        ";
$siswa= query($query);
?>

<table border="1" cellpadding="10" cellspacing="0">

        <tr>
            <th>No.</th>
            <th>Aksi</th>
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
                <td>
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