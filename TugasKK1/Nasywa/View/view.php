<?php
if (!isset($Informasi_data)) {
    die("Akses ditolak! File ini tidak boleh diakses langsung. Silakan akses melalui index_mvc.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nasywa</title>
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

        /* ========== DATA SECTION ========== */
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

    <nav>
        <div class="logo">
            <div class="circle"></div>
            <span>FOROP4T</span>
        </div>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="#">Daftar Kelas</a></li>
            <li><a href="#">Daftar Guru</a></li>
            <li><a href="#">Jam Pelajaran</a></li>
        </ul>
    </nav>

    <div class="data-section">
        <h2>Menampilkan Seluruh Data Siswa X PPLG 3</h2>
        <h3>SQL JOIN</h3>

        <table>
            <tr>
                <th>Nama Siswa</th>
                <th>NIS</th>
                <th>Kelas</th>
                <th>Tingkat</th>
            </tr>
            <?php if ($Informasi_data && $Informasi_data->num_rows > 0) { ?>
                <?php while($row = $Informasi_data->fetch_assoc()) { ?>
                    <tr>
                        <td><?= htmlspecialchars(string: $row['nama_siswa']); ?></td>
                        <td><?= htmlspecialchars(string: $row['NIS']); ?></td>
                        <td><?= htmlspecialchars(string: $row['nama_kelas']); ?></td>
                        <td><?= htmlspecialchars(string: $row['tingkat']); ?></td>
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