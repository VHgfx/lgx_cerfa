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
use Projet\Database\Profil;
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

class AdminsController extends AdminController{

    public function index(){
        $user = $this->user;
        Privilege::hasPrivilege(Privilege::$AllView,$user->privilege);
        $nbreParPage = 20;
        $profiles = Profile::searchType();
        $search = (isset($_GET['search'])&&!empty($_GET['search'])) ? $_GET['search'] : null;
        $sexe = (isset($_GET['sexe'])&&!empty($_GET['sexe'])) ? $_GET['sexe'] : null;
        $login_debut = (isset($_GET['login_debut'])&&!empty($_GET['login_debut'])) ? date(MYSQL_DATE_FORMAT, strtotime($_GET['login_debut'])) : null;
        $login_end = (isset($_GET['login_end'])&&!empty($_GET['login_end'])) ? date(MYSQL_DATE_FORMAT, strtotime($_GET['login_end'])) : null;
        $debut = (isset($_GET['debut'])&&!empty($_GET['debut'])) ? date(MYSQL_DATE_FORMAT, strtotime($_GET['debut'])) : null;
        $end = (isset($_GET['end'])&&!empty($_GET['end'])) ? date(MYSQL_DATE_FORMAT, strtotime($_GET['end'])) : null;
        $nbre = Profil::countBySearchType($search,$sexe,$debut,$end,$login_debut,$login_end);
        $nbrePages = ceil($nbre->Total / $nbreParPage);
        if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbrePages) {
            $pageCourante = $_GET['page'];
        } else {
            $pageCourante = 1;
            $params['page'] = $pageCourante;
        }
        $profils = Profil::searchType($nbreParPage,$pageCourante,$search,$sexe,$debut,$end,$login_debut,$login_end);
        $this->render('admin.admin.index',compact('profiles','profils','user','nbre','nbrePages'));
    }

    public function save(){
        header('content-type: application/json');
        $return = [];
        $tab = ["add", "edit"];
        if (isset($_POST['nom']) && !empty($_POST['nom']) &&isset($_POST['prenom']) && !empty($_POST['prenom'])
            &&isset($_POST['email'])&& isset($_POST['action']) && !empty($_POST['action']) && isset($_POST['id']) 
            && in_array($_POST["action"], $tab)) {
            $nom = trim($_POST['nom']);
            $prenom = trim($_POST['prenom']);
           
          
            $email = trim($_POST['email']);
            $action = $_POST['action'];
            $id = (int)$_POST['id'];
            $errorEmail = "Cette adresse email existe déjà, veuillez le changer";
          
            $idProfil = 3;
            $profile = Profile::find($idProfil);
            if($profile){
                if($action == "edit") {
                    Privilege::hasPrivilege(Privilege::$AllView,$this->user->privilege);
                    if (!empty($id)){
                        $profil = Profil::find($id);
                        if ($profil) {
                            $bool = true;
                           
                            
                            if(!empty($email) && $profil->email!=$email){
                                $cla = Profil::byEmail($email);
                                if($cla)
                                    $bool = false;
                            }
                            
                                if($bool){
                                    $pdo = App::getDb()->getPDO();
                                    try{
                                        $pdo->beginTransaction();
                                        Profil::save($nom,$prenom,$email,$profil->password,$profil->id);
                                        Profil::setProfile($idProfil,$profile->nom,$profile->privilege,$id);
                                        $message = "L'administrateur a été mis à jour avec succès";
                                        $this->session->write('success',$message);
                                        $pdo->commit();
                                        $return = array("statuts" => 0, "mes" => $message);
                                    }catch (Exception $e){
                                        $pdo->rollBack();
                                        $message = $this->error;
                                        $return = array("statuts" => 1, "mes" => $message);
                                    }
                                }else{
                                    $return = array("statuts" => 1, "mes" => $errorEmail);
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
                    Privilege::hasPrivilege(Privilege::$AllView,$this->user->privilege);
                   $bool = true;
                    if(!empty($email)){
                        $cla1 = Profil::byEmail($email);
                        if($cla1)
                            $bool = false;
                      }
                    
                        if($bool){
                            $pdo = App::getDb()->getPDO();
                            try{
                                $pdo->beginTransaction();
                                Profil::save($nom,$prenom,$email,sha1("0000"));
                                $idLast = Profil::lastId();
                                Profil::setProfile($idProfil,$profile->nom,$profile->privilege,$idLast);
                                $message = "L'administrateur a été ajouté avec succès";
                                $this->session->write('success',$message);
                                $pdo->commit();
                                $return = array("statuts" => 0, "mes" => $message);
                            }catch (Exception $e){
                                $pdo->rollBack();
                                $message = $this->error;
                                $return = array("statuts" => 1, "mes" => $message);
                            }
                        }else{
                            $return = array("statuts" => 1, "mes" => $errorEmail);
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

    public function genererMotDePasse($longueur = 10) {
        // Caractères autorisés
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@';
    
        // Mélanger les caractères
        $melange = str_shuffle($caracteres);
    
        // Extraire la portion souhaitée
        $motDePasse = substr($melange, 0, $longueur);
    
        return $motDePasse;
    }

    public function reset(){
        Privilege::hasPrivilege(Privilege::$AllView,$this->user->privilege);
        header('content-type: application/json');
        $return = [];
        if(isset($_POST['id']) && !empty($_POST['id'])){
            $id = $_POST['id'];
            $profil = Profil::find($id);
            if ($profil){
                $pdo = App::getDb()->getPDO();
                try{
                    $pdo->beginTransaction();

                    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@';
    
                        // Mélanger les caractères
                    $melange = str_shuffle($caracteres);
                    
                        // Extraire la portion souhaitée
                    $code= substr($melange, 0, rand(10, 15));
                   
                    
                    Profil::setPassword(sha1($code),$id);
                    if(!empty($profil->email)){
                        Email::sendEmailUser($profil->email, $profil->nom,$code);
                    }
                    $message = "Le mot de passe a été changé avec succès";
                    $this->session->write('success',$message);
                    $pdo->commit();
                    $return = array("statuts" => 0, "mes" => $message);
                }catch (Exception $e){
                    $pdo->rollBack();
                    $message = $this->error;
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

    
    

    public function activate(){
        Privilege::hasPrivilege(Privilege::$AllView,$this->user->privilege);
        header('content-type: application/json');
        $return = [];
        if(isset($_POST['id']) && !empty($_POST['id'])&&isset($_POST['etat']) && in_array($_POST['etat'],[0,1,2])){
            $id = $_POST['id'];
            $etat = $_POST['etat'];
            $profil = Profil::find($id);
            if($profil){
                $pdo = App::getDb()->getPDO();
                try{
                    $pdo->beginTransaction();
                    Profil::setEtat($etat,$id);
                    if($etat==1){
                        if(!empty($profil->email)){
                            Email::sendEmailUserActive($profil->email, $profil->nom) ;
                        }
                    }else{
                        if(!empty($profil->email)){
                            Email::sendEmailUserDesactive($profil->email, $profil->nom) ;
                        }

                       
                    }
                    $message = "L'opération s'est passée avec succès";
                    $this->session->write('success',$message);
                    $pdo->commit();
                    $return = array("statuts" => 0, "mes" => $message);
                }catch (Exception $e){
                    $pdo->rollBack();
                    $message = $this->error;
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

    public function setPhoto() {
        // Assurez-vous que l'en-tête de la réponse est défini comme texte
        header('Content-Type: text/plain');
    
        try {
            Privilege::hasPrivilege(Privilege::$AllView, $this->user->privilege);
    
            if (isset($_FILES['image']['name'])) {
                $id = DataHelper::post('idPhoto');
                
                if (isset($_FILES['image']['tmp_name']) && !empty($_FILES['image']['tmp_name']) && !is_null($id)) {
                    if ($_FILES['image']['error'] == 0) {
                        $extensions_valides = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                        $extension_upload = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));
                        
                        if (in_array($extension_upload, $extensions_valides)) {
                            if ($_FILES['image']['size'] <= 2000000) {
                                $profil = Profil::find($id);
                                if ($profil) {
                                    $pdo = App::getDb()->getPDO();
                                    $pdo->beginTransaction();
                                    
                                    $root = FileHelper::moveImage($_FILES['image']['tmp_name'], "identity", "png", "", true);
    
                                    if (!empty($profil->photo) && strpos($profil->photo, 'images') === false) {
                                        FileHelper::deleteImage($profil->photo);
                                    }
    
                                    if ($root) {
                                        Profil::setPhoto($root, $id);
                                        $success = "La photo a été mise à jour avec Succès";
                                        $this->session->write('success', $success);
                                        $pdo->commit();
                                        echo $success; // Renvoie un message de succès au format texte
                                    } else {
                                        $erreur = $this->error;
                                        echo $erreur; // Renvoie un message d'erreur au format texte
                                    }
                                } else {
                                    $erreur = 'Une erreur est survenue, rechargez et réessayez';
                                    echo $erreur; // Renvoie un message d'erreur au format texte
                                }
                            } else {
                                $erreur = 'Le fichier doit avoir une taille inférieure à 2M';
                                echo $erreur; // Renvoie un message d'erreur au format texte
                            }
                        } else {
                            $message = "Le fichier doit être une image";
                            echo $message; // Renvoie un message d'erreur au format texte
                        }
                    } else {
                        $message = "Une erreur est survenue lors de l'envoi du fichier";
                        echo $message; // Renvoie un message d'erreur au format texte
                    }
                } else {
                    $message = "Vous devez télécharger un fichier";
                    echo $message; // Renvoie un message d'erreur au format texte
                }
            } else {
                $message = "Une erreur est survenue";
                echo $message; // Renvoie un message d'erreur au format texte
            }
        } catch (Exception $e) {
            $pdo->rollBack();
            $erreur = "Une erreur est survenue lors du traitement de la requête";
            echo $erreur; // Renvoie un message d'erreur au format texte
        }
    }

    public function delete(){
        Privilege::hasPrivilege(Privilege::$AllView,$this->user->privilege);
        header('content-type: application/json');
        if (isset($_POST['id'])&&!empty($_POST['id'])){
            $id = $_POST['id'];
            $admin = Profil::find($id);
            if ($admin){
                Profil::delete($id);
                $message = "L'administrateur a été supprimée avec succès";
                $this->session->write('success',$message);
                $return = array("statuts"=>0, "mes"=>$message);

            }else{
                $message = "L'administrateur n'existe plus";
                $return = array("statuts"=>1, "mes"=>$message);
            }
        }else{
            $message = "Renseigner l'id SVP !!!";
            $return = array("statuts"=>1, "mes"=>$message);
        }
        echo json_encode($return);
    }
    

}