<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Agensi.php');
include('classes/Group.php');
include('classes/Member.php');
include('classes/Template.php');

// buat instance Group
$listGroup = new Group($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$listGroup->open();
// tampilkan data Group
$listGroup->getGroupJoin();

// cari pengurus
if (isset($_POST['btn-cari'])) {
    // methode mencari data pengurus
    $listGroup->searchGroup($_POST['cari']);
} else {
    // method menampilkan data pengurus
    $listGroup->getGroupJoin();
}

$data = null;

// ambil data Group
// gabungkan dgn tag html
// untuk di passing ke skin/template
while ($row = $listGroup->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 pengurus-thumbnail">
        <a href="detail.php?id=' . $row['group_id'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['group_logo'] . '" class="card-img-top" alt="' . $row['group_logo'] . '">
            </div>
            <div class="card-body text-center">
                <p class="card-text group-nama my-0">' . $row['group_nama'] . '</p>
                <p class="card-text divisi-nama">' . $row['agensi_nama'] . '</p>
            </div>
        </a>
    </div>    
    </div>';
}

// tutup koneksi
$listGroup->close();

// buat instance template
$home = new Template('templates/skin.html');

// simpan data ke template
$home->replace('DATA_PENGURUS', $data);
$home->write();
