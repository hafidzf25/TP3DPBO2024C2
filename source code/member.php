<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Agensi.php');
include('classes/Group.php');
include('classes/Member.php');
include('classes/Template.php');

$member = new Member($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$member->open();
$member->getMember();

$view = new Template('templates/skintabel.html');

$mainTitle = 'Member';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Member</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'member';
$tambah = "<button class='btn btn-danger'>
            <a style='text-decoration:none; color:white;' href='tambahubah.php?tambah=member'>Tambah Member</button><br><br>
            
            <form class='d-flex' method='post' action=''>
                    <button class='btn btn-outline-dark' type='submit' name='btn-az'>Sort berdasarkan Nama Member A-Z</button>
                    <button class='btn btn-outline-dark' type='submit' name='btn-za'>Sort berdasarkan Nama Member Z-A</button> <br> <br>
                </form>";

// cari pengurus
if (isset($_POST['btn-az'])) {
    // methode mencari data pengurus
    $member->getMemberSort("ASC");
} else if (isset($_POST['btn-za'])) {
    $member->getMemberSort("DESC");
} else {
    // method menampilkan data pengurus
    $member->getMember();
}

while ($mem = $member->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $mem['member_nama'] . '</td>
    <td style="font-size: 22px;">
        <a href="tambahubah.php?id=' . $mem['member_id'] . '&tambah=editmember" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="member.php?hapus=' . $mem['member_id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($member->deleteData($id) > 0) {
            echo "<script>
                alert('Member berhasil dihapus!');
                document.location.href = 'member.php';
            </script>";
        } else {
            echo "<script>
                alert('Member gagal dihapus!');
                document.location.href = 'member.php';
            </script>";
        }
    }
}

$member->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('TAMBAH_AJA', $tambah);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
