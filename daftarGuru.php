<?php 
include "koneksi.php"; 

// Ambil filter tingkat dari URL
$tingkat_filter = isset($_GET['tingkat']) ? $_GET['tingkat'] : 'semua';

// Query data guru dengan JOIN ke tabel kelas
if ($tingkat_filter == 'semua') {
    $sql = "SELECT 
                g.Id_Guru,
                g.nama_guru,
                g.mata_pelajaran,
                g.NIP,
                g.Kode_Guru,
                k.nama_kelas,
                k.tingkat,
                k.Id_Kelas
            FROM guru g
            LEFT JOIN kelas k ON g.Id_Kelas = k.Id_Kelas
            ORDER BY k.tingkat, k.nama_kelas, g.nama_guru";
    $stmt = $conn->prepare($sql);
} else {
    $sql = "SELECT 
                g.Id_Guru,
                g.nama_guru,
                g.mata_pelajaran,
                g.NIP,
                g.Kode_Guru,
                k.nama_kelas,
                k.tingkat,
                k.Id_Kelas
            FROM guru g
            LEFT JOIN kelas k ON g.Id_Kelas = k.Id_Kelas
            WHERE k.tingkat = ?
            ORDER BY k.nama_kelas, g.nama_guru";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $tingkat_filter);
}

$stmt->execute();
$result = $stmt->get_result();
$guru_list = $result->fetch_all(MYSQLI_ASSOC);

// Hitung statistik
$sql_stats = "SELECT 
                COUNT(DISTINCT g.Id_Guru) as total_guru,
                COUNT(DISTINCT CASE WHEN k.tingkat = '10' THEN g.Id_Guru END) as guru_kelas_10,
                COUNT(DISTINCT CASE WHEN k.tingkat = '11' THEN g.Id_Guru END) as guru_kelas_11,
                COUNT(DISTINCT CASE WHEN k.tingkat = '12' THEN g.Id_Guru END) as guru_kelas_12
              FROM guru g
              LEFT JOIN kelas k ON g.Id_Kelas = k.Id_Kelas";
