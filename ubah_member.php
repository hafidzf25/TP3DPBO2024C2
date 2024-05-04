<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Agensi.php');
include('classes/Group.php');
include('classes/Member.php');
include('classes/Template.php');

// buat instance group
$lisMember = new Member($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$lisMember->open();

$det = $_POST['ttl'];
$_POST['ttl'] = null;
$_POST['ttl'] = $det[0] . $det[1] . $det[2] . $det[3] . $det[4] . $det[5] . $det[6] . $det[4] . $det[8] . $det[9];

if ($lisMember->updateData($_POST['id'] , $_POST, $_FILES['foto']) == 1) {
    echo "<script>
        alert('Data berhasil diubah!');
        document.location.href = 'member.php';
    </script>";
} else {
    echo "<script>
        alert('Data tidak berhasil diubah!');
        document.location.href = 'member.php';
    </script>";
}

// tutup koneksi
$lisMember->close();
?>