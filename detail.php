<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Agensi.php');
include('classes/Group.php');
include('classes/Member.php');
include('classes/Template.php');

$group = new Group($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$group->open();

$member = new Member($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$member->open();

$data = nulL;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $group->getGroupById($id);
        $row = $group->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['group_nama'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['group_logo'] . '" class="img-thumbnail" alt="' . $row['group_logo'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>' . $row['group_nama'] . '</td>
                                </tr>
                                <tr>
                                    <td>Debut</td>
                                    <td>:</td>
                                    <td>' . $row['group_debut'] . '</td>
                                </tr>
                                <tr>
                                    <td>Agensi</td>
                                    <td>:</td>
                                    <td>' . $row['agensi_nama'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="tambahubah.php?id=' . $row['group_id'] . '&tambah=editgroup"><button type="button" class="btn btn-success text-white">Ubah Group</button></a>
                <a href="detail.php?hapus=' . $row['group_id'] . '"><button type="button" class="btn btn-danger">Hapus Group</button></a>
            </div>';
    }
}

$data2 = nulL;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $member->getMember($id);

        $data2 .= '<div class="card-header text-center">
        <h3 class="my-0">Member Grup</h3>
        </div>';

        while ($row = $member->getResult()) {
            if ($row['group_id'] == $id) {
                # code...
                $data2 .= '
            <div class="card-body text-end">
                <div class="row mb-5">
                    <div class="col-3">
                        <div class="row justify-content-center">
                            <img src="assets/images/' . $row['member_foto'] . '" class="img-thumbnail" alt="' . $row['member_foto'] . '" width="60">
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="card px-3">
                                <table border="0" class="text-start">
                                    <tr>
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td>' . $row['member_nama'] . '</td>
                                    </tr>
                                    <tr>
                                        <td>Tempat Tanggal Lahir</td>
                                        <td>:</td>
                                        <td>' . $row['member_ttl'] . '</td>
                                    </tr>
                                    <tr>
                                        <td>Tinggi</td>
                                        <td>:</td>
                                        <td>' . $row['member_tinggi'] . '</td>
                                    </tr>
                                    <tr>
                                        <td>Golongan Darah</td>
                                        <td>:</td>
                                        <td>' . $row['member_goldar'] . '</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        }
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($group->deleteData($id) > 0) {
            echo "<script>
                alert('Group berhasil dihapus!');
                document.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                alert('Group gagal dihapus!');
                document.location.href = 'index.php';
            </script>";
        }
    }
}

$group->close();
$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_PENGURUS', $data);
$detail->replace('DATA_DETAIL_MEMBER', $data2);
$detail->write();
