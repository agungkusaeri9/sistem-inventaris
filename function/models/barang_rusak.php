<?php

function get()
{
    global $koneksi;
    $items = $koneksi->query("SELECT brg.kode_barang,brg.kategori, knd.no_polisi, prl.nama_perlengkapan, br.*
    FROM barang_rusak AS br
    INNER JOIN barang AS brg ON br.id_barang = brg.id_barang
    LEFT JOIN kendaraan AS knd ON brg.id_kendaraan = knd.id_kendaraan
    LEFT JOIN perlengkapan AS prl ON brg.id_perlengkapan = prl.id_perlengkapan
    WHERE knd.no_polisi IS NOT NULL OR prl.nama_perlengkapan IS NOT NULL");
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
    $jumlah = htmlspecialchars($post['jumlah']);
    $tanggal = htmlspecialchars($post['tanggal']);
    $jenis_kerusakan = htmlspecialchars($post['jenis_kerusakan']);

    if ($id_kendaraan)
        $id_barang = $id_kendaraan;
    else
        $id_barang = $id_perlengkapan;


    $insert = $koneksi->query("INSERT INTO `barang_rusak` (`id_barang_rusak`, `id_barang`, `tanggal`, `jumlah_barang`, `jenis_kerusakan`) VALUES (NULL, '$id_barang', '$tanggal', '$jumlah', '$jenis_kerusakan')");

    if ($insert) {
        $insertId = $koneksi->insert_id;
    } else {
        $insertId = false;
    }

    return $insertId;
}

function getById($id_barang_rusak)
{
    global $koneksi;
    $item = $koneksi->query("SELECT brg.kode_barang, brg.kategori, knd.*, prl.*, br.*
    FROM barang_rusak AS br
    INNER JOIN barang AS brg ON br.id_barang = brg.id_barang
    LEFT JOIN kendaraan AS knd ON brg.id_kendaraan = knd.id_kendaraan
    LEFT JOIN perlengkapan AS prl ON brg.id_perlengkapan = prl.id_perlengkapan
    WHERE (knd.no_polisi IS NOT NULL OR prl.nama_perlengkapan IS NOT NULL) AND br.id_barang_rusak = $id_barang_rusak;
    ")->fetch_assoc();
    // $item = $koneksi->query("SELECT * FROM barang_rusak WHERE id_barang_rusak=$id_barang_rusak")->fetch_assoc();
    return $item;
}

function updateData($post)
{
    global $koneksi;
    $id_barang_rusak = htmlspecialchars($post['id_barang_rusak']);
    $jumlah_barang = htmlspecialchars($post['jumlah_barang']);
    $jenis_kerusakan = htmlspecialchars($post['jenis_kerusakan']);
    $tanggal = htmlspecialchars($post['tanggal']);

    $update = $koneksi->query("UPDATE `barang_rusak` SET `tanggal` = '$tanggal', `jumlah_barang` = '$jumlah_barang', `jenis_kerusakan` = '$jenis_kerusakan' WHERE `barang_rusak`.`id_barang_rusak` = $id_barang_rusak");

    if ($update) {
        return true;
    } else {
        return false;
    }
}

function deleteData($id_barang_rusak)
{
    global $koneksi;
    $item = $koneksi->query("DELETE FROM barang_rusak WHERE id_barang_rusak=$id_barang_rusak");
}

function validasiTambah($post)
{
    if (!$post['tanggal'] || !$post['jumlah'] || !$post['jenis_kerusakan']) {
        if (!$post['id_kendaraan'] && !$post['id_perlengkapan']) {
            redirectUrl(BASE_URL . '/main.php?page=perlengkapan-create&status=error&message=Kategori Barang tidak boleh kosong.');
            exit;
        }
        redirectUrl(BASE_URL . '/main.php?page=perlengkapan-create&status=error&message=Semua inputan tidak boleh kosong.');
        exit;
    }
}

function validasiEdit($post)
{
    if (!$post['jumlah_barang'] || !$post['tanggal'] || !$post['jenis_kerusakan']) {
        redirectUrl(BASE_URL . '/main.php?page=barang-rusak-edit&id_barang_rusak=' . $post['id_barang_rusak'] . '&status=error&message=Semua inputan tidak boleh kosong.');
        exit;
    }
}
