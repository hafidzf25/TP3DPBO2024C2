<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Agensi.php');
include('classes/Group.php');
include('classes/Member.php');
include('classes/Template.php');

$listMember = new Member($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$listAgensi = new Agensi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$listAgensi->open();
$listAgensi->getAgensi();

$listGroup = new Group($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$listGroup->open();
$listGroup->getGroup();

if (isset($_GET['tambah'])) {
    if ($_GET['tambah'] == 'member') {

        $judul = null;
        $judul = '<h3 class="my-0">Tambah Member</h3>';

        $data_member = null;

        $data_member .= '<form action="tambah_member.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nama</label>
                                <input required type="text" name="nama" class="form-control" id="exampleInputPassword1" placeholder="Masukkan Nama">
                            </div>
                            <br>
                            <div class="form-group">
                            <label for="exampleInputEmail1">Tempat Tanggal Lahir</label>
                            <input required type="date" name="ttl" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tinggi</label>
                                <input required type="text" name="tinggi" class="form-control" id="exampleInputPassword1" placeholder="Masukkan Tinggi Badan">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Golongan Darah</label>
                                <select required class="form-control" name="goldar" id="exampleFormControlSelect1">
                                    <option value="A+">A+</option>
                                    <option value="B+">B+</option>
                                    <option value="AB+">AB+</option>
                                    <option value="O+">O+</option>
                                    <option value="A-">A-</option>
                                    <option value="B-">B-</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O-">O-</option>
                                </select>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Member Group</label>
                                <select required class="form-control" name="group_id" id="exampleFormControlSelect1">
                                ';
        while ($row = $listGroup->getResult()) {
            $data_member .= "<option value='" . $row['group_id'] . "'>" . $row['group_nama'] . "</option>";
        }
        $data_member .= '
                                </select>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Masukkan Foto</label>
                                <input required type="file" name="foto" class="form-control-file" id="exampleFormControlFile1">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>';

        // ambil data pengurus
        // gabungkan dgn tag html
        // untuk di passing ke skin/template

        $listGroup->close();
        $listAgensi->close();

        // buat instance template
        $home = new Template('templates/skintambahubah.html');

        // simpan data ke template
        $home->replace('JUDUL', $judul);
        $home->replace('TAMBAH_MEMBER', $data_member);
        $home->write();
    }
    else if ($_GET['tambah'] == 'agensi') {

        $judul = null;
        $judul = '<h3 class="my-0">Tambah Agensi</h3>';

        $data_agensi = null;

        $data_agensi .= '<form action="tambah_agensi.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nama Agensi</label>
                                <input required type="text" name="nama_agensi" class="form-control" id="exampleInputPassword1" placeholder="Masukkan Nama">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nama Pendiri</label>
                                <input required type="text" name="nama_pendiri" class="form-control" id="exampleInputPassword1" placeholder="Masukkan Nama">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>';

        // ambil data pengurus
        // gabungkan dgn tag html
        // untuk di passing ke skin/template

        $listGroup->close();
        $listAgensi->close();

        // buat instance template
        $home = new Template('templates/skintambahubah.html');

        // simpan data ke template
        $home->replace('JUDUL', $judul);
        $home->replace('TAMBAH_MEMBER', $data_agensi);
        $home->write();
    }
    else if ($_GET['tambah'] == 'group') {

        $judul = null;
        $judul = '<h3 class="my-0">Tambah Group</h3>';

        $data_group = null;

        $data_group .= '<form action="tambah_group.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nama Grup</label>
                                <input required type="text" name="nama" class="form-control" id="exampleInputPassword1" placeholder="Masukkan Nama">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Grup Debut</label>
                                <input required type="text" name="debut" class="form-control" id="exampleInputPassword1" placeholder="Masukkan tahun debut">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Agensi</label>
                                <select required class="form-control" name="agensi_id" id="exampleFormControlSelect1">
                                ';
                                while ($row = $listAgensi->getResult()) {
                                    $data_group .= "<option value='" . $row['agensi_id'] . "'>" . $row['agensi_nama'] . "</option>";
                                }
                                $data_group .= '
                                </select>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Masukkan Logo</label>
                                <input required type="file" name="foto" class="form-control-file" id="exampleFormControlFile1">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>';

        // ambil data pengurus
        // gabungkan dgn tag html
        // untuk di passing ke skin/template

        $listGroup->close();
        $listAgensi->close();

        // buat instance template
        $home = new Template('templates/skintambahubah.html');

        // simpan data ke template
        $home->replace('JUDUL', $judul);
        $home->replace('TAMBAH_MEMBER', $data_group);
        $home->write();
    }
    else if ($_GET['tambah'] == 'editgroup') {

        $judul = null;
        $judul = '<h3 class="my-0">Edit Group</h3>';
        $id = $_GET['id'];

        $listGroup->getGroupById($id);
        $row = $listGroup->getResult();

        $data_group = null;

        $data_group .= '<form action="ubah_group.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="hidden" value=' . $row['group_id'] . ' name="id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nama Grup</label>
                                <input required type="text" value="' . $row["group_nama"] . '" name="nama" class="form-control" id="exampleInputPassword1" placeholder="Masukkan Nama">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Grup Debut</label>
                                <input required type="text" value="' . $row["group_debut"] . '" name="debut" class="form-control" id="exampleInputPassword1" placeholder="Masukkan tahun debut">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Agensi</label>
                                <select required class="form-control" name="agensi_id" id="exampleFormControlSelect1">
                                ';
                                while ($agen = $listAgensi->getResult()) {
                                    $selected = ($agen["agensi_nama"] == $row['agensi_nama']) ? 'selected' : ''; // Menandai pilihan saat ini
                                    $data_group .= "<option value='" . $agen['agensi_id'] . "' . $selected . '>" .  $agen['agensi_nama'] . "</option>";
                                }
                                $data_group .= '
                                </select>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Masukkan Logo</label>
                                <input type="file" name="foto" class="form-control-file" id="exampleFormControlFile1">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>';

        // ambil data pengurus
        // gabungkan dgn tag html
        // untuk di passing ke skin/template

        $listGroup->close();
        $listAgensi->close();

        // buat instance template
        $home = new Template('templates/skintambahubah.html');

        // simpan data ke template
        $home->replace('JUDUL', $judul);
        $home->replace('TAMBAH_MEMBER', $data_group);
        $home->write();
    }

    else if ($_GET['tambah'] == 'editagensi') {

        $judul = null;
        $judul = '<h3 class="my-0">Edit Agensi</h3>';
        $id = $_GET['id'];

        $listAgensi->getAgensiById($id);
        $row = $listAgensi->getResult();

        $data_agensi = null;

        $data_agensi .= '<form action="ubah_agensi.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="hidden" value=' . $row['agensi_id'] . ' name="id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nama Grup</label>
                                <input required type="text" value="' . $row["agensi_nama"] . '" name="nama_agensi" class="form-control" id="exampleInputPassword1" placeholder="Masukkan Nama Agensi">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Grup Debut</label>
                                <input required type="text" value="' . $row["agensi_pendiri"] . '" name="nama_pendiri" class="form-control" id="exampleInputPassword1" placeholder="Masukkan Nama Pendiri">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>';

        // ambil data pengurus
        // gabungkan dgn tag html
        // untuk di passing ke skin/template

        $listGroup->close();
        $listAgensi->close();

        // buat instance template
        $home = new Template('templates/skintambahubah.html');

        // simpan data ke template
        $home->replace('JUDUL', $judul);
        $home->replace('TAMBAH_MEMBER', $data_agensi);
        $home->write();
    }

    else if ($_GET['tambah'] == 'editmember') {

        $listMember->open();
        $listMember->getMember();
        $judul = null;
        $judul = '<h3 class="my-0">Edit Member</h3>';
        $id = $_GET['id'];

        $listMember->getMemberById($id);
        $row = $listMember->getResult();
        
        // print_r($row);
        // die;
        $det = $row['member_ttl'];
                                $row['member_ttl'] = null;
                                $row['member_ttl'] = $det[0] . $det[1] . $det[2] . $det[3] . $det[4] . $det[5] . $det[6] . $det[4] . $det[8] . $det[9];

        $data_member = null;

        $data_member .= '<form action="ubah_member.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="hidden" value=' . $row['member_id'] . ' name="id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nama Member</label>
                                <input required type="text" value="' . $row["member_nama"] . '" name="nama" class="form-control" id="exampleInputPassword1" placeholder="Masukkan Nama">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nama Grup</label>
                                <input required type="date" value="' . 

                                
                                $row["member_ttl"] 
                                
                                . '" name="ttl" class="form-control" id="exampleInputPassword1" placeholder="Masukkan Nama">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tinggi Member</label>
                                <input required type="text" value="' . $row["member_tinggi"] . '" name="tinggi" class="form-control" id="exampleInputPassword1" placeholder="Masukkan tahun debut">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Golongan Darah</label>
                                <select required class="form-control" name="goldar" id="exampleFormControlSelect1">';
                                // Loop untuk membuat pilihan semester
                                $goldar = ['A+', 'B+', 'AB+', 'O+', 'A-', 'B-', 'AB-', 'O-'];
                                // print_r($goldar);
                                // die;
                                for ($i=0; $i < 8; $i++) {
                                    $selected = ($goldar[$i] == $row['member_goldar']) ? 'selected' : ''; // Menandai pilihan saat ini
                                    $data_member .= '<option value="' . $goldar[$i] . '" ' . $selected . '>' .  $goldar[$i] . '</option>';
                                }
                            $data_member .= '</select>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Member Group</label>
                                <select required class="form-control" name="group_id" id="exampleFormControlSelect1">
                                ';
                                while ($gruf = $listGroup->getResult()) {
                                    $selected = ($gruf["group_id"] == $row['group_id']) ? 'selected' : ''; // Menandai pilihan saat ini
                                    $data_member .= "<option value='" . $gruf['group_id'] . "' . $selected . '>" .  $gruf['group_nama'] . "</option>";
                                }
                                $data_member .= '
                                </select>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Masukkan Logo</label>
                                <input type="file" name="foto" class="form-control-file" id="exampleFormControlFile1">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>';

        // ambil data pengurus
        // gabungkan dgn tag html
        // untuk di passing ke skin/template

        $listGroup->close();
        $listAgensi->close();

        // buat instance template
        $home = new Template('templates/skintambahubah.html');

        // simpan data ke template
        $home->replace('JUDUL', $judul);
        $home->replace('TAMBAH_MEMBER', $data_member);
        $home->write();
    }
}
