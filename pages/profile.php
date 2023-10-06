<?php
require_once 'function/models/user.php';
require_once 'function/helper.php';

if (isset($_POST['update'])) {
    // cek kedua password apakah sama
    $password = $_POST['password'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    if ($password !== $konfirmasi_password) {
        redirectUrl(BASE_URL . '/main.php?page=profile&status=error&message=Password dan Konfirmasi Password tidak Sesuai.');
    } else {
        $update = updateProfile($_POST);
        if ($update) {
            redirectUrl(BASE_URL . '/main.php?page=profile&status=success&message=Profil berhasil diupdate.');
        } else {
            redirectUrl(BASE_URL . '/main.php?page=profile&status=error&message=Profil gagal diupdate.');
        }
    }
}
?>

<section class="section">
    <div class="section-header">
        <h1>Profile</h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <?php if (isset($error)) : ?>
                    <?= $error ?>
                    <?php endif; ?>

                    <form action="" method="post">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama" value="<?= $_SESSION['nama'] ?>"
                                id="nama">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" value="<?= $_SESSION['username'] ?>"
                                id="username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password <span class="small text-danger">(Abaikan jika tidak ingin
                                    merubah password)</span></label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <div class="form-group">
                            <label for="konfirmasi_password">Konfirmasi Password <span
                                    class="small text-danger">(Abaikan jika tidak ingin merubah password)</span></label>
                            <input type="password" class="form-control" name="konfirmasi_password"
                                id="konfirmasi_password">
                        </div>
                        <div class="form-group float-right">
                            <button name="update" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>