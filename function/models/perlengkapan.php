<?php

function get()
{
    global $koneksi;
    $items = $koneksi->query("SELECT prl.*, brg.kode_barang 
    FROM perlengkapan AS prl 
    INNER JOIN barang AS brg 
    ON brg.id_perlengkapan = prl.id_perlengkapan
    ");
    $data = [];
    while ($row = $items->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function getAllJson()
{
    global $koneksi;
    $items = $koneksi->query("SELECT prl.*, brg.kode_barang, brg.id_barang
    FROM perlengkapan AS prl 
    INNER JOIN barang AS brg 
    ON brg.id_perlengkapan = prl.id_perlengkapan
    ");
    $data = [];
    while ($row = $items->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function tambahData($post)
{
    global $koneksi;
    $kode_barang = htmlspecialchars($post['kode_barang']);
    $nama_perlengkapan = htmlspecialchars($post['nama_perlengkapan']);
    $tanggal_register = htmlspecialchars($post['tanggal_register']);
    $jumlah = htmlspecialchars($post['jumlah']);
    $status = htmlspecialchars($post['status']);
    $harga_perolehan = htmlspecialchars($post['harga_perolehan']);
    $cara_perolehan = htmlspecialchars($post['cara_perolehan']);
    $penempatan = htmlspecialchars($post['penempatan']);
    $satuan = htmlspecialchars($post['satuan']);
    $insert = $koneksi->query("INSERT INTO `perlengkapan` (`id_perlengkapan`, `nama_perlengkapan`, `tanggal_register`, `jumlah`, `status`,`satuan`, `harga_perolehan`, `cara_perolehan`, `penempatan`) VALUES (NULL, '$nama_perlengkapan', '$tanggal_register', $jumlah, '$status','$satuan', $harga_perolehan, '$cara_perolehan', '$penempatan');");

    if ($insert) {
        $insertId = $koneksi->insert_id;
        // insert data barang
        $koneksi->query("INSERT INTO `barang` (`id_barang`, `kode_barang`, `kategori`, `id_kendaraan`, `id_perlengkapan`) VALUES (NULL, '$kode_barang', 'Perlengkapan', NULL, '$insertId')");
    } else {
        $insertId = false;
    }

    return $insertId;
}

function getById($id_perlengkapan)
{
    global $koneksi;
    $item = $koneksi->query("SELECT prl.*, brg.kode_barang 
    FROM perlengkapan AS prl 
    INNER JOIN barang AS brg 
    ON brg.id_perlengkapan = prl.id_perlengkapan WHERE prl.id_perlengkapan=$id_perlengkapan")->fetch_assoc();
    return $item;
}

function updateData($post)
{
    global $koneksi;
    $kode_barang = htmlspecialchars($post['kode_barang']);
    $nama_perlengkapan = htmlspecialchars($post['nama_perlengkapan']);
    $tanggal_register = htmlspecialchars($post['tanggal_register']);
    $jumlah = htmlspecialchars($post['jumlah']);
    $status = htmlspecialchars($post['status']);
    $harga_perolehan = htmlspecialchars($post['harga_perolehan']);
    $cara_perolehan = htmlspecialchars($post['cara_perolehan']);
    $penempatan = htmlspecialchars($post['penempatan']);
    $satuan = htmlspecialchars($post['satuan']);

    $update = $koneksi->query("UPDATE `perlengkapan` SET `nama_perlengkapan` = '$nama_perlengkapan', `tanggal_register` = '$tanggal_register', `jumlah` = '$jumlah', `status` = '$status', `satuan` = '$satuan', `harga_perolehan` = '$harga_perolehan', `cara_perolehan` = '$cara_perolehan', `penempatan` = '$penempatan' WHERE `perlengkapan`.`id_perlengkapan` = $post[id_perlengkapan]");

    if ($update) {
        return true;
    } else {
        return false;
    }
}

function deleteData($id_perlengkapan)
{
    global $koneksi;
    $item = $koneksi->query("DELETE FROM perlengkapan WHERE id_perlengkapan=$id_perlengkapan");
}

function validasiTambah($post)
{
    global $koneksi;
    if (!$post['nama_perlengkapan'] || !$post['tanggal_register'] || !$post['jumlah'] || !$post['status'] || !$post['satuan'] || !$post['harga_perolehan'] || !$post['cara_perolehan'] || !$post['penempatan']) {
        redirectUrl(BASE_URL . '/main.php?page=perlengkapan-create&status=error&message=Semua inputan tidak boleh kosong.');
        exit;
    }

    // cek kode barang
    $cek = $koneksi->query("SELECT * FROM barang WHERE kode_barang='$post[kode_barang]'")->fetch_assoc();

    if ($cek) {
        redirectUrl(BASE_URL . '/main.php?page=perlengkapan-create&status=error&message=Kode Barang tersebut sudah ada di database.');
        exit;
    }
}

function validasiEdit($post)
{
    if (!$post['nama_perlengkapan'] || !$post['tanggal_register'] || !$post['jumlah'] || !$post['status'] || !$post['satuan'] || !$post['harga_perolehan'] || !$post['cara_perolehan'] || !$post['penempatan']) {
        redirectUrl(BASE_URL . '/main.php?page=perlengkapan-edit&id_perlengkapan=' . $post['id_perlengkapan'] . '&status=error&message=Semua inputan tidak boleh kosong.');
        exit;
    }
}

function getDataFilter($filter)
{
    global $koneksi;

    $dari_tanggal = $filter['dari_tanggal'];
    $sampai_tanggal = $filter['sampai_tanggal'];
    $query = "SELECT prl.*, brg.kode_barang 
    FROM perlengkapan AS prl 
    INNER JOIN barang AS brg 
    ON brg.id_perlengkapan = prl.id_perlengkapan";
    // Filter tanggal jika 'dari_tanggal' dan 'sampai_tanggal' ada
    if (!empty($dari_tanggal) && !empty($sampai_tanggal)) {
        $query .= " AND DATE(prl.tanggal_dibuat) BETWEEN '$dari_tanggal' AND '$sampai_tanggal'";
    } elseif (!empty($dari_tanggal)) {
        $query .= " AND DATE(prl.tanggal_dibuat) = '$dari_tanggal'";
    }

    $items = $koneksi->query($query);
    $data = [];
    while ($row = $items->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}
