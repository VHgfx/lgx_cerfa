<?php


use Projet\Database\Test;
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
App::setTitle("Les bureaux");
App::setNavigation("Les bureaux");
App::setBreadcumb('<li class="active"> Bureaux</li>');
App::addStyle('assets/css/multi-select.css',true);
App::addScript('assets/js/jquery.multi-select.js',true);
App::addScript('assets/js/bureau.js',true);
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-dark">
            <div class="panel-heading">
                <h5 class="panel-title">

                 Bureaux Test ok boss  <small>(<?= thousand($nbre->Total); ?>)</small>

                </h5>
                <div class="panel-control">
                    <?php if(Privilege::canView(Privilege::$AllView,$user->privilege)){ ?>
                        <a href="javascript:void(0);" data-toggle="tooltip" class="new" data-original-title="Nouveau bureau">
                            <i class="icon-plus text-success fa-2x"></i>
                        </a>
                       
                    <?php } ?>
                    
                </div>
            </div>
            <div class="panel-body">
                <div class="row m-t-sm">
                    <div class="col-md-12">
                        <form action="<?= App::url('bureau') ?>" method="get">
                           
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <input type="text" class="form-control" <?= (isset($_GET['search'])&&!empty($_GET['search']))?'value="'.$_GET['search'].'"':''; ?>
                                           data-toggle="tooltip" data-original-title="Chercher par nom" name="search" placeholder="Chercher par nom">
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
                                   
                                    <th class="">Noms</th>
                                    <th class="">type</th>
                                    <th class="">Couleur</th>

                                  
                                   
                                    <th class="text-center">Actions</th>
                                   
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(!empty($items)){
                                    foreach ($items as $bureau) {
                                      
                                         
                                        $stat1 = "";
                                        
                                       
                                        $stat01 = $stat02 = $stat04 = "";
                                        if(Privilege::canView(Privilege::$AllView,$user->privilege)){
                                            $stat01 = '<li>
                                                                <a href="javascript:void(0);" data-id="'.$bureau->id.'"
                                                                 data-nom="'.$bureau->nom.'"  data-type="'.$bureau->type.'"
                                                                 data-couleur="'.$bureau->couleur.'"
                                                                
                                                                class="edit">Modifier</a>
                                                            </li>';
                                        }
                                        
                                        if(Privilege::canView(Privilege::$AllView,$user->privilege)){
                                           

                                              $stat04 = '<li>
                                                           
                                                            <a href="javascript:void(0);" data-url="'.App::url('bureau/delete').'" 
                                                            class="trash" data-id="'.$bureau->id.'">Supprimer bureau</a>
                                                        </li>';
                                        }
                                        echo
                                            '
                                            <tr>
                                               
                                                <td class="">'.$bureau->nom.'</td>
                                                <td class="">'.$bureau->type.'</td>
                                                <td class="">'.$bureau->couleur.'</td>
                                                
                                               

                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                            Actions <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            '.$stat04.$stat01.$stat1.'
                                                        </ul>
                                                    </div>
                                                </td>
                                              
                                            </tr>
                                            ';
                                    }}else{
                                    echo '<tr><td colspan="9" class="text-danger text-center">Liste des bureaux vide ...</td></tr>';
                                }
                                ?>
                                </tbody>
                                <?php
                                if(!empty($items)){ ?>
                                    <tfoot >
                                    <tr>
                                        <td colspan="9" >
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
            <form action="<?= App::url('bureau/save') ?>" id="newForm" method="post">
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
                            <label for="type">type<b>*</b></label>
                            <input type="text" class="form-control" id="type" placeholder="type">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="couleur">Couleur<b>*</b></label>
                            <input type="text" class="form-control" id="couleur" placeholder="couleur">
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
