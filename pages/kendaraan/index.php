<?php

require_once 'function/models/kendaraan.php';

$items = get();

if (isset($_POST['delete'])) {
    $delete = deleteData($_POST['id_kendaraan']);
    redirectUrl(BASE_URL . '/main.php?page=kendaraan&status=success&message=kendaraan berhasil dihapus!');
}

?>
<section class="section">
    <div class="section-header">
        <h1>Data kendaraan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=dashboard' ?>">Dashboard</a>
            </div>
            <div class="breadcrumb-item">Data Kendaraan</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="<?= BASE_URL . '/main.php?page=kendaraan-create' ?>" class="btn btn-sm btn-primary mb-3 btnAdd"><i class="fas fa-plus"></i> Tambah Data</a>
                        <div class="table-responsive">
                            <table class="table nowrap table-striped table-hover" id="dTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode Barang</th>
                                        <th>No Polisi</th>
                                        <th>Merek</th>
                                        <th>Type</th>
                                        <th>Tahun Pembuatan</th>
                                        <th>Tanggal Register</th>
                                        <th>No. Rangka</th>
                                        <th>No. Mesin</th>
                                        <th>No. Bpkb</th>
                                        <th>Harga Perolehan</th>
                                        <th>Kondisi</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($items as $item) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $item['kode_barang'] ?></td>
                                            <td><?= $item['no_polisi'] ?></td>
                                            <td><?= $item['merek'] ?></td>
                                            <td><?= $item['type'] ?></td>
                                            <td><?= $item['tahun_pembuatan'] ?></td>
                                            <td><?= formatTanggal($item['tanggal_register']) ?></td>
                                            <td><?= $item['no_rangka'] ?></td>
                                            <td><?= $item['no_mesin'] ?></td>
                                            <td><?= $item['no_bpkb'] ?></td>
                                            <td><?= formatRupiah($item['harga_perolehan']) ?></td>
                                            <td><?= $item['kondisi'] ?></td>
                                            <td><?= $item['status'] ?></td>
                                            <td>
                                                <a href="<?= BASE_URL . '/main.php?page=kendaraan-edit&id_kendaraan=' . $item['id_kendaraan'] ?>" class="btn btn-info"><i class="fas fa-edit"></i> Edit</a>
                                                <form action="" method="post" class="d-inline">
                                                    <input type="text" name="id_kendaraan" value="<?= $item['id_kendaraan'] ?>" hidden>
                                                    <button name="delete" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                                                </form>

                                            </td>
                                        </tr>

                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>