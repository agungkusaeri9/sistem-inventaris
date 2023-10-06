<?php

require_once 'function/models/dashboard.php';
require_once 'function/helper.php';


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
                        <h4>Jumlah Pembayaran</h4>
                    </div>
                    <div class="card-body">
                        0
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Jumlah Warga</h4>
                    </div>
                    <div class="card-body">
                        0
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Jumlah Jenis Iuran</h4>
                    </div>
                    <div class="card-body">
                        0
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Jumlah Periode Iuran</h4>
                    </div>
                    <div class="card-body">
                        0
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Pembayaran Terakhir</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="dTable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>Kode Pembayaran</th>
                                    <th>Nama Warga</th>
                                    <th>Jenis Iuran</th>
                                    <th>Nominal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>