<?php


use Projet\Database\Vues;
use Projet\Database\Worker;
use Projet\Model\App;
use Projet\Model\DateParser;
use Projet\Model\FileHelper;
use Projet\Model\Paginator;
use Projet\Model\Privilege;
use Projet\Model\StringHelper;

$url = substr(explode('?',$_SERVER["REQUEST_URI"])[0],1);
$laPage = isset($_GET['page'])?$_GET['page']:1;
$paginator = new Paginator($url,$laPage,$nbrePages,$_GET,$_GET);
App::setTitle("Les Administrateurs");
App::setNavigation("Les Administrateurs");
App::setBreadcumb('<li class="active">Administrateurs</li>');
App::addStyle('assets/css/multi-select.css',true);
App::addScript('assets/js/jquery.multi-select.js',true);
App::addScript('assets/js/admin.js',true);
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-dark">
            <div class="panel-heading">
                <h5 class="panel-title">
                    Administrateurs <small>(<?= thousand($nbre->Total); ?>)</small>
                </h5>
                <div class="panel-control">
                    <?php if(Privilege::canView(Privilege::$AllView,$user->privilege)){ ?>
                        <a href="javascript:void(0);" data-toggle="tooltip" class="new" data-original-title="Nouvel administrateur">
                            <i class="icon-plus text-success fa-2x"></i>
                        </a>
                    <?php } ?>
                    <!-- <a target="_blank" href="<?= App::url('admins/pdf') ?>"
                       data-toggle="tooltip" data-original-title="Generer le fichier PDF des admins" ><i class="fa fa-file-pdf-o fa-2x text-primary"></i></a>
                    <a target="_blank" href="<?= App::url('admins/excell') ?>"
                       data-toggle="tooltip" data-original-title="Generer le fichier Excel des admins" ><i class="fa fa-file-excel-o fa-2x text-info"></i></a>
                    <a href="javascript:void(0);" data-toggle="tooltip" class="panel-collapse" data-original-title="Reduire/Agrandir">
                        <i class="icon-arrow-down fa-2x"></i>
                    </a>
                    <a href="<?= App::url('admins') ?>" data-toggle="tooltip" class="panel-reload" data-original-title="Rafraichir">
                        <i class="icon-reload fa-2x"></i>
                    </a> -->
                </div>
            </div>
            <div class="panel-body">
                <div class="row m-t-sm">
                    <div class="col-md-12">
                        <form action="<?= App::url('admins') ?>" method="get">
                            <div class="row">
                              
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <input type="text" class="form-control" <?= (isset($_GET['search'])&&!empty($_GET['search']))?'value="'.$_GET['search'].'"':''; ?>
                                           data-toggle="tooltip" data-original-title="Chercher par nom, prénom, ou email" name="search" placeholder="Chercher par nom, prénom, ou email">
                                </div>
                               
                            </div>
                            <div class="row">
                                <div class="col-md-offset-10 col-md-2">
                                    <button class="btn btn-block btn-default" type="submit">Chercher</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row m-t-sm" style="min-height: 470px;">
                    <div class="col-md-12">
                        <div class="table-responsive project-stats">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center">Photo</th>
                                    <th class="">Noms</th>
                                   
                                    <th class="">Email</th>
                                   
                                    <th class="">Profil</th>
                                    <th class="">Etat</th>
                                    <th class="text-center">#</th>
                                    <th class="">Connexion</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(!empty($profils)){
                                    foreach ($profils as $profil) {
                                          
                                         if(empty($profil->photo)){
                                            $profilphoto =FileHelper::url('assets/img/user.jpg');
                                         }else{ $profilphoto = FileHelper::url($profil->photo);}


                                        $stat1 = "";
                                        $stat2 = "";
                                        if(($profil->etat==0||$profil->etat==2)&&Privilege::canView(Privilege::$AllView,$user->privilege)){
                                            $stat1 = '<li>
                                                        <a href="javascript:void(0);" data-url="'.App::url('admins/activate').'" 
                                                        class="activate" data-etat="'.$profil->etat.'" data-id="'.$profil->id.'">Activer l\'administrateur</a>
                                                    </li>';
                                        }else{
                                            if(Privilege::canView(Privilege::$AllView,$user->privilege)){
                                                $stat1 = '<li>
                                                    <a href="javascript:void(0);" data-url="'.App::url('admins/activate').'" 
                                                    class="activate" data-etat="'.$profil->etat.'" data-id="'.$profil->id.'">Désactiver l\'administrateur</a>
                                                </li>';
                                            }
                                        }
                                        $stat01 = $stat02 = $stat04 = "";
                                        if(Privilege::canView(Privilege::$AllView,$user->privilege)){
                                            $stat01 = '<li>
                                                                <a href="javascript:void(0);" data-id="'.$profil->id.'"
                                                                 data-nom="'.$profil->nom.'"  data-prenom="'.$profil->prenom.'"
                                                                 data-email="'.$profil->email.'"
                                                                 
                                                                class="edit">Modifier</a>
                                                            </li>';
                                        }
                                        if(Privilege::canView(Privilege::$AllView,$user->privilege)){
                                            $stat02 = '<li class="divider"></li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="editPhoto" 
                                                                data-id="'.$profil->id.'">Modifier la photo</a>
                                                            </li>';
                                        }
                                        if(Privilege::canView(Privilege::$AllView,$user->privilege)){
                                            $stat04 = '<li>
                                                                <a href="javascript:void(0);" data-url="'.App::url('admins/reset').'" 
                                                                class="reset" data-id="'.$profil->id.'">Réinitialiser le mot de passe</a>
                                                            </li>';


                                                            $stat03 = '<li>
                                                                <a href="javascript:void(0);" data-url="'.App::url('admins/delete').'" 
                                                                class="delete" data-id="'.$profil->id.'">supprimer l\'administrateur</a>
                                                            </li>';
                                        }
                                        echo
                                            '
                                            <tr>
                                                <td class="text-center"><img src="'.$profilphoto.'" class="img-circle img-xs" alt="Img"></td>
                                                <td class="">'.StringHelper::getShortName($profil->nom,$profil->prenom).'</td>
                                                
                                                <td class="">'.StringHelper::isEmpty($profil->email,1).'</td>
                                                
                                                <td class="">'.StringHelper::isEmpty($profil->libProfile).'</td>
                                                <td class="">'.StringHelper::$tabState[$profil->etat].'</td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                            Actions <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            '.$stat04.$stat01.$stat1.$stat02.$stat03.'
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td class="">'.DateParser::relativeTime($profil->last_login).'</td>
                                            </tr>
                                            ';
                                    }}else{
                                    echo '<tr><td colspan="9" class="text-danger text-center">Liste des administrateurs vide ...</td></tr>';
                                }
                                ?>
                                </tbody>
                                <?php
                                if(!empty($profils)){ ?>
                                    <tfoot>
                                    <tr>
                                        <td colspan="9">
                                            <?php $paginator->paginateTwo(); ?>
                                        </td>
                                    </tr>
                                    </tfoot>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade newModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title titleForm">Titre</h2>
            </div>
            <form action="<?= App::url('admins/save') ?>" id="newForm" method="post">
                <div class="modal-body">
                    <input type="hidden" id="action">
                    <input type="hidden" id="idElement">
                    <p class="mainColor text-right">* Champs obligatoires</p>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="nom">Nom <b>*</b></label>
                            <input type="text" class="form-control" id="nom" placeholder="Nom">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="prenom">Prénom <b>*</b></label>
                            <input type="text" class="form-control" id="prenom" placeholder="Prénom">
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6 form-group">
                            <label for="email">Adresse email</label>
                            <input type="email" class="form-control" id="email" placeholder="Adresse email">
                        </div>
                        
                       
                    </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="submit" class="newBtn btn btn-default">Ajouter</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade photoModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title">METTRE LA PHOTO A JOUR</h2>
            </div>
            <form action="<?= App::url('admins/setPhoto') ?>" id="photoForm" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="idPhoto" name="idPhoto">
                    <p class="mainColor text-right">* Champs obligatoires</p>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="photoImage">Photo <b>*</b></label>
                            <input type="file" class="form-control" id="photoImage" accept="image/*" name="image">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="photoBtn btn btn-default">MISE A JOUR</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>