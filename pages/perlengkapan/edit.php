<?php

require_once 'function/models/perlengkapan.php';

$id_perlengkapan = $_GET['id_perlengkapan'];

$item = getById($id_perlengkapan);

if (!$item)
    redirectUrl(BASE_URL . '/main.php?page=perlengkapan');

if (isset($_POST['update'])) {
    validasiEdit($_POST);
    $update = updateData($_POST);
    if ($update) {
        redirectUrl(BASE_URL . '/main.php?page=perlengkapan&status=success&message=perlengkapan berhasil diupdate!');
    } else {
        redirectUrl(BASE_URL . '/main.php?page=perlengkapan&status=error&message=Perlengkapan gagal diupdate!');
    }
}

?>

<section class="section">
    <div class="section-header">
        <h1>Edit perlengkapan</h1>
        <div class="section-header-breadcrumb">
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=dashboard' ?>">Dashboard</a>
                </div>
                <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=perlengkapan' ?>">Data
                        perlengkapan</a></div>
                <div class="breadcrumb-item">Edit perlengkapan</div>
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
                            <input type="hidden" name="id_perlengkapan" value="<?= $item['id_perlengkapan'] ?>">
                            <div class="form-group">
                                <label for="kode_barang">Kode Barang</label>
                                <input type="text" class="form-control" name="kode_barang" value="<?= $item['kode_barang'] ?>" id="nama_perlengkapan" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama_perlengkapan">Nama Perlengkapan</label>
                                <input type="text" class="form-control" name="nama_perlengkapan" value="<?= $item['nama_perlengkapan'] ?>" id="nama_perlengkapan">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_register">Tanggal Register</label>
                                <input type="date" class="form-control" name="tanggal_register" value="<?= $item['tanggal_register'] ?>" id="tanggal_register">
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" class="form-control" name="jumlah" value="<?= $item['jumlah'] ?>" id="jumlah">
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="" selected disabled>Pilih Status</option>
                                    <option <?php if ($item['status'] === 'Barang Lama') : ?> selected <?php endif; ?> value="Barang Lama">Barang Lama</option>
                                    <option <?php if ($item['status'] === 'Penerimaan Barang') : ?> selected <?php endif; ?> value="Penerimaan Barang">Penerimaan Barang</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="satuan">Satuan</label>
                                <input type="text" class="form-control" name="satuan" value="<?= $item['satuan'] ?>" id="satuan">
                            </div>
                            <div class="form-group">
                                <label for="harga_perolehan">Harga Perolehan</label>
                                <input type="number" class="form-control" name="harga_perolehan" value="<?= $item['harga_perolehan'] ?>" id="harga_perolehan">
                            </div>
                            <div class="form-group">
                                <label for="cara_perolehan">Cara Perolehan</label>
                                <textarea name="cara_perolehan" id="cara_perolehan" cols="30" rows="5" class="form-control" style="height:80px"><?= $item['cara_perolehan'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="penempatan">Penempatan</label>
                                <input type="text" class="form-control" name="penempatan" value="<?= $item['penempatan'] ?>" id="penempatan">
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