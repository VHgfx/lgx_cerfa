<?php


namespace Projet\Controller\Batiment;



use Projet\Controller\Admin\AdminsController;

use Projet\Database\Bureau;
use Projet\Database\Entreprise;
use Projet\Database\Formation;
use Projet\Database\Salle;
use Projet\Database\Test;
use Projet\Model\App;
use Projet\Model\Email;
use Projet\Model\Privilege;
use Exception;


class BureauController extends AdminsController
{
    public function index(){
        Privilege::hasPrivilege(Privilege::$AllView,$this->user->privilege);
        $user = $this->user;
        $nbreParPage = 10;
        $search = (isset($_GET['search'])&&!empty($_GET['search'])) ? $_GET['search'] : null;
        $nbre = Bureau::countBySearchType($search);
        $nbrePages = ceil($nbre->Total / $nbreParPage);
        if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbrePages) {
            $pageCourante = $_GET['page'];
        } else {
            $pageCourante = 1;
            $params['page'] = $pageCourante;
        }
        $items = Bureau::searchType($nbreParPage,$pageCourante,$search);
       
        $this->render('admin.batiment.bureau',compact('search','user','nbre','nbrePages','items'));
    }


    public function save(){
       
        header('content-type: application/json');
        $return = [];
        $tab = ["add", "edit"];
        if (isset($_POST['nom']) && !empty($_POST['nom']) &&isset($_POST['type']) && !empty($_POST['type']) 
        &&isset($_POST['couleur']) && !empty($_POST['couleur'])&&
             isset($_POST['action']) && !empty($_POST['action']) && isset($_POST['id']) 
            && in_array($_POST["action"], $tab)) {
            $nom = trim($_POST['nom']);
            $couleur = trim($_POST['couleur']);
            $type = trim($_POST['type']);
            $action = $_POST['action'];
            $id = (int)$_POST['id'];
            $errorNom = "Ce nom existe déjà, veuillez le changer";
         
            
            
            
                
                if($action == "edit") {
                    Privilege::hasPrivilege(Privilege::$AllView,$this->user->privilege);
                    if (!empty($id)){
                        $bureau = Bureau::find($id);
                       
                            $bool1 = true;
                            if($bureau->nom!=$nom){
                                $cla = Bureau::byNom($numero);
                                if($cla)
                                    $bool1 = false;
                            }
                            
                            if($bool1){
                               
                                       
                                        $pdo = App::getDb()->getPDO();
                                        try{
                                            $pdo->beginTransaction();
                                            Bureau::save($nom,$type,$couleur,$id);
                                            $message = "Le bureau a été mis à jour avec succès";
                                            $this->session->write('success',$message);
                                            $pdo->commit();
                                            $return = array("statuts" => 0, "mes" => $message);
                                        }catch (Exception $e){
                                            $pdo->rollBack();
                                            $message = $this->error;
                                            $return = array("statuts" => 1, "mes" => $message);
                                        }
                                       
                               
                            }else{
                                $return = array("statuts" => 1, "mes" => $errorNom);
                            }
                        
                    } else {
                        $message = $this->error;
                        $return = array("statuts" => 1, "mes" => $message);
                    }
                } else {
                    Privilege::hasPrivilege(Privilege::$AllView,$this->user->privilege);
                    $bool1 = true;
                    $cla = Bureau::byNom($nom);
                    if($cla)
                        $bool1 = false;
                   
                    
                    if($bool1){
                       
                                $pdo = App::getDb()->getPDO();
                                    try{
                                        $pdo->beginTransaction();
                                       
                                        
                                        Bureau::save($nom,$type,$couleur);
                                        
                                        $message = "Le bureau a été ajouté avec succès";
                                        $this->session->write('success',$message);
                                        $pdo->commit();
                                        $return = array("statuts" => 0, "mes" => $message);
                                    }catch (Exception $e){
                                        $pdo->rollBack();
                                        $message = $this->error;
                                        $return = array("statuts" => 1, "mes" => $message);
                                    }
                                
                        
                    }else{
                        $return = array("statuts" => 1, "mes" => $errorNom);
                    }
                }
            
        } else {
            $message = "Veiullez renseigner tous les champs requis";
            $return = array("statuts" => 1, "mes" => $message);
        }
        echo json_encode($return);
    }




   

public function delete(){
        Privilege::hasPrivilege(Privilege::$AllView,$this->user->privilege);
        header('content-type: application/json');
        if (isset($_POST['id'])&&!empty($_POST['id'])){
            $id = $_POST['id'];
            $bureau = Bureau::find($id);
            if ($bureau){
                Bureau::delete($id);
                $message = "Le bureau a été supprimée avec succès";
                $this->session->write('success',$message);
                $return = array("statuts"=>0, "mes"=>$message);

            }else{
                $message = "Le bureau n'existe plus";
                $return = array("statuts"=>1, "mes"=>$message);
            }
        }else{
            $message = "Renseigner l'id SVP !!!";
            $return = array("statuts"=>1, "mes"=>$message);
        }
        echo json_encode($return);
    }

  
}