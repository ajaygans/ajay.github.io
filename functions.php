<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "php");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}



// tambah
function tambah($data)
{
    global $conn;
    $nama = htmlspecialchars($data["nama"]);
    $NIS = htmlspecialchars($data["NIS"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $email = htmlspecialchars($data["email"]);


    // upload gambar
    $gambar = upload();
    if(!$gambar){
        return false;
    }


    $query = "INSERT INTO siswa
            VALUES
            ('', '$nama', '$NIS','$jurusan','$email','$gambar')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


// upload
function upload(){

    $namaFile=$_FILES['gambar']['name'];
    $ukuranFile= $_FILES['gambar']['size'];
    $error= $_FILES['gambar']['error'];
    $tmpName= $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if($error === 4){
        echo "<script>
                alert('masukkan gambar');
              </script>";
        return false;
    }

    // cek apakah yang upload adalah gambar
    $ekstensigambarvalid = ['jpg','jpeg','png'];
    $ekstensiGambar = explode(".", $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar,$ekstensigambarvalid)) {
        echo "<script>
                alert('pastikan yang di upload tipe nya adalah jpg/jpeg/png!');
              </script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if ($ukuranFile > 2300000) {
        echo "<script>
                alert('pastikan gambar yang diupload tidak lebih dari dua mb');
              </script>";
        return false;
    }

    // lolos pengecekkan,gambar siap diupload
    // generate nama gambar baru
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namafilebaru);

    return $namafilebaru;

}


// hapus
function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM siswa WHERE id = $id");

    return mysqli_affected_rows($conn);
}


// edit
function edit($data){
    global $conn;

    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $NIS = htmlspecialchars($data["NIS"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $email = htmlspecialchars($data["email"]);
    $gambarlama = htmlspecialchars($data["gambarlama"]);

    //cek apakah user pilih gambar baru atau tidak
    if ( $_FILES['gambar']['error'] === 4 ) {
        $gambar = $gambarlama;
    } else {
        $gambar = upload();
    }

    


    $query = "UPDATE  siswa SET
                nama='$nama' ,
                NIS='$NIS',
                jurusan='$jurusan',
                email='$email',
                gambar='$gambar'
                WHERE id=$id
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}


// cari
function cari($keyword) {
    $query="SELECT * FROM siswa WHERE 
            nama LIKE '%$keyword%' OR
            NIS LIKE '%$keyword%' OR
            jurusan LIKE '%$keyword%' OR
            email LIKE '%$keyword%' 
            ";
    return query($query);
}


// registrasi
function registrasi($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username
    ='$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('username telah terdaftar');
              </script>";
              return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
                alert('konfirmasi password tidak sesuai');
              </script>";

        return false;
    }

    // enskripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username'
    , '$password')");

    return mysqli_affected_rows($conn);

}
