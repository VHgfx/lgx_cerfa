<?php

return
    [

        ""=>'\Projet\Controller\Page\AuthController#login',
        "ajax"=>'\Projet\Controller\Page\HomeController#log',
        "error"=>'\Projet\Controller\Error\HomeController#error',
        "error_db"=>'\Projet\Controller\Error\HomeController#error_db',
        "unauthorize"=>'\Projet\Controller\Error\HomeController#unauthorize',
        "expired"=>'\Projet\Controller\Error\HomeController#expired',
        "logout"=>'\Projet\Controller\Page\HomeController#logout',

       

        "home"=>'\Projet\Controller\Admin\HomeController#index',
        "session"=>'\Projet\Controller\Admin\HomeController#session',
        "password"=>'\Projet\Controller\Admin\HomeController#password',
        "password/change"=>'\Projet\Controller\Admin\HomeController#changePassword',

        "admins"=>'\Projet\Controller\Admin\AdminsController#index',
        "admins/save"=>'\Projet\Controller\Admin\AdminsController#save',
        "admins/activate"=>'\Projet\Controller\Admin\AdminsController#activate',
        "admins/reset"=>'\Projet\Controller\Admin\AdminsController#reset',
        "admins/delete"=>'\Projet\Controller\Admin\AdminsController#delete',
        "admins/setPhoto"=>'\Projet\Controller\Admin\AdminsController#setPhoto',

        "formations"=>'\Projet\Controller\Admin\FormationsController#index',
        "formations/save"=>'\Projet\Controller\Admin\FormationsController#save',
        "formations/delete"=>'\Projet\Controller\Admin\FormationsController#delete',

        "employeurs"=>'\Projet\Controller\Admin\EntreprisesController#index',
        "employeurs/save"=>'\Projet\Controller\Admin\EntreprisesController#save',
        "employeurs/delete"=>'\Projet\Controller\Admin\EntreprisesController#delete',
     

    


        "alternants"=>'\Projet\Controller\Scolarite\AlternantController#index',
        "alternants/save"=>'\Projet\Controller\Scolarite\AlternantController#save',
        "alternants/delete"=>'\Projet\Controller\Scolarite\AlternantController#delete',
       
       

        "cerfas"=>'\Projet\Controller\Scolarite\CerfaController#index',
        "cerfas/save"=>'\Projet\Controller\Scolarite\CerfaController#save',
        "cerfas/savenew"=>'\Projet\Controller\Scolarite\CerfaController#savenew',
        "cerfas/delete"=>'\Projet\Controller\Scolarite\CerfaController#delete',
        "cerfas/send"=>'\Projet\Controller\Scolarite\CerfaController#send',
        "cerfas/sendEmployeur"=>'\Projet\Controller\Scolarite\CerfaController#sendEmployeur',
        "cerfas/pdf"=>'\Projet\Controller\Admin\StatsController#cerfas',
       
        "ordis"=>'\Projet\Controller\Scolarite\OrdisController#index',
        "ordis/save"=>'\Projet\Controller\Scolarite\OrdisController#save',
        "ordis/delete"=>'\Projet\Controller\Scolarite\OrdisController#delete',


               
        "bureau"=>'\Projet\Controller\Batiment\BureauController#index',
        "bureau/save"=>'\Projet\Controller\Batiment\BureauController#save',
        "bureau/delete"=>'\Projet\Controller\Batiment\BureauController#delete',
        

    ];
