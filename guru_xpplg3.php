<?php 
include "koneksi.php"; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Guru - X PPLG 3</title>
    <style>
        :root {
            --primary-color: #0d4a52;
            --secondary-color: #3b7e88;
            --accent-color: #2d7b84;
            --background-color-page: #f4f8f9;
            --text-light: #ffffff;
            --text-dark: #333333;
            --text-secondary: #aaaaaa;
            --border-color: #ddd;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', Arial, sans-serif;
        }

        body {
            background-color: var(--background-color-page);
            color: var(--text-dark);
            line-height: 1.6;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 80px;
            background-color: white;
            border-bottom: 1px solid #eee;
        }
        .logo { display: flex; align-items: center; font-size: 1.2rem; font-weight: bold; }
        .circle { width: 20px; height: 20px; border-radius: 50%; background-color: var(--secondary-color); margin-right: 10px; }
        nav ul { list-style: none; display: flex; gap: 30px; }
        nav ul li a { text-decoration: none; color: var(--text-dark); font-weight: 500; }

        .hero-section {
            padding: 60px 80px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            background-color: var(--background-color-page);
            min-height: 500px;
        }

        .text-content { max-width: 50%; }
        .text-content h1 { font-size: 3rem; color: var(--primary-color); margin-bottom: 10px; }
        .text-content p { font-size: 1.1rem; color: var(--text-secondary); margin-bottom: 40px; }

        .card-container { display: flex; gap: 20px; }
        .main-card {
            width: 180px;
            height: 180px;
            background-color: var(--secondary-color);
            color: var(--text-light);
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 20px;
            text-align: left;
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
            text-decoration: none;
        }
        .main-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1); }
        .card-icon { font-size: 3rem; margin-bottom: 10px; }
        .main-card h3 { font-size: 1.2rem; font-weight: bold; line-height: 1.2; }

        .right-illustration {
            width: 45%;
            height: 350px;
            background-color: #e0e6e7;
            border-radius: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        .illustration-content { font-size: 1.5rem; color: var(--secondary-color); text-align: center; padding: 20px; }
        .calendar-placeholder { width: 80%; height: 80%; border: 5px solid var(--secondary-color); border-radius: 10px; position: relative; }
        .calendar-placeholder::before, .calendar-placeholder::after { 
            content: ''; position: absolute; top: -20px; width: 40px; height: 10px; 
            background-color: var(--secondary-color); border-radius: 5px; 
        }
        .calendar-placeholder::before { left: 20%; }
        .calendar-placeholder::after { right: 20%; }

        .data-section {
            padding: 40px 80px;
            background-color: white; 
            margin-bottom: 50px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        } 

        .data-section h2 {
            color: var(--accent-color);
            margin-bottom: 20px;
            border-bottom: 2px solid var(--accent-color);
            padding-bottom: 10px;
            font-size: 1.8rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }
        th, td {
            border: 1px solid var(--border-color);
            padding: 12px 15px;
            text-align: left;
        }
        th {
            background-color: var(--accent-color);
            color: white;
        }
        tr:nth-child(even) { background-color: #f7f7f7; }
        tr:hover { background-color: #e8f4f5; }
        
        .no-data {
            text-align: center;
            padding: 40px;
            color: var(--text-secondary);
            font-size: 1.1rem;
        }

        /* Tombol Aksi */
        .btn {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            text-decoration: none;
            display: inline-block;
            margin: 2px;
            transition: all 0.3s;
        }
        .btn-edit {
            background-color: #3b7e88;
            color: white;
        }
        .btn-edit:hover {
            background-color: #0d4a52;
        }
        .btn-delete {
            background-color: #db7d7bff;
            color: white;
        }
        .btn-delete:hover {
            background-color: #e53935;
        }

        /* Modal Edit */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }
        .modal.active {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.3);
        }
        .modal-header {
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--accent-color);
        }
        .modal-header h3 {
            color: var(--accent-color);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: var(--text-dark);
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            font-size: 1rem;
        }
        .form-group input:focus {
            outline: none;
            border-color: var(--accent-color);
        }
        .btn-submit {
            background-color: var(--accent-color);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            width: 100%;
            margin-top: 10px;
        }
        .btn-submit:hover {
            background-color: var(--primary-color);
        }
        .btn-cancel {
            background-color: #999;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            width: 100%;
            margin-top: 10px;
        }
        .btn-cancel:hover {
            background-color: #777;
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

    <section class="hero-section">
        <div class="text-content">
            <h1 style="color:#2d7b84;">X PPLG 3</h1>
            <p style="color:#2d7b84;">Informasi mengenai kelas X PPLG 3 untuk mempermudah pengelolaan informasi</p>

            <div class="card-container">
                <a href="matapelajaran_xpplg3.php" class="main-card">
                    <span class="card-icon">📅</span> <h3>Mata Pelajaran</h3>
                </a>

                <a href="absensi_xpplg3.php" class="main-card">
                    <span class="card-icon">📋</span> <h3>Absensi</h3>
                </a>

                <a href="guru_xpplg3.php" class="main-card">
                    <span class="card-icon">👤</span> <h3>Daftar Guru</h3>
                </a>
            </div>
        </div>

        <div class="right-illustration">
            <div class="illustration-content">
                 <div class="calendar-placeholder"></div>
                 <p style="margin-top: 40px; color: var(--primary-color);">Daftar Guru</p>
            </div>
        </div>
    </section>

    <div class="data-section"> 
        <h2 style="color:#2d7b84;">Daftar Guru X PPLG 3</h2>

        <table>
            <tr>
                <th>No</th>
                <th>Kode Guru</th>
                <th>Nama Guru</th>
                <th>Mata Pelajaran</th>
                <th>NIP</th>
                <th>Aksi</th>
            </tr>

            <?php

            // Proses Delete
            if(isset($_GET['aksi']) && $_GET['aksi'] == 'hapus' && isset($_GET['kode'])) {
                $kode_guru = mysqli_real_escape_string($conn, $_GET['kode']);
                
                $delete = mysqli_query($conn, "DELETE FROM guru WHERE Kode_Guru='$kode_guru'");
                
                if($delete) {
                    echo "<script>alert('Data guru berhasil dihapus!'); window.location='guru_xpplg3.php';</script>";
                } else {
                    echo "<script>alert('Gagal menghapus data guru!'); window.location='guru_xpplg3.php';</script>";
                }
            }

            // Proses Update
            if(isset($_POST['update'])) {
                $kode_guru = mysqli_real_escape_string($conn, $_POST['kode_guru']);
                $nama_guru = mysqli_real_escape_string($conn, $_POST['nama_guru']);
                $mata_pelajaran = mysqli_real_escape_string($conn, $_POST['mata_pelajaran']);
                $nip = mysqli_real_escape_string($conn, $_POST['nip']);
                
                $update = mysqli_query($conn, "UPDATE guru SET 
                                        nama_guru='$nama_guru', 
                                        mata_pelajaran='$mata_pelajaran', 
                                        NIP='$nip' 
                                        WHERE Kode_Guru='$kode_guru'");
                
                if($update) {
                    echo "<script>alert('Data guru berhasil diupdate!'); window.location='guru_xpplg3.php';</script>";
                } else {
                    echo "<script>alert('Gagal mengupdate data guru!'); window.location='guru_xpplg3.php';</script>";
                }
            }

            // Ambil data untuk edit
            $edit_data = null;
            if(isset($_GET['aksi']) && $_GET['aksi'] == 'edit' && isset($_GET['kode'])) {
                $kode_guru = mysqli_real_escape_string($conn, $_GET['kode']);
                $edit_query = mysqli_query($conn, "SELECT * FROM guru WHERE Kode_Guru='$kode_guru'");
                $edit_data = mysqli_fetch_array($edit_query);
            }

            $query = "SELECT g.* 
                      FROM guru g
                      INNER JOIN kelas k ON g.Id_Kelas = k.Id_Kelas
                      WHERE k.nama_kelas = 'X PPLG 3'
                      ORDER BY g.nama_guru ASC";
            
            $data = mysqli_query($conn, $query);
            
            if(mysqli_num_rows($data) > 0) {
                $no = 1;
                while($d = mysqli_fetch_array($data)){
                    echo "
                    <tr>
                        <td>$no</td>
                        <td>".htmlspecialchars($d['Kode_Guru'])."</td>
                        <td>".htmlspecialchars($d['nama_guru'])."</td>
                        <td>".htmlspecialchars($d['mata_pelajaran'])."</td>
                        <td>".htmlspecialchars($d['NIP'])."</td>
                        <td>
                            <a href='?aksi=edit&kode=".urlencode($d['Kode_Guru'])."' class='btn btn-edit'>Edit</a>
                            <a href='?aksi=hapus&kode=".urlencode($d['Kode_Guru'])."' class='btn btn-delete' onclick='return confirm(\"Yakin ingin menghapus data guru ini?\")'>Hapus</a>
                        </td>
                    </tr>";
                    $no++;
                }
            } else {
                echo "
                <tr>
                    <td colspan='6' class='no-data'>Belum ada data guru untuk kelas X PPLG 3</td>
                </tr>";
            }
            ?>
        </table>
    </div>

    <!-- Modal Edit -->
    <?php if($edit_data): ?>
    <div id="editModal" class="modal active">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit Data Guru</h3>
            </div>
            <form method="POST" action="">
                <input type="hidden" name="kode_guru" value="<?php echo htmlspecialchars($edit_data['Kode_Guru']); ?>">
                
                <div class="form-group">
                    <label>Kode Guru</label>
                    <input type="text" value="<?php echo htmlspecialchars($edit_data['Kode_Guru']); ?>" disabled>
                </div>
                
                <div class="form-group">
                    <label>Nama Guru</label>
                    <input type="text" name="nama_guru" value="<?php echo htmlspecialchars($edit_data['nama_guru']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Mata Pelajaran</label>
                    <input type="text" name="mata_pelajaran" value="<?php echo htmlspecialchars($edit_data['mata_pelajaran']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label>NIP</label>
                    <input type="text" name="nip" value="<?php echo htmlspecialchars($edit_data['NIP']); ?>" required>
                </div>
                
                <button type="submit" name="update" class="btn-submit">Update Data</button>
                <a href="guru_xpplg3.php" class="btn-cancel" style="text-align: center; display: block; text-decoration: none;">Batal</a>
            </form>
        </div>
    </div>
    <?php endif; ?>

</body>
</html>