<?php

require_once 'function/models/barang_service.php';


?>
<section class="section">
    <div class="section-header">
        <h1>Laporan Barang Service</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=dashboard' ?>">Dashboard</a>
            </div>
            <div class="breadcrumb-item">Laporan Barang Service</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="<?= BASE_URL . '/pages/barang-service/cetak-pdf.php' ?>" method="post">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="dari_tanggal">Dari</label>
                                    <input type="date" name="dari_tanggal" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="sampai_tanggal">Sampai</label>
                                    <input type="date" name="sampai_tanggal" class="form-control">
                                </div>
                                <div class="col-md-4 align-self-end mb-1">
                                    <button name="cetak" class="btn btn-danger">Cetak PDF</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>