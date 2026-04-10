<?php 
include "koneksi.php"; 

$tingkat_filter = isset($_GET['tingkat']) ? $_GET['tingkat'] : 'semua';

if ($tingkat_filter == 'semua') {
    $sql = "SELECT 
                g.Id_Guru,
                g.nama_guru,
                g.NIP,
                g.Kode_Guru,
                k.nama_kelas,
                k.tingkat
            FROM guru g
            LEFT JOIN kelas k ON g.Id_Kelas = k.Id_Kelas
            ORDER BY k.tingkat, k.nama_kelas, g.nama_guru";
    $stmt = $conn->prepare($sql);
} else {
    $sql = "SELECT 
                g.Id_Guru,
                g.nama_guru,
                g.NIP,
                g.Kode_Guru,
                k.nama_kelas,
                k.tingkat
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

// Statistik
$sql_stats = "SELECT 
                COUNT(DISTINCT g.Id_Guru) as total_guru,
                COUNT(DISTINCT CASE WHEN k.tingkat = '10' THEN g.Id_Guru END) as guru_kelas_10,
                COUNT(DISTINCT CASE WHEN k.tingkat = '11' THEN g.Id_Guru END) as guru_kelas_11,
                COUNT(DISTINCT CASE WHEN k.tingkat = '12' THEN g.Id_Guru END) as guru_kelas_12
              FROM guru g
              LEFT JOIN kelas k ON g.Id_Kelas = k.Id_Kelas";
$stats = $conn->query($sql_stats)->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Daftar Guru</title>

<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Poppins, sans-serif;
}

body {
  background: #f4f8f9;
}

/* NAVBAR */
nav {
  background: #225f65;
  color: white;
  display: flex;
  justify-content: space-between;
  padding: 15px 40px;
  position: fixed;
  width: 100%;
  top: 0;
}

nav ul {
  display: flex;
  gap: 20px;
  list-style: none;
}

nav a {
  color: white;
  text-decoration: none;
}

/* CONTAINER */
.container {
  max-width: 1100px;
  margin: 100px auto;
  padding: 20px;
}

/* HEADER */
h1 {
  text-align: center;
  margin-bottom: 20px;
  color: #2c6b74;
}

/* INFO BOX */
.info-box {
  display: flex;
  justify-content: space-around;
  background: linear-gradient(120deg, #2d7b84, #56a6a9);
  color: white;
  padding: 20px;
  border-radius: 10px;
  margin-bottom: 20px;
}

.info-box div {
  text-align: center;
}

/* FILTER */
.filter {
  background: white;
  padding: 15px;
  border-radius: 10px;
  margin-bottom: 20px;
}

.filter select, .filter button {
  padding: 8px 15px;
  border-radius: 5px;
}

/* TABLE */
.table-box {
  background: white;
  border-radius: 10px;
  overflow: hidden;
}

table {
  width: 100%;
  border-collapse: collapse;
}

thead {
  background: #2d7b84;
  color: white;
}

th, td {
  padding: 12px;
}

tr:hover {
  background: #f0f8f9;
}

/* BADGE */
.badge {
  padding: 5px 10px;
  border-radius: 20px;
  color: white;
  font-size: 12px;
}

.t10 { background: green; }
.t11 { background: orange; }
.t12 { background: red; }

</style>
</head>

<body>

<nav>
  <h3>FOROP4T</h3>
  <ul>
    <li><a href="index.html">Beranda</a></li>
    <li><a href="#">Kelas</a></li>
    <li><a href="guru.php">Guru</a></li>
  </ul>
</nav>

<div class="container">

<h1>Daftar Guru</h1>

<div class="info-box">
  <div>
    <h2><?php echo $stats['total_guru']; ?></h2>
    <p>Total Guru</p>
  </div>
  <div>
    <h2><?php echo $stats['guru_kelas_10']; ?></h2>
    <p>Kelas 10</p>
  </div>
  <div>
    <h2><?php echo $stats['guru_kelas_11']; ?></h2>
    <p>Kelas 11</p>
  </div>
  <div>
    <h2><?php echo $stats['guru_kelas_12']; ?></h2>
    <p>Kelas 12</p>
  </div>
</div>

<div class="filter">
<form method="GET">
  <select name="tingkat">
    <option value="semua">Semua</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
  </select>
  <button type="submit">Filter</button>
</form>
</div>

<div class="table-box">
<?php if(count($guru_list)>0): ?>
<table>
<thead>
<tr>
  <th>No</th>
  <th>NIP</th>
  <th>Kode Guru</th>
  <th>Nama</th>
  <th>Kelas</th>
  <th>Tingkat</th>
</tr>
</thead>

<tbody>
<?php $no=1; foreach($guru_list as $g): ?>
<tr>
  <td><?= $no++ ?></td>
  <td><?= htmlspecialchars($g['NIP']) ?></td>
  <td><?= htmlspecialchars($g['Kode_Guru']) ?></td>
  <td><b><?= htmlspecialchars($g['nama_guru']) ?></b></td>
  <td><?= htmlspecialchars($g['nama_kelas'] ?? '-') ?></td>
  <td>
    <?php if($g['tingkat']): ?>
      <span class="badge t<?= $g['tingkat'] ?>">
        <?= $g['tingkat'] ?>
      </span>
    <?php else: echo '-'; endif; ?>
  </td>
</tr>
<?php endforeach; ?>
</tbody>

</table>
<?php else: ?>
<p style="padding:20px;">Tidak ada data</p>
<?php endif; ?>
</div>

</div>

</body>
</html>