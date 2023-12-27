<?php


namespace Projet\Controller\Admin;



use Projet\Controller\Admin\AdminsController;

use Projet\Database\Formation;
use Projet\Database\Salle;
use Projet\Database\Test;
use Projet\Model\App;
use Projet\Model\Email;
use Projet\Model\Privilege;
use Exception;


class FormationsController extends AdminsController
{
    public function index(){
        Privilege::hasPrivilege(Privilege::$AllView,$this->user->privilege);
        $user = $this->user;
        $nbreParPage = 10;
        $search = (isset($_GET['search'])&&!empty($_GET['search'])) ? $_GET['search'] : null;
        $nbre = Formation::countBySearchType($search);
        $nbrePages = ceil($nbre->Total / $nbreParPage);
        if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbrePages) {
            $pageCourante = $_GET['page'];
        } else {
            $pageCourante = 1;
            $params['page'] = $pageCourante;
        }
        $items = Formation::searchType($nbreParPage,$pageCourante,$search);
        $this->render('admin.admin.formation',compact('search','user','nbre','nbrePages','items'));
    }


    public function save()
{
    header('content-type: application/json');
    $return = [];
    $tab = ["add", "edit"];

    if (
        isset($_POST['nomF']) && !empty($_POST['nomF']) &&
        isset($_POST['action']) && !empty($_POST['action']) &&
        isset($_POST['id']) && in_array($_POST["action"], $tab)
    ) {

        $nomF = $_POST['nomF'];
        $diplomeF = $_POST['diplomeF'];
        $intituleF = $_POST['intituleF'];
        $numeroF = $_POST['numeroF'];
        $siretF = $_POST['siretF'];
        $codeF = $_POST['codeF'];
        $rnF = $_POST['rnF'];
        $entrepriseF = $_POST['entrepriseF'];
        $responsableF = $_POST['responsableF'];
        $rueF = $_POST['rueF'];
        $voieF = $_POST['voieF'];
        $complementF = $_POST['complementF'];
        $postalF = $_POST['postalF'];
        $communeF = $_POST['communeF'];

        $debutO = $_POST['debutO'];
        $prevuO = $_POST['prevuO'];
        $dureO = $_POST['dureO'];
        $nomO = $_POST['nomO'];
        $numeroO = $_POST['numeroO'];
        $siretO = $_POST['siretO'];
        $rueO = $_POST['rueO'];
        $voieO = $_POST['voieO'];
        $complementO = $_POST['complementO'];
        $postalO = $_POST['postalO'];
        $communeO = $_POST['communeO'];
        
        $action = $_POST['action'];
        $id = $_POST['id'];

        if ($action == "edit") {
            if (!empty($id)) {
                $formation = Formation::find($id);

                if ($formation) {
                    $bool = true;

                    if ($nomF != $formation->nomF) {
                        if (Formation::byNom($nomF)) {
                            $bool = "La formation existe déjà";
                        }
                    }

                    if (is_bool($bool)) {
                        $pdo = App::getDb()->getPDO();
                        try {
                            $pdo->beginTransaction();
                            Formation::save(
                            $nomF,$diplomeF,$intituleF,$numeroF,$siretF,$codeF,$rnF,$entrepriseF,$responsableF,$rueF,$voieF,$complementF,$postalF,$communeF,
                            $debutO,$prevuO,$dureO,$nomO,$numeroO,$siretO,$rueO,$voieO,$complementO,$postalO,$communeO,
                            $id);
                            $message = "La formation a été mise à jour avec succès";
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
            if (!Formation::byNom($nomF)) {
                $pdo = App::getDb()->getPDO();
                try {
                    $pdo->beginTransaction();
                    Formation::save(
                    $nomF,$diplomeF,$intituleF,$numeroF,$siretF,$codeF,$rnF,$entrepriseF,$responsableF,$rueF,$voieF,$complementF,$postalF,$communeF,
                    $debutO,$prevuO,$dureO,$nomO,$numeroO,$siretO,$rueO,$voieO,$complementO,$postalO,$communeO,
                    $id = null);
                    $message = "La formation a été ajoutée avec succès";
                    $this->session->write('success', $message);
                    $pdo->commit();
                    $return = array("statuts" => 0, "mes" => $message);
                } catch (Exception $e) {
                    $pdo->rollBack();
                    $message = $this->error;
                    $return = array("statuts" => 1, "mes" => $message);
                }
            } else {
                $message = "Le nom de la formation existe déjà, veuillez utiliser un autre nom";
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
            $formation = Formation::find($id);
            if ($formation){
                Formation::delete($id);
                $message = "La formation a été supprimée avec succès";
                $this->session->write('success',$message);
                $return = array("statuts"=>0, "mes"=>$message);

            }else{
                $message = "La formation n'existe plus";
                $return = array("statuts"=>1, "mes"=>$message);
            }
        }else{
            $message = "Renseigner l'id SVP !!!";
            $return = array("statuts"=>1, "mes"=>$message);
        }
        echo json_encode($return);
    }



}