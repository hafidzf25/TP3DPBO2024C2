<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Agensi.php');
include('classes/Group.php');
include('classes/Member.php');
include('classes/Template.php');

// buat instance member
$listGroup = new Group($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$listGroup->open();

if ($listGroup->addData($_POST, $_FILES['foto']) == 1) {
    echo "<script>
        alert('Group berhasil ditambah!');
        document.location.href = 'index.php';
    </script>";
} else {
    echo "<script>
        alert('Group tidak ditambah!');
        document.location.href = 'index.php';
    </script>";
}

// tutup koneksi
$listMember->close();
?>