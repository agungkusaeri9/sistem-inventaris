<aside id="sidebar-wrapper">
        <div class="sidebar-brand">
                <a href="<?= BASE_URL ?>/main.php?page=dashboard">Inventaris</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
                <a href="<?= BASE_URL ?>/main.php?page=dashboard">Inventaris</a>
        </div>
        <ul class="sidebar-menu">
                <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL . '/main.php?page=dashboard' ?>"><i class="fas fa-fire"></i>
                                <span>Dashboard</span>
                        </a>
                </li>
                <?php if ($_SESSION['level'] === 'admin') : ?>
                        <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL . '/main.php?page=perlengkapan' ?>"><i class="fas fa-folder"></i>
                                        <span>Perlengkapan</span>
                                </a>
                        </li>

                        <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL . '/main.php?page=kendaraan' ?>"><i class="fas fa-folder"></i>
                                        <span>Kendaraan</span>
                                </a>
                        </li>

                        <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL . '/main.php?page=barang-rusak' ?>"><i class="fas fa-folder"></i>
                                        <span>Barang Rusak</span>
                                </a>
                        </li>
                        <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL . '/main.php?page=barang-tidak-layak-pakai' ?>"><i class="fas fa-folder"></i>
                                        <span>Barang Tidak Layak Pakai</span>
                                </a>
                        </li>
                        <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL . '/main.php?page=barang-service' ?>"><i class="fas fa-folder"></i>
                                        <span>Barang Service</span>
                                </a>
                        </li>
                <?php endif; ?>
                <li class="dropdown">
                        <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i> <span>Laporan</span></a>
                        <ul class="dropdown-menu">
                                <li><a class="nav-link" href="<?= BASE_URL . '/main.php?page=laporan-kendaraan' ?>">Inventaris Kendaraan</a></li>
                                <li><a class="nav-link" href="<?= BASE_URL . '/main.php?page=laporan-perlengkapan' ?>">Inventaris Perlengkapan</a></li>
                                <li><a class="nav-link" href="<?= BASE_URL . '/main.php?page=laporan-barang-rusak' ?>">Barang Rusak</a></li>
                                <li><a class="nav-link" href="<?= BASE_URL . '/main.php?page=laporan-barang-tidak-layak-pakai' ?>">Barang Tidak Layak Pakai</a></li>
                                <li><a class="nav-link" href="<?= BASE_URL . '/main.php?page=laporan-barang-service' ?>">Barang Service</a></li>
                        </ul>
                </li>
                <?php if ($_SESSION['level'] === 'admin') : ?>
                        <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL . '/main.php?page=user' ?>"><i class="fas fa-users"></i>
                                        <span>User</span>
                                </a>
                        </li>
                <?php endif; ?>
        </ul>
</aside>