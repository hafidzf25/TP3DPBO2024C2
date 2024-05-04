<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Agensi.php');
include('classes/Group.php');
include('classes/Member.php');
include('classes/Template.php');

// buat instance group
$listGroup = new Group($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$listGroup->open();

if ($listGroup->updateData($_POST['id'] , $_POST, $_FILES['foto']) == 1) {
    echo "<script>
        alert('Data berhasil diubah!');
        document.location.href = 'index.php';
    </script>";
} else {
    echo "<script>
        alert('Data tidak berhasil diubah!');
        document.location.href = 'index.php';
    </script>";
}

// tutup koneksi
$listGroup->close();
?>