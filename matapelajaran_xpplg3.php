<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mata Pelajaran - X PPLG 3</title>

  <style>
        /* --- Variabel Warna --- */
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

        /* ========== 1. NAVIGASI ========== */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 80px;
            background-color: white;
            border-bottom: 1px solid #eee;
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
            background-color: var(--secondary-color); 
            margin-right: 10px; 
        }
        nav ul { 
            list-style: none; 
            display: flex; 
            gap: 30px; 
        }
        nav ul li a { 
            text-decoration: none; 
            color: var(--text-dark); 
            font-weight: 500; 
            padding: 8px 15px;
            transition: all 0.3s; 
            border-radius: 8px;
        }
        nav ul li a:hover { 
            background-color: var(--secondary-color);
            color: white;
        }

        /* ========== 2. HERO SECTION ========== */
        .hero-section {
            padding: 60px 80px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            background-color: var(--background-color-page);
            min-height: 500px;
        }

        .text-content { max-width: 50%; }
        .text-content h1 { 
            font-size: 3rem; 
            color: var(--primary-color); 
            margin-bottom: 10px; 
        }
        .text-content p { 
            font-size: 1.1rem; 
            color: var(--text-secondary); 
            margin-bottom: 40px; 
        }

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
        .main-card:hover { 
            transform: translateY(-5px); 
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1); 
        }
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
        .illustration-content { 
            font-size: 1.5rem; 
            color: var(--secondary-color); 
            text-align: center; 
            padding: 20px; 
        }
        .calendar-placeholder { 
            width: 80%; 
            height: 80%; 
            border: 5px solid var(--secondary-color); 
            border-radius: 10px; 
            position: relative; 
        }
        .calendar-placeholder::before, .calendar-placeholder::after { 
            content: ''; 
            position: absolute; 
            top: -20px; 
            width: 40px; 
            height: 10px; 
            background-color: var(--secondary-color); 
            border-radius: 5px; 
        }
        .calendar-placeholder::before { left: 20%; }
        .calendar-placeholder::after { right: 20%; }

        /* ========== 3. DATA SECTION ========== */
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

        .data-section h3 {
            color: var(--accent-color);
            margin-top: 30px;
            margin-bottom: 15px;
            font-size: 1.3rem;
        }

        /* ========== FORM STYLING ========== */
        .mapel-form {
            background: #ffffff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            border: 1px solid #e5e5e5;
        }

        .mapel-form input[type="text"] {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 15px;
            border: 1px solid #cccccc;
            border-radius: 10px;
            font-size: 15px;
            outline: none;
            transition: 0.2s ease-in-out;
            background: #fafafa;
            font-family: 'Poppins', Arial, sans-serif;
        }

        .mapel-form input:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 5px rgba(45,123,132,0.3);
            background: #ffffff;
        }

        .mapel-form .add-btn {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border-radius: 10px;
            background: var(--accent-color);
            color: white;
            border: none;
            cursor: pointer;
            transition: 0.2s;
            font-weight: 600;
        }

        .mapel-form .add-btn:hover {
            background: #24656b;
            transform: translateY(-2px);
        }

        /* ========== TABLE STYLING ========== */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            font-size: 0.95rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        th, td {
            border: 1px solid var(--border-color);
            padding: 12px 15px;
            text-align: left;
        }
        th {
            background-color: var(--accent-color);
            color: var(--text-light);
            font-weight: bold;
            text-transform: uppercase;
        }
        tr:nth-child(even) { background-color: #f7f7f7; }
        tr:hover { background-color: #ededed; }

        /* ========== BUTTON AKSI ========== */
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
            font-weight: 500;
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

        /* ========== MODAL STYLING ========== */
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
            max-width: 600px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.3);
        }
        
        .modal-header {
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--accent-color);
        }
        
        .modal-header h3 {
            color: var(--accent-color);
            margin: 0;
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
            font-family: 'Poppins', Arial, sans-serif;
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
            font-weight: 600;
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
            text-align: center;
            display: block;
            text-decoration: none;
            font-weight: 600;
        }
        .btn-cancel:hover {
            background-color: #777;
        }

        .no-data {
            text-align: center;
            padding: 40px;
            color: var(--text-secondary);
            font-size: 1.1rem;
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
                 <p style="margin-top: 40px; color: var(--primary-color);">Mata Pelajaran</p>
            </div>
        </div>
    </section>

    <div class="data-section"> 
        <h2 style="color:#2d7b84;">Daftar Mata Pelajaran X PPLG 3</h2>

        <!-- FORM INPUT -->
        <h3>Input Mata Pelajaran</h3>
        <form method="POST" class="mapel-form">
            <input type="text" name="Kode_Mapel" placeholder="Kode Mata Pelajaran" required>
            <input type="text" name="Nama_Mapel" placeholder="Nama Mata Pelajaran" required>
            <input type="text" name="Kelompok_Mapel" placeholder="Kelompok Mata Pelajaran" required>
            <button class="add-btn" type="submit" name="submit_mapel">Simpan Mata Pelajaran</button>
        </form>

        <!-- TABLE -->
        <table>
            <tr>
                <th>No</th>
                <th>Kode Mapel</th>
                <th>Nama Mapel</th>
                <th>Kelompok</th>
                <th>Aksi</th>
            </tr>

            <?php

            // Proses Delete
            if(isset($_GET['aksi']) && $_GET['aksi'] == 'hapus' && isset($_GET['kode'])) {
                $kode_mapel = mysqli_real_escape_string($conn, $_GET['kode']);
                
                $delete = mysqli_query($conn, "DELETE FROM mapel WHERE Kode_Mapel='$kode_mapel'");
                
                if($delete) {
                    echo "<script>alert('Data mata pelajaran berhasil dihapus!'); window.location='matapelajaran_xpplg3.php';</script>";
                } else {
                    echo "<script>alert('Gagal menghapus data mata pelajaran!'); window.location='matapelajaran_xpplg3.php';</script>";
                }
            }

            // Proses Create
            if(isset($_POST['submit_mapel'])){
                $kode = mysqli_real_escape_string($conn, $_POST['Kode_Mapel']);
                $nama = mysqli_real_escape_string($conn, $_POST['Nama_Mapel']);
                $kelompok = mysqli_real_escape_string($conn, $_POST['Kelompok_Mapel']);

                $insert = mysqli_query($conn, "INSERT INTO mapel (Kode_Mapel, Nama_Mapel, Kelompok_Mapel) 
                                               VALUES('$kode', '$nama', '$kelompok')");
                
                if($insert) {
                    echo "<script>alert('Data mata pelajaran berhasil ditambahkan!'); window.location='matapelajaran_xpplg3.php';</script>";
                } else {
                    echo "<script>alert('Gagal menambahkan data mata pelajaran!'); window.location='matapelajaran_xpplg3.php';</script>";
                }
            }

            // Proses Update
            if(isset($_POST['update'])) {
                $kode_lama = mysqli_real_escape_string($conn, $_POST['kode_mapel_lama']);
                $kode = mysqli_real_escape_string($conn, $_POST['Kode_Mapel']);
                $nama = mysqli_real_escape_string($conn, $_POST['Nama_Mapel']);
                $kelompok = mysqli_real_escape_string($conn, $_POST['Kelompok_Mapel']);
                
                $update = mysqli_query($conn, "UPDATE mapel SET 
                                        Kode_Mapel='$kode',
                                        Nama_Mapel='$nama', 
                                        Kelompok_Mapel='$kelompok' 
                                        WHERE Kode_Mapel='$kode_lama'");
                
                if($update) {
                    echo "<script>alert('Data mata pelajaran berhasil diupdate!'); window.location='matapelajaran_xpplg3.php';</script>";
                } else {
                    echo "<script>alert('Gagal mengupdate data mata pelajaran!'); window.location='matapelajaran_xpplg3.php';</script>";
                }
            }

            // Ambil data untuk edit
            $edit_data = null;
            if(isset($_GET['aksi']) && $_GET['aksi'] == 'edit' && isset($_GET['kode'])) {
                $kode_mapel = mysqli_real_escape_string($conn, $_GET['kode']);
                $edit_query = mysqli_query($conn, "SELECT * FROM mapel WHERE Kode_Mapel='$kode_mapel'");
                $edit_data = mysqli_fetch_array($edit_query);
            }

            // Tampilkan data
            $no = 1;
            $data = mysqli_query($conn, "SELECT * FROM mapel ORDER BY Kode_Mapel ASC");
            
            if(mysqli_num_rows($data) > 0) {
                while($d = mysqli_fetch_array($data)){
                    echo "
                    <tr>
                        <td>$no</td>
                        <td>".htmlspecialchars($d['Kode_Mapel'])."</td>
                        <td>".htmlspecialchars($d['Nama_Mapel'])."</td>
                        <td>".htmlspecialchars($d['Kelompok_Mapel'])."</td>
                        <td>
                            <a href='?aksi=edit&kode=".urlencode($d['Kode_Mapel'])."' class='btn btn-edit'>Edit</a>
                            <a href='?aksi=hapus&kode=".urlencode($d['Kode_Mapel'])."' class='btn btn-delete' onclick='return confirm(\"Yakin ingin menghapus mata pelajaran ini?\")'>Hapus</a>
                        </td>
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

    <!-- Modal Edit -->
    <?php if($edit_data): ?>
    <div id="editModal" class="modal active">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit Data Mata Pelajaran</h3>
            </div>
            <form method="POST" action="">
                <input type="hidden" name="kode_mapel_lama" value="<?php echo htmlspecialchars($edit_data['Kode_Mapel']); ?>">
                
                <div class="form-group">
                    <label>Kode Mata Pelajaran</label>
                    <input type="text" name="Kode_Mapel" value="<?php echo htmlspecialchars($edit_data['Kode_Mapel']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Nama Mata Pelajaran</label>
                    <input type="text" name="Nama_Mapel" value="<?php echo htmlspecialchars($edit_data['Nama_Mapel']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Kelompok Mata Pelajaran</label>
                    <input type="text" name="Kelompok_Mapel" value="<?php echo htmlspecialchars($edit_data['Kelompok_Mapel']); ?>" required>
                </div>
                
                <button type="submit" name="update" class="btn-submit">Update Data</button>
                <a href="matapelajaran_xpplg3.php" class="btn-cancel">Batal</a>
            </form>
        </div>
    </div>
    <?php endif; ?>

</body>
</html>