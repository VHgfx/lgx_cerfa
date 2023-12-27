<?php

use Projet\Model\App;
use Projet\Model\FileHelper;
use Projet\Model\Session;

$auth = App::getDBAuth();
$page = isset($_GET['url']) ? $_GET['url'] : '';

$session = Session::getInstance();
?>
<!doctype html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no"/>

    <link rel="icon" type="image/png" href="<?= FileHelper::url('assets/img/fav.png') ?>" sizes="16x16">
    <link rel="icon" type="image/png" href="<?= FileHelper::url('assets/img/fav.png') ?>" sizes="32x32">

    <title><?= App::getTitle(); ?></title>

    <link href="<?= FileHelper::url('assets/plugins/pace-master/themes/blue/pace-theme-flash.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= FileHelper::url('assets/plugins/uniform/css/uniform.default.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= FileHelper::url('assets/plugins/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= FileHelper::url('assets/plugins/fontawesome/css/font-awesome.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= FileHelper::url('assets/plugins/line-icons/simple-line-icons.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= FileHelper::url('assets/plugins/offcanvasmenueffects/css/menu_cornerbox.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= FileHelper::url('assets/plugins/waves/waves.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= FileHelper::url('assets/plugins/switchery/switchery.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= FileHelper::url('assets/plugins/3d-bold-navigation/css/style.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= FileHelper::url('assets/plugins/toastr/toastr.min.css') ?>" rel="stylesheet" type="text/css">

    <link href="<?= FileHelper::url('assets/css/modern.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= FileHelper::url('assets/css/themes/green.css') ?>" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="<?= FileHelper::url('assets/plugins/3d-bold-navigation/js/modernizr.js') ?>"></script>
    <script type="text/javascript" src="<?= FileHelper::url('assets/plugins/offcanvasmenueffects/js/snap.svg-min.js') ?>"></script>

</head>

<body class="page-login login-alt">

<main class="page-content" style="background: #1A3F4C;background-repeat: no-repeat;background-position: center center;background-size: cover">
        <?php
        if (isset($_SESSION['success'])) {
            echo '<div class="alert alert-success text-center" style="display: none" data-alert=""><a href="javascript:void(0);" class="alert-close close"></a><span class="alertJss">' . $session->read('success') . '</span></div>';
            $session->delete('success');
        }
        if (isset($_SESSION['danger'])) {
            echo '<div class="alert alert-danger text-center" style="display: none" data-alert=""><a href="javascript:void(0);" class="alert-close close"></a><span class="alertJs">' . $session->read('danger') . '</span></div>';
            $session->delete('danger');
        }
        echo $content;

        ?>
    </main>

    <script type="text/javascript" src="<?= FileHelper::url('assets/plugins/jquery/jquery-2.1.4.min.js') ?>"></script>
    <script type="text/javascript" src="<?= FileHelper::url('assets/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
    <script type="text/javascript" src="<?= FileHelper::url('assets/plugins/pace-master/pace.min.js') ?>"></script>
    <script type="text/javascript" src="<?= FileHelper::url('assets/plugins/jquery-blockui/jquery.blockui.js') ?>"></script>
    <script type="text/javascript" src="<?= FileHelper::url('assets/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script type="text/javascript" src="<?= FileHelper::url('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
    <script type="text/javascript" src="<?= FileHelper::url('assets/plugins/switchery/switchery.min.js') ?>"></script>
    <script type="text/javascript" src="<?= FileHelper::url('assets/plugins/uniform/jquery.uniform.min.js') ?>"></script>
    <script type="text/javascript" src="<?= FileHelper::url('assets/plugins/offcanvasmenueffects/js/classie.js') ?>"></script>
    <script type="text/javascript" src="<?= FileHelper::url('assets/plugins/waves/waves.min.js') ?>"></script>
    <script type="text/javascript" src="<?= FileHelper::url('assets/plugins/toastr/toastr.min.js') ?>"></script>
    <script type="text/javascript" src="<?= FileHelper::url('assets/js/modern.min.js') ?>"></script>
    
    <?php
    App::addScript("assets/js/modern.min.js",true, true);
    if(!empty(App::getScripts()['default'])){
        foreach (App::getScripts()['default'] as $default) {
            echo $default.PHP_EOL;
        }
    }
    if(!empty(App::getScripts()['source'])){
        foreach (App::getScripts()['source'] as $source) {
            echo $source.PHP_EOL;
        }
    }
    if(!empty(App::getScripts()['script'])){
        foreach (App::getScripts()['script'] as $script) {
            echo $script.PHP_EOL;
        }
    }
    ?>
    <script type="text/javascript">
        function showAlert($form,$type,$message) {
            removeAlert();
            var $classe = '';
            if($type===1){
                $classe = ' alert-success';
                $message += '<br>Redirection en cours, veuillez patienter SVP';
                $form.find('*').prop('disabled',true);
            }else{
                $classe = ' alert-danger';
            }
            $form.prepend('<div class="alerterForm alert text-center alert-dismissible'+$classe+'">' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' +
                '<span>'+$message+'</span></div>');
        }
        function removeAlert() {
            $('.alerterForm').remove();
        }
    </script>
    <script type="text/javascript">

        $(document).ready(function () {
            if($('.alertJss').text() != ''){
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-center",
                    showMethod: 'fadeIn',
                    hideMethod: 'fadeOut',
                    timeOut: 3000
                };
                toastr.success($('.alertJss').text(),'Succès !');
            }
            if($('.alertJs').text() != ''){
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-center",
                    showMethod: 'fadeIn',
                    hideMethod: 'fadeOut',
                    timeOut: 3000
                };
                toastr.error($('.alertJs').text(),'Oups !');
            }
        });
    </script>
</body>
</html>