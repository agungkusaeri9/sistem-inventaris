<?php

require_once 'function/models/perlengkapan.php';
is_admin();

if (isset($_POST['tambah'])) {
    validasiTambah($_POST);
    $tambah = tambahData($_POST);
    if ($tambah) {
        redirectUrl(BASE_URL . '/main.php?page=perlengkapan&status=success&message=Perlengkapan berhasil ditambah!');
    } else {
        redirectUrl(BASE_URL . '/main.php?page=perlengkapan&status=error&message=Perlengkapan gagal ditambah!');
    }
}

?>

<section class="section">
    <div class="section-header">
        <h1>Tambah perlengkapan</h1>
        <div class="section-header-breadcrumb">
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=dashboard' ?>">Dashboard</a>
                </div>
                <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=perlengkapan' ?>">Data
                        perlengkapan</a></div>
                <div class="breadcrumb-item">Tambah perlengkapan</div>
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
                            <div class="form-group">
                                <label for="kode_barang">Kode Barang</label>
                                <input type="text" class="form-control" name="kode_barang" value="" id="kode_barang">
                            </div>
                            <div class="form-group">
                                <label for="nama_perlengkapan">Nama Perlengkapan</label>
                                <input type="text" class="form-control" name="nama_perlengkapan" value="" id="nama_perlengkapan">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_register">Tanggal Register</label>
                                <input type="date" class="form-control" name="tanggal_register" value="" id="tanggal_register">
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" class="form-control" name="jumlah" value="" id="jumlah">
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="" selected disabled>Pilih Status</option>
                                    <option value="Barang Lama">Barang Lama</option>
                                    <option value="Penerimaan Barang">Penerimaan Barang</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="satuan">Satuan</label>
                                <input type="text" class="form-control" name="satuan" value="" id="satuan">
                            </div>
                            <div class="form-group">
                                <label for="harga_perolehan">Harga Perolehan</label>
                                <input type="number" class="form-control" name="harga_perolehan" value="" id="harga_perolehan">
                            </div>
                            <div class="form-group">
                                <label for="cara_perolehan">Cara Perolehan</label>
                                <textarea name="cara_perolehan" id="cara_perolehan" cols="30" rows="5" class="form-control" style="height:80px"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="penempatan">Penempatan</label>
                                <input type="text" class="form-control" name="penempatan" value="" id="penempatan">
                            </div>
                            <div class="form-group">
                                <button name="tambah" class="btn btn-block btn-primary"><i class="fas fa-plus"></i>
                                    Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>