$result_stats = $conn->query($sql_stats);
$stats = $result_stats->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Guru - Website Sekolah</title>

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
      scroll-behavior: smooth;
    }

    body {
      background-color: #f4f8f9;
      color: #333;
    }

    /* ========== NAVBAR ========== */
    nav {
      background-color: #225f65;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 14px 50px;
      position: fixed;
      width: 100%;
      top: 0;
      left: 0;
      z-index: 1000;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
    }

    nav .logo {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 20px;
      font-weight: 600;
      letter-spacing: 1px;
    }

    nav .logo .circle {
      width: 32px;
      height: 32px;
      background: #cce7e8;
      border-radius: 50%;
    }

    nav ul {
      list-style: none;
      display: flex;
      gap: 25px;
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

    /* ========== CONTAINER ========== */
    .container {
      max-width: 1200px;
      margin: 100px auto 40px;
      padding: 20px;
    }

    .header {
      text-align: center;
      margin-bottom: 30px;
    }

    .header h1 {
      color: #2c6b74;
      font-size: 32px;
      margin-bottom: 10px;
    }

    .header p {
      color: #555;
      font-size: 16px;
    }

    /* ========== INFO BOX ========== */
    .info-box {
      background: linear-gradient(120deg, #2d7b84, #56a6a9);
      color: white;
      padding: 20px;
      border-radius: 10px;
      margin-bottom: 20px;
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;
      gap: 20px;
    }

    .info-item {
      text-align: center;
    }

    .info-item .number {
      font-size: 32px;
      font-weight: 700;
      margin-bottom: 5px;
    }

    .info-item .label {
      font-size: 14px;
      opacity: 0.9;
    }

    /* ========== FILTER ========== */
    .filter-section {
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      margin-bottom: 30px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 15px;
    }

    .filter-section label {
      font-weight: 600;
      color: #2c6b74;
      font-size: 15px;
    }

    .filter-section select {
      padding: 8px 15px;
      border-radius: 6px;
      border: 2px solid #2c6b74;
      font-size: 14px;
      cursor: pointer;
      transition: 0.3s;
    }

    .filter-section select:focus {
      outline: none;
      border-color: #56a6a9;
    }

    .filter-section .btn-filter {
      background-color: #2c6b74;
      color: white;
      border: none;
      padding: 8px 20px;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s;
    }

    .filter-section .btn-filter:hover {
      background-color: #3b949c;
      transform: scale(1.05);
    }

    /* ========== TABLE ========== */
    .table-container {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    thead {
      background: linear-gradient(120deg, #2d7b84, #56a6a9);
      color: white;
    }

    thead th {
      padding: 15px;
      text-align: left;
      font-weight: 600;
      font-size: 15px;
    }

    tbody tr {
      border-bottom: 1px solid #e0e0e0;
      transition: 0.3s;
    }

    tbody tr:hover {
      background-color: #f0f8f9;
    }

    tbody td {
      padding: 15px;
      font-size: 14px;
      color: #333;
    }

    tbody tr:last-child {
      border-bottom: none;
    }

    .no-data {
      text-align: center;
      padding: 40px;
      color: #999;
      font-size: 16px;
    }

    /* ========== BADGE TINGKAT ========== */
    .badge {
      display: inline-block;
      padding: 5px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
      color: white;
    }

    .badge.tingkat-10 {
      background-color: #4CAF50;
    }

    .badge.tingkat-11 {
      background-color: #FF9800;
    }

    .badge.tingkat-12 {
      background-color: #F44336;
    }

    /* ========== BACK BUTTON ========== */
    .back-btn {
      display: inline-block;
      background-color: #2c6b74;
      color: white;
      text-decoration: none;
      padding: 10px 20px;
      border-radius: 8px;
      font-weight: 600;
      transition: 0.3s;
      margin-bottom: 20px;
    }

    .back-btn:hover {
      background-color: #3b949c;
      transform: translateY(-2px);
    }

    /* ========== FOOTER ========== */
    footer {
      background-color: #225f65;
      color: white;
      text-align: center;
      padding: 25px;
      margin-top: 40px;
    }

    footer a {
      color: #a6d8d9;
      text-decoration: none;
      margin: 0 10px;
      transition: 0.3s;
    }

    footer a:hover {
      color: white;
    }

    /* ========== RESPONSIVE ========== */
    @media (max-width: 768px) {
      nav {
        padding: 14px 20px;
      }

      nav ul {
        gap: 15px;
      }

      .container {
        margin-top: 80px;
        padding: 15px;
      }

      .table-container {
        overflow-x: auto;
      }

      table {
        min-width: 800px;
      }

      thead th, tbody td {
        padding: 10px;
        font-size: 13px;
      }
    }
  </style>
</head>

<body>
  <!-- NAVBAR -->
  <nav>
    <div class="logo">
      <div class="circle"></div>
      <span>FOROP4T</span>
    </div>
    <ul>
      <li><a href="index.html">Beranda</a></li>
      <li><a href="index.html#kelas">Daftar Kelas</a></li>
      <li><a href="guru.php">Daftar Guru</a></li>
      <li><a href="index.html#jam">Jam Pelajaran</a></li>
    </ul>
  </nav>

  <div class="container">
    <a href="index.html" class="back-btn">← Kembali ke Beranda</a>

    <div class="header">
      <h1>Daftar Guru</h1>
      <p>Guru-guru yang berdedikasi membimbing siswa menuju kesuksesan</p>
    </div>

    <div class="info-box">
      <div class="info-item">
        <div class="number"><?php echo $stats['total_guru']; ?></div>
        <div class="label">Total Guru</div>
      </div>
      <div class="info-item">
        <div class="number"><?php echo $stats['guru_kelas_10']; ?></div>
        <div class="label">Guru Kelas 10</div>
      </div>
      <div class="info-item">
        <div class="number"><?php echo $stats['guru_kelas_11']; ?></div>
        <div class="label">Guru Kelas 11</div>
      </div>
      <div class="info-item">
        <div class="number"><?php echo $stats['guru_kelas_12']; ?></div>
        <div class="label">Guru Kelas 12</div>
      </div>
    </div>

    <div class="filter-section">
      <label for="tingkatFilter">Filter Berdasarkan Tingkat:</label>
      <form method="GET" action="" style="display: flex; gap: 10px; align-items: center;">
        <select name="tingkat" id="tingkatFilter">
          <option value="semua" <?php echo $tingkat_filter == 'semua' ? 'selected' : ''; ?>>Semua Tingkat</option>
          <option value="10" <?php echo $tingkat_filter == '10' ? 'selected' : ''; ?>>Kelas 10</option>
          <option value="11" <?php echo $tingkat_filter == '11' ? 'selected' : ''; ?>>Kelas 11</option>
          <option value="12" <?php echo $tingkat_filter == '12' ? 'selected' : ''; ?>>Kelas 12</option>
        </select>
        <button type="submit" class="btn-filter">Terapkan Filter</button>
      </form>
    </div>

    <!-- TABLE -->
    <div class="table-container">
      <?php if (count($guru_list) > 0): ?>
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>NIP</th>
            <th>Kode Guru</th>
            <th>Nama Guru</th>
            <th>Mata Pelajaran</th>
            <th>Kelas</th>
            <th>Tingkat</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $no = 1;
          foreach ($guru_list as $guru): 
          ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo htmlspecialchars($guru['NIP']); ?></td>
            <td><?php echo htmlspecialchars($guru['Kode_Guru']); ?></td>
            <td><strong><?php echo htmlspecialchars($guru['nama_guru']); ?></strong></td>
            <td><?php echo htmlspecialchars($guru['mata_pelajaran']); ?></td>
            <td><?php echo htmlspecialchars($guru['nama_kelas'] ?? '-'); ?></td>
            <td>
              <?php if ($guru['tingkat']): ?>
              <span class="badge tingkat-<?php echo $guru['tingkat']; ?>">
                Kelas <?php echo $guru['tingkat']; ?>
              </span>
              <?php else: ?>
              <span style="color: #999;">-</span>
              <?php endif; ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?php else: ?>
      <div class="no-data">
        <p>Tidak ada data guru untuk filter yang dipilih.</p>
      </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- FOOTER -->
  <footer>
    <p>Ikuti kami di Instagram:</p>
    <p>
      <a href="https://instagram.com/akun1" target="_blank">@akun1</a> |
      <a href="https://instagram.com/akun2" target="_blank">@akun2</a> |
      <a href="https://instagram.com/akun3" target="_blank">@akun3</a>
    </p>
  </footer>
</body>
</html>