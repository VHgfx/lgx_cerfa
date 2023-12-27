<?php


namespace Projet\Controller\Admin;



use Exception;

use Projet\Database\Profil;
use Projet\Database\Profile;

use Projet\Model\App;

use Projet\Model\Privilege;


class ProfileController extends AdminController{

    public function index(){
        Privilege::hasPrivilege(Privilege::$AllView,$this->user->privilege);
        $user = $this->user;
        $nbreParPage = 20;
        if(isset($_GET['search'])){
            $search = (!empty($_GET['search'])) ? $_GET['search'] : null;
            $nbre = Profile::countBySearchType($search);
            $nbrePages = ceil($nbre->Total / $nbreParPage);
            if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbrePages) {
                $pageCourante = $_GET['page'];
            } else {
                $pageCourante = 1;
                $params['page'] = $pageCourante;
            }
            $profiles = Profile::searchType($nbreParPage,$pageCourante,$search);
        }else{
            $nbre = Profile::countBySearchType();
            $nbrePages = ceil($nbre->Total / $nbreParPage);
            if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbrePages) {
                $pageCourante = $_GET['page'];
            } else {
                $pageCourante = 1;
                $params['page'] = $pageCourante;
            }
            $profiles = Profile::searchType($nbreParPage,$pageCourante);
        }
        $this->render('admin.profile.index',compact('profiles','user','nbre','nbrePages'));
    }

    public function save(){
        Privilege::hasPrivilege(Privilege::$AllView,$this->user->privilege);
        header('content-type: application/json');
        $return = [];
        $tab = ["add", "edit"];
        if (isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['privilege']) && !empty($_POST['privilege'])
            && isset($_POST['action']) && !empty($_POST['action']) && isset($_POST['id']) && in_array($_POST["action"], $tab)) {
            $nom = $_POST['nom'];
            $privilege = $_POST['privilege'];
            $explodes = explode(',',trim($privilege));
            $privileges = "";
            $i=0;
            foreach ($explodes as $explode) {
                if(Privilege::isPrivilege(trim($explode))){
                    $privileges .= $i==0?trim($explode):','.trim($explode);
                    $i++;
                }
            }
            $action = $_POST['action'];
            $id = $_POST['id'];
            if(!empty($privileges)){
                if($action == "edit") {
                    if (!empty($id)){
                        $item = Profile::find($id);
                        if ($item) {
                            $pdo = App::getDb()->getPDO();
                            try{
                                $pdo->beginTransaction();
                                Profile::save($nom,$privileges,$item->id);
                                $admins = Profil::searchType(null,null,null,null,null,null,null,null,$item->id);
                                foreach ($admins as $admin) {
                                    Profil::setProfile($id,$nom,$privileges,$admin->id);
                                }
                                $message = "Le profil a été mis à jour avec succès";
                                $this->session->write('success',$message);
                                $pdo->commit();
                                $return = array("statuts" => 0, "mes" => $message);
                            }catch (Exception $e){
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
                    $pdo = App::getDb()->getPDO();
                    try{
                        $pdo->beginTransaction();
                        Profile::save($nom,$privileges);
                        $message = "Le profil a été ajouté avec succès";
                        $this->session->write('success',$message);
                        $pdo->commit();
                        $return = array("statuts" => 0, "mes" => $message);
                    }catch (Exception $e){
                        $pdo->rollBack();
                        $message = $this->error;
                        $return = array("statuts" => 1, "mes" => $message);
                    }
                }
            }else{
                $message = $this->error;
                $return = array("statuts" => 1, "mes" => $message);
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
        $return = [];
        if(isset($_POST['id']) && !empty($_POST['id'])){
            $id = $_POST['id'];
            $profile = Profile::find($id);
            if($profile){
                $nbre = Profil::countByIdProfile($id);
                if($nbre->Total==0){
                    $pdo = App::getDb()->getPDO();
                    try{
                        $pdo->beginTransaction();
                        Profile::delete($id);
                        $message = "Le profil a été supprimé avec succès";
                        $this->session->write('success',$message);
                        $pdo->commit();
                        $return = array("statuts" => 0, "mes" => $message);
                    }catch (Exception $e){
                        $pdo->rollBack();
                        $message = $this->error;
                        $return = array("statuts" => 1, "mes" => $message);
                    }
                }else{
                    $message = "Le profil ne peut être supprimé car contient des administrateurs";
                    $return = array("statuts" => 1, "mes" => $message);
                }
            }else{
                $message = $this->error;
                $return = array("statuts" => 1, "mes" => $message);
            }
        }else{
            $message = $this->error;
            $return = array("statuts" => 1, "mes" => $message);
        }
        echo json_encode($return);
    }

}