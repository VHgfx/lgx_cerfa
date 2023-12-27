<?php



use Projet\Model\App;
use Projet\Model\Paginator;
use Projet\Model\StringHelper;


$url = substr(explode('?',$_SERVER["REQUEST_URI"])[0],1);
$laPage = isset($_GET['page'])?$_GET['page']:1;
$paginator = new Paginator($url,$laPage,$nbrePages,$_GET,$_GET);
App::setTitle("Les FORMATIONS");
App::setNavigation("Les FORMATIONS");
App::setBreadcumb('<li class="active">FORMATIONS</li>');
App::addScript('assets/js/formation.js',true);
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-dark">
            <div class="panel-heading">
                <h5 class="panel-title">
                     FORMATIONS <small>(<?= thousand($nbre->Total); ?>)</small>
                </h5>
                <div class="panel-control">
                    <a href="javascript:void(0);" data-toggle="tooltip" id="add" data-original-title="Nouvelle formation">
                        <i class="icon-plus text-success fa-2x"></i>
                    </a>
                  

                    <a href="javascript:void(0);" data-toggle="tooltip" class="panel-collapse" data-original-title="Reduire/Agrandir">
                        <i class="icon-arrow-down fa-2x"></i>
                    </a>
                    <a href="<?= App::url('formations') ?>" data-toggle="tooltip" class="panel-reload" data-original-title="Rafraichir">
                        <i class="icon-reload fa-2x"></i>
                    </a>
                     </div>
            </div>
            <div class="panel-body">
                <div class="row m-t-sm">
                    <div class="col-md-12">
                        <form action="<?= App::url('formations') ?>" method="get">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="search" <?= (isset($_GET['search'])&&!empty($_GET['search']))?'value="'.$_GET['search'].'"':''; ?> placeholder="Chercher par  nom entreprise " class="form-control" title="Chercher par le nom ">
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
                                    <th class="">Nom</th>
                                    <th class=""> Diplôme ou titre visé </th> 
                                    <th class=""> Code du diplôme : </th> 
                                    <th class=""> Code RNCP </th> 
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody id="table-Villes">
                                <?php
                                if (!empty($items)){
                                    foreach ($items as $item) {
                                        ?>
                                        <tr>
                                            <td class=""><?= StringHelper::isEmpty($item->nomF); ?></td>
                                            <td class=""><?= StringHelper::isEmpty($item->diplomeF); ?></td>
                                            <td class=""><?= StringHelper::isEmpty($item->codeF); ?></td>
                                            <td class=""><?= StringHelper::isEmpty($item->rnF); ?></td>
                                            <td class="text-center">
                                            <a href="javascript:void(0);" class="edit text-success"
                                                    data-id="<?= $item->id; ?>"


                                                    data-nomF="<?= $item->nomF; ?>"
                                                    data-diplomeF="<?= $item->diplomeF; ?>"
                                                    data-intituleF="<?= $item->intituleF; ?>"
                                                    data-numeroF="<?= $item->numeroF; ?>"
                                                    data-siretF="<?= $item->siretF; ?>"
                                                    data-codeF="<?= $item->codeF; ?>"
                                                    data-rnF="<?= $item->rnF; ?>"
                                                    data-entrepriseF="<?= $item->entrepriseF; ?>"
                                                    data-responsableF="<?= $item->responsableF; ?>"
                                                    data-rueF="<?= $item->rueF; ?>"
                                                    data-voieF="<?= $item->voieF; ?>"
                                                    data-complementF="<?= $item->complementF; ?>"
                                                    data-postalF="<?= $item->postalF; ?>"
                                                    data-communeF="<?= $item->communeF; ?>"


                                                    data-debutO="<?= $item->debutO; ?>"
                                                    data-prevuO="<?= $item->prevuO; ?>"
                                                    data-dureO="<?= $item->dureO; ?>"
                                                    data-nomO="<?= $item->nomO; ?>"
                                                    data-numeroO="<?= $item->numeroO; ?>"
                                                    data-siretO="<?= $item->siretO; ?>"
                                                    data-rueO="<?= $item->rueO; ?>"
                                                    data-voieO="<?= $item->voieO; ?>"
                                                    data-complementO="<?= $item->complementO; ?>"
                                                    data-postalO="<?= $item->postalO; ?>"
                                                    data-communeO="<?= $item->communeO; ?>"
                                                    >
                                                        <i class="fa fa-edit fa-2x"></i>
                                                    </a>
                                                    &nbsp
                                                <a href="javascript:void(0);" class="trash text-danger"
                                                   data-url="<?= App::url('formations/delete'); ?>"
                                                   data-id="<?= $item->id; ?>"><i class="fa fa-trash fa-2x"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } } else{ ?>
                                    <tr>
                                        <td colspan="9" class="text-danger text-center">Liste des formations vide</td>
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
</div>
<div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title" id="intro">Enregistrer une formation</h2>
            </div>
            <form action="<?= App::url('formations/save') ?>" id="newFrom" method="post">
                <div class="modal-body">
                    <input type="hidden" id="idElement">
                    <input type="hidden" id="action">
                    <p class="mainColor text-right">* Champs obligatoires</p>
                    <div class="row">
                        <p class="mainColor text-left">Formation</p>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Dénomination du CFA responsable:<b>*</b></label>
                                <input type="text" id="nomF"  name="nomF" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Diplôme ou titre visé par l’apprenti : </label>
                                <input type="text" id="diplomeF"   name="diplomeF" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                                <label class="control-label"> Intitulé précis : </label>
                                <input type="text" id="intituleF"  name="intituleF" class="form-control" >
                            </div>
                        </div>
                      
                       
                    </div>

                    <div class="row">
                    <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">N° UAI du CFA :   </label>
                                <input type="text" id="numeroF" name="numeroF" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label"> N° SIRET CFA :  </label>
                                <input type="text" id="siretF" name="siretF" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Code du diplôme :  </label>
                                <input type="text" id="codeF" name="codeF" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Code RNCP :     </label>
                                <input type="text" id="rnF"  name="rnF" class="form-control" >
                            </div>
                        </div>
                        
                    </div>


                    <div class="row">

                    <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">CFA d’entreprise :  </label>
                                <select  id="entrepriseF" name="entrepriseF" class="form-control">
                                <option value="">............</option>
                                <option value="oui">Oui</option>
                                <option value="non">Non</option>
                               
                            </select>
                            </div>
                        </div>   
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="control-label">Si le CFA responsable est le lieu de formation principal cochez la case ci-contre  </label>
                                <select id="responsableF"  name="responsableF" class="form-control">
                                <option value="">............</option>
                                <option value="oui">Oui</option>
                              
                               
                            </select>
                            </div>
                        </div>
                    
                    </div>


                    <div class="row">
                    
                        <p style="margin-left:15px; "   class=" text-left">Adresse du CFA responsable :   </p>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" id="rueF" name="rueF" class="form-control" placeholder="N°" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                 <input type="text" id="voieF"  name="voieF" class="form-control"  placeholder="Voie"  >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                               <input type="text" id="complementF"  name="complementF" class="form-control" placeholder="Complement" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" id="postalF" name="postalF" class="form-control" placeholder="Code Postal" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                 <input type="text" id="communeF"  name="communeF" class="form-control"  placeholder="Commune"  >
                            </div>
                        </div>
                       
                    </div>

                    <!-- break one  -->

                    <div class="row">
                        <p style="margin-left:15px; "   class=" text-left">Organisation de la formation en CFA :    </p>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label class="control-label"> Date de début de formation en CFA :  </label>
                                <input type="date" id="debutO" name="debutO" class="form-control" placeholder="Date de début de formation en CFA :  " >
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                            <label class="control-label"> Date prévue de fin des épreuves ou examens:</label>
                                 <input type="date" id="prevuO"  name="prevuO" class="form-control"  placeholder="Date prévue de fin des épreuves ou examens :"  >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label class="control-label" style="font-size:11px; " >Durée de la formation : En heures   </label>
                               <input type="number" id="dureO" name="dureO" class="form-control"  >
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <p style="margin-left:15px; "   class=" text-left">Lieu principal de réalisation de la formation si différent du CFA responsable :    </p>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label class="control-label">Dénomination du lieu de formation principal :     </label>
                                <input type="text" id="nomO"  name="nomO"class="form-control" placeholder="  " >
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                            <label class="control-label">N° UAI :  </label>
                               <input type="text" id="numeroO" name="numeroO" class="form-control" placeholder="" >
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                            <label class="control-label">N° SIRET :    </label>
                               <input type="text" id="siretO" name="siretO" class="form-control" placeholder="" >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <p style="margin-left:15px; "   class=" text-left">Adresse du lieu de formation principal :    </p>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" id="rueO" name="rueO" class="form-control" placeholder="N°" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                 <input type="text" id="voieO" name="voieO" class="form-control"  placeholder="Voie"  >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                               <input type="text" id="complementO"  name="complementO" class="form-control" placeholder="Complement" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                               <input type="text" id="postalO"  name="postalO" class="form-control" placeholder="Code postal :" >
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                               <input type="text" id="communeO" name="communeO" class="form-control" placeholder="Commune : " >
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


