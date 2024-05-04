<?php

class Agensi extends DB
{
    function getAgensi()
    {
        $query = "SELECT * FROM agensi";
        return $this->execute($query);
    }

    function getAgensiById($id)
    {
        $query = "SELECT * FROM agensi WHERE agensi_id=$id";
        return $this->execute($query);
    }

    function addAgensi($data)
    {
        $nama = $data['nama_agensi'];
        $pendiri = $data['nama_pendiri'];
        $query = "INSERT INTO agensi VALUES('', '$nama', '$pendiri')";
        return $this->executeAffected($query);
    }

    function updateAgensi($id, $data)
    {
        $nama = $data['nama_agensi'];
        $pendiri = $data['nama_pendiri'];
        $query = "UPDATE agensi SET agensi_nama = '$nama', agensi_pendiri = '$pendiri' WHERE agensi_id = $id";
        return $this->executeAffected($query);
    }

    function deleteAgensi($id)
    {
        $query = "DELETE FROM agensi WHERE agensi_id=$id";
        return $this->executeAffected($query);
    }
}
