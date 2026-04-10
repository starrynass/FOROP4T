<?php
if (!isset($Informasi2_data1)) {
    die("Akses ditolak! File ini tidak boleh diakses langsung. Silakan akses melalui index_mvc.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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
    
<div class="data-section">
    <h2>Menampilkan Rekap Absensi X PPLG 3 Berdasarkan <br> Tanggal dan Mata Pelajaran</h2><br>
    <h3>SQL JOIN</h3>

<table>
            <tr>
                <th>Tanggal</th>
                <th>Jumlah Hadir</th>
                <th>Daftar Tidak Hadir</th>
                <th>Mata Pelajaran</th>
                <th>Kode Mapel</th>
                <th>Total Siswa</th>
                <th>Persentase Hadir</th>
            </tr>
            <?php if ($Informasi2_data1 && $Informasi2_data1->num_rows > 0) { ?>
                <?php while($row = $Informasi2_data1->fetch_assoc()) { ?>
                    <tr>
                        <td><?= htmlspecialchars(string: $row['Tanggal']); ?></td>
                        <td><?= htmlspecialchars(string: $row['Jumlah_Hadir']); ?></td>
                        <td><?= htmlspecialchars(string: $row['Daftar_Tidak_Hadir']); ?></td>
                        <td><?= htmlspecialchars(string: $row['Nama_Mapel']); ?></td>
                        <td><?= htmlspecialchars(string: $row['Kode_Mapel']); ?></td>
                        <td><?= htmlspecialchars(string: $row['Total_Siswa']); ?></td>
                        <td><?= htmlspecialchars(string: $row['Persentase_Hadir']); ?></td>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="7" style="text-align: center;">Belum ada data</td>
                </tr>
            <?php } ?>
        </table>
</div>

</body>
</html>