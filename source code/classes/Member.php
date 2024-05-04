<?php

class Member extends DB
{
    function getMemberJoin()
    {
        $query = "SELECT * FROM member JOIN groupop ON member.group_id=groupop.group_id ORDER BY member.member_id";

        return $this->execute($query);
    }

    function getMemberSort($sort)
    {
        $query = "SELECT * FROM member JOIN groupop ON member.group_id=groupop.group_id ORDER BY member.member_nama $sort";

        return $this->execute($query);
    }

    function getMember()
    {
        $query = "SELECT * FROM member";
        return $this->execute($query);
    }

    function getMemberById($id)
    {
        $query = "SELECT * FROM member JOIN groupop ON member.group_id=groupop.group_id WHERE member_id=$id";
        return $this->execute($query);
    }

    function addData($data, $file)
    {
        $foto = $file['name'];
        $nama = $data['nama'];
        $ttl = $data['ttl'];
        $tinggi = $data['tinggi'];
        $goldar = $data['goldar'];
        $group = $data['group_id'];

        $tempNamaFoto = $file['tmp_name'];
        $direktori = 'assets/images/' . $foto;
        move_uploaded_file($tempNamaFoto, $direktori);

        $query = "INSERT INTO member VALUES('', '$nama', '$ttl', '$tinggi', '$foto', '$goldar', '$group')";
        return $this->executeAffected($query);
    }

    function updateData($id, $data, $file)
    {
        $foto = $file['name'];
        $nama = $data['nama'];
        $ttl = $data['ttl'];
        $tinggi = $data['tinggi'];
        $goldar = $data['goldar'];
        $group = $data['group_id'];

        if ($foto != "") {
            $tempfoto = $file['tmp_name'];
            $direktori = 'assets/images/' . $foto;
            move_uploaded_file($tempfoto, $direktori);
            $query = "UPDATE member SET member_foto = '$foto', member_nama = '$nama', member_ttl = '$ttl', member_tinggi = '$tinggi', member_goldar = '$goldar', group_id = '$group' WHERE member_id = $id";
        }else{
            $query = "UPDATE member SET member_nama = '$nama', member_ttl = '$ttl', member_tinggi = '$tinggi', member_goldar = '$goldar', group_id = '$group' WHERE member_id = $id";
        }
        
        return $this->executeAffected($query);
    }

    function deleteData($id)
    {
        $query = "DELETE FROM member WHERE member_id=$id";
        return $this->executeAffected($query);
    }
}
