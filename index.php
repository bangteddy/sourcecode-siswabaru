<?php
include 'koneksi.php';
session_start();

$query = "SELECT * FROM siswa";
$sql = mysqli_query($conn, $query);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!------------------------------- Bootstrap & Javascript ---------------------------------------------------------->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>

    <!-- Fontawesome -->
    <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">

    <!------------------- DATA TABLES ------------------------>
    <link rel="stylesheet" type="text/css" href="datatables/datatables.css">
    <script type="text/javascript" src="datatables/datatables.js"></script>

    <title>Bintang Timur Prestasi</title>
</head>

<script>
$(document).ready(function() {
    $('#dt').DataTable();
});
</script>

<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                Pendaftaran Siswa Baru Bintang Timur Prestasi
            </a>
        </div>
    </nav>

    <!-- Judul -->

    <div class="container">


        <h2 class="mt-4">Data Siswa</h2>
        <figure>
            <blockquote class="blockquote">
                <p>Data Siswa yang telah mendaftar</p>
            </blockquote>
        </figure>
        <a href="kelola.php" type="button" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah Data</a>

        <!------------------------------------- ALERT NOTIFIKASI ---------------------------------------------------------------------------->
        <?php
        if (isset($_SESSION['eksekusi'])) :
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php
                echo $_SESSION['eksekusi'];
                ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
            session_destroy();
        endif; ?>
        <!----------------------------------------------------------------------------------------------------------------------------------->

        <div class="table-responsive">
            <table id="dt" class="table align-middle hover stripe">
                <thead>
                    <tr>
                        <th>
                            <center>No</center>
                        </th>
                        <th>NISN</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Foto</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                        </th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $no = 1;
                    while ($result = mysqli_fetch_assoc($sql)) :
                    ?>
                    <tr>
                        <td>
                            <center><?= $no++; ?></center>
                        </td>
                        <td><?= $result['nisn']; ?></td>
                        <td><?= $result['nama_siswa']; ?></td>
                        <td><?= $result['jenis_kelamin']; ?></td>
                        <td><img src="img/<?= $result['foto_siswa']; ?>" alt="foto" style="width: 100px;"></td>
                        <td><?= $result['alamat']; ?></td>
                        <td>
                            <a href="kelola.php?ubah=<?= $result['id']; ?>" type="button" class="btn btn-danger btn-sm">
                                <i class="fa fa-pencil"> Edit</i></a>
                            <a href="proses.php?hapus=<?= $result['id']; ?>" type="button"
                                class="btn btn-primary btn-sm"><i class="fa fa-trash"
                                    onclick="return confirm ('Yakin Mau Hapus Data ini')"> Delete</i></a>
                        </td>
                        </th>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>