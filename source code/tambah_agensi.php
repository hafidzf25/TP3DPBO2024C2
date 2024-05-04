<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Agensi.php');
include('classes/Group.php');
include('classes/Member.php');
include('classes/Template.php');

// buat instance member
$listAgensi = new Agensi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$listAgensi->open();

if ($listAgensi->addAgensi($_POST) == 1) {
    echo "<script>
        alert('Agensi berhasil ditambah!');
        document.location.href = 'agensi.php';
    </script>";
} else {
    echo "<script>
        alert('Agensi tidak ditambah!');
        document.location.href = 'agensi.php';
    </script>";
}

// tutup koneksi
$listMember->close();
?>