<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href=".<?php echo base_url() ?>/public/">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="<?php echo base_url() ?>/public/images/favicon.png">
    <!-- Page Title  -->
    <title><?php echo $judul ?></title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/assets/css/dashlite.css?ver=3.1.3">
    <link id="skin-default" rel="stylesheet" href="<?php echo base_url() ?>/public/assets/css/theme.css?ver=3.1.3">
</head>

<body class="nk-body npc-invest bg-lighter ">
    <div class="nk-app-root">
        <!-- wrap @s -->
        <div class="nk-wrap ">
            <!-- main header @s -->

            <!-- main header @e -->
            <!-- content @s -->

            <div class="nk-content nk-content-fluid">
                <div class="container-xl wide-xl">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <?php $this->renderSection('content') ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content @e -->
            <!-- footer @s -->
            <div class="nk-footer nk-footer-fluid bg-lighter">
                <div class="container-xl">
                    <div class="nk-footer-wrap">
                        <div class="nk-footer-copyright"> <a href="https://digitalnative.web.id" target="_blank"> &copy; 2023 Digital Native </a>
                        </div>

                    </div>
                </div>
            </div>
            <!-- footer @e -->
        </div>
        <!-- wrap @e -->
    </div>
    <!-- app-root @e -->
    <!-- select region modal -->

    <!-- JavaScript -->
    <script>
        var BASE_URL = "<?php echo base_url() ?>/"
    </script>
    <script src="<?php echo base_url() ?>/public/assets/js/bundle.js?ver=3.1.3"></script>
    <script src="<?php echo base_url() ?>/public/assets/js/scripts.js?ver=3.1.3"></script>
    <script src="<?php echo base_url() ?>/public/assets/js/charts/gd-invest.js?ver=3.1.3"></script>
    <script src="<?php echo base_url() ?>/public/assets/js/scan_absen.js?v=<?php echo time(); ?>"></script>
    <script src="<?php echo base_url() ?>/public/assets/qrcode/qrcode.js"></script>

</body>

</html>