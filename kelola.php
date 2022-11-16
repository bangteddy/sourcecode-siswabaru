<!DOCTYPE html>

<?php
include 'koneksi.php';

$id = '';
$nisn = '';
$nama_siswa = '';
$jenis_kelamin = '';
$alamat = '';

if (isset($_GET['ubah'])) {
    $id = $_GET['ubah'];

    $query = " SELECT * FROM siswa WHERE id='$id'";
    $sql = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($sql);

    $nisn = $result['nisn'];
    $nama_siswa = $result['nama_siswa'];
    $jenis_kelamin = $result['jenis_kelamin'];
    $alamat = $result['alamat'];


    // var_dump($result);

    // die;
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
    <title>Bintang Timur Prestasi</title>

    <!-- Fontawesome -->
    <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">
</head>

<body>
    <nav class="navbar navbar-light bg-light mb-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                Pendaftaran Siswa Baru Bintang Timur Prestasi
            </a>
        </div>
    </nav>
    <div class="container">
        <form action="proses.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id; ?>">
            <div class="mb-4 row">
                <label for="nisn" class="col-sm-2 col-form-label">NISN</label>
                <div class="col-sm-10">
                    <input type="text" name="nisn" class="form-control" id="nisn" placeholder="Ex: 080989999" required
                        value="<?= $nisn; ?>">
                </div>
            </div>
            <div class="mb-4 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                    <input type="text" name="nama_siswa" class="form-control" id="nama" placeholder="Ex :Teguh Irawan"
                        required value="<?= $nama_siswa; ?>">
                </div>
            </div>
            <div class="mb-4 row">
                <label for="jkel" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                    <select required id="jkel" name="jenis_kelamin" class="form-select">
                        <option value="">Jenis Kelamin</option>
                        <option <?php if ($jenis_kelamin == 'Laki-Laki') {
                                    echo "selected";
                                } ?> value="Laki-Laki">Laki-Laki</option>
                        <option <?php if ($jenis_kelamin == 'Perempuan') {
                                    echo "selected";
                                } ?> value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="mb-4 row">
                <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10">
                    <input <?php if (!isset($_GET['ubah'])) {
                                echo "required";
                            } ?> type="file" name="foto" class="form-control" id="nama">
                </div>
            </div>
            <div class="mb-4 row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="alamat" rows="3" cols="50" required><?= $alamat; ?></textarea>
                </div>
            </div>

            <div class="mb-3 row mt-4">
                <div class="col">

                    <?php
                    if (isset($_GET['ubah'])) { ?>

                    <button type="submit" name="aksi" value="edit" class="btn btn-primary">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        Simpan Perubahan
                    </button>
                    <?php
                    } else {
                    ?>
                    <button type="submit" name="aksi" value="add" class="btn btn-primary">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        Tambah Data
                    </button>
                    <?php } ?>

                    <a href="index.php" type="button" class="btn btn-danger">
                        <i class="fa fa-step-backward" aria-hidden="true"></i>
                        Batalkan
                    </a>

                </div>

            </div>

        </form>
    </div>
</body>

</html>