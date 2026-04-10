<?php

class Informasi1 {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllInformasi(): mixed{
        $sql = "SELECT
        s.nama_siswa, k.nama_kelas
        FROM siswa s
        JOIN kelas k ON s.Id_Kelas = k.Id_Kelas
        LIMIT 10;";

        return $this->conn->query($sql);
    }
}

class Informasi2 {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllInformasi(): mixed{
        $sql = "SELECT s.Nama_Siswa,
(SELECT k.nama_kelas FROM kelas k WHERE k.Id_Kelas = s.Id_Kelas ) AS nama_kelas
FROM siswa s
LIMIT 10;";
        return $this->conn->query($sql);
    }
}

class Informasi3 {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllInformasi(): mixed{
        $sql = "SELECT g.nama_guru, k.nama_kelas
FROM kelas k
JOIN guru g ON g.Id_Kelas = k.Id_Kelas ;
        ";
        return $this->conn->query($sql);
    }
}


class Informasi4{
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllInformasi(): mixed{
        $sql = "SELECT g.nama_guru,
(SELECT k.nama_kelas FROM kelas k WHERE k.Id_Kelas = g.Id_Kelas ) AS nama_kelas
FROM guru g;";

    return $this->conn->query($sql);
    }
}


?>