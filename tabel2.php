<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tabel 2 - Penjualan Kayu per Bulan</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            padding: 40px;
            color: #2c3e50;
        }
        h2 {
            color: #34495e;
            margin-bottom: 20px;
            text-align: left; /* perubahan */
        }
        .buttons {
            margin-bottom: 20px;
            text-align: left; /* perubahan */
        }
        .buttons button {
            background-color: #2980b9;
            color: #fff;
            border: none;
            padding: 10px 18px;
            margin: 0 10px 0 0;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s ease;
        }
        .buttons button:hover {
            background-color: #1f6390;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 14px 16px;
            border-bottom: 1px solid #ecf0f1;
            text-align: left;
        }
        th {
            background-color: #2c3e50;
            color: #fff;
        }
        tr:hover {
            background-color: #f0f9ff;
        }
        .subtotal {
            background-color: #ecf0f1;
            font-weight: bold;
        }
        .total {
            background-color: #dff6ec;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h2>Tabel 2 - Penjualan Kayu per Bulan</h2>

<div class="buttons">
    <form action="tabel2_pdf.php" method="GET" target="_blank" style="display: inline;">
        <button type="submit">📄 Export PDF</button>
    </form>
    <a href="index.php" style="text-decoration: none;">
        <button type="button">🔙 Kembali</button>
    </a>
</div>

<table>
    <thead>
        <tr>
            <th>Bulan</th>
            <th>Jenis Kayu</th>
            <th>Jumlah Penjualan (m³)</th>
            <th>Total Harga Penjualan (Rp)</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $data = [
            'Maret' => [
                ['jenis' => 'acacia', 'jumlah' => 250, 'harga' => 51500],
                ['jenis' => 'hevea', 'jumlah' => 600, 'harga' => 94000],
                ['jenis' => 'sungkai', 'jumlah' => 550, 'harga' => 101500],
            ],
            'April' => [
                ['jenis' => 'acacia', 'jumlah' => 300, 'harga' => 66600],
                ['jenis' => 'hevea', 'jumlah' => 550, 'harga' => 86500],
                ['jenis' => 'sungkai', 'jumlah' => 350, 'harga' => 68250],
            ],
            'Mei' => [
                ['jenis' => 'acacia', 'jumlah' => 200, 'harga' => 46000],
                ['jenis' => 'hevea', 'jumlah' => 750, 'harga' => 125750],
                ['jenis' => 'sungkai', 'jumlah' => 580, 'harga' => 117500],
            ],
            'Juni' => [
                ['jenis' => 'acacia', 'jumlah' => 510, 'harga' => 117600],
                ['jenis' => 'hevea', 'jumlah' => 650, 'harga' => 112250],
                ['jenis' => 'sungkai', 'jumlah' => 250, 'harga' => 48750],
            ],
        ];

        $grand_total_m3 = 0;
        $grand_total_harga = 0;

        foreach ($data as $bulan => $kayu_list) {
            $subtotal_m3 = 0;
            $subtotal_harga = 0;

            foreach ($kayu_list as $index => $item) {
                echo "<tr>
                        <td>" . ($index === 0 ? ucwords($bulan) : '') . "</td>
                        <td>" . ucwords($item['jenis']) . "</td>
                        <td>" . number_format($item['jumlah']) . "</td>
                        <td>Rp " . number_format($item['harga'], 0, ',', '.') . "</td>
                    </tr>";
                $subtotal_m3 += $item['jumlah'];
                $subtotal_harga += $item['harga'];
            }

            echo "<tr class='subtotal'>
                    <td colspan='2'>Total " . ucwords($bulan) . "</td>
                    <td>" . number_format($subtotal_m3) . "</td>
                    <td>Rp " . number_format($subtotal_harga, 0, ',', '.') . "</td>
                  </tr>";

            $grand_total_m3 += $subtotal_m3;
            $grand_total_harga += $subtotal_harga;
        }

        echo "<tr class='total'>
                <td colspan='2'>Total Keseluruhan</td>
                <td>" . number_format($grand_total_m3) . "</td>
                <td>Rp " . number_format($grand_total_harga, 0, ',', '.') . "</td>
              </tr>";
        ?>
    </tbody>
</table>

</body>
</html>
