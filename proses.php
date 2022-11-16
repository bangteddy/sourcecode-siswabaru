<?php
// include 'koneksi.php';
include 'fungsi.php';
session_start();

if (isset($_POST['aksi'])) {
    if ($_POST['aksi'] == "add") {


        $berhasil = tambah($_POST, $_FILES);
        if ($berhasil) {

            $_SESSION['eksekusi'] = "Data Berhasil ditambahkan"; // ALERT NOTIFIKASI
            echo "
			<script>
			alert('data berhasil ditambahkan!');
			document.location.href='index.php';
			</script>
		";
        } else {
            echo "
			<script>
			alert('data Gagal ditambahkan!');
			document.location.href='index.php';
			</script>
		";
        }

        // EKSEKUSI EDIT DATA
    } else if ($_POST['aksi'] == "edit") {

        $berhasil = ubah($_POST, $_FILES);

        if ($berhasil) {

            $_SESSION['eksekusi'] = "Data Berhasil diedit"; // ALERT NOTIFIKASI
            echo "
                    <script>
                    alert('data berhasil diEdit');
                    document.location.href='index.php';
                    </script>";
        } else {
            echo "
            <script>
            alert('data Gagal diedit!');
            document.location.href='index.php';
            </script>
        ";
        }
    }
}

// <!-- FUNGSI HAPUS DAN REMOVE FILE DI SERVER --!>
if (isset($_GET['hapus'])) {

    $berhasil = hapus($_GET);

    if ($berhasil) {

        $_SESSION['eksekusi'] = "Data Berhasil dihapus"; // ALERT NOTIFIKASI

        echo "
			<script>
			alert('data berhasil dihapus!');
			document.location.href='index.php';
			</script>
		";
    } else {
        echo "
        <script>
        alert('data Gagal dihapus!');
        document.location.href='index.php';
        </script>
    ";
    }
}