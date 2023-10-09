<?php
require_once '../../config/koneksi.php';
require_once '../../function/helper.php';
require_once '../../config/config.php';
require_once '../../function/models/barang_service.php';
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
    <title>Laporan Barang Service</title>
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
    <h2 style="text-align: center">Laporan Barang Service</h2>
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
                <th>Nama Barang</th>
                <th>Tanggal</th>
                <th>Jumlah Barang</th>
                <th>Biaya Service</th>
                <th>Keterangan</th>
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
            <td>';

    if ($item['kategori'] === 'Kendaraan') {
        $html .= 'Kendaraan : No. Polisi ' . $item['no_polisi'];
    } else {
        $html .= 'Perlengkapan : ' . $item['nama_perlengkapan'];
    }

    $html .= '
            </td>
            <td>' . formatTanggal($item['tanggal']) . '</td>
            <td>' . $item['jumlah_barang'] . '</td>
            <td>' . formatRupiah($item['biaya_service']) . '</td>
            <td>' . $item['keterangan'] . '</td>
        </tr>';
}

$html .= '
        </tbody>
    </table>
</body>
</html>';

// Muat konten HTML ke DomPDF
$dompdf->loadHtml($html);

// Atur ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'portrait');

// Render PDF (menghasilkan output dalam bentuk file PDF)
$dompdf->render();

// Keluarkan dokumen PDF ke browser atau simpan ke file
$dompdf->stream("laporan-barang-service.pdf", ["Attachment" => true]);
