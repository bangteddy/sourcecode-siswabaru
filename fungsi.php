<?php
include 'koneksi.php';

function tambah($data, $files)
{

    // tangkap data dari FORM
    global $conn;
    $nisn           = $data['nisn'];
    $nama_siswa     = $data['nama_siswa'];
    $jenis_kelamin  = $data['jenis_kelamin'];

    $split          = explode('.', $files['foto']['name']);
    $ekstensi       = $split[count($split) - 1];
    $angkaUnik      = uniqid();
    $foto           = $angkaUnik . '.' . $ekstensi;
    $alamat         = $data['alamat'];

    // tampung data untuk upload File
    $dir            = "img/";
    $tmpFile        = $files['foto']['tmp_name'];
    $ukuranFile     = $files['foto']['size'];

    // Cek ukuran File
    if ($ukuranFile > 1000000) {
        echo "<script>
        alert ('file Terlalu Besar');
        document.location.href='kelola.php';
        </script>";
    }

    // Query Upload File
    move_uploaded_file($tmpFile, $dir . $foto);

    // Query Data(tampilkan data ke kelola.php)
    $query = "INSERT INTO siswa VALUES (null, '$nisn', '$nama_siswa','$jenis_kelamin','$foto','$alamat') ";
    mysqli_query($conn, $query);

    return true;
}



function ubah($data, $files)
{
    // tangkap data dari FORM
    global $conn;
    $id             = $data['id'];
    $nisn           = $data['nisn'];
    $nama_siswa     = $data['nama_siswa'];
    $jenis_kelamin  = $data['jenis_kelamin'];
    $alamat         = $data['alamat'];

    $queryShow   = " SELECT * FROM siswa WHERE id = '$id'";
    $sqlShow     = mysqli_query($conn, $queryShow);
    $result      = mysqli_fetch_assoc($sqlShow);

    if ($files['foto']['name'] == "") {
        $foto = $result['foto_siswa']; // ambil row dari DBMS
    } else {
        $angkaUnik      = uniqid();
        $split          = explode('.', $files['foto']['name']);
        $ekstensi       = $split[count($split) - 1];

        $foto = $angkaUnik . '.' . $ekstensi;
        unlink("img/" . $result['foto_siswa']);
        move_uploaded_file($files['foto']['tmp_name'], 'img/' . $foto);
    }

    $query = " UPDATE siswa SET 
    nisn='$nisn',
    nama_siswa = '$nama_siswa',
    jenis_kelamin = '$jenis_kelamin',
    alamat = '$alamat',
    foto_siswa = '$foto'
    WHERE id=$id";
    mysqli_query($conn, $query);

    return true;
}

function hapus($data)
{
    global $conn;
    $id_siswa   = $data['hapus'];

    $queryShow   = " SELECT * FROM siswa WHERE id = '$id_siswa'";
    $sqlShow     = mysqli_query($conn, $queryShow);
    $result      = mysqli_fetch_assoc($sqlShow);

    unlink("img/" . $result["foto_siswa"]);

    $query      = " DELETE FROM siswa WHERE id ='$id_siswa'";
    mysqli_query($conn, $query);

    return true;
}