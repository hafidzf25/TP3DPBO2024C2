<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Agensi.php');
include('classes/Group.php');
include('classes/Member.php');
include('classes/Template.php');

$agensi = new Agensi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$agensi->open();
$agensi->getAgensi();

$view = new Template('templates/skintabel.html');

$mainTitle = 'Agensi';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Agensi</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'agensi';
$tambah = "<button class='btn btn-danger'>
            <a style='text-decoration:none; color:white;' href='tambahubah.php?tambah=agensi'>Tambah Agensi</button><br><br>";

while ($agen = $agensi->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $agen['agensi_nama'] . '</td>
    <td style="font-size: 22px;">
        <a href="tambahubah.php?id=' . $agen['agensi_id'] . '&tambah=editagensi" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="agensi.php?hapus=' . $agen['agensi_id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($agensi->deleteAgensi($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'agensi.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'agensi.php';
            </script>";
        }
    }
}

$agensi->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('TAMBAH_AJA', $tambah);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
