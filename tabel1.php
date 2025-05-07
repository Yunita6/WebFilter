<!DOCTYPE html>
<html>
<head>
    <title>Tabel 1 - Laporan Produksi & Penjualan Kayu</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f4f8;
            padding: 40px;
            color: #333;
        }
        h2 {
            margin-bottom: 25px;
            color: #2c3e50;
        }
        table {
            width: 90%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }
        th, td {
            padding: 12px 16px;
            border-bottom: 1px solid #e0e0e0;
        }
        th {
            background-color: #3498db;
            color: white;
            text-align: left;
        }
        tr:hover {
            background-color: #f1f9ff;
        }
        tfoot td {
            font-weight: bold;
            background-color: #ecf0f1;
        }
        .buttons {
            margin-bottom: 20px;
        }
        .buttons button {
            background-color: #2ecc71;
            border: none;
            color: white;
            padding: 10px 18px;
            margin-right: 10px;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .buttons button:hover {
            background-color: #27ae60;
        }
        .buttons a button {
            background-color: #e74c3c;
        }
        .buttons a button:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

<h2>Tabel 1 - Rekap Produksi dan Penjualan Kayu</h2>

<?php
$data = [
    ['jenis_kayu' => 'acacia', 'produksi' => 2570, 'penjualan' => 1260, 'total_harga' => 281700],
    ['jenis_kayu' => 'hevea',  'produksi' => 4150, 'penjualan' => 2550, 'total_harga' => 418500],
    ['jenis_kayu' => 'sungkai','produksi' => 3620, 'penjualan' => 1730, 'total_harga' => 336000],
];

$total_produksi = 0;
$total_penjualan = 0;
$total_harga = 0;
?>

<div class="buttons">
    <form action="tabel1_pdf.php" method="GET" target="_blank" style="display: inline;">
        <button type="submit">Export PDF</button>
    </form>
    <a href="index.php" style="text-decoration: none;">
        <button type="button">Kembali</button>
    </a>
</div>

<table>
    <thead>
        <tr>
            <th>Jenis Kayu</th>
            <th>Jumlah Produksi (m³)</th>
            <th>Jumlah Penjualan (m³)</th>
            <th>Total Harga Penjualan (Rp)</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $row): 
            $total_produksi += $row['produksi'];
            $total_penjualan += $row['penjualan'];
            $total_harga += $row['total_harga'];
        ?>
        <tr>
            <td><?= htmlspecialchars($row['jenis_kayu']) ?></td>
            <td><?= number_format($row['produksi']) ?></td>
            <td><?= number_format($row['penjualan']) ?></td>
            <td>Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td>Total</td>
            <td><?= number_format($total_produksi) ?></td>
            <td><?= number_format($total_penjualan) ?></td>
            <td>Rp <?= number_format($total_harga, 0, ',', '.') ?></td>
        </tr>
    </tfoot>
</table>

</body>
</html>
