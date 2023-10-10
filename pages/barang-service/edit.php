<?php

require_once 'function/models/barang_service.php';
is_admin();

$id_barang_service = $_GET['id_barang_service'];

$item = getById($id_barang_service);

if (!$item)
    redirectUrl(BASE_URL . '/main.php?page=barang-service');

if (isset($_POST['update'])) {
    validasiEdit($_POST);
    $update = updateData($_POST);
    if ($update) {
        redirectUrl(BASE_URL . '/main.php?page=barang-service&status=success&message=Barang Service berhasil diupdate!');
    } else {
        redirectUrl(BASE_URL . '/main.php?page=barang-service&status=error&message=Barang Service gagal diupdate!');
    }
}

?>

<section class="section">
    <div class="section-header">
        <h1>Edit Barang Service</h1>
        <div class="section-header-breadcrumb">
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=dashboard' ?>">Dashboard</a>
                </div>
                <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=barang-service' ?>">Data
                        Barang Service</a></div>
                <div class="breadcrumb-item">Edit Barang Service</div>
            </div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <?php if (isset($error)) : ?>
                            <?= $error ?>
                        <?php endif; ?>
                        <form action="" method="post">
                            <input type="hidden" name="id_barang_service" value="<?= $item['id_barang_service'] ?>">
                            <div class="form-group">
                                <label for="kode_barang">Kode Barang</label>
                                <input type="text" class="form-control" name="kode_barang" value="<?= $item['kode_barang'] ?>" id="nama_barang_service" readonly>
                            </div>
                            <?php if ($item['kategori'] === 'Kendaraan') : ?>
                                <div class="form-group">
                                    <label for="nama_barang">Nama Barang</label>
                                    <input type="text" class="form-control" name="nama_barang" value="Kendaraan : No. Polisi <?= $item['no_polisi'] ?>" id="nama_barang" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="merek">Merek</label>
                                    <input type="text" class="form-control" name="merek" value="<?= $item['merek'] ?>" id="merek" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <input type="text" class="form-control" name="type" value="<?= $item['type'] ?>" id="type" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="no_rangka">No. Rangka</label>
                                    <input type="text" class="form-control" name="no_rangka" value="<?= $item['no_rangka'] ?>" id="no_rangka" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="no_mesin">No. Mesin</label>
                                    <input type="text" class="form-control" name="no_mesin" value="<?= $item['no_mesin'] ?>" id="no_mesin" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="no_bpkb">No. BPKB</label>
                                    <input type="text" class="form-control" name="no_bpkb" value="<?= $item['no_bpkb'] ?>" id="no_bpkb" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="tahun_pembuatan">Tahun Pembuatan</label>
                                    <input type="text" class="form-control" name="tahun_pembuatan" value="<?= $item['tahun_pembuatan'] ?>" id="tahun_pembuatan" readonly>
                                </div>
                            <?php endif; ?>
                            <?php if ($item['kategori'] === 'Perlengkapan') : ?>
                                <div class="form-group">
                                    <label for="nama_barang">Nama Barang</label>
                                    <input type="text" class="form-control" name="nama_barang" value="Perlengkapan : <?= $item['nama_perlengkapan'] ?>" id="nama_barang" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="satuan">Satuan</label>
                                    <input type="text" class="form-control" name="satuan" value="<?= $item['satuan'] ?>" id="satuan" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="penempatan">Penempatan</label>
                                    <input type="text" class="form-control" name="penempatan" value="<?= $item['penempatan'] ?>" id="penempatan" readonly>
                                </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label for="jumlah_barang">Jumlah Barang</label>
                                <input type="text" class="form-control" name="jumlah_barang" value="<?= $item['jumlah_barang'] ?>" id="jumlah_barang">
                            </div>
                            <div class="form-group">
                                <label for="biaya_service">Biaya Service</label>
                                <input type="text" class="form-control" name="biaya_service" value="<?= $item['biaya_service'] ?>" id="biaya_service">
                            </div>
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" value="<?= $item['tanggal'] ?>" id="tanggal">
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" cols="30" rows="5" style="min-height:80px" class="form-control"><?= $item['keterangan'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <button name="update" class="btn btn-block btn-primary"><i class="fas fa-save"></i>
                                    update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>