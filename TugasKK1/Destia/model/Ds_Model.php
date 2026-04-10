<?php

class Ds_Informasi_1 {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllInformasi(): mixed{
        $sql = "SELECT 
    s.Nama_Siswa,
    s.NIS,
    k.nama_kelas
FROM siswa s
INNER JOIN kelas k ON s.Id_Kelas = k.Id_Kelas
WHERE k.tingkat = 10;";

        return $this->conn->query($sql);
    }
}

class Ds_Informasi_2 {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllInformasi(): mixed{
        $sql = "SELECT 
    Nama_Siswa,
    NIS,
    (SELECT nama_kelas FROM kelas WHERE Id_Kelas = siswa.Id_Kelas) AS nama_kelas
FROM siswa
WHERE Id_Kelas IN (SELECT Id_Kelas FROM kelas WHERE tingkat = 10);";

        return $this->conn->query($sql);
    }
}

class Ds_Informasi_3 {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllInformasi(): mixed{
        $sql = "SELECT 
    s.Nama_Siswa,
    s.NIS,
    k.nama_kelas,
    g.nama_guru
FROM siswa s
INNER JOIN kelas k ON s.Id_Kelas = k.Id_Kelas
INNER JOIN guru g ON g.Id_Kelas = k.Id_Kelas
WHERE g.NIP = '197801152005011001';";

        return $this->conn->query($sql);
    }
}

class Ds_Informasi_4 {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllInformasi(): mixed{
        $sql = "SELECT 
    Nama_Siswa,
    NIS,
    (SELECT nama_kelas FROM kelas WHERE Id_Kelas = siswa.Id_Kelas) AS nama_kelas,
    (SELECT nama_guru FROM guru WHERE Id_Kelas = (SELECT Id_Kelas FROM kelas WHERE Id_Kelas = siswa.Id_Kelas) AND NIP = '197801152005011001') AS nama_guru
FROM siswa
WHERE Id_Kelas IN (SELECT Id_Kelas FROM guru WHERE NIP = '197801152005011001');";

        return $this->conn->query($sql);
    }
}
?>