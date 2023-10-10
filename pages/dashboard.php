<?php

require_once 'function/models/dashboard.php';
require_once 'function/helper.php';


$kendaraan = kendaraan();
$perlengkapan = perlengkapan();
$barang_rusak = barang_rusak();
$barang_tidak_layak_pakai = barang_tidak_layak_pakai();
?>

<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Jumlah Kendaraan</h4>
                    </div>
                    <div class="card-body">
                        <?= $kendaraan['total'] ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Jumlah Perlengkapan</h4>
                    </div>
                    <div class="card-body">
                        <?= $perlengkapan['total'] ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Jumlah Barang Rusak</h4>
                    </div>
                    <div class="card-body">
                        <?= $barang_rusak['total'] ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Barang Tidak Layak Pakai</h4>
                    </div>
                    <div class="card-body">
                        <?= $barang_tidak_layak_pakai['total'] ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>