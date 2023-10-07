<?php

function get()
{
    global $koneksi;
    $items = $koneksi->query("SELECT knd.*, brg.kode_barang 
    FROM kendaraan AS knd 
    INNER JOIN barang AS brg 
    ON brg.id_kendaraan = knd.id_kendaraan
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
    $no_polisi = htmlspecialchars($post['no_polisi']);
    $merek = htmlspecialchars($post['merek']);
    $type = htmlspecialchars($post['type']);
    $tahun_pembuatan = htmlspecialchars($post['tahun_pembuatan']);
    $tanggal_register = htmlspecialchars($post['tanggal_register']);
    $no_rangka = htmlspecialchars($post['no_rangka']);
    $no_mesin = htmlspecialchars($post['no_mesin']);
    $no_bpkb = htmlspecialchars($post['no_bpkb']);
    $status = htmlspecialchars($post['status']);
    $harga_perolehan = htmlspecialchars($post['harga_perolehan']);
    $cara_perolehan = htmlspecialchars($post['cara_perolehan']);
    $penempatan = htmlspecialchars($post['penempatan']);
    $kondisi = htmlspecialchars($post['kondisi']);
    $insert = $koneksi->query("INSERT INTO `kendaraan` (`id_kendaraan`, `no_polisi`,`merek`, `type`, `tahun_pembuatan`, `tanggal_register`, `no_rangka`, `no_mesin`, `no_bpkb`, `cara_perolehan`, `harga_perolehan`, `penempatan`, `kondisi`, `status`) VALUES (NULL, '$no_polisi','$merek', '$type', '$tahun_pembuatan', '$tanggal_register', '$no_rangka', '$no_mesin', '$no_bpkb', '$cara_perolehan', '$harga_perolehan', '$penempatan', '$kondisi', '$status')");

    if ($insert) {
        $insertId = $koneksi->insert_id;
        // insert data barang
        $koneksi->query("INSERT INTO `barang` (`id_barang`, `kode_barang`, `kategori`, `id_kendaraan`, `id_perlengkapan`) VALUES (NULL, '$kode_barang', 'Kendaraan', '$insertId', NULL)");
    } else {
        $insertId = false;
    }

    return $insertId;
}

function getById($id_kendaraan)
{
    global $koneksi;
    $item = $koneksi->query("SELECT knd.*, brg.kode_barang 
    FROM kendaraan AS knd 
    INNER JOIN barang AS brg 
    ON brg.id_kendaraan = knd.id_kendaraan WHERE knd.id_kendaraan=$id_kendaraan")->fetch_assoc();
    return $item;
}

function updateData($post)
{
    global $koneksi;
    $no_polisi = htmlspecialchars($post['no_polisi']);
    $merek = htmlspecialchars($post['merek']);
    $type = htmlspecialchars($post['type']);
    $tahun_pembuatan = htmlspecialchars($post['tahun_pembuatan']);
    $tanggal_register = htmlspecialchars($post['tanggal_register']);
    $no_rangka = htmlspecialchars($post['no_rangka']);
    $no_mesin = htmlspecialchars($post['no_mesin']);
    $no_bpkb = htmlspecialchars($post['no_bpkb']);
    $status = htmlspecialchars($post['status']);
    $harga_perolehan = htmlspecialchars($post['harga_perolehan']);
    $cara_perolehan = htmlspecialchars($post['cara_perolehan']);
    $penempatan = htmlspecialchars($post['penempatan']);
    $kondisi = htmlspecialchars($post['kondisi']);
    $update = $koneksi->query("UPDATE `kendaraan` SET `no_polisi` = '$no_polisi', `merek` = '$merek', `type` = '$type', `tahun_pembuatan` = '$tahun_pembuatan', `tanggal_register` = '$tanggal_register', `no_rangka` = '$no_rangka', `no_mesin` = '$no_mesin', `no_bpkb` = '$no_bpkb', `cara_perolehan` = '$cara_perolehan', `harga_perolehan` = '$harga_perolehan', `penempatan` = '$penempatan', `kondisi` = '$kondisi', `status` = '$status' WHERE `kendaraan`.`id_kendaraan` = $post[id_kendaraan]  ");

    if ($update) {
        return true;
    } else {
        return false;
    }
}

function deleteData($id_kendaraan)
{
    global $koneksi;
    $item = $koneksi->query("DELETE FROM kendaraan WHERE id_kendaraan=$id_kendaraan");
}

function validasiTambah($post)
{
    global $koneksi;
    if (!$post['no_polisi'] || !$post['merek'] || !$post['type'] || !$post['tahun_pembuatan'] || !$post['tanggal_register'] || !$post['no_rangka'] || !$post['no_mesin'] || !$post['no_bpkb'] || !$post['harga_perolehan'] || !$post['kondisi'] || !$post['status'] || !$post['cara_perolehan'] || !$post['penempatan']) {
        redirectUrl(BASE_URL . '/main.php?page=kendaraan-create&status=error&message=Semua inputan tidak boleh kosong.');
        exit;
    }

    // cek kode barang
    $cek = $koneksi->query("SELECT * FROM barang WHERE kode_barang='$post[kode_barang]'")->fetch_assoc();

    if ($cek) {
        redirectUrl(BASE_URL . '/main.php?page=kendaraan-create&status=error&message=Kode Barang tersebut sudah ada di database.');
        exit;
    }
}

function validasiEdit($post)
{
    if (!$post['no_polisi'] || !$post['merek'] || !$post['type'] || !$post['tahun_pembuatan'] || !$post['tanggal_register'] || !$post['no_rangka'] || !$post['no_mesin'] || !$post['no_bpkb'] || !$post['harga_perolehan'] || !$post['kondisi'] || !$post['status'] || !$post['cara_perolehan'] || !$post['penempatan']) {
        redirectUrl(BASE_URL . '/main.php?page=kendaraan-edit&id_kendaraan=' . $post['id_kendaraan'] . '&status=error&message=Semua inputan tidak boleh kosong.');
        exit;
    }
}
