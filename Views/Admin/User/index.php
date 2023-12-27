<?php


use Projet\Database\Profil;
use Projet\Model\App;
use Projet\Model\Privilege;

App::setTitle("Tableau de bord");
App::setNavigation("Tableau de bord");
App::setBreadcumb("");
App::addScript('assets/plugins/flot/jquery.flot.min.js',true);
App::addScript('assets/plugins/flot/jquery.flot.tooltip.min.js',true);

App::addStyle('https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css',true);
App::addScript('https://cdn.jsdelivr.net/momentjs/latest/moment.min.js',true);
App::addScript('https://cdn.jsdelivr.net/momentjs/latest/moment-with-locales.min.js',true);
App::addScript('https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js',true);
App::addStyle('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css',true);

?>
<style>
    .col-lg-6.col-md-6m,.col-md-6 {
        margin-top: 55px;
        padding-right: 5px !important;
        padding-left: 5px !important;
    }
    .panel-body{
        height: 125px;
        margin-top: 20px;
    }
</style>
<div class="row">
    <div class="col-lg-6 col-md-6">
        <div class="panel info-box panel-dark">
            <div class="panel-body">
                <div class="info-box-stats">
                   
                    <span class="info-box-title">
                        Administrateurs (
                        <a href="<?= App::url('admins') ?>">
                        <small><?= thousand($nbreadmins->Total); ?></small><i class="text-xs"> total</i>
                        </a>
                        
                        )
                    </span>
                </div>
                <div class="info-box-icon">
                    <i class="icon-users"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="panel info-box panel-dark">
            <div class="panel-body">
                <div class="info-box-stats">
                <p></p>
                    <span class="info-box-title">
                        Alternants (
                        <a href="<?= App::url('alternants') ?>">
                        <small><?= thousand($nbrealternants->Total); ?></small><i class="text-xs"> total</i>
                        </a>
                        
                        )
                    </span>
                </div>
                <div class="info-box-icon">
                    <i class="icon-user"></i>
                </div>
            </div>
        </div>
    </div>

   

   

    <div class="col-lg-6 col-md-6">
        <div class="panel info-box panel-dark">
            <div class="panel-body">
                <div class="info-box-stats">
                <p></p>
                    <span class="info-box-title">
                        Cerfas (
                        <a href="<?= App::url('cerfas') ?>">
                        <small><?= thousand($nbrecerfas->Total); ?></small><i class="text-xs"> total</i>
                        </a>
                        
                        )
                    </span>
                </div>
                <div class="info-box-icon">
                    <i class="icon-doc" style="color: #F93100;"></i>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-6 col-md-6">
        <div class="panel info-box panel-dark">
            <div class="panel-body">
                <div class="info-box-stats">
                <p></p>
                    <span class="info-box-title">
                        Employeurs (
                        <a href="<?= App::url('employeurs') ?>">
                        <small><?= thousand($nbreemployeurs->Total); ?></small><i class="text-xs"> total</i>
                        </a>
                        
                        )
                    </span>
                </div>
                <div class="info-box-icon">
                    <i class="icon-doc" style="color: #F93100;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-6">
        <div class="panel info-box panel-dark">
            <div class="panel-body">
                <div class="info-box-stats">
                <p></p>
                    <span class="info-box-title">
                       Formations (
                        <a href="<?= App::url('formations') ?>">
                        <small><?= thousand($nbreformations->Total); ?></small><i class="text-xs"> total</i>
                        </a>
                        
                        )
                    </span>
                </div>
                <div class="info-box-icon">
                    <i class="icon-doc" style="color: #F93100;"></i>
                </div>
            </div>
        </div>
    </div>

    
   
   
    
</div>

