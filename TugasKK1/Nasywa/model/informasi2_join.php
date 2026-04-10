<?php include "koneksi.php" ?>


<?php
     $no = 1;
            $data = mysqli_query($conn, "SELECT 
                a.Tanggal,
                a.Jumlah_Hadir,
                a.Daftar_Tidak_Hadir,
                m.Nama_Mapel,
                m.Kode_Mapel,
                (a.Jumlah_Hadir + a.Jumlah_Tidak_Hadir) AS Total_Siswa,
                ROUND((a.Jumlah_Hadir * 100.0 / (a.Jumlah_Hadir + a.Jumlah_Tidak_Hadir)), 2) AS Persentase_Hadir
            FROM absensirekap_xpplg3 a
            INNER JOIN guru g ON a.Id_Guru = g.Id_Guru
            LEFT JOIN mapel m ON g.id_mapel = m.id_mapel  
            WHERE (a.Jumlah_Hadir + a.Jumlah_Tidak_Hadir) > 0
            ORDER BY a.Tanggal DESC;
            ");
            
            if(mysqli_num_rows($data) > 0) {
                while($d = mysqli_fetch_array($data)){
                    echo "
                    <tr>
                        <td>$no</td>
                        <td>".htmlspecialchars($d['Tanggal'])."</td>
                        <td>".htmlspecialchars($d['Jumlah_Hadir'])."</td>
                        <td>".htmlspecialchars($d['Daftar_Tidak_Hadir'])."</td>
                        <td>".htmlspecialchars($d['Nama_Mapel'])."</td>
                        <td>".htmlspecialchars($d['Kode_Mapel'])."</td>
                        <td>".htmlspecialchars($d['Total_Siswa'])."</td>
                        <td>".htmlspecialchars($d['Persentase_Hadir'])."</td>
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