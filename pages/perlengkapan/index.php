<?php

require_once 'function/models/perlengkapan.php';
is_admin();

$items = get();

if (isset($_POST['delete'])) {
    $delete = deleteData($_POST['id_perlengkapan']);
    redirectUrl(BASE_URL . '/main.php?page=perlengkapan&status=success&message=perlengkapan berhasil dihapus!');
}

?>
<section class="section">
    <div class="section-header">
        <h1>Data perlengkapan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=dashboard' ?>">Dashboard</a>
            </div>
            <div class="breadcrumb-item">Data perlengkapan</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="<?= BASE_URL . '/main.php?page=perlengkapan-create' ?>" class="btn btn-sm btn-primary mb-3 btnAdd"><i class="fas fa-plus"></i> Tambah Data</a>
                        <div class="table-responsive">
                            <table class="table table-striped nowrap table-hover" id="dTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode Barang</th>
                                        <th>Nama perlengkapan</th>
                                        <th>Tanggal Register</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                        <th>Harga Perolehan</th>
                                        <th>Penempatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($items as $item) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $item['kode_barang'] ?></td>
                                            <td><?= $item['nama_perlengkapan'] ?></td>
                                            <td><?= formatTanggal($item['tanggal_register']) ?></td>
                                            <td><?= $item['jumlah'] ?></td>
                                            <td><?= $item['status'] ?></td>
                                            <td><?= formatRupiah($item['harga_perolehan']) ?></td>
                                            <td><?= $item['penempatan'] ?></td>
                                            <td>
                                                <a href="<?= BASE_URL . '/main.php?page=perlengkapan-edit&id_perlengkapan=' . $item['id_perlengkapan'] ?>" class="btn btn-info"><i class="fas fa-edit"></i> Edit</a>
                                                <form action="" method="post" class="d-inline">
                                                    <input type="text" name="id_perlengkapan" value="<?= $item['id_perlengkapan'] ?>" hidden>
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