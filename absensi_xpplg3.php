<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi - X PPLG 3</title>

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
        .absensi-form {
            background: #ffffff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            border: 1px solid #e5e5e5;
        }

        .absensi-form input[type="text"],
        .absensi-form input[type="number"],
        .absensi-form input[type="date"],
        .absensi-form textarea {
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

        .absensi-form input:focus,
        .absensi-form textarea:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 5px rgba(45,123,132,0.3);
            background: #ffffff;
        }

        .absensi-form textarea {
            resize: vertical;
            min-height: 80px;
        }

        .absensi-form .add-btn {
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

        .absensi-form .add-btn:hover {
            background: #24656b;
            transform: translateY(-2px);
        }

        /* ========== TABLE STYLING ========== */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }

        table th {
            background: var(--accent-color);
            color: white;
            padding: 12px;
            font-size: 15px;
            text-align: left;
            font-weight: bold;
        }

        table td {
            padding: 10px 12px;
            border-bottom: 1px solid #eeeeee;
        }

        table tr:hover {
            background: #f3ffff;
        }

        table pre {
            white-space: pre-wrap;
            font-family: "Poppins", sans-serif;
            margin: 0;
            font-size: 14px;
        }

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
            max-height: 90vh;
            overflow-y: auto;
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
        
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            font-size: 1rem;
            font-family: 'Poppins', Arial, sans-serif;
        }
        
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--accent-color);
        }
        
        .form-group textarea {
            resize: vertical;
            min-height: 100px;
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
                <span class="card-icon">📅</span>
                <h3>Mata Pelajaran</h3>
            </a>
            <a href="absensi_xpplg3.php" class="main-card">
                <span class="card-icon">📋</span>
                <h3>Absensi</h3>
            </a>
            <a href="guru_xpplg3.php" class="main-card">
                <span class="card-icon">👤</span>
                <h3>Daftar Guru</h3>
            </a>
        </div>
    </div>

    <div class="right-illustration">
        <div class="illustration-content">
            <div class="calendar-placeholder"></div>
            <p style="margin-top:40px;color:var(--primary-color);">Absensi</p>
        </div>
    </div>
</section>

<div class="data-section">
    <h2 style="color:#2d7b84;">Absensi Rekap X PPLG 3</h2>

    <h3>Input Rekap Absensi</h3>
    <form method="POST" class="absensi-form">
        <input type="date" name="Tanggal" required>
        <input type="number" name="Jumlah_Hadir" placeholder="Jumlah Hadir" required>
        <input type="number" name="Jumlah_Tidak" placeholder="Jumlah Tidak Hadir" required>
        <textarea name="Daftar_Tidak" placeholder="Daftar siswa yang tidak hadir (pisahkan dengan enter)" rows="3" required></textarea>
        <button class="add-btn" type="submit" name="submit_rekap">Simpan Rekap</button>
    </form>

    <table>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Hadir</th>
            <th>Tidak Hadir</th>
            <th>Daftar Tidak Hadir</th>
            <th>Aksi</th>
        </tr>

        <?php
        

        // Proses Delete
        if(isset($_GET['aksi']) && $_GET['aksi'] == 'hapus' && isset($_GET['id'])) {
            $id = mysqli_real_escape_string($conn, $_GET['id']);
            
            $delete = mysqli_query($conn, "DELETE FROM absensiRekap_XPPLG3 WHERE id='$id'");
            
            if($delete) {
                echo "<script>alert('Data absensi berhasil dihapus!'); window.location='absensi_xpplg3.php';</script>";
            } else {
                echo "<script>alert('Gagal menghapus data absensi!'); window.location='absensi_xpplg3.php';</script>";
            }
        }

        if(isset($_POST['submit_rekap'])){
            $t = mysqli_real_escape_string($conn, $_POST['Tanggal']);
            $h = mysqli_real_escape_string($conn, $_POST['Jumlah_Hadir']);
            $th = mysqli_real_escape_string($conn, $_POST['Jumlah_Tidak']);
            $dt = mysqli_real_escape_string($conn, $_POST['Daftar_Tidak']);

            $insert = mysqli_query($conn, "INSERT INTO absensiRekap_XPPLG3 (Tanggal, Jumlah_Hadir, Jumlah_Tidak_Hadir, Daftar_Tidak_Hadir) 
                                           VALUES('$t', '$h', '$th', '$dt')");
            
            if($insert) {
                echo "<script>alert('Data absensi berhasil ditambahkan!'); window.location='absensi_xpplg3.php';</script>";
            } else {
                echo "<script>alert('Gagal menambahkan data absensi!'); window.location='absensi_xpplg3.php';</script>";
            }
        }

        if(isset($_POST['update'])) {
            $id = mysqli_real_escape_string($conn, $_POST['Id']);
            $t = mysqli_real_escape_string($conn, $_POST['Tanggal']);
            $h = mysqli_real_escape_string($conn, $_POST['Jumlah_Hadir']);
            $th = mysqli_real_escape_string($conn, $_POST['Jumlah_Tidak']);
            $dt = mysqli_real_escape_string($conn, $_POST['Daftar_Tidak']);
            
            $update = mysqli_query($conn, "UPDATE absensiRekap_XPPLG3 SET 
                                    Tanggal='$t', 
                                    Jumlah_Hadir='$h', 
                                    Jumlah_Tidak_Hadir='$th',
                                    Daftar_Tidak_Hadir='$dt'
                                    WHERE id='$id'");
            
            if($update) {
                echo "<script>alert('Data absensi berhasil diupdate!'); window.location='absensi_xpplg3.php';</script>";
            } else {
                echo "<script>alert('Gagal mengupdate data absensi!'); window.location='absensi_xpplg3.php';</script>";
            }
        }

        $edit_data = null;
        if(isset($_GET['aksi']) && $_GET['aksi'] == 'edit' && isset($_GET['id'])) {
            $id = mysqli_real_escape_string($conn, $_GET['id']);
            $edit_query = mysqli_query($conn, "SELECT * FROM absensiRekap_XPPLG3 WHERE id='$id'");
            $edit_data = mysqli_fetch_array($edit_query);
        }

        $query = "SELECT * FROM absensiRekap_XPPLG3 ORDER BY Tanggal DESC";
        $data = mysqli_query($conn, $query);
        
        if(mysqli_num_rows($data) > 0) {
            $no = 1;
            while($d = mysqli_fetch_array($data)){
                echo "
                <tr>
                    <td>$no</td>
                    <td>".htmlspecialchars($d['Tanggal'])."</td>
                    <td>".htmlspecialchars($d['Jumlah_Hadir'])." siswa</td>
                    <td>".htmlspecialchars($d['Jumlah_Tidak_Hadir'])." siswa</td>
                    <td><pre>".htmlspecialchars($d['Daftar_Tidak_Hadir'])."</pre></td>
                    <td>
                        <a href='?aksi=edit&id=".urlencode($d['Id'])."' class='btn btn-edit'>Edit</a>
                        <a href='?aksi=hapus&id=".urlencode($d['Id'])."' class='btn btn-delete' onclick='return confirm(\"Yakin ingin menghapus data absensi ini?\")'>Hapus</a>
                    </td>
                </tr>";
                $no++;
            }
        } else {
            echo "
            <tr>
                <td colspan='6' class='no-data'>Belum ada data absensi untuk kelas X PPLG 3</td>
            </tr>";
        }
        ?>
    </table>
</div>


<?php if($edit_data): ?>
<div id="editModal" class="modal active">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Edit Data Absensi</h3>
        </div>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($edit_data['id']); ?>">
            
            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="Tanggal" value="<?php echo htmlspecialchars($edit_data['Tanggal']); ?>" required>
            </div>
            
            <div class="form-group">
                <label>Jumlah Hadir</label>
                <input type="number" name="Jumlah_Hadir" value="<?php echo htmlspecialchars($edit_data['Jumlah_Hadir']); ?>" required>
            </div>
            
            <div class="form-group">
                <label>Jumlah Tidak Hadir</label>
                <input type="number" name="Jumlah_Tidak" value="<?php echo htmlspecialchars($edit_data['Jumlah_Tidak_Hadir']); ?>" required>
            </div>
            
            <div class="form-group">
                <label>Daftar Tidak Hadir</label>
                <textarea name="Daftar_Tidak" required><?php echo htmlspecialchars($edit_data['Daftar_Tidak_Hadir']); ?></textarea>
            </div>
            
            <button type="submit" name="update" class="btn-submit">Update Data</button>
            <a href="absensi_xpplg3.php" class="btn-cancel">Batal</a>
        </form>
    </div>
</div>
<?php endif; ?>

</body>
</html>