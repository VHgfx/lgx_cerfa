<?php


namespace Projet\Controller\Scolarite;



use Projet\Controller\Admin\AdminsController;

use Projet\Database\Cerfa;
use Projet\Database\Entreprise;
use Projet\Database\Formation;
use Projet\Database\Salle;
use Projet\Database\Test;
use Projet\Model\App;
use Projet\Model\Email;
use Projet\Model\Privilege;
use Exception;


class CerfaController extends AdminsController
{
    public function index(){
        Privilege::hasPrivilege(Privilege::$AllView,$this->user->privilege);
        $user = $this->user;
        $nbreParPage = 10;
        $search = (isset($_GET['search'])&&!empty($_GET['search'])) ? $_GET['search'] : null;
        $nbre = Cerfa::countBySearchType($search);
        $nbrePages = ceil($nbre->Total / $nbreParPage);
        if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbrePages) {
            $pageCourante = $_GET['page'];
        } else {
            $pageCourante = 1;
            $params['page'] = $pageCourante;
        }
        $items = Cerfa::searchType($nbreParPage,$pageCourante,$search);
        $employeurs = Entreprise::searchType();
        $formations = Formation::searchType();
        $this->render('admin.scolarite.cerfa',compact('search','user','nbre','nbrePages','items','employeurs','formations'));
    }


    public function save()
{
    header('content-type: application/json');
    $return = [];
    $tab = ["add", "edit"];

    if (
        isset($_POST['idemployeur']) && !empty($_POST['idemployeur']) &&
        isset($_POST['emailA']) && !empty($_POST['emailA']) &&
        isset($_POST['action']) && !empty($_POST['action']) &&
        isset($_POST['id']) && in_array($_POST["action"], $tab)
    ) {

        $idemployeur = $_POST['idemployeur'];
        $idformation = $_POST['idformation'];


        $nomA = $_POST['nomA'];
        $nomuA = $_POST['nomuA'];
        $prenomA = $_POST['prenomA'];
        $sexeA = $_POST['sexeA'];
        $naissanceA = $_POST['naissanceA'];
        $departementA = $_POST['departementA'];
        $communeNA = $_POST['communeNA'];
        $nationaliteA = $_POST['nationaliteA'];
        $regimeA = $_POST['regimeA'];
        $situationA = $_POST['situationA'];
        $titrePA = $_POST['titrePA'];
        $derniereCA = $_POST['derniereCA'];
        $securiteA = $_POST['securiteA'];
        $intituleA = $_POST['intituleA'];
        $titreOA = $_POST['titreOA'];
        $declareSA = $_POST['declareSA'];
        $declareHA = $_POST['declareHA'];
        $declareRA = $_POST['declareRA'];
        $rueA = $_POST['rueA'];
        $voieA = $_POST['voieA'];
        $complementA = $_POST['complementA'];
        $postalA = $_POST['postalA'];
        $communeA = $_POST['communeA'];
        $numeroA = $_POST['numeroA'];
        $emailA = $_POST['emailA'];

        $nomR = $_POST['nomR'];
        $emailR = $_POST['emailR'];
        $rueR = $_POST['rueR'];
        $voieR = $_POST['voieR'];
        $complementR = $_POST['complementR'];
        $postalR = $_POST['postalR'];
        $communeR = $_POST['communeR'];


        $nomM = $_POST['nomM'];
        $prenomM = $_POST['prenomM'];
        $naissanceM = $_POST['naissanceM'];
        $securiteM = $_POST['securiteM'];
        $emailM = $_POST['emailM'];
        $emploiM = $_POST['emploiM'];
        $diplomeM = $_POST['diplomeM'];
        $niveauM = $_POST['niveauM'];

        $nomM1 = $_POST['nomM1'];
        $prenomM1 = $_POST['prenomM1'];
        $naissanceM1 = $_POST['naissanceM1'];
        $securiteM1 = $_POST['securiteM1'];
        $emailM1 = $_POST['emailM1'];
        $emploiM1 = $_POST['emploiM1'];
        $diplomeM1 = $_POST['diplomeM1'];
        $niveauM1 = $_POST['niveauM1'];

        $travailC = $_POST['travailC'];
        $derogationC = $_POST['derogationC'];
        $numeroC = $_POST['numeroC'];
        $conclusionC = $_POST['conclusionC'];
        $debutC = $_POST['conclusionC'];
        $finC = $_POST['finC'];
        $avenantC = $_POST['avenantC'];
        $executionC = $_POST['executionC'];
        $dureC = $_POST['dureC'];
        $typeC = $_POST['typeC'];
        $rdC = $_POST['rdC'];
        $raC = $_POST['raC'];
        $rpC = $_POST['rpC'];
        $rsC = $_POST['rsC'];
        $rdC1 = $_POST['rdC1'];
        $raC1 = $_POST['raC1'];
        $rpC1 = $_POST['rpC1'];
        $rsC1 = $_POST['rsC1'];

        $rdC2 = $_POST['rdC2'];
        $raC2 = $_POST['raC2'];
        $rpC2 = $_POST['rpC2'];
        $rsC2 = $_POST['rsC2'];

        $salaireC = $_POST['salaireC'];
        $caisseC = $_POST['caisseC'];
        $logementC = $_POST['logementC'];
        $avantageC = $_POST['avantageC'];
        $autreC = $_POST['autreC'];

        $lieuO = $_POST['lieuO'];
        $priveO = $_POST['priveO'];
        $attesteO = $_POST['attesteO'];



        
        $action = $_POST['action'];
        $id = $_POST['id'];

        if ($action == "edit") {
            if (!empty($id)) {
                $cerfa = Cerfa::find($id);

                if ($cerfa) {
                    $bool = true;

                    if ($emailA != $cerfa->emailA) {
                        if (Cerfa::byEmail($emailA)) {
                            $bool = false;
                        }
                    }

                    if(!empty($naissanceA) && empty($salaireC)){
                        $dateAujourdhui = date("Y-m-d");
                        $smic = 1747.20;

                        $dateNaissanceObj = date_create($naissanceA);
                        $dateAujourdhuiObj = date_create($dateAujourdhui);
                    
                        // Calcul de l'âge
                        $diff = date_diff($dateNaissanceObj, $dateAujourdhuiObj);
                        $age = $diff->y;
                    
                        if ($age < 18) {
                            if(  $dateAujourdhui >= $rdC && $dateAujourdhui <= $raC){
                                $salaireC = 0.27 * $smic;
                                $rpC =27;
                            }elseif($dateAujourdhui >= $rdC1 && $dateAujourdhui <= $raC1 ){
                                $salaireC = 0.39 * $smic;
                                $rpC1 =39;
                            }elseif( $dateAujourdhui >= $rdC2 && $dateAujourdhui <= $raC2){
                                $salaireC = 0.55 * $smic;
                                $rpC2 =55;
                            }else{
                                $salaireC = 0.27 * $smic;
                                $rpC =27;
                            }
                         
                        } elseif ($age >= 18 && $age <= 20) {
                            if(  $dateAujourdhui >= $rdC && $dateAujourdhui <= $raC){
                                $salaireC = 0.43 * $smic;
                                $rpC =43;
                            }elseif($dateAujourdhui >= $rdC1 && $dateAujourdhui <= $raC1 ){
                                $salaireC = 0.51 * $smic;
                                $rpC1 =51;
                            }elseif( $dateAujourdhui >= $rdC2 && $dateAujourdhui <= $raC2){
                                $salaireC = 0.67 * $smic;
                                $rpC2 =67;
                            }else{
                                $salaireC = 0.43 * $smic;
                                $rpC =43;
                            }   
                         
                            
                        } elseif ($age >= 21 && $age <= 25) {

                            if( $dateAujourdhui >= $rdC && $dateAujourdhui <= $raC){
                                $salaireC = 0.53 * $smic;
                                $rpC =53;
                            }elseif($dateAujourdhui >= $rdC1 && $dateAujourdhui <= $raC1 ){
                                $salaireC = 0.61 * $smic;
                                $rpC1 =61;
                            }elseif( $dateAujourdhui >= $rdC2 && $dateAujourdhui <= $raC2 ){
                                $salaireC = 0.78 * $smic;
                                $rpC2 =78;
                            }else{
                                $rpC =53;
                                $salaireC = 0.53 * $smic;
                            }
                           
                        } else {
                            $salaireC = $smic;
                            $rpC =100;
                            $rpC1 =100;
                            $rpC2 =100;
                        }
                    }




                    if ($bool) {
                        $pdo = App::getDb()->getPDO();
                        try {
                            $pdo->beginTransaction();
                            Cerfa::save($idemployeur, $idformation,
                            $nomA, $nomuA, $prenomA, $sexeA,
                            $naissanceA, $departementA, $communeNA, 
                            $nationaliteA , $regimeA , $situationA, $titrePA,
                            $derniereCA, $securiteA, $intituleA, $titreOA , 
                            $declareSA , $declareHA, $declareRA, $rueA, 
                            $voieA , $complementA, $postalA, $communeA, $numeroA , $emailA ,
                            $nomR,$emailR,$rueR,$voieR,$complementR,$postalR,$communeR, 
                            $nomM,$prenomM,$naissanceM,$securiteM,$emailM,$emploiM,$diplomeM,$niveauM, 
                            $nomM1,$prenomM1,$naissanceM1,$securiteM1,$emailM1,$emploiM1,$diplomeM1,$niveauM1, 
                            $travailC,$derogationC,$numeroC,$conclusionC,$debutC,$finC,$avenantC,$executionC,$dureC,$typeC,
                            $rdC,$raC,$rpC,$rsC,
                            $rdC1,$raC1,$rpC1,$rsC1,
                            $rdC2,$raC2,$rpC2,$rsC2,
                            $salaireC,$caisseC,$logementC,$avantageC,$autreC,
                            $lieuO,$priveO,$attesteO,
                            $id);
                            $message = "La cerfa a été mise à jour avec succès";
                            $this->session->write('success', $message);
                            $pdo->commit();
                            $return = array("statuts" => 0, "mes" => $message);
                        } catch (Exception $e) {
                            $pdo->rollBack();
                            $message = $this->error;
                            $return = array("statuts" => 1, "mes" => $message);
                        }
                    } else {
                        $message = "Le cerfa avec cet email existe déjà";
                        $return = array("statuts" => 1, "mes" => $message);
                    }
                } else {
                    $message = $this->error;
                    $return = array("statuts" => 1, "mes" => $message);
                }
            } else {
                $message = $this->error;
                $return = array("statuts" => 1, "mes" => $message);
            }
        } else {
            if (!Cerfa::byNom($nomE)) {
                $pdo = App::getDb()->getPDO();
                try {
                    $pdo->beginTransaction();
                    Cerfa::save($idemployeur, $idformation,
                    $nomA, $nomuA, $prenomA, $sexeA,
                    $naissanceA, $departementA, $communeNA, 
                    $nationaliteA, $regimeA, $situationA, $titrePA,
                    $derniereCA, $securiteA, $intituleA, $titreOA, 
                    $declareSA, $declareHA, $declareRA, $rueA, 
                    $voieA, $complementA, $postalA, $communeA, $numeroA, $emailA,
                    $nomR, $emailR, $rueR, $voieR , $complementR, $postalR, $communeR, 
                    $nomM,$prenomM,$naissanceM,$securiteM,$emailM,$emploiM,$diplomeM,$niveauM, 
                    $nomM1,$prenomM1,$naissanceM1,$securiteM1,$emailM1,$emploiM1,$diplomeM1,$niveauM1, 
                    $travailC,$derogationC,$numeroC,$conclusionC,$debutC,$finC,$avenantC,$executionC,$dureC,$typeC,
                    $rdC,$raC,$rpC,$rsC,$rdC1,$raC1,$rpC1,$rsC1,$salaireC,$caisseC,$logementC,$avantageC,$autreC,
                    $lieuO,$priveO,$attesteO,
                    $id = null);
                    $message = "La cerfa a été ajoutée avec succès";
                    $this->session->write('success', $message);
                    $pdo->commit();
                    $return = array("statuts" => 0, "mes" => $message);
                } catch (Exception $e) {
                    $pdo->rollBack();
                    $message = $this->error;
                    $return = array("statuts" => 1, "mes" => $message);
                }
            } else {
                $message = "Le nom du cerfa existe déjà, veuillez utiliser un autre nom";
                $return = array("statuts" => 1, "mes" => $message);
            }
        }
    } else {
        $message = "Veuillez renseigner tous les champs requis";
        $return = array("statuts" => 1, "mes" => $message);
    }

    echo json_encode($return);
}

