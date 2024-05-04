<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Agensi.php');
include('classes/Group.php');
include('classes/Member.php');
include('classes/Template.php');

// buat instance group
$listAgensi = new Agensi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$listAgensi->open();

if ($listAgensi->updateAgensi($_POST['id'] , $_POST) == 1) {
    echo "<script>
        alert('Data berhasil diubah!');
        document.location.href = 'agensi.php';
    </script>";
} else {
    echo "<script>
        alert('Data tidak berhasil diubah!');
        document.location.href = 'agensi.php';
    </script>";
}

// tutup koneksi
$listAgensi->close();
?>