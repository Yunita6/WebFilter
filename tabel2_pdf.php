<?php
require 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$dompdf = new Dompdf($options);

// Data penjualan kayu per bulan
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

// Mulai membuat HTML
$html = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            color: #2c3e50;
            padding: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 5px;
        }
        .header {
            text-align: center;
            font-size: 14px;
            margin-bottom: 20px;
        }
        .tanggal {
            text-align: right;
            font-size: 12px;
            color: #7f8c8d;
            margin-bottom: 10px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 12px;
        }
        th, td {
            padding: 8px 10px;
            border: 1px solid #bdc3c7;
            text-align: left;
        }
        th {
            background-color: #2c3e50;
            color: white;
        }
        .subtotal {
            background-color: #ecf0f1;
            font-weight: bold;
        }
        .total {
            background-color: #d0e6f6;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h2>Laporan Penjualan Kayu per Bulan</h2>
<div class="header">PT. Perkayuan Lestari - Divisi Penjualan</div>
<div class="tanggal">Dicetak pada: ' . date('d M Y') . '</div>

<table>
    <thead>
        <tr>
            <th>Bulan</th>
            <th>Jenis Kayu</th>
            <th>Jumlah Penjualan (m³)</th>
            <th>Total Harga Penjualan (Rp)</th>
        </tr>
    </thead>
    <tbody>';

$grand_total_m3 = 0;
$grand_total_harga = 0;

foreach ($data as $bulan => $kayu_list) {
    $subtotal_m3 = 0;
    $subtotal_harga = 0;

    foreach ($kayu_list as $index => $item) {
        $html .= "<tr>
            <td>" . ($index === 0 ? ucwords($bulan) : '') . "</td>
            <td>" . ucwords($item['jenis']) . "</td>
            <td>" . number_format($item['jumlah']) . "</td>
            <td>Rp " . number_format($item['harga'], 0, ',', '.') . "</td>
        </tr>";
        $subtotal_m3 += $item['jumlah'];
        $subtotal_harga += $item['harga'];
    }

    $html .= "<tr class='subtotal'>
        <td colspan='2'>Total " . ucwords($bulan) . "</td>
        <td>" . number_format($subtotal_m3) . "</td>
        <td>Rp " . number_format($subtotal_harga, 0, ',', '.') . "</td>
    </tr>";

    $grand_total_m3 += $subtotal_m3;
    $grand_total_harga += $subtotal_harga;
}

$html .= "<tr class='total'>
    <td colspan='2'>Total Keseluruhan</td>
    <td>" . number_format($grand_total_m3) . "</td>
    <td>Rp " . number_format($grand_total_harga, 0, ',', '.') . "</td>
</tr>";

$html .= '
    </tbody>
</table>

</body>
</html>
';

// Generate PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream('Laporan_Penjualan_Kayu.pdf', ['Attachment' => 0]);
?>
