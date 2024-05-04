<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Agensi.php');
include('classes/Group.php');
include('classes/Member.php');
include('classes/Template.php');

// if ($_FILES) {
//     print_r($_POST);
//     print_r($_FILES);
//     die;
// }

// buat instance member
$listMember = new Member($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$listMember->open();

// print_r($_POST);
// // print_r($_FILES);
$det = $_POST['ttl'];
$_POST['ttl'] = null;
$_POST['ttl'] = $det[0] . $det[1] . $det[2] . $det[3] . $det[4] . $det[8] . $det[9] . $det[4] . $det[5] . $det[6];

// echo($_POST['ttl']);
// die;

if ($listMember->addData($_POST, $_FILES['foto']) == 1) {
    echo "<script>
        alert('Member berhasil ditambah!');
        document.location.href = 'index.php';
    </script>";
} else {
    echo "<script>
        alert('Member tidak ditambah!');
        document.location.href = 'index.php';
    </script>";
}

// tutup koneksi
$listMember->close();
?>