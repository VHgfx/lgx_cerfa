<?php
/**
 * Created by PhpStorm.
 * Eleve: Ndjeunou
 * Date: 23/01/2017
 * Time: 09:19
 */

namespace Projet\Controller\Admin;


use DateTime;
use Exception;
use Projet\Database\affiliate_project;
use Projet\Database\affiliate_user;
use Projet\Database\Alternant;

use Projet\Database\category;
use Projet\Database\Cerfa;
use Projet\Database\checkout_orders;
use Projet\Database\Contact;
use Projet\Database\council;
use Projet\Database\customer_project;
use Projet\Database\Entreprise;
use Projet\Database\Formation;
use Projet\Database\orders;
use Projet\Database\products;
use Projet\Database\Profile;
use Projet\Database\project_payment;
use Projet\Database\Question;
use Projet\Database\schedule_meeting;
use Projet\Database\subcategory;
use Projet\Database\Profil;
use Projet\Database\Test;
use Projet\Database\users;
use Projet\Database\Visite;
use Projet\Database\withdraw_request;
use Projet\Model\App;
use Projet\Model\DateParser;
use Projet\Model\Privilege;
use Projet\Model\StringHelper;

class HomeController extends AdminController{
    
    public function index(){
        $user = $this->user;
        Privilege::hasPrivilege(Privilege::$AllView,$user->privilege);
        $search = (isset($_GET['search'])&&!empty($_GET['search'])) ? $_GET['search'] : null;
        $sexe = (isset($_GET['sexe'])&&!empty($_GET['sexe'])) ? $_GET['sexe'] : null;
        $login_debut = (isset($_GET['login_debut'])&&!empty($_GET['login_debut'])) ? date(MYSQL_DATE_FORMAT, strtotime($_GET['login_debut'])) : null;
        $login_end = (isset($_GET['login_end'])&&!empty($_GET['login_end'])) ? date(MYSQL_DATE_FORMAT, strtotime($_GET['login_end'])) : null;
        $debut = (isset($_GET['debut'])&&!empty($_GET['debut'])) ? date(MYSQL_DATE_FORMAT, strtotime($_GET['debut'])) : null;
        $end = (isset($_GET['end'])&&!empty($_GET['end'])) ? date(MYSQL_DATE_FORMAT, strtotime($_GET['end'])) : null;
        $nbreadmins = Profil::countBySearchType($search,$sexe,$debut,$end,$login_debut,$login_end);
        $nbrealternants = Alternant::countBySearchType();
        $nbreformations = Formation::countBySearchType();
        $nbreemployeurs = Entreprise::countBySearchType();
        $nbrecerfas = Cerfa::countBySearchType();
        $_SESSION['page_active'] = 'home';
        $current = date(DATE_FORMAT);
        $this->render('admin.user.index',compact('user','current','nbreadmins','nbrealternants','nbrecerfas','nbreemployeurs','nbreformations'));
       
    }

  


    public function password(){
        $user = $this->user;
        $this->render('admin.user.password',compact('user'));
    }

    public function changePassword(){
        $return = [];
        header('content-type: application/json');
        if (isset($_POST['oldpassword'])  && !empty($_POST['oldpassword']) && isset($_POST['newpassword'])
            && !empty($_POST['newpassword']) && isset($_POST['confirmpassword']) && !empty($_POST['confirmpassword'])){
            $user = $this->user;
            $oldpass = $_POST['oldpassword'];
            $newpass = $_POST['newpassword'];
            $confirmpass = $_POST['confirmpassword'];
            if($user->password == sha1($oldpass)){
                if ($newpass == $confirmpass){
                    $pdo = App::getDb()->getPDO();
                    try{
                        $pdo->beginTransaction();
                        Profil::setPassword(sha1($newpass),$user->id);
                        $message = "Votre mot de passe a été modifié avec succès";
                        $pdo->commit();
                        $return = array("statuts"=>0, "mes"=>$message);
                    }catch(Exception $e){
                        $pdo->rollBack();
                        $message = "Une erreur est survenue, réessayer";
                        $return = array("statuts"=>1, "mes"=>$message);
                    }
                }else{
                    $message = "Le nouveau mot de passe doit être identique à la confirmation";
                    $return = array("statuts"=>1, "mes"=>$message);
                }
            }else{
                $message = "Votre mot de passe actuel est incorrect";
                $return = array("statuts"=>1, "mes"=>$message);
            }
        }else{
            $message = "Une erreur est survenue, réessayer";
            $return = array("statuts"=>1, "mes"=>$message);
        }
        echo json_encode($return);
    }


    public function session(){
       
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Assurez-vous que 'page' est défini dans les données POST
            if (isset($_POST['page'])) {
                // Mettez à jour la session avec la nouvelle valeur
                $_SESSION['page_active'] = $_POST['page'];
        
                // Envoyez une réponse pour indiquer le succès
                echo 'Session mise à jour avec succès.';
            } else {
                // Envoyez une réponse d'erreur si 'page' n'est pas défini
                http_response_code(400);
                echo 'Erreur: Paramètre manquant.';
            }
        } else {
            // Envoyez une réponse d'erreur si la requête n'est pas de type POST
            http_response_code(405);
            echo 'Erreur: Méthode non autorisée.';
        }
    }




  

}