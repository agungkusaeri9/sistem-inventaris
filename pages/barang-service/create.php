<?php

require_once 'function/models/barang_service.php';


if (isset($_POST['tambah'])) {
    validasiTambah($_POST);
    $tambah = tambahData($_POST);
    if ($tambah) {
        redirectUrl(BASE_URL . '/main.php?page=barang-service&status=success&message=Barang Service berhasil ditambah!');
    } else {
        redirectUrl(BASE_URL . '/main.php?page=barang-service&status=error&message=Barang Service gagal ditambah!');
    }
}

?>

<section class="section">
    <div class="section-header">
        <h1>Tambah Barang Service</h1>
        <div class="section-header-breadcrumb">
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=dashboard' ?>">Dashboard</a>
                </div>
                <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=barang-service' ?>">Data
                        Barang Service</a></div>
                <div class="breadcrumb-item">Tambah Barang Service</div>
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
                            <input type="hidden" name="status_rusak" value="Barang Rusak">
                            <div class="form-group">
                                <label for="kategori">Kategori Barang</label>
                                <select name="kategori" id="kategori" class="form-control">
                                    <option value="" selected disabled>Pilih Kategori Barang</option>
                                    <option value="Kendaraan">Kendaraan</option>
                                    <option value="Perlengkapan">Perlengkapan</option>
                                </select>
                            </div>
                            <div class="form-group d-none fg-idkendaraan">
                                <label for="id_kendaraan">Pilih Barang/Kendaraan</label>
                                <select name="id_kendaraan" id="id_kendaraan" class="form-control">
                                    <option value="" selected disabled>Pilih Kendaraan</option>
                                </select>
                            </div>
                            <div class="form-group d-none fg-idperlengkapan">
                                <label for="id_perlengkapan">Pilih Barang/Perlengkapan</label>
                                <select name="id_perlengkapan" id="id_perlengkapan" class="form-control">
                                    <option value="" selected disabled>Pilih Perlengkapan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" value="" id="tanggal">
                            </div>
                            <div class="form-group">
                                <label for="jumlah_barang">Jumlah Barang</label>
                                <input type="number" class="form-control" name="jumlah_barang" value="" id="jumlah_barang">
                            </div>
                            <div class="form-group">
                                <label for="biaya_service">Biaya Service</label>
                                <input type="number" class="form-control" name="biaya_service" value="" id="biaya_service">
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" cols="30" rows="5" style="min-height:80px" class="form-control"></textarea>
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
<script>
    $(function() {
        $('#kategori').on('change', function() {
            let kategori = $(this).val();

            if (kategori === 'Kendaraan') {
                // jika jenis nya kendaraan
                $('.fg-idkendaraan').removeClass('d-none');
                $('.fg-idperlengkapan').addClass('d-none');

                // tampilkan data barang berdasarkan kategori kendaraan
                $.ajax({
                    url: '<?= BASE_URL . '/pages/kendaraan/getAllJson.php'  ?>',
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(data) {

                        var idKendaraan = $("#id_kendaraan");
                        idKendaraan.empty(); // Bersihkan elemen select

                        // Tambahkan opsi pertama
                        idKendaraan.append('<option value="">Pilih Kendaraan</option>');

                        // Looping melalui data dan tambahkan opsi ke select
                        $.each(data, function(index, item) {
                            idKendaraan.append(`<option value="${item.id_barang}"> No. Polisi : ${item.no_polisi} </option>`);
                        });
                    },
                    error: function(err) {
                        onsole.log(err);
                    }
                })
            } else if (kategori === 'Perlengkapan') {
                // jika jenis nya kendaraan
                $('.fg-idkendaraan').addClass('d-none');
                $('.fg-idperlengkapan').removeClass('d-none');

                // tampilkan data barang berdasarkan kategori kendaraan
                $.ajax({
                    url: '<?= BASE_URL . '/pages/perlengkapan/getAllJson.php'  ?>',
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(data) {
                        var selectPerlengkapan = $("#id_perlengkapan");
                        selectPerlengkapan.empty(); // Bersihkan elemen select

                        // Tambahkan opsi pertama
                        selectPerlengkapan.append('<option value="">Pilih Perlengkapan</option>');

                        // Looping melalui data dan tambahkan opsi ke select
                        $.each(data, function(index, item) {
                            selectPerlengkapan.append(`<option value="${item.id_barang}"> ${item.nama_perlengkapan} </option>`);
                        });
                    },
                    error: function(err) {
                        onsole.log(err);
                    }
                })
            }
        })
    })
</script>