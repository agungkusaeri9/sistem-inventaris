<?php
require_once '../../config/koneksi.php';
require_once '../../function/helper.php';
require_once '../../config/config.php';
require_once '../../function/models/perlengkapan.php';
require_once '../../dompdf/autoload.inc.php'; // Memasukkan DomPDF

$filter = [
    'dari_tanggal' => isset($_POST['dari_tanggal']) ? $_POST['dari_tanggal'] : NULL,
    'sampai_tanggal' => isset($_POST['sampai_tanggal']) ? $_POST['sampai_tanggal'] : NULL
];


$items = getDataFilter($filter);


use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$dompdf = new Dompdf($options);

$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Inventaris Perlengkapan</title>
    <style>
        body {
            font-size: 12px;
        }

        table {
            width: 100%;
        }

        .styled-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .styled-table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        .styled-table tbody tr.active-row,
        tr.active-row {
            font-weight: bold;
            color: #009879;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center">Laporan Inventaris Perlengkapan</h2>
    <table class="tb-info">';

// Tambahkan informasi tanggal filter jika tersedia
if ($filter['dari_tanggal']) {
    $html .= '
        <tr>
            <td style="text-align:left">Dari Tanggal</td>
            <td> : </td>
            <td>' . $filter['dari_tanggal'] . '</td>
        </tr>';
}
if ($filter['sampai_tanggal']) {
    $html .= '
        <tr>
            <td style="text-align:left">Sampai Tanggal</td>
            <td> : </td>
            <td>' . $filter['sampai_tanggal'] . '</td>
        </tr>';
}

$html .= '
    </table>
    <table class="styled-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Kode Barang</th>
                <th>Nama perlengkapan</th>
                <th>Tanggal Register</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Harga Perolehan</th>
                <th>Penempatan</th>
            </tr>
        </thead>
        <tbody>';

// Tambahkan data dari database ke dalam tabel
$i = 1;
foreach ($items as $item) {
    $html .= '
    <tr>
    <td>' . $i++ . '</td>
    <td>' . $item['kode_barang'] . '</td>
    <td>' . $item['nama_perlengkapan'] . '</td>
    <td>' . formatTanggal($item['tanggal_register']) . '</td>
    <td>' . $item['jumlah'] . '</td>
    <td>' . $item['status'] . '</td>
    <td>' . formatRupiah($item['harga_perolehan']) . '</td>
    <td>' . $item['penempatan'] . '</td>
</tr>   
    ';
}

$html .= '
        </tbody>
    </table>
</body>
</html>';

// Muat konten HTML ke DomPDF
$dompdf->loadHtml($html);

// Atur ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'landscape');

// Render PDF (menghasilkan output dalam bentuk file PDF)
$dompdf->render();

// Keluarkan dokumen PDF ke browser atau simpan ke file
$dompdf->stream("laporan-inventaris-perlengkapan.pdf", ["Attachment" => true]);
