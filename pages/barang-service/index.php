<?php

require_once 'function/models/barang_service.php';
is_admin();

$items = get();

if (isset($_POST['delete'])) {
    $delete = deleteData($_POST['id_barang_service']);
    redirectUrl(BASE_URL . '/main.php?page=barang-service&status=success&message=Barang Service berhasil dihapus!');
}

?>
<section class="section">
    <div class="section-header">
        <h1>Data Barang Service</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=dashboard' ?>">Dashboard</a>
            </div>
            <div class="breadcrumb-item">Data Barang Service</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="<?= BASE_URL . '/main.php?page=barang-service-create' ?>" class="btn btn-sm btn-primary mb-3 btnAdd"><i class="fas fa-plus"></i> Tambah Data</a>
                        <div class="table-responsive">
                            <table class="table table-striped nowrap table-hover" id="dTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah Barang</th>
                                        <th>Biaya Service</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($items as $item) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $item['kode_barang'] ?></td>
                                            <td>
                                                <?php

                                                if ($item['kategori'] === 'Kendaraan') {
                                                    echo 'Kendaraan : No. Polisi ' . $item['no_polisi'];
                                                } else {
                                                    echo 'Perlengkapan : ' . $item['nama_perlengkapan'];
                                                }

                                                ?>
                                            </td>
                                            <td><?= formatTanggal($item['tanggal']) ?></td>
                                            <td><?= $item['jumlah_barang'] ?></td>
                                            <td><?= formatRupiah($item['biaya_service']) ?></td>
                                            <td><?= $item['keterangan'] ?></td>
                                            <td>
                                                <a href="<?= BASE_URL . '/main.php?page=barang-service-edit&id_barang_service=' . $item['id_barang_service'] ?>" class="btn btn-info"><i class="fas fa-edit"></i> Edit</a>
                                                <form action="" method="post" class="d-inline">
                                                    <input type="text" name="id_barang_service" value="<?= $item['id_barang_service'] ?>" hidden>
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