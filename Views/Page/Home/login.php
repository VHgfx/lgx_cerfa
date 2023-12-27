<?php
use Projet\Model\App;
use Projet\Model\FileHelper;

$auth = App::getDBAuth();
App::setTitle("Se connecter à l'administration");
App::addScript("assets/js/login.js", true);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Se connecter à l'administration</title>
    <link rel="stylesheet" href="<?= FileHelper::url('assets/css/votre-style.css') ?>">
    <!-- Inclure jQuery depuis un CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?= FileHelper::url('assets/js/login.js') ?>"></script>
</head>
<body>
    <div class="page-inner" style="background: transparent !important">
        <div  style="margin: auto; height: 100px"> </div>
        <div id="main-wrapper" style="margin-top: 0">
            <div class="row">
                <div class="col-md-3 center divBox" style="background: #fff; padding: 30px; margin-top: 50px">
                    <div class="login-box">
                        <a href="<?= App::url('') ?>" class="logo-name text-center">
                            <img src="<?= FileHelper::url('assets/img/lgxlogo.jpg') ?>" style="height: auto; width: 200px;" alt="">
                        </a>
                        <p style="color: #00008B; margin-top: 20px;"><h2 class="text-center no-m">Cerfa</h2></p>
                        <form class="m-t-md text-center" action="<?= App::url('ajax') ?>" id="loginForm">
                            <div class="form-group">
                                <input type="text" class="form-control" id="login" placeholder="Email ou Téléphone" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="password" placeholder="Mot de passe" required>
                            </div>
                            <button type="submit" style="background: #153C4A;" class="sendBtn btn btn-success btn-lg btn-rounded" translate="no">Login</button>
                        </form>
                        <p class="text-center text-sm" style="margin-top: 20px">2023 &copy; Développé par LGX Création</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
