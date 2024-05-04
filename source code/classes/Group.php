<?php

class Group extends DB
{
    function getGroupJoin()
    {
        $query = "SELECT * FROM groupop JOIN agensi ON groupop.agensi_id=agensi.agensi_id ORDER BY groupop.group_id";

        return $this->execute($query);
    }

    function getGroup()
    {
        $query = "SELECT * FROM groupop";
        return $this->execute($query);
    }

    function searchGroup($keyword)
    {
        $query = "SELECT * FROM groupop JOIN agensi ON groupop.agensi_id=agensi.agensi_id WHERE group_nama LIKE '%$keyword%'";
        return $this->execute($query);
    }

    function getGroupById($id)
    {
        $query = "SELECT * FROM groupop JOIN agensi ON groupop.agensi_id=agensi.agensi_id WHERE group_id=$id";
        return $this->execute($query);
    }

    function addData($data, $file)
    {
        $foto = $file['name'];
        $nama = $data['nama'];
        $debut = $data['debut'];
        $agensi = $data['agensi_id'];

        $tempNamaFoto = $file['tmp_name'];
        $direktori = 'assets/images/' . $foto;
        move_uploaded_file($tempNamaFoto, $direktori);

        $query = "INSERT INTO groupop VALUES('', '$nama', '$debut', '$foto', '$agensi')";
        return $this->executeAffected($query);
    }

    function updateData($id, $data, $file)
    {
        $foto = $file['name'];
        $nama = $data['nama'];
        $debut = $data['debut'];
        $agensi = $data['agensi_id'];

        if ($foto != "") {
            $tempfoto = $file['tmp_name'];
            $direktori = 'assets/images/' . $foto;
            move_uploaded_file($tempfoto, $direktori);
            $query = "UPDATE groupop SET group_logo = '$foto', group_nama = '$nama', group_debut = '$debut', agensi_id = '$agensi' WHERE group_id = $id";
        }else{
            $query = "UPDATE groupop SET group_nama = '$nama', group_debut = '$debut', agensi_id = '$agensi' WHERE group_id = $id";
        }

        return $this->executeAffected($query);
    }

    function deleteData($id)
    {
        $query = "DELETE FROM groupop WHERE group_id=$id";
        return $this->executeAffected($query);
    }
}
