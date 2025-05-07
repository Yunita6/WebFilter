<!DOCTYPE html>
<html>
<head>
    <title>Data Produksi Kayu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background-color: #f5f7fa;
        }

        h2 {
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        label {
            margin-right: 10px;
            font-weight: bold;
        }

        input[type="date"] {
            padding: 6px 10px;
            margin-right: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            padding: 7px 15px;
            background-color: #3498db;
            border: none;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }

        button[type="button"] {
            background-color: #e74c3c;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        th, td {
            border: 1px solid #eee;
            padding: 12px;
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

<h2>Filter Data Produksi Kayu</h2>

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

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$tanggal_awal  = isset($_GET['tanggal_awal']) ? $_GET['tanggal_awal'] : '';
$tanggal_akhir = isset($_GET['tanggal_akhir']) ? $_GET['tanggal_akhir'] : '';

$sql = "SELECT * FROM produksi";

if (!empty($tanggal_awal) && !empty($tanggal_akhir)) {
    $sql .= " WHERE tanggal_produksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
}

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>No</th>
                <th>Nama Pabrik</th>
                <th>Jenis Kayu</th>
                <th>Tanggal Produksi</th>
                <th>Jumlah (m³)</th>
            </tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['no']}</td>
                <td>{$row['nama_pabrik']}</td>
                <td>{$row['jenis_kayu']}</td>
                <td>{$row['tanggal_produksi']}</td>
                <td>{$row['jumlah_m3']}</td>
              </tr>";
    }
    
    echo "</table>";
} else {
    echo "<p>Tidak ada data produksi pada rentang tanggal tersebut.</p>";
}
?>

<!-- Tombol Export PDF -->
<?php if (!empty($tanggal_awal) && !empty($tanggal_akhir)) : ?>
    <form action="produksi_pdf.php" method="GET" class="pdf-form" target="_blank">
        <input type="hidden" name="tanggal_awal" value="<?= $tanggal_awal ?>">
        <input type="hidden" name="tanggal_akhir" value="<?= $tanggal_akhir ?>">
        <button type="submit">Export PDF</button>
    </form>
<?php endif; ?>

</body>
</html>
