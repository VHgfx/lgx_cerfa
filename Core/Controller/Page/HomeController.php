<?php


namespace Projet\Controller\Page;



use Projet\Database\Profil;
use Projet\Model\App;


class HomeController extends PageController{
    
    public function index(){
        $this->check();
        $this->render('page.home.index');
    }

    public function error(){
        $this->session->write('danger',"You are requesting a resource that does not exist");
        $this->render('page.home.error');
    }

    public function unauthorize(){
        $this->session->write('danger',"You do not have permission to access this resource");
        $this->render('page.home.unauthorize');
    }

    public function logout(){
        $_SESSION = array();
        if(App::getDBAuth()->signOut()){
            App::redirect(App::url(""));
        }
    }

    public function log(){
        $return = '';
        header('Content-Type: text/plain');
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];
            if (!empty($login) && !empty($password)) {
                $conMessage = App::getDBAuth()->login($login, $password);
                if (is_bool($conMessage)) {
                    $lastUrl = empty($this->session->read('lastUrlAsked')) ? App::url('home') : $this->session->read('lastUrlAsked');
                    $this->session->delete('lastUrlAsked');
                    $return = $lastUrl;
                } else {
                    $return = $conMessage;
                }
            } else {
                $message = "Please fill in all required fields";
                $return = $message;
            }
        } else {
            $message = "Invalid request"; 
            $return = $message;
        }
        echo $return;
    }
    
    
}