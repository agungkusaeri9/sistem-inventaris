<?php

function get()
{
    global $koneksi;
    $items = $koneksi->query("SELECT brg.kode_barang,brg.kategori, knd.no_polisi, prl.nama_perlengkapan, bs.*
    FROM barang_service AS bs
    INNER JOIN barang AS brg ON bs.id_barang = brg.id_barang
    LEFT JOIN kendaraan AS knd ON brg.id_kendaraan = knd.id_kendaraan
    LEFT JOIN perlengkapan AS prl ON brg.id_perlengkapan = prl.id_perlengkapan
    WHERE (knd.no_polisi IS NOT NULL OR prl.nama_perlengkapan IS NOT NULL)");
    $data = [];
    while ($row = $items->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function tambahData($post)
{
    global $koneksi;
    $id_kendaraan = isset($post['id_kendaraan']) ? htmlspecialchars($post['id_kendaraan']) : null;
    $id_perlengkapan = isset($post['id_perlengkapan']) ? htmlspecialchars($post['id_perlengkapan']) : null;
    $jumlah_barang = htmlspecialchars($post['jumlah_barang']);
    $tanggal = htmlspecialchars($post['tanggal']);
    $biaya_service = htmlspecialchars($post['biaya_service']);
    $keterangan = htmlspecialchars($post['keterangan']);
    if ($id_kendaraan)
        $id_barang = $id_kendaraan;
    else
        $id_barang = $id_perlengkapan;


    $insert = $koneksi->query("INSERT INTO `barang_service` (`id_barang_service`, `id_barang`, `tanggal`, `jumlah_barang`, `biaya_service`, `keterangan`) VALUES (NULL, $id_barang, '$tanggal', '$jumlah_barang', '$biaya_service', '$keterangan');");

    if ($insert) {
        $insertId = $koneksi->insert_id;
    } else {
        $insertId = false;
    }

    return $insertId;
}

function getById($id_barang_service)
{
    global $koneksi;
    $item = $koneksi->query("SELECT brg.kode_barang, brg.kategori, knd.*, prl.*, bs.*
    FROM barang_service AS bs
    INNER JOIN barang AS brg ON bs.id_barang = brg.id_barang
    LEFT JOIN kendaraan AS knd ON brg.id_kendaraan = knd.id_kendaraan
    LEFT JOIN perlengkapan AS prl ON brg.id_perlengkapan = prl.id_perlengkapan
    WHERE (knd.no_polisi IS NOT NULL OR prl.nama_perlengkapan IS NOT NULL) AND bs.id_barang_service = $id_barang_service;
    ")->fetch_assoc();
    // $item = $koneksi->query("SELECT * FROM barang_rusak WHERE id_barang_service=$id_barang_service")->fetch_assoc();
    return $item;
}

function updateData($post)
{
    global $koneksi;
    $id_barang_service = htmlspecialchars($post['id_barang_service']);
    $jumlah_barang = htmlspecialchars($post['jumlah_barang']);
    $biaya_service = htmlspecialchars($post['biaya_service']);
    $tanggal = htmlspecialchars($post['tanggal']);
    $keterangan = htmlspecialchars($post['keterangan']);

    $update = $koneksi->query("UPDATE `barang_service` SET `tanggal` = '$tanggal', `jumlah_barang` = '$jumlah_barang', `biaya_service` = '$biaya_service',  `keterangan` = '$keterangan' WHERE `barang_service`.`id_barang_service` = $id_barang_service");

    if ($update) {
        return true;
    } else {
        return false;
    }
}

function deleteData($id_barang_service)
{
    global $koneksi;
    $item = $koneksi->query("DELETE FROM barang_service WHERE id_barang_service=$id_barang_service");
}

function validasiTambah($post)
{
    if (!$post['tanggal'] || !$post['jumlah_barang'] || !$post['biaya_service'] || !$post['keterangan']) {
        if (!$post['id_kendaraan'] && !$post['id_perlengkapan']) {
            redirectUrl(BASE_URL . '/main.php?page=barang-service-create&status=error&message=Kategori Barang tidak boleh kosong.');
            exit;
        }
        redirectUrl(BASE_URL . '/main.php?page=barang-service-create&status=error&message=Semua inputan tidak boleh kosong.');
        exit;
    }
}

function validasiEdit($post)
{
    if (!$post['tanggal'] || !$post['jumlah_barang'] || !$post['biaya_service'] || !$post['keterangan']) {
        redirectUrl(BASE_URL . '/main.php?page=barang-service-edit&id_barang_service=' . $post['id_barang_service'] . '&status=error&message=Semua inputan tidak boleh kosong.');
        exit;
    }
}

function getDataFilter($filter)
{
    global $koneksi;

    $dari_tanggal = $filter['dari_tanggal'];
    $sampai_tanggal = $filter['sampai_tanggal'];

    $query = "SELECT brg.kode_barang, brg.kategori, knd.no_polisi, prl.nama_perlengkapan, bs.*
    FROM barang_service AS bs
    INNER JOIN barang AS brg ON bs.id_barang = brg.id_barang
    LEFT JOIN kendaraan AS knd ON brg.id_kendaraan = knd.id_kendaraan
    LEFT JOIN perlengkapan AS prl ON brg.id_perlengkapan = prl.id_perlengkapan
    WHERE (knd.no_polisi IS NOT NULL OR prl.nama_perlengkapan IS NOT NULL)";

    // Filter tanggal jika 'dari_tanggal' dan 'sampai_tanggal' ada
    if (!empty($dari_tanggal) && !empty($sampai_tanggal)) {
        $query .= " AND tanggal BETWEEN '$dari_tanggal' AND '$sampai_tanggal'";
    } elseif (!empty($dari_tanggal)) {
        $query .= " AND tanggal = '$dari_tanggal'";
    }

    $items = $koneksi->query($query);
    $data = [];
    while ($row = $items->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}
