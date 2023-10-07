<?php

require_once 'function/models/kendaraan.php';


if (isset($_POST['tambah'])) {
    validasiTambah($_POST);
    $tambah = tambahData($_POST);
    if ($tambah) {
        redirectUrl(BASE_URL . '/main.php?page=kendaraan&status=success&message=kendaraan berhasil ditambah!');
    } else {
        redirectUrl(BASE_URL . '/main.php?page=kendaraan&status=error&message=kendaraan gagal ditambah!');
    }
}

?>

<section class="section">
    <div class="section-header">
        <h1>Tambah Kendaraan</h1>
        <div class="section-header-breadcrumb">
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=dashboard' ?>">Dashboard</a>
                </div>
                <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=kendaraan' ?>">Data
                        kendaraan</a></div>
                <div class="breadcrumb-item">Tambah Kendaraan</div>
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
                                <label for="no_polisi">No. Polisi</label>
                                <input type="text" class="form-control" name="no_polisi" value="" id="no_polisi">
                            </div>
                            <div class="form-group">
                                <label for="merek">Merek</label>
                                <input type="text" class="form-control" name="merek" value="" id="merek">
                            </div>
                            <div class="form-group">
                                <label for="type">Type</label>
                                <input type="text" class="form-control" name="type" value="" id="type">
                            </div>
                            <div class="form-group">
                                <label for="tahun_pembuatan">Tahun Pembuatan</label>
                                <input type="number" class="form-control" name="tahun_pembuatan" value="" id="tahun_pembuatan">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_register">Tanggal Register</label>
                                <input type="date" class="form-control" name="tanggal_register" value="" id="tanggal_register">
                            </div>
                            <div class="form-group">
                                <label for="no_rangka">No. Rangka</label>
                                <input type="text" class="form-control" name="no_rangka" value="" id="no_rangka">
                            </div>
                            <div class="form-group">
                                <label for="no_mesin">No. Mesin</label>
                                <input type="text" class="form-control" name="no_mesin" value="" id="no_mesin">
                            </div>
                            <div class="form-group">
                                <label for="no_bpkb">No. BPKB</label>
                                <input type="text" class="form-control" name="no_bpkb" value="" id="no_bpkb">
                            </div>
                            <div class="form-group">
                                <label for="cara_perolehan">Cara Perolehan</label>
                                <textarea name="cara_perolehan" id="cara_perolehan" cols="30" rows="5" class="form-control" style="height:80px"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="harga_perolehan">Harga Perolehan</label>
                                <input type="number" class="form-control" name="harga_perolehan" value="" id="harga_perolehan">
                            </div>
                            <div class="form-group">
                                <label for="penempatan">Penempatan</label>
                                <input type="text" class="form-control" name="penempatan" value="" id="penempatan">
                            </div>
                            <div class="form-group">
                                <label for="kondisi">Kondisi</label>
                                <input type="text" class="form-control" name="kondisi" value="" id="kondisi">
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