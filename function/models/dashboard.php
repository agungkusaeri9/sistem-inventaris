<?php


function perlengkapan()
{
    global  $koneksi;
    $item = $koneksi->query("SELECT COUNT(*) as total FROM perlengkapan")->fetch_assoc();
    return $item;
}

function kendaraan()
{
    global  $koneksi;
    $item = $koneksi->query("SELECT COUNT(*) as total FROM kendaraan")->fetch_assoc();
    return $item;
}

function barang_rusak()
{
    global  $koneksi;
    $item = $koneksi->query("SELECT COUNT(*) as total FROM barang_rusak WHERE status_rusak = 'Barang Rusak'")->fetch_assoc();
    return $item;
}


function barang_tidak_layak_pakai()
{
    global  $koneksi;
    $item = $koneksi->query("SELECT COUNT(*) as total FROM barang_rusak WHERE status_rusak = 'Barang Tidak Layak Pakai'")->fetch_assoc();
    return $item;
}
