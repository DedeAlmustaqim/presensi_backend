<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href=".<?php echo base_url() ?>/public/">
    <meta charset="utf-8">
   
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Presensi manager by Digital Native Developer">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="<?php echo base_url() ?>/public/images/favicon.png">
    <!-- Page Title  -->
    <title><?php echo $judul ?></title>
    <!-- StyleSheets  -->

    <link rel="stylesheet" href="<?php echo base_url() ?>/public/assets/css/dashlite.css?ver=3.1.3">
    <link id="skin-default" rel="stylesheet" href="<?php echo base_url() ?>/public/assets/css/theme.css?ver=3.1.3">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/public/assets/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/public/assets/datatables.net-bs4/css/responsive.dataTables.min.css">


</head>

<body class="nk-body npc-invest bg-lighter ">
    <div class="nk-app-root">
        <!-- wrap @s -->
        <div class="nk-wrap ">
            <!-- main header @s -->
            <?= $this->include('partial/admin/header') ?>
            <!-- main header @e -->
            <!-- content @s -->
            <div class="nk-content nk-content-fluid">
                <div class="container-xl wide-xl">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <div class="nk-block-head nk-block-head-sm">
                                <?= $this->include('partial/admin/breadcumb') ?>
                            </div><!-- .nk-block-head -->
                            <div class="nk-block">
                                <div class="row g-gs">
                                    <?php $this->renderSection('content_admin') ?>
                                </div><!-- .row -->
                            </div><!-- .nk-block -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- content @e -->
            <!-- footer @s -->
            <div class="nk-footer nk-footer-fluid bg-lighter">
                <div class="container-xl">
                    <div class="nk-footer-wrap">
                        <div class="nk-footer-copyright"> &copy; 2023 Presensi by Digital Native Developer
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- footer @e -->
        </div>
        <!-- wrap @e -->
    </div>
    <!-- app-root @e -->
 


    <script src="<?php echo base_url() ?>/public/assets/js/bundle.js?ver=3.1.3"></script>
    <script src="<?php echo base_url() ?>/public/assets/js/scripts.js?ver=3.1.3"></script>
    <script src="<?php echo base_url() ?>/public/assets/js/libs/datatable-btns.js?ver=3.1.3"></script>

    <script src="<?php echo base_url() ?>/public/assets/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>/public/assets/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url() ?>/public/assets/js/appsbyDigitalNative.js"></script>
    <script src="<?php echo base_url() ?>/public/assets/js/admin/jsAdminbyDigitalNative.js?=<?php echo date('Y-m-d H:i:s')?>"></script>

    <script>
        var BASE_URL = "<?php echo base_url() ?>/"
        var akses = "<?php echo session('akses') ?>"
    </script>
</body>


</html>