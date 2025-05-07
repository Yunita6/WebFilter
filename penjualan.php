<!DOCTYPE html>
<html>
<head>
    <title>Data Penjualan Kayu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f9;
            padding: 30px;
        }

        h2 {
            color: #333;
        }

        form {
            background: #fff;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        label {
            font-weight: bold;
            margin-right: 10px;
        }

        input[type="date"] {
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 15px;
        }

        button {
            padding: 7px 15px;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            margin-right: 10px;
        }

        button[type="submit"] {
            background-color: #3498db;
        }

        button[type="button"] {
            background-color: #e74c3c;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px;
            border: 1px solid #eee;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .pdf-form {
            margin-top: 15px;
        }
    </style>
</head>
<body>

<h2>Filter Data Penjualan Kayu</h2>

<form method="GET" action="">
    <label>Tanggal Awal:</label>
    <input type="date" name="tanggal_awal" required value="<?= isset($_GET['tanggal_awal']) ? $_GET['tanggal_awal'] : '' ?>">
    
    <label>Tanggal Akhir:</label>
    <input type="date" name="tanggal_akhir" required value="<?= isset($_GET['tanggal_akhir']) ? $_GET['tanggal_akhir'] : '' ?>">
    
    <button type="submit">Filter</button>
    <a href="index.php">
        <button type="button">Batal</button>
    </a>
</form>

<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "jati";

$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$tanggal_awal  = isset($_GET['tanggal_awal']) ? $_GET['tanggal_awal'] : '';
$tanggal_akhir = isset($_GET['tanggal_akhir']) ? $_GET['tanggal_akhir'] : '';

$sql = "SELECT * FROM penjualan";

if (!empty($tanggal_awal) && !empty($tanggal_akhir)) {
    $sql .= " WHERE tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
}

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>No</th>
                <th>Nama Pabrik</th>
                <th>Jenis Kayu</th>
                <th>Tanggal</th>
                <th>Jumlah (m³)</th>
                <th>Harga per m³</th>
                <th>Pembeli</th>
            </tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['no']}</td>
                <td>{$row['nama_pabrik']}</td>
                <td>{$row['jenis_kayu']}</td>
                <td>{$row['tanggal']}</td>
                <td>{$row['jumlah_m3']}</td>
                <td>Rp " . number_format($row['harga_per_m3'], 0, ',', '.') . "</td>
                <td>{$row['pembeli']}</td>
              </tr>";
    }
    
    echo "</table>";
} else {
    echo "<p>Tidak ada data penjualan pada rentang tanggal tersebut.</p>";
}
?>

<!-- Tombol Export PDF -->
<?php if (!empty($tanggal_awal) && !empty($tanggal_akhir)) : ?>
    <form action="export_pdf.php" method="GET" class="pdf-form" target="_blank">
        <input type="hidden" name="tanggal_awal" value="<?= $tanggal_awal ?>">
        <input type="hidden" name="tanggal_akhir" value="<?= $tanggal_akhir ?>">
        <button type="submit" style="background-color: #2ecc71;">Export PDF</button>
    </form>
<?php endif; ?>

</body>
</html>
