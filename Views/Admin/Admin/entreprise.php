<?php



use Projet\Model\App;
use Projet\Model\Paginator;
use Projet\Model\StringHelper;


$url = substr(explode('?',$_SERVER["REQUEST_URI"])[0],1);
$laPage = isset($_GET['page'])?$_GET['page']:1;
$paginator = new Paginator($url,$laPage,$nbrePages,$_GET,$_GET);
App::setTitle("Les EMPLOYEURS");
App::setNavigation("Les EMPLOYEURS");
App::setBreadcumb('<li class="active">EMPLOYEURS</li>');
App::addScript('assets/js/entreprise.js',true);
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-dark">
            <div class="panel-heading">
                <h5 class="panel-title">
                 EMPLOYEURS<small>(<?= thousand($nbre->Total); ?>)</small>
                </h5>
                <div class="panel-control">
                    <a href="javascript:void(0);" data-toggle="tooltip" id="add" data-original-title="Nouveau employeur">
                        <i class="icon-plus text-success fa-2x"></i>
                    </a>
                  

                    <a href="javascript:void(0);" data-toggle="tooltip" class="panel-collapse" data-original-title="Reduire/Agrandir">
                        <i class="icon-arrow-down fa-2x"></i>
                    </a>
                    <a href="<?= App::url('employeurs') ?>" data-toggle="tooltip" class="panel-reload" data-original-title="Rafraichir">
                        <i class="icon-reload fa-2x"></i>
                    </a>
                     </div>
            </div>
            <div class="panel-body">
                <div class="row m-t-sm">
                    <div class="col-md-12">
                        <form action="<?= App::url('employeurs') ?>" method="get">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="search" <?= (isset($_GET['search'])&&!empty($_GET['search']))?'value="'.$_GET['search'].'"':''; ?> placeholder="Chercher par  nom  " class="form-control" title="Chercher par le nom ">
                                    </div>
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
                                <thead class="noBackground">
                                <tr>
                                    <th class="">Nom </th>
                                    <th class="">Email </th>
                                    <th class="">Numero </th>
                                    <th class=""> Type Employeur</th>
                                    <th class=""> N°SIRET</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody id="table-Villes">
                                <?php
                                if (!empty($items)){
                                    foreach ($items as $item) {
                                        ?>
                                        <tr>
                                            <td class=""><?= StringHelper::isEmpty($item->nomE); ?></td>
                                            <td class=""><?= StringHelper::isEmpty($item->emailE); ?></td>
                                            <td class=""><?= StringHelper::isEmpty($item->numeroE); ?></td>
                                            <td class=""><?=  StringHelper::isEmpty($item->typeE); ?></td>
                                            <td class=""><?= StringHelper::isEmpty($item->siretE);  ?></td>
                                            <td class="text-center">
                                            <a href="javascript:void(0);" class="edit text-success"
                                                    data-nomE="<?= $item->nomE; ?>"
                                                    data-id="<?= $item->id; ?>"

                                                    data-typeE="<?= $item->typeE; ?>"
                                                    data-specifiqueE="<?= $item->specifiqueE; ?>"
                                                    data-totalE="<?= $item->totalE; ?>"
                                                    data-siretE="<?= $item->siretE; ?>"
                                                    data-codeaE="<?= $item->codeaE; ?>"
                                                    data-codeiE="<?= $item->codeiE; ?>"

                                                    data-rueE="<?= $item->rueE; ?>"
                                                    data-voieE="<?= $item->voieE; ?>"
                                                    data-complementE="<?= $item->complementE; ?>"
                                                    data-postalE="<?= $item->postalE; ?>"
                                                    data-communeE="<?= $item->communeE; ?>"
                                                    data-emailE="<?= $item->emailE; ?>"
                                                    data-numeroE="<?= $item->numeroE; ?>"
                                                    >
                                                        <i class="fa fa-edit fa-2x"></i>
                                                    </a>
                                                    &nbsp
                                                <a href="javascript:void(0);" class="trash text-danger"
                                                   data-url="<?= App::url('employeurs/delete'); ?>"
                                                   data-id="<?= $item->id; ?>"><i class="fa fa-trash fa-2x"></i>
                                                </a>

                                                

                                              

                                              
                                            </td>
                                        </tr>
                                    <?php } } else{ ?>
                                    <tr>
                                        <td colspan="9" class="text-danger text-center">Liste des employeurs  vide</td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                                <?php
                                if(!empty($items)){ ?>
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
<div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title" id="intro">Enregistrer une entreprise</h2>
            </div>
            <form action="<?= App::url('employeurs/save') ?>" id="newFrom" method="post">
                <div class="modal-body">
                    <input type="hidden" id="idElement">
                    <input type="hidden" id="action">
                    <p class="mainColor text-right">* Champs obligatoires</p>
                    <div class="row">
                        <p class="mainColor text-left">Employeur</p>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Nom et prénom ou dénomination :  <b>*</b></label>
                                <input type="text" id="nomE"   name="nomE" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Type d’employeur:</label>
                                <input type="text" id="typeE" name="typeE" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Employeur spécifique :  </label>
                                <input type="text" id="specifiqueE"  name="specifiqueE" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Effectif total salariés :  </label>
                                <input type="text" id="totalE"  name="totalE" class="form-control" >
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="row">
                    <div class="col-md-4">
                            <div class="form-group">
                                <label style="font-size:11px;" class="control-label">N°SIRET de l’établissement d’exécution du contrat : </label>
                                <input type="text" id="siretE"  name="siretE" class="form-control">
                            </div>
                        </div>
                       
                        <div class="col-md-3">
                            <div class="form-group">
                                <label style="font-size:11px;"class="control-label">Code activité de l’entreprise (NAF) : </label>
                                <input type="text" id="codeaE"  name="codeaE" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="control-label">Code IDCC de la convention collective applicable : </label>
                                <input type="text" id="codeiE" name="codeiE" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                       
                      
                       
                    </div>
                    <div class="row">
                        <p style="margin-left:15px; "   class=" text-left  ">Adresse de l’établissement d’exécution du contrat : </p>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" id="rueE" name="rueE" class="form-control" placeholder="N° " >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                 <input type="text" id="voieE" name="voieE" class="form-control"  placeholder="Voie "  >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                               <input type="text" id="complementE"  name="complementE" class="form-control" placeholder="Complement" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" id="postalE"  name="postalE" class="form-control" placeholder="Code Postal " >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      
                       
                        <div class="col-md-4">
                            <div class="form-group">
                                 <input type="text" id="communeE" name="communeE" class="form-control"  placeholder="Commune "  >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                
                                <input type="email" id="emailE" name="emailE" class="form-control" placeholder="Courriel " >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                
                                <input type="text" id="numeroE"  name="numeroE" class="form-control"  placeholder="Téléphone " >
                            </div>
                        </div>
                       
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="confirm" class="newBtn btn btn-default">AJOUTER</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>


