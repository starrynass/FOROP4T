<?php include "koneksi.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas KK1 Nasywa</title>

    <style>

        :root {
            --primary-color: #0d4a52;
            --secondary-color: #3b7e88;
            --accent-color: #2d7b84;
            --background-color-page: #f4f8f9;
            --text-light: #ffffff;
            --text-dark: #333333;
            --text-secondary: #aaaaaa;
            --border-color: #dcd6d6;
        }

 * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
            background-color: var(--background-color-page);
            color: var(--text-dark);
            line-height: 1.6;
        }

    /* ========== NAVBAR ========== */
    nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 80px;
            background-color: #225f65;
            border-bottom: 1px solid #eee;
            color: white;
        }
        .logo { 
            display: flex; 
            align-items: center; 
            font-size: 1.2rem; 
            font-weight: bold; 
        }
        .circle { 
            width: 20px; 
            height: 20px; 
            border-radius: 50%; 
            background-color: #cce7e8; 
            margin-right: 10px; 
        }
        nav ul { 
            list-style: none; 
            display: flex; 
            gap: 30px; 
        }
    nav ul li a {
      color: white;
      text-decoration: none;
      font-size: 15px;
      transition: 0.3s;
      font-weight: 500;
    }

        nav ul li a:hover { 
            color: #a6d8d9;
        }

            /* ========== 3. DATA SECTION ========== */
        .data-section {
            padding: 40px 80px;
            background-color: white; 
            margin-bottom: 50px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

                .data-section h2 {
            color: var(--accent-color);
            margin-bottom: 2px;
            border-bottom: 2px solid var(--accent-color);
            padding-bottom: 10px;
            font-size: 1.7rem;
        }

            .data-section h3 {
            color: var(--accent-color);
            margin-bottom: 20px;
            border-bottom: 1px solid var(--accent-color);
            padding-bottom: 10px;
            font-size: 1.0rem;
        }


            /* ========== TABLE STYLING ========== */
        table {
            width: 75%;
            border-collapse: collapse;
            margin-top: 30px;
            font-size: 0.95rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-left: auto;
            margin-right: auto;
            border-collapse: collapse;
        }
        th, td {
            border: 2px solid var(--border-color);
            padding: 5px 15px;
            text-align: left;
        }
        th {
            background-color: var(--accent-color);
            color: var(--text-light);
            font-weight: bold;
            text-transform: uppercase;
        }

    </style>
</head>
<body>

 <nav>
        <div class="logo">
            <div class="circle"></div>
            <span>FOROP4T</span>
        </div>
        <ul>
            <li><a href="index.html#kelas">Daftar Kelas</a></li>
            <li><a href="index.html#guru">Daftar Guru</a></li>
            <li><a href="index.html#jam">Jam Pelajaran</a></li>
        </ul>
    </nav>
    
<div class="data-section">

    <h2>Menampilkan Seluruh Data Siswa X PPLG 3</h2><br>

    <h3>SQL JOIN</h3>

    <table>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>NIS</th>
                <th>Nama Kelas</th>
                <th>Tingkat</th>
            </tr>


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

    </table><br>

    <h3>SQL BERTINGKAT</h3>

    <table>
        <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>NIS</th>
                <th>Tingkat</th>
                <th>Nama Kelas</th>
            </tr>


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
    </table><br><br>

    <h2>Menampilkan Rekap Absensi X PPLG 3 Berdasarkan <br> Tanggal dan Mata Pelajaran</h2><br>
    <h3>SQL JOIN</h3>

    <table>
    <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jumlah Hadir</th>
                <th>Daftar Tidak Hadir</th>
                <th>Mata Pelajaran</th>
                <th>Kode Mapel</th>
                <th>Total Siswa</th>
                <th>Persentase Kehadiran</th>
            </tr>


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

    </table><br>

    <h3>SQL BERTINGKAT</h3>

    <table>
<tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jumlah Hadir</th>
                <th>Daftar Tidak Hadir</th>
                <th>Mata Pelajaran</th>
                <th>Kode Mapel</th>
                <th>Total Siswa</th>
                <th>Persentase Kehadiran</th>
            </tr>


    <?php
     $no = 1;
            $data = mysqli_query($conn, "SELECT 
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
                ROUND((a.Jumlah_Hadir * 100.0 / (a.Jumlah_Hadir + a.Jumlah_Tidak_Hadir)), 2) AS Persentase_Hadir
            FROM absensirekap_xpplg3 a
            INNER JOIN guru g ON a.Id_Guru = g.Id_Guru
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

    </table>

</div>

</body>
</html>