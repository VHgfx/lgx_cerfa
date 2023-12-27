<?php


namespace Projet\Controller\Admin;


use DateTime;
use Exception;
use Projet\Database\Annee;
use Projet\Database\Annonce;
use Projet\Database\Classe;
use Projet\Database\Conversation;
use Projet\Database\Cours;
use Projet\Database\Enseignant;
use Projet\Database\Matiere;
use Projet\Database\Message;
use Projet\Database\Pays;
use Projet\Database\Point;
use Projet\Database\Entreprise;
use Projet\Database\Profile;
use Projet\Database\Service;
use Projet\Database\Sollicitation;
use Projet\Database\SousCategorie;
use Projet\Database\Ville;
use Projet\Database\Vues;
use Projet\Database\Worker;
use Projet\Model\App;
use Projet\Model\DataHelper;
use Projet\Model\Email;
use Projet\Model\EmailAll;
use Projet\Model\FileHelper;
use Projet\Model\Privilege;
use Projet\Model\Random;
use Projet\Model\Sms;
use Projet\Model\StringHelper;

class EntreprisesController extends AdminController{

    public function index(){
        $user = $this->user;
        Privilege::hasPrivilege(Privilege::$AllView,$user->privilege);
        $nbreParPage = 20;
        $search = (isset($_GET['search'])&&!empty($_GET['search'])) ? $_GET['search'] : null;
        $nbre = Entreprise::countBySearchType($search);
        $nbrePages = ceil($nbre->Total / $nbreParPage);
        if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbrePages) {
            $pageCourante = $_GET['page'];
        } else {
            $pageCourante = 1;
            $params['page'] = $pageCourante;
        }
        $items = Entreprise::searchType($nbreParPage,$pageCourante,$search);
        $this->render('admin.admin.entreprise',compact('items','user','nbre','nbrePages'));
    }

  

   

    public function save()
    {
        header('content-type: application/json');
        $return = [];
        $tab = ["add", "edit"];
    
        if (
            isset($_POST['nomE']) && !empty($_POST['nomE']) &&
            isset($_POST['action']) && !empty($_POST['action']) &&
            isset($_POST['id']) && in_array($_POST["action"], $tab)
        ) {
    
            $nomE = $_POST['nomE'];
            $typeE = $_POST['typeE'];
            $specifiqueE = $_POST['specifiqueE'];
            $totalE = $_POST['totalE'];
            $siretE = $_POST['siretE'];
            $codeaE = $_POST['codeaE'];
            $codeiE = $_POST['codeiE'];
            $rueE = $_POST['rueE'];
            $voieE = $_POST['voieE'];
            $complementE = $_POST['complementE'];
            $postalE = $_POST['postalE'];
            $communeE = $_POST['communeE'];
            $emailE = $_POST['emailE'];
            $numeroE = $_POST['numeroE'];

            $action = $_POST['action'];
            $id = $_POST['id'];
    
            if ($action == "edit") {
                if (!empty($id)) {
                    $entreprise = Entreprise::find($id);
    
                    if ($entreprise) {
                        $bool = true;
    
                        if ($nomE != $entreprise->nomE) {
                            if (Entreprise::byNom($nomE)) {
                                $bool = "L'employeur existe déjà";
                            }
                        }
    
                        if (is_bool($bool)) {
                            $pdo = App::getDb()->getPDO();
                            try {
                                $pdo->beginTransaction();
                                Entreprise::save($nomE, $typeE, $specifiqueE, $totalE, $siretE, $codeaE, $codeiE, $rueE, $voieE, $complementE, $postalE, $communeE, $emailE, $numeroE,
                                $id);
                                $message = "L'employeur a été mise à jour avec succès";
                                $this->session->write('success', $message);
                                $pdo->commit();
                                $return = array("statuts" => 0, "mes" => $message);
                            } catch (Exception $e) {
                                $pdo->rollBack();
                                $message = $this->error;
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
                    $message = $this->error;
                    $return = array("statuts" => 1, "mes" => $message);
                }
            } else {
                if (!Entreprise::byNom($nomE)) {
                    $pdo = App::getDb()->getPDO();
                    try {
                        $pdo->beginTransaction();
                        Entreprise::save($nomE, $typeE, $specifiqueE, $totalE, $siretE, $codeaE, $codeiE, $rueE, $voieE, $complementE, $postalE, $communeE, $emailE, $numeroE,
                        $id = null);
                        $message = "L'employeur a été ajoutée avec succès";
                        $this->session->write('success', $message);
                        $pdo->commit();
                        $return = array("statuts" => 0, "mes" => $message);
                    } catch (Exception $e) {
                        $pdo->rollBack();
                        $message = $this->error;
                        $return = array("statuts" => 1, "mes" => $message);
                    }
                } else {
                    $message = "Le nom de l'employeur existe déjà, veuillez utiliser un autre nom";
                    $return = array("statuts" => 1, "mes" => $message);
                }
            }
        } else {
            $message = "Veuillez renseigner tous les champs requis";
            $return = array("statuts" => 1, "mes" => $message);
        }
    
        echo json_encode($return);
    }

    public function delete(){
        Privilege::hasPrivilege(Privilege::$AllView,$this->user->privilege);
        header('content-type: application/json');
        if (isset($_POST['id'])&&!empty($_POST['id'])){
            $id = $_POST['id'];
            $entreprise = Entreprise::find($id);
            if ($entreprise){
                Entreprise::delete($id);
                $message = "L'employeur a été supprimée avec succès";
                $this->session->write('success',$message);
                $return = array("statuts"=>0, "mes"=>$message);

            }else{
                $message = "L'employeur n'existe plus";
                $return = array("statuts"=>1, "mes"=>$message);
            }
        }else{
            $message = "Renseigner l'id SVP !!!";
            $return = array("statuts"=>1, "mes"=>$message);
        }
        echo json_encode($return);
    }
    

}