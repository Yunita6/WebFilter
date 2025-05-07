<?php
require 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('defaultFont', 'Arial');
$dompdf = new Dompdf($options);

// HTML-nya (ambil dari output halaman atau buat manual)
$html = '
<h2>Tabel 1 - Rekap Produksi dan Penjualan Kayu</h2>
<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>Jenis Kayu</th>
            <th>Jumlah Produksi (m³)</th>
            <th>Jumlah Penjualan (m³)</th>
            <th>Total Harga Penjualan (Rp)</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>acacia</td><td>2.570</td><td>1.260</td><td>Rp 281.700</td></tr>
        <tr><td>hevea</td><td>4.150</td><td>2.550</td><td>Rp 418.500</td></tr>
        <tr><td>sungkai</td><td>3.620</td><td>1.730</td><td>Rp 336.000</td></tr>
    </tbody>
    <tfoot>
        <tr><td>Total</td><td>10.340</td><td>5.540</td><td>Rp 1.036.200</td></tr>
    </tfoot>
</table>
';

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("laporan_tabel1.pdf", ["Attachment" => false]);
?>
