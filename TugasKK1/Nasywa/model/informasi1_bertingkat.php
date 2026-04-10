<?php include "koneksi.php" ?>


<?php
     $no = 1;
            $data = mysqli_query($conn, "SELECT 
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
            ");
            
            if(mysqli_num_rows($data) > 0) {
                while($d = mysqli_fetch_array($data)){
                    echo "
                    <tr>
                        <td>$no</td>
                        <td>".htmlspecialchars($d['nama_siswa'])."</td>
                        <td>".htmlspecialchars($d['NIS'])."</td>
                        <td>".htmlspecialchars($d['tingkat'])."</td>
                        <td>".htmlspecialchars($d['nama_kelas'])."</td>
                    </tr>";
                    $no++;
                }
            } else {
                echo "
                <tr>
                    <td colspan='5' class='no-data'>Belum ada data mata pelajaran</td>
                </tr>";
            }
            ?>