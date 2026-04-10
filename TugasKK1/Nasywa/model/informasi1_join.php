<?php 
include "koneksi.php" ?>

  <?php
     $no = 1;
            $data = mysqli_query($conn, "SELECT 
                s.nama_siswa,
                s.NIS,
                k.nama_kelas,
                k.tingkat
            FROM siswa s
            JOIN kelas k ON s.id_kelas = k.id_kelas
            WHERE k.nama_kelas = 'X PPLG 3'
            ORDER BY s.nama_siswa;
            ");
            
            if(mysqli_num_rows($data) > 0) {
                while($d = mysqli_fetch_array($data)){
                    echo "
                    <tr>
                        <td>$no</td>
                        <td>".htmlspecialchars($d['nama_siswa'])."</td>
                        <td>".htmlspecialchars($d['NIS'])."</td>
                        <td>".htmlspecialchars($d['nama_kelas'])."</td>
                        <td>".htmlspecialchars($d['tingkat'])."</td>
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