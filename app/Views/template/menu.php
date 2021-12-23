<nav class="bottom-navbar">
    <div class="container">
        <ul class="nav page-navigation">
            <?php if (session()->get('role') == 'Administrator'): ?>
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('home')?>">
                    <i class="mdi mdi-file-document-box menu-icon"></i>
                    <span class="menu-title">Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('admin/kecamatan')?>">
                    <i class="mdi mdi-chart-areaspline menu-icon"></i>
                    <span class="menu-title">Kecamatan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('admin/petugas')?>">
                    <i class="mdi mdi-human-male-female menu-icon"></i>
                    <span class="menu-title">Petugas</span>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="<?=base_url('penduduk')?>">
                    <i class="mdi mdi-file-document-box menu-icon"></i>
                    <span class="menu-title">Penduduk</span>
                </a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('admin/laporan')?>">
                    <i class="mdi mdi-file-document-box menu-icon"></i>
                    <span class="menu-title">Laporan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('admin/kuesioner')?>">
                    <i class="mdi mdi-file-document-box menu-icon"></i>
                    <span class="menu-title">Kuesioner</span>
                </a>
            </li>
            <?php endif;?>

            <?php if (session()->get('role') == 'Petugas'): ?>
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('home')?>">
                    <i class="mdi mdi-file-document-box menu-icon"></i>
                    <span class="menu-title">Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('petugas/penduduk')?>">
                    <i class="mdi mdi-file-document-box menu-icon"></i>
                    <span class="menu-title">Penduduk</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('petugas/laporan')?>">
                    <i class="mdi mdi-file-document-box menu-icon"></i>
                    <span class="menu-title">Laporan</span>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="<?=base_url('petugas/backup')?>">
                    <i class="mdi mdi-file-document-box menu-icon"></i>
                    <span class="menu-title">Backup</span>
                </a>
            </li> -->
            <?php endif;?>
        </ul>
    </div>
</nav>