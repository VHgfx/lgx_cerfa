<!Doctype html>
<html lang="fr">
<head>
<link rel="icon" type="image/png" href="./Public/img/favicon.png" >
<script src="./Public/assets/jquery/jquery.min.js" type="text/javascript"></script>
<script src="./Public/assets/jquery/toastr/toastr.js" type="text/javascript"></script>
<meta charset="utf-8">
<link href="./Public/css/font-awesome/materiel/materielindigo.min.css?ver=1.3.0" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="./Public/css/font-awesome-4.7.0/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="./Public/assets/bootstrap/css/bootstrap.css">
<link href="./Public/assets/bootstrap/css/bootstrap.min.css?ver=1.2.0" rel="stylesheet">
<link href="./Public/assets/jquery/toastr/toastr.min.css" rel="stylesheet">
<script src="./Public/js/form.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="./Public/css/form.css">


<title>LGX-FORM</title>
</head>

<body>
<main class="bg-white"  > 
	<div>
		<div>
			<figure>
				<img src="./Public/img/lgxlogo.png" alt="icon entreprise LGX" class="imagestruct">
			</figure>
		</div>
        <div>
			<p style=" margin-top: 20px;"><h6 
		   style="font-style: oblique; font-weight: normal;"class="text-center ">   Remplissez ce formulaire pour l'etablissement de votre cerfa 
            <p style="color: red;">(*) Champs obligatoires</p>
 </h6></p>
        </div>
		
        <div>
        	 <form  onsubmit="return sendData();" method="POST"  id="myForm">
             <div class="row">
                       
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Nom de naissance de l’apprenti(e) : <b>*</b></label>
                                <input type="text" id="nomA" name="nomA" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Nom d’usage :  </label>
                                <input type="text" id="nomuA" name="nomuA" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Le premier prénom de l’apprenti(e)s  <b>*</b></label>
                                <input type="text" id="prenomA" name="prenomA" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Sexe :  <b>*</b></label>
                                <select  id="sexeA"  name="sexeA" class="form-control" required>
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
                                <label class="control-label">Date de naissance :   <b>*</b></label>
                                <input type="date" id="naissanceA" name="naissanceA" class="form-control"  required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Département de naissance : <b>*</b></label>
                                <input type="text" id="departementA" name="departementA" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Commune de naissance :   <b>*</b></label>
                                <input type="text" id="communeNA" name="communeNA" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                         <div class="form-group">
                             <label class="control-label">Nationalité :  <b>*</b></label>
                             <input type="text" id="nationaliteA"  name="nationaliteA" class="form-control" required>
                         </div>
                     </div>
                    </div>


                    <div class="row">
                     
                     
                     <div class="col-md-2">
                         <div class="form-group">
                             <label class="control-label">Régime social :    <b>*</b></label>
                             <input type="text" id="regimeA" name="regimeA" class="form-control" required>
                         </div>
                     </div>
                     <div class="col-md-3">
                         <div class="form-group">
                             <label class="control-label">Situation avant ce contrat :  <b>*</b></label>
                             <input type="text" id="situationA" name="situationA" class="form-control" required>
                         </div>
                     </div>
                     <div class="col-md-4">
                         <div class="form-group">
                             <label class="control-label">Dernier diplôme ou titre préparé :   <b>*</b></label>
                             <input type="text" id="titrePA" name="titrePA" class="form-control" required>
                         </div>
                     </div>
                     <div class="col-md-3">
                         <div class="form-group">
                             <label class="control-label">Dernière classe / année suivie :  <b>*</b></label>
                             <input type="text" id="derniereCA"  name="derniereCA" class="form-control" required>
                         </div>
                     </div>
                 </div>

                 <div class="row">
                 
                 <div class="col-md-3">
                         <div class="form-group">
                             <label class="control-label">numero securite social :  <b>*</b></label>
                             <input type="number" id="securiteA" name="securiteA" class="form-control" required>
                         </div>
                     </div>
                     
                     <div class="col-md-5">
                         <div class="form-group">
                             <label class="control-label">Intitulé précis du dernier diplôme ou titre préparé :    <b>*</b></label>
                             <input type="text" id="intituleA"   name="intituleA" class="form-control" required>
                         </div>
                     </div>
                     <div class="col-md-4">
                         <div class="form-group">
                             <label class="control-label">Diplôme ou titre le plus élevé obtenu :  <b>*</b></label>
                             <input type="text" id="titreOA"  name="titreOA" class="form-control" required>
                         </div>
                     </div>
                     
                 </div>




                    <div class="row">
                     <div class="col-md-4">
                         <div class="form-group">
                             <label class="control-label">Déclare être inscrit sur la liste des sportifs de haut  niveau : <b>*</b></label>
                             <select  id="declareSA"  name="declareSA" class="form-control" required>
                                <option value="">__</option>
                                <option value="oui">Oui</option>
                                <option value="non">Non</option>
                               
                            </select>
                         </div>
                     </div>
                     <div class="col-md-4">
                         <div class="form-group">
                             <label class="control-label">Déclare bénéficier de la reconnaissance travailleur handicapé : <b>*</b></label>
                             <select  id="declareHA" name="declareHA" class="form-control" required>
                                <option value="">__</option>
                                <option value="oui">Oui</option>
                                <option value="non">Non</option>
                               
                            </select>
                         </div>
                     </div>
                     <div class="col-md-4">
                         <div class="form-group">
                             <label class="control-label">Déclare avoir un projet de création ou de reprise d’entreprise : <b>*</b> </label>
                             <select  id="declareRA" id="declareRA" class="form-control" required>
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
                                <input type="text" id="rueA"   name="rueA" class="form-control" placeholder="N°  *" required >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                 <input type="text" id="voieA"  name="voieA" class="form-control"  placeholder="Voie  *"  required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                               <input type="text" id="complementA"  name="complementA" class="form-control" placeholder="Complement" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" id="postalA" name="postalA" class="form-control" placeholder="Code Postal *" required >
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px;">
                       <div class="col-md-6">
                            <div class="form-group">
                                 <input type="text" id="communeA"  name="communeA" class="form-control"  placeholder="Commune *" required >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                 <input type="number" id="numeroA"  name="numeroA" class="form-control"  placeholder="Téléphone :  *"  required>
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
                        <p style="margin-left:10px; "   class=" text-left">Adresse du représentant légal :  </p>
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
                    <div class="row"  style="margin-top:10px;">
                      
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

                      <!-- informations Maitre apprentissage legal  -->

                    <div class="row" style="margin-top:10px;">
                        <p class="mainColor text-left"> LE MAÎTRE D’APPRENTISSAGE</p>
                     </div>

                    <div class="row">
                        <p style="margin-left:15px; "   class=" text-left">Maître d’apprentissage n°1   </p>
                       
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Nom de naissance :  <b>*</b> </label>
                                <input type="text" id="nomM"   name="nomM"  class="form-control" required >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Prénom :  <b>*</b></label>
                                <input type="text" id="prenomM" name="prenomM" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Date de naissance :   <b>*</b></label>
                                <input type="date" id="naissanceM" name="naissanceM" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">NIR :   <b>*</b></label>
                                <input type="text" id="securiteM"  name="securiteM" class="form-control" required >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Courriel :  <b>*</b></label>
                                <input type="email" id="emailM" name="emailM" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Emploi occupé :  <b>*</b></label>
                                <input type="text" id="emploiM"  name="emploiM" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label" style="font-size: 11px;">Diplôme ou titre le plus élevé obtenu :   <b>*</b></label>
                                <input type="text" id="diplomeM" name="diplomeM" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" >
                                <label class="control-label"  style="font-size: 10px;">Niveau de diplôme ou titre le plus élevé obtenu :  <b>*</b></label>
                                <input type="text" id="niveauM"  name="niveauM" class="form-control" required>
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

                    <div class="row" style="margin-bottom:10px;">
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


                    <button type="submit"  id="circle"   class="sendBtn btn  btn-lg btn-rounded  text-center" name="submit_form" >Envoyer</button>
            </form>

                  
        </div>
	</div>
</main>





<script src="./Public/assets/bootstrap/js/bootstrap.bundle.min.js?ver=1.2.0"></script>
<script src="./Public/assets/bootstrap/js/bootstrap.bundle.js?ver=1.2.0"></script>
<script src="./Public/assets/bootstrap/js/bootstrap.js?ver=1.2.0"></script>
<script src="./Public/assets/bootstrap/js/bootstrap.min.js?ver=1.2.0"></script>
<script src="./Public/assets/bootstrap/js/bootstrap.esm.js?ver=1.2.0"></script>
<script src="./Public/assets/bootstrap/js/bootstrap.esm.min.js?ver=1.2.0"></script>
</body>
</html>

                   
                   