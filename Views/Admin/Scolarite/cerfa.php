<?php



use Projet\Database\Entreprise;
use Projet\Database\Formation;
use Projet\Model\App;
use Projet\Model\Paginator;
use Projet\Model\StringHelper;


$url = substr(explode('?',$_SERVER["REQUEST_URI"])[0],1);
$laPage = isset($_GET['page'])?$_GET['page']:1;
$paginator = new Paginator($url,$laPage,$nbrePages,$_GET,$_GET);
App::setTitle("Les CERFAS");
App::setNavigation("Les CERFAS");
App::setBreadcumb('<li class="active">CERFAS</li>');
App::addScript('assets/js/cerfa.js',true);
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-dark">
            <div class="panel-heading">
                <h5 class="panel-title">
                    CERFAS <small>(<?= thousand($nbre->Total); ?>)</small>
                </h5>
                <div class="panel-control">
                    <a href="javascript:void(0);" data-toggle="tooltip" id="add" data-original-title="Nouveau cerfa">
                        <i class="icon-plus text-success fa-2x"></i>
                    </a>
                   
                     </div>
            </div>
            <div class="panel-body">
                <div class="row m-t-sm">
                    <div class="col-md-12">
                        <form action="<?= App::url('cerfas') ?>" method="get">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="search" <?= (isset($_GET['search'])&&!empty($_GET['search']))?'value="'.$_GET['search'].'"':''; ?> placeholder="Chercher par  nom d'apprenant " class="form-control" title="Chercher par le nom ">
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
                                    <th class="">Nom entreprise</th>
                                    <th class="">Intitulé précis de la formation  / Nom du Centre de Formation </th>
                                    <th class="text-right">Nom Apprenant </th>
                                    <th class="text-right">Email Apprenant</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody id="table-Villes">
                                <?php
                                if (!empty($items)){
                                    foreach ($items as $item) {
                                        $ligneformation  = Formation :: find($item->idformation);
                                        $ligneemployeur  = Entreprise :: find($item->idemployeur);
                                        if($item->idformation == 0){$nomF = StringHelper::isEmpty(''); }else{ $nomF = $ligneformation->intituleF.' / '.$ligneformation->nomF; }
                                        ?>
                                        <tr>
                                            <td class=""><?= StringHelper::isEmpty($ligneemployeur->nomE); ?></td>
                                            <td class=""><?= $nomF; ?></td>
                                            <td class="text-right"><?=StringHelper::isEmpty($item->nomA); ?></td>
                                            <td class="text-right"><?=StringHelper::isEmpty($item->emailA); ?></td>
                                            <td class="text-center">
                                            <a href="javascript:void(0);" class="edit text-success"
                                                    data-idemployeur="<?= $item->idemployeur; ?>"
                                                    data-idformation="<?= $item->idformation; ?>"
                                                    data-id="<?= $item->id; ?>"


                                                    data-nomA="<?= $item->nomA; ?>"
                                                    data-nomuA="<?= $item->nomuA; ?>"
                                                    data-prenomA="<?= $item->prenomA; ?>"
                                                    data-sexeA="<?= $item->sexeA; ?>"
                                                    data-naissanceA="<?= $item->naissanceA; ?>"
                                                    data-departementA="<?= $item->departementA; ?>"
                                                    data-communeNA="<?= $item->communeNA; ?>"
                                                    data-nationaliteA="<?= $item->nationaliteA; ?>"
                                                    data-regimeA="<?= $item->regimeA; ?>"
                                                    data-situationA="<?= $item->situationA; ?>"
                                                    data-titrePA="<?= $item->titrePA; ?>"
                                                    data-derniereCA="<?= $item->derniereCA; ?>"
                                                    data-securiteA="<?= $item->securiteA; ?>"
                                                    data-intituleA="<?= $item->intituleA; ?>"
                                                    data-titreOA="<?= $item->titreOA; ?>"
                                                    data-declareSA="<?= $item->declareSA; ?>"
                                                    data-declareHA="<?= $item->declareHA; ?>"
                                                    data-declareRA="<?= $item->declareRA; ?>"
                                                    data-rueA="<?= $item->rueA; ?>"
                                                    data-voieA="<?= $item->voieA; ?>"
                                                    data-complementA="<?= $item->complementA;?>"
                                                    data-postalA="<?= $item->postalA; ?>"
                                                    data-communeA="<?= $item->communeA;?>"
                                                    data-numeroA="<?= $item->numeroA;?>"
                                                    data-emailA="<?= $item->emailA; ?>"

                                                    data-nomR="<?= $item->nomR; ?>"
                                                    data-emailR="<?= $item->emailR; ?>"
                                                    data-rueR="<?= $item->rueR; ?>"
                                                    data-voieR="<?= $item->voieR; ?>"
                                                    data-complementR="<?= $item->complementR;?>"
                                                    data-postalR="<?= $item->postalR; ?>"
                                                    data-communeR="<?= $item->communeR;?>"


                                                    data-nomM="<?= $item->nomM; ?>"
                                                    data-prenomM="<?= $item->prenomM; ?>"
                                                    data-naissanceM="<?= $item->naissanceM; ?>"
                                                    data-securiteM="<?= $item->securiteM; ?>"
                                                    data-emailM="<?= $item->emailM; ?>"
                                                    data-emploiM="<?= $item->emploiM; ?>"
                                                    data-diplomeM="<?= $item->diplomeM; ?>"
                                                    data-niveauM="<?= $item->niveauM; ?>"


                                                    data-nomM1="<?= $item->nomM1; ?>"
                                                    data-prenomM1="<?= $item->prenomM1; ?>"
                                                    data-naissanceM1="<?= $item->naissanceM1; ?>"
                                                    data-securiteM1="<?= $item->securiteM1; ?>"
                                                    data-emailM1="<?= $item->emailM1; ?>"
                                                    data-emploiM1="<?= $item->emploiM1; ?>"
                                                    data-diplomeM1="<?= $item->diplomeM1; ?>"
                                                    data-niveauM1="<?= $item->niveauM1; ?>"

                                                    data-travailC="<?= $item->travailC; ?>"
                                                    data-derogationC="<?= $item->derogationC; ?>"
                                                    data-numeroC="<?= $item->numeroC; ?>"
                                                    data-conclusionC="<?= $item->conclusionC; ?>"
                                                    data-debutC="<?= $item->debutC; ?>"
                                                    data-finC="<?= $item->finC; ?>"
                                                    data-avenantC="<?= $item->avenantC; ?>"
                                                    data-executionC="<?= $item->executionC; ?>"
                                                    data-dureC="<?= $item->dureC; ?>"
                                                    data-typeC="<?= $item->typeC; ?>"
                                                    data-rdC="<?= $item->rdC; ?>"
                                                    data-raC="<?= $item->raC; ?>"
                                                    data-rpC="<?= $item->rpC; ?>"
                                                    data-rsC="<?= $item->rsC; ?>"
                                                    
                                                    data-rdC1="<?= $item->rdC1; ?>"
                                                    data-raC1="<?= $item->raC1; ?>"
                                                    data-rpC1="<?= $item->rpC1; ?>"
                                                    data-rsC1="<?= $item->rsC1; ?>"

                                                    data-rdC2="<?= $item->rdC2; ?>"
                                                    data-raC2="<?= $item->raC2; ?>"
                                                    data-rpC2="<?= $item->rpC2; ?>"
                                                    data-rsC2="<?= $item->rsC2; ?>"

                                                    data-salaireC="<?= $item->salaireC; ?>"
                                                    data-caisseC="<?= $item->caisseC; ?>"
                                                    data-logementC="<?= $item->logementC; ?>"
                                                    data-avantageC="<?= $item->avantageC; ?>"
                                                    data-autreC="<?= $item->autreC; ?>"

                                                    data-lieuO="<?= $item->lieuO; ?>"
                                                    data-priveO="<?= $item->priveO; ?>"
                                                    data-attesteO="<?= $item->attesteO; ?>"



                                                    
                                                    >
                                                        <i class="fa fa-edit fa-2x"></i>
                                                    </a>
                                                    &nbsp
                                                <a href="javascript:void(0);" class="trash text-danger"
                                                   data-url="<?= App::url('cerfas/delete'); ?>"
                                                   data-id="<?= $item->id; ?>"><i class="fa fa-trash fa-2x"></i>
                                                </a>

                                                <a  target="_blank"
                                                   href="<?= App::url('cerfas/pdf?data='.base64_encode($item->id)) ?>"
                                                   ><i class="fa fa-print fa-2x"></i>
                                                </a>

                                                <a href="javascript:void(0);" class="send"
                                                   data-url="<?= App::url('cerfas/send'); ?>"
                                                   data-id="<?= $item->id; ?>"><i class="fa fa-paper-plane fa-2x"></i>
                                                </a>

                                                <a href="javascript:void(0);" class="sendEmployeur"  title="Envoyer le  cerfa à l'employeur"
                                                   data-url="<?= App::url('cerfas/sendEmployeur'); ?>"
                                                   data-id="<?= $item->id; ?>"><i class="fa fa-share-square fa-2x"></i>
                                                </a>

                                              

                                              
                                            </td>
                                        </tr>
                                    <?php } } else{ ?>
                                    <tr>
                                        <td colspan="9" class="text-danger text-center">Liste des cerfas vide</td>
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
<div class="modal fade newModal"   id="new" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title " id="introplus"></h2>
            </div>
            <form action="<?= App::url('cerfas/savenew') ?>" id="newForm1" method="post">
                <div class="modal-body">
                    <input type="hidden" id="actionE">
                    <input type="hidden" id="idElementE">
                    <p class="mainColor text-right">* Champs obligatoires</p>

                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label class="control-label">Nom et prénom ou dénomination Employeur:<b>*</b></label>
                                <select name="idemployeur" id="idemployeur" class="form-control" >
                                <option value="">__</option>
                                <?php
                                foreach ($employeurs as $employeur) {
                                    echo '<option value="' . $employeur->id . '">' . $employeur->nomE . '</option>';
                                }
                                ?>
                            </select>
                            </div>
                        </div> 
                        <div class="col-md-5 form-group">
                            <label for="email">Email de l'apprenant <b>*</b></label>
                            <input type="email" class="form-control" id="emailAA" name="emailAA" placeholder="email" required>
                        </div>

                        
                    </div>

                    <div class="row">
                    <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Intitulé précis de la formation  / Nom du Centre de Formation: </label>
                                <select name="idformation" id="idformation" class="form-control" >
                                <option value="">__</option>
                                <?php
                                foreach ($formations as $formation) {
                                    $nom = (empty($formation->intituleF)) ? StringHelper::isEmpty('').' / '. $formation->nomF: $formation->intituleF.' / '. $formation->nomF;
                                    echo '<option value="' . $formation->id . '">' .  $nom . '</option>';
                                }
                                ?>
                            </select>
                            </div>
                        </div> 
                    </div>
                    
                   
                </div>
                <div class="modal-footer">
                    <button type="submit" id="confirmplus" class="newBtn btn btn-default">Ajouter</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="host">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title" id="intro">Enregistrer un cerfa</h2>
            </div>
            <form action="<?= App::url('cerfas/save') ?>" id="newFrom" method="post">
                <div class="modal-body">
                    <input type="hidden" id="idElement">
                    <input type="hidden" id="action">
                    <p class="mainColor text-right">* Champs obligatoires</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nom et prénom ou dénomination Employeur:<b>*</b></label>
                                <select name="idemployeurs" id="idemployeurs" class="form-control" >
                                <option value="">__</option>
                                <?php
                                foreach ($employeurs as $employeur) {
                                    echo '<option value="' . $employeur->id . '">' . $employeur->nomE . '</option>';
                                }
                                ?>
                            </select>
                            </div>
                        </div> 

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Intitulé précis de la formation  / Nom du Centre de Formation: </label>
                                <select name="idformations" id="idformations" class="form-control" >
                                <option value="">__</option>
                                <?php
                                foreach ($formations as $formation) {
                                    $nom = (empty($formation->intituleF)) ? StringHelper::isEmpty('').' / '. $formation->nomF: $formation->intituleF.' / '. $formation->nomF;
                                    echo '<option value="' . $formation->id . '">' .  $nom . '</option>';
                                }
                                ?>
                                ?>
                            </select>
                            </div>
                        </div> 
                    </div>



                        <!-- information apprentis -->


                    <div class="row">
                        <p class="mainColor text-left">L’APPRENTI(E)</p>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Nom de naissance de l’apprenti(e) : </label>
                                <input type="text" id="nomA" name="nomA" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Nom d’usage :  </label>
                                <input type="text" id="nomuA" name="nomuA" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Le premier prénom de l’apprenti(e)s  </label>
                                <input type="text" id="prenomA" name="prenomA" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Sexe :  </label>
                                <select  id="sexeA"  name="sexeA" class="form-control">
                                <option value="">__</option>
                                <option value="M">M</option>
                                <option value="F">F</option>
                               
                            </select>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                     
                       
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Date de naissance :   </label>
                                <input type="date" id="naissanceA" name="naissanceA" class="form-control" value="JJ/MM/AAAA">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Département de naissance : </label>
                                <input type="text" id="departementA" name="departementA" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Commune de naissance :   </label>
                                <input type="text" id="communeNA" name="communeNA" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-3">
                         <div class="form-group">
                             <label class="control-label">Nationalité :  </label>
                             <input type="text" id="nationaliteA"  name="nationaliteA" class="form-control" >
                         </div>
                     </div>
                    </div>


                    <div class="row">
                     
                     
                     <div class="col-md-2">
                         <div class="form-group">
                             <label class="control-label">Régime social :    </label>
                             <input type="text" id="regimeA" name="regimeA" class="form-control" >
                         </div>
                     </div>
                     <div class="col-md-3">
                         <div class="form-group">
                             <label class="control-label">Situation avant ce contrat :  </label>
                             <input type="text" id="situationA" name="situationA" class="form-control" >
                         </div>
                     </div>
                     <div class="col-md-4">
                         <div class="form-group">
                             <label class="control-label">Dernier diplôme ou titre préparé :   </label>
                             <input type="text" id="titrePA" name="titrePA" class="form-control" >
                         </div>
                     </div>
                     <div class="col-md-3">
                         <div class="form-group">
                             <label class="control-label">Dernière classe / année suivie :  </label>
                             <input type="text" id="derniereCA"  name="derniereCA" class="form-control" >
                         </div>
                     </div>
                 </div>

                 <div class="row">
                 
                 <div class="col-md-3">
                         <div class="form-group">
                             <label class="control-label">NIR de l’apprenti(e) :  </label>
                             <input type="text" id="securiteA" name="securiteA" class="form-control" >
                         </div>
                     </div>
                     
                     <div class="col-md-5">
                         <div class="form-group">
                             <label class="control-label">Intitulé précis du dernier diplôme ou titre préparé :    </label>
                             <input type="text" id="intituleA"   name="intituleA" class="form-control" >
                         </div>
                     </div>
                     <div class="col-md-4">
                         <div class="form-group">
                             <label class="control-label">Diplôme ou titre le plus élevé obtenu :  </label>
                             <input type="text" id="titreOA"  name="titreOA" class="form-control" >
                         </div>
                     </div>
                     
                 </div>




                    <div class="row">
                     <div class="col-md-4">
                         <div class="form-group">
                             <label class="control-label">Déclare être inscrit sur la liste des sportifs de haut  niveau : </label>
                             <select  id="declareSA"  name="declareSA" class="form-control">
                                <option value="">__</option>
                                <option value="oui">Oui</option>
                                <option value="non">Non</option>
                               
                            </select>
                         </div>
                     </div>
                     <div class="col-md-4">
                         <div class="form-group">
                             <label class="control-label">Déclare bénéficier de la reconnaissance travailleur handicapé : </label>
                             <select  id="declareHA" name="declareHA" class="form-control">
                                <option value="">__</option>
                                <option value="oui">Oui</option>
                                <option value="non">Non</option>
                               
                            </select>
                         </div>
                     </div>
                     <div class="col-md-4">
                         <div class="form-group">
                             <label class="control-label">Déclare avoir un projet de création ou de reprise d’entreprise :  </label>
                             <select  id="declareRA" id="declareRA" class="form-control">
                                <option value="">__</option>
                                <option value="oui">oui</option>
                                <option value="non">Non</option>
                               
                            </select>
                         </div>
                     </div>
                 </div>


                    <div class="row">
                        <p style="margin-left:15px; "   class=" text-left">Adresse de l’apprenti(e) :  <b>*</b> </p>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" id="rueA"   name="rueA" class="form-control" placeholder="N°" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                 <input type="text" id="voieA"  name="voieA" class="form-control"  placeholder="Voie"  >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                               <input type="text" id="complementA"  name="complementA" class="form-control" placeholder="Complement" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" id="postalA" name="postalA" class="form-control" placeholder="Code Postal" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                       <div class="col-md-4">
                            <div class="form-group">
                                 <input type="text" id="communeA"  name="communeA" class="form-control"  placeholder="Commune"  >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                 <input type="text" id="numeroA"  name="numeroA" class="form-control"  placeholder="Téléphone : "  >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                 <input type="email" id="emailA" name="emailA" class="form-control"  placeholder="email: *"  required>
                            </div>
                        </div>
                       
                    </div>


                                <!-- informations representant legal  -->

                    <div class="row">
                        <p class="mainColor text-left">Représentant légal (à renseigner si l’apprenti est mineur non  émancipé) </p>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nom de naissance et prénom : </label>
                                <input type="text" id="nomR" name="nomR" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                               <label class="control-label">Courriel : </label>
                                 <input type="text" id="emailR"  name="emailR" class="form-control"  placeholder="Courriel"  >
                            </div>
                        </div>
                       
                      
                    </div>

                    <div class="row">
                        <p style="margin-left:15px; "   class=" text-left">Adresse du représentant légal :  </p>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" id="rueR"  name="rueR" class="form-control" placeholder="N°" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                 <input type="text" id="voieR"  name="voieR" class="form-control"  placeholder="Voie"  >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                               <input type="text" id="complementR"  name="complementR" class="form-control" placeholder="Complement">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" id="postalR"  name="postalR" class="form-control" placeholder="Code Postal">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                 <input type="text" id="communeR" name="communeR" class="form-control"  placeholder="Commune">
                            </div>
                        </div>

                        
                       
                    </div>


                       <!-- informations maitres de stage  -->

                     
                     <div class="row">
                        <p class="mainColor text-left"> LE MAÎTRE D’APPRENTISSAGE</p>
                     </div>

                    <div class="row">
                        <p style="margin-left:15px; "   class=" text-left">Maître d’apprentissage n°1   </p>
                       
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Nom de naissance :  </label>
                                <input type="text" id="nomM"   name="nomM"  class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Prénom : </label>
                                <input type="text" id="prenomM" name="prenomM" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Date de naissance :  </label>
                                <input type="date" id="naissanceM" name="naissanceM" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">NIR :  </label>
                                <input type="text" id="securiteM"  name="securiteM" class="form-control" >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Courriel : </label>
                                <input type="email" id="emailM" name="emailM" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Emploi occupé : </label>
                                <input type="text" id="emploiM"  name="emploiM" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label" style="font-size: 11px;">Diplôme ou titre le plus élevé obtenu :  </label>
                                <input type="text" id="diplomeM" name="diplomeM" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" >
                                <label class="control-label"  style="font-size: 10px;">Niveau de diplôme ou titre le plus élevé obtenu : </label>
                                <input type="text" id="niveauM"  name="niveauM" class="form-control" >
                            </div>
                        </div>   
                    </div>

                 

                    <div class="row">
                        <p style="margin-left:15px; "   class=" text-left">Maître d’apprentissage n°2   </p>
                       
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Nom de naissance :  </label>
                                <input type="text" id="nomM1"   name="nomM1"  class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Prénom : </label>
                                <input type="text" id="prenomM1" name="prenomM1" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Date de naissance : </label>
                                <input type="date" id="naissanceM1" name="naissanceM1" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">NIR :  </label>
                                <input type="text" id="securiteM1"  name="securiteM1" class="form-control" >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Courriel :</label>
                                <input type="email" id="emailM1" name="emailM1" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Emploi occupé : </label>
                                <input type="text" id="emploiM1"  name="emploiM1" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label" style="font-size: 11px;">Diplôme ou titre le plus élevé obtenu :  </label>
                                <input type="text" id="diplomeM1" name="diplomeM1" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" >
                                <label class="control-label"  style="font-size: 10px;">Niveau de diplôme ou titre le plus élevé obtenu : </label>
                                <input type="text" id="niveauM1"  name="niveauM1" class="form-control" >
                            </div>
                        </div>   
                    </div>






                     <!-- informations sur le contrat  -->

                     
                     <div class="row">
                        <p class="mainColor text-left"> LE CONTRAT  </p>
                     </div>

                    
                    <div class="row">
                       
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label"> Travail sur machines dangereuses ou exposition à des risques particuliers :      </label>
                                <select name="numero" id="travailC" name="travailC" class="form-control">
                                <option value="">__</option>
                                <option value="oui">Oui</option>
                                <option value="non">Non</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Type de dérogation : à renseigner si une dérogation existe pour ce contrat  </label>
                                <input type="text" id="derogationC" name="derogationC" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Numéro du contrat précédent ou du contrat sur lequel porte l’avenant :</label>
                                <input type="text" id="numeroC"  name="numeroC" class="form-control" >
                            </div>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label" >Date de conclusion : (Date de signature du présent contrat).   </label>
                                <input type="date" id="conclusionC"  name="conclusionC" class="form-control" >
                            </div>
                        </div>
                       
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label" > Date de début de formation pratique  chez l’employeur :  </label>
                                <input type="date" id="debutC" name="debutC" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Date de fin du contrat ou de la période d’apprentissage :  </label>
                                <input type="date" id="finC"  name="finC" class="form-control" >
                            </div>
                        </div>   
                       
                       
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Si avenant, date d’effet:</label>
                                <input type="date" id="avenantC"  name="avenantC" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label" style="font-size: 11px;">Date de début d’exécution du contrat:</label>
                                <input type="date" id="executionC"  name="executionC" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label"> Durée hebdomadaire du travail:</label>
                                <input type="number" id="dureC" name="dureC" class="form-control" >
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Type de contrat ou d’avenant : </label>
                                <input type="text" id="typeC" name="typeC" class="form-control" >
                            </div>
                        </div>
                        
                    </div>    

                    <div class="row">
                        <p style="margin-left:15px; "   class=" text-left">Rémunération   </p>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label"> 1er annee </label>
                                <input type="date" id="rdC" name="rdC" class="form-control" placeholder="du">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label class="control-label"> .</label>
                                <input type="date" id="raC" name="raC" class="form-control" placeholder="au" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label class="control-label"> .</label>
                                <input type="number" id="rpC" name="rpC" class="form-control" placeholder="pourcentage" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label class="control-label"> .</label>
                                <input type="text" id="rsC" name="rsC" class="form-control" placeholder="du">
                            </div>
                        </div> 
                        
                        
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label"> 2eme annee </label>
                                <input type="date" id="rdC1" name="rdC1" class="form-control" placeholder="du">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label class="control-label"> .</label>
                                <input type="date" id="raC1" name="raC1" class="form-control" placeholder="au" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label class="control-label"> .</label>
                                <input type="number" id="rpC1" name="rpC1" class="form-control" placeholder="pourcentage" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label class="control-label"> .</label>
                                <input type="text" id="rsC1" name="rsC1" class="form-control" placeholder="du">
                            </div>
                        </div> 
                        
                        
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label"> 3eme annee </label>
                                <input type="date" id="rdC2" name="rdC2" class="form-control" placeholder="du">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label class="control-label"> .</label>
                                <input type="date" id="raC2" name="raC2" class="form-control" placeholder="au" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label class="control-label"> .</label>
                                <input type="number" id="rpC2" name="rpC2" class="form-control" placeholder="pourcentage" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label class="control-label"> .</label>
                                <input type="text" id="rsC2" name="rsC2" class="form-control" placeholder="du">
                            </div>
                        </div> 
                        
                        
                    </div>

                   



                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label"> Salaire brut mensuel à l’embauche : </label>
                                <input type="text" id="salaireC" name="salaireC" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label"> Caisse de retraite complémentaire :   </label>
                                <input type="text" id="caisseC" name="caisseC" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label"> Logement :  € / mois   </label>
                                <input type="number" id="logementC" name="logementC" class="form-control" >
                            </div>
                        </div> 
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label"> Avantages en nature, le cas échéant : Nourriture :  € / repas  </label>
                                <input type="number" id="avantageC" name="avantageC" class="form-control" >
                            </div>
                        </div>
                        
                        
                        <div class="col-md-6">
                            <div class="form-group">
                            <label class="control-label"> Autre :    </label>
                            
                            <select  id="autreC" name="autreC" class="form-control">
                                <option value="">__</option>
                                <option value="oui">Oui</option>
                                <option value="non">Non</option>
                                </select>
                            </div>
                        </div> 
                    </div>

                    <div class="row">
                        
                        <div class="col-md-3">
                            <div class="form-group">
                            <label class="control-label">  Fait à    </label>
                                <input type="text" id="lieuO" name="lieuO" class="form-control" placeholder="  " >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label class="control-label">  entreprise prive ou public    </label>
                            <select  id="priveO"  name="priveO" class="form-control">
                                <option value="">__</option>
                                <option value="oui">prive</option>
                                <option value="non">public</option>
                               
                            </select>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                            <label class="control-label"> L’employeur atteste disposer de l’ensemble des pièces justificatives nécessaires au dépôt du contrat   </label>
                            <select  id="attesteO"  name="attesteO" class="form-control">
                                <option value="">__</option>
                                <option value="oui">oui</option>
                                <option value="non">non</option>
                               
                            </select>
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