public function savenew()
{
    header('content-type: application/json');
    $return = [];
        $idemployeur = $_POST['idemployeur'];
        $idformation = $_POST['idformation'];
        $emailA = $_POST['emailAA'];
       

       
            if (!Cerfa::byEmail($emailA)) {
                $pdo = App::getDb()->getPDO();
                try {
                    $pdo->beginTransaction();
                    Cerfa::save($idemployeur,$idformation,
                    
                    null, null,null, null,
                    null, null, null, 
                    null, null, null, null,
                    null, null, null,null, 
                    null, null, null, null, 
                    null, null, null, null,null, $emailA,
                    null,null, null, null , null, null, null, 
                    null,null,null,null,null,null,null,null, 
                    null,null,null,null,null,null,null,null, 
                    null,null,null,null,null,null,null,null,null,null,
                    null,null,null,null,null,null,null,null,null,null,null,null,null,
                    null,null,null,
                    null);
                    $message = "La cerfa a été ajoutée avec succès";
                    $this->session->write('success', $message);
                    $pdo->commit();
                    App::url('cerfas');
                    $return = array("statuts" => 0, "mes" => $message);
                    
                } catch (Exception $e) {
                    $pdo->rollBack();
                    $message = $this->error;
                    $return = array("statuts" => 1, "mes" => $message);
                }
            } else {
                $message = "L'email de l'apprenant  existe déjà, veuillez utiliser un autre email";
                $return = array("statuts" => 1, "mes" => $message);
            }
       
   

    echo json_encode($return);
}

   

    public function delete(){
        Privilege::hasPrivilege(Privilege::$AllView,$this->user->privilege);
        header('content-type: application/json');
        if (isset($_POST['id'])&&!empty($_POST['id'])){
            $id = $_POST['id'];
            $salle = Cerfa::find($id);
            if ($salle){
                Cerfa::delete($id);
                $message = "Le cerfa a été supprimée avec succès";
                $this->session->write('success',$message);
                $return = array("statuts"=>0, "mes"=>$message);

            }else{
                $message = "Le cerfa n'existe plus";
                $return = array("statuts"=>1, "mes"=>$message);
            }
        }else{
            $message = "Renseigner l'id SVP !!!";
            $return = array("statuts"=>1, "mes"=>$message);
        }
        echo json_encode($return);
    }

    public function send(){
        Privilege::hasPrivilege(Privilege::$AllView,$this->user->privilege);
        header('content-type: application/json');
        if (isset($_POST['id'])&&!empty($_POST['id'])){
            $id = $_POST['id'];
            $cerfa = Cerfa::find($id);
            if ($cerfa){
                if(!empty($cerfa->emailA)){
                    Email::sendEmailApprenti($cerfa->emailA, $id);
                    $message = "Le cerfa a été envoyer  avec succès";
                    $this->session->write('success',$message);
                    $return = array("statuts"=>0, "mes"=>$message);
                }else{
                    $message = "Renseigner l'email de l'apprenti(e)";
                    $return = array("statuts"=>1, "mes"=>$message);
                }
                
             
            }else{
                $message = "Le cerfa n'existe plus";
                $return = array("statuts"=>1, "mes"=>$message);
            }
        }else{
            $message = "Renseigner l'id SVP !!!";
            $return = array("statuts"=>1, "mes"=>$message);
        }
        echo json_encode($return);
    }

}