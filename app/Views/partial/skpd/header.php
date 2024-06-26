<div class="nk-header nk-header-fluid is-light">
    <div class="container-xl wide-xl">
        <div class="nk-header-wrap">
            <div class="nk-menu-trigger me-sm-2 d-lg-none">
                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em class="icon ni ni-menu"></em></a>
            </div>
            <div class="nk-header-brand">
                <a href="<?php echo base_url() ?>/skpd/dashboard" class="logo-link">
                    <img class="logo-light logo-img" src="<?php echo base_url() ?>/public/images/logo.png" srcset="<?php echo base_url() ?>/public/images/logo2x.png 2x" alt="logo">
                    <img class="logo-dark logo-img" src="<?php echo base_url() ?>/public/images/logo.png" srcset="<?php echo base_url() ?>/public/images/logo-dark2x.png 2x" alt="logo-dark">
                </a>
            </div><!-- .nk-header-brand -->
            <div class="nk-header-menu" data-content="headerNav">
                <div class="nk-header-mobile">
                    <div class="nk-header-brand">
                        <a href="<?php echo base_url() ?>/skpd/dashboard" class="logo-link">
                            <img class="logo-light logo-img" src="<?php echo base_url() ?>/public/images/logo.png" srcset="<?php echo base_url() ?>/public/images/logo2x.png 2x" alt="logo">
                            <img class="logo-dark logo-img" src="<?php echo base_url() ?>/public/images/logo.png" srcset="<?php echo base_url() ?>/public/images/logo-dark2x.png 2x" alt="logo-dark">
                        </a>
                    </div>
                    <div class="nk-menu-trigger me-n2">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em class="icon ni ni-arrow-left"></em></a>
                    </div>
                </div>
                <ul class="nk-menu nk-menu-main ui-s2">
                    <li class="nk-menu-item has-sub">
                        <a href="<?php echo base_url() ?>/skpd/dashboard" class="nk-menu-link">
                            <span class="nk-menu-text">Dashboard</span>
                        </a>

                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="<?php echo base_url() ?>/skpd/absensi" class="nk-menu-link"><span class="nk-menu-text">Data Absensi Pegawai</span></a>

                    </li>

                    <!-- .nk-menu-item -->


                    <li class="nk-menu-item has-sub">
                        <a href="<?php echo base_url() ?>/skpd/rekap/pegawai" class="nk-menu-link"><span class="nk-menu-text">Rekapitulasi</span></a>

                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-text">Pengaturan</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="<?php echo base_url() ?>/skpd/unit" class="nk-menu-link"><span class="nk-menu-text">SKPD</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="<?php echo base_url() ?>/skpd/pegawai" class="nk-menu-link"><span class="nk-menu-text">Pegawai</span></a>
                            </li>


                        </ul><!-- .nk-menu-sub -->
                </ul><!-- .nk-menu -->
            </div><!-- .nk-header-menu -->
            <div class="nk-header-tools">
                <ul class="nk-quick-nav">

                    <li class="dropdown user-dropdown order-sm-first">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <div class="user-toggle">
                                <div class="user-avatar sm">
                                    <em class="icon ni ni-user-alt"></em>
                                </div>
                                <div class="user-info d-none d-xl-block">
                                    <div class="user-status"><?php echo session('hak_akses') ?></div>
                                    <div class="user-name dropdown-indicator"><?php echo session('ses_nm') ?></div>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1 is-light">
                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                <div class="user-card">
                                    <div class="user-avatar">
                                        <span>AB</span>
                                    </div>
                                    <div class="user-info">
                                        <span class="lead-text"><?php echo session('ses_nm') ?></span>

                                    </div>
                                    <div class="user-action">
                                        <a class="btn btn-icon me-n2" href="<?php echo base_url() ?>/auth/logout"><em class="icon ni ni-power"></em></a>
                                    </div>
                                </div>
                            </div>


                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li><a href="<?php echo base_url() ?>/auth/logout"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li><!-- .dropdown -->

                </ul><!-- .nk-quick-nav -->
            </div><!-- .nk-header-tools -->
        </div><!-- .nk-header-wrap -->
    </div><!-- .container-fliud -->
</div>