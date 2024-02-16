<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href=".<?php echo base_url() ?>/public/.<?php echo base_url() ?>/public/.<?php echo base_url() ?>/public/">
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

<body class="nk-body bg-white npc-general pg-auth">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner card-inner-xl">
                                <a class="text" href="<?php echo base_url()?>">Home</a>
                                <div class="entry">
                            <?php echo $teks?>        
                            </div>
                            </div><!-- .card-inner -->
                        </div><!-- .card -->
                    </div>
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="<?php echo base_url() ?>/public/assets/js/bundle.js?ver=3.1.3"></script>
    <script src="<?php echo base_url() ?>/public/assets/js/scripts.js?ver=3.1.3"></script>
    <!-- select region modal -->


</html>