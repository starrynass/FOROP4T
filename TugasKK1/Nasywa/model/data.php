<?php

class Informasi1_Join {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllInformasi(): mixed{
        $sql = "SELECT 
                s.nama_siswa,
                s.NIS,
                k.nama_kelas,
                k.tingkat
            FROM siswa s
            JOIN kelas k ON s.id_kelas = k.id_kelas
            WHERE k.nama_kelas = 'X PPLG 3'
            ";

        return $this->conn->query($sql);
    }
}

class Informasi1_Bertingkat {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllInformasi(): mixed{
        $sql = "SELECT 
                s.nama_siswa, 
                s.NIS,
                (SELECT k.tingkat 
                FROM kelas k 
                WHERE k.id_kelas = s.id_kelas) AS tingkat,
                (SELECT k.nama_kelas 
                FROM kelas k 
                WHERE k.id_kelas = s.id_kelas) AS nama_kelas
            FROM siswa s
            WHERE s.id_kelas IN (
                SELECT id_kelas
                FROM kelas 
                WHERE nama_kelas = 'X PPLG 3'
            );
            ";

        return $this->conn->query($sql);
    }
}

class Informasi2_Join {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllInformasi(): mixed{
        $sql = "SELECT 
                a.Tanggal,
                a.Jumlah_Hadir,
                a.Daftar_Tidak_Hadir,
                m.Nama_Mapel,
                m.Kode_Mapel,
                (a.Jumlah_Hadir + a.Jumlah_Tidak_Hadir) AS Total_Siswa,
                ROUND((a.Jumlah_Hadir * 100.0 / (a.Jumlah_Hadir + a.Jumlah_Tidak_Hadir)), 2) 
                AS Persentase_Hadir
            FROM absensirekap_xpplg3 a
            INNER JOIN guru g ON a.Id_Guru = g.Id_Guru
            LEFT JOIN mapel m ON g.id_mapel = m.id_mapel  
            WHERE (a.Jumlah_Hadir + a.Jumlah_Tidak_Hadir) > 0
            ORDER BY a.Tanggal DESC;
            ";

        return $this->conn->query($sql);
    }
}

class Informasi2_Bertingkat {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllInformasi(): mixed{
        $sql = "SELECT 
                a.Tanggal,
                a.Jumlah_Hadir,
                a.Daftar_Tidak_Hadir,
                (SELECT Nama_Mapel 
                FROM mapel m 
                WHERE m.id_mapel = g.id_mapel
                ) AS Nama_Mapel,
                (SELECT Kode_Mapel
                FROM mapel m2
                WHERE m2.id_mapel = g.id_mapel
                ) AS Kode_Mapel,
                (a.Jumlah_Hadir + a.Jumlah_Tidak_Hadir) AS Total_Siswa,
                ROUND((a.Jumlah_Hadir * 100.0 / (a.Jumlah_Hadir + a.Jumlah_Tidak_Hadir)), 2) 
                AS Persentase_Hadir
            FROM absensirekap_xpplg3 a
            INNER JOIN guru g ON a.Id_Guru = g.Id_Guru
            ORDER BY a.Tanggal DESC;
            ";
        return $this->conn->query($sql);
    }
}

?>


