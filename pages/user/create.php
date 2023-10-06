<?php

require_once 'function/models/user.php';

if (isset($_POST['tambah'])) {
    validasiTambah($_POST);
    $tambah = tambahData($_POST);
    if ($tambah) {
        redirectUrl(BASE_URL . '/main.php?page=user&status=success&message=User berhasil ditambahkan!');
    } else {
        redirectUrl(BASE_URL . '/main.php?page=user&status=error&message=User gagal ditambahkan!');
    }
}

?>

<section class="section">
    <div class="section-header">
        <h1>Tambah User</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=dashboard' ?>">Dashboard</a>
            </div>
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=user' ?>">Data User</a></div>
            <div class="breadcrumb-item">Tambah User</div>
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
                        <form action="" method="post" id="form">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" name="nama" value="" id="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="username" class="form-control" name="username" value="" id="username"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="level">Level</label>
                                <select name="level" id="level" class="form-control" required>
                                    <option value="">Pilih Level</option>
                                    <option value="admin">Admin</option>
                                    <option value="camat">Camat</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" value="" id="password"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="konfirmasi_password">Konfirmasi Password</label>
                                <input type="password" class="form-control" name="konfirmasi_password" value=""
                                    id="konfirmasi_password" required>
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
</section>

<script>
    $(function () {

        let getBlokByKomplek = function (id_komplek) {
            let data;
            $.ajax({
                url: '<?= BASE_URL . ' / pages / blok / get - by - komplek.php ' ?>',
                async: false,
                type: 'GET',
                data: {
                    id_komplek
                },
                dataType: 'JSON',
                success: function (response) {
                    data = response;
                },
                error: function (err) {
                    console.log(err);
                }
            })

            return data;
        }

        $('#form #level').on('change', function () {
            let level = $(this).val();
            if (level === 'admin') {
                $('.d-warga').addClass('d-none');
            } else {
                $('.d-warga').removeClass('d-none');
            }
        })


        // get blok by komplek
        $('#form #id_komplek').on('change', function () {
            let id_komplek = $(this).val();

            let data_blok = getBlokByKomplek(id_komplek);
            $('#form #id_blok').empty();
            $('#form #id_blok').append(`<option value="">Pilih Blok</option>`)
            data_blok.forEach(blok => {
                $('#form #id_blok').append(`
                    <option value="${blok.id_blok}">${blok.nama_blok}</option>
                `)
            })
        })
    })
</script>