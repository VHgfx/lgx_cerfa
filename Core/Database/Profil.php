<?php


namespace Projet\Database;


use Projet\Model\Table;

class Profil extends Table{

    protected static $table = 'user';

    public static function save($nom,$prenom,$email,$password,$id=null){
        $sql = 'INSERT INTO ';
        $baseSql = self::getTable().' SET prenom = :prenom,
            nom = :nom,email = :email,password = :password';
        $baseParam = [':prenom' => $prenom,':nom' => $nom,
            ':email' => $email,':password' => $password];
        if(isset($id)){
            $sql = 'UPDATE ';
            $baseSql .= ' WHERE id = :id';
            $baseParam [':id'] = $id;
        }
        return self::query($sql.$baseSql, $baseParam, true, true);
    }


    public static function countByIdProfile($idProfile) {
        $sql = 'SELECT COUNT(*) AS Total FROM ' . static::getTable() . ' WHERE idProfile = :idProfile';
        $params = [':idProfile' => $idProfile];
        return self::query($sql, $params,true);
    }

    public static function setLast_login($date, $id) {
        $sql = 'UPDATE ' . self::getTable() . ' SET last_login = :updated WHERE id = :id ';
        $params = [':updated' => $date, ':id' => $id];
        $result =  self::query($sql, $params,true,true);
        
        // Execute the update query
        if ($result) {
            return true; // Update successful
        } else {
            // Handle the update failure (e.g., return false or throw an exception)
            return false;
        }
    }
    


    public static function setCreatedAt($created_at,$id){
        $sql = 'UPDATE '.self::getTable().' SET created_at = :created_at WHERE id = :id';
        $param = [':created_at'=>($created_at),':id'=>($id)];
        return self::query($sql,$param,true,true);
    }

  

   

 

  

    

    

   

    public static function setProfile($idProfile,$libProfile,$privilege,$id){
        $sql = 'UPDATE '.self::getTable().' SET idProfile = :idProfile,libProfile = :libProfile,privilege = :privilege WHERE id = :id';
        $param = [':idProfile'=>($idProfile),':libProfile'=>($libProfile),':privilege'=>($privilege),':id'=>($id)];
        return self::query($sql,$param,true,true);
    }

    public static function setPrivilege($privilege,$id){
        $sql = 'UPDATE '.self::getTable().' SET privilege = :privilege WHERE id = :id ';
        $param = [':privilege'=>($privilege),':id'=>($id)];
        return self::query($sql,$param,true,true);
    }

    
    public static function setEtat($etat,$id){
        $sql = 'UPDATE '.self::getTable().' SET etat = :etat WHERE id = :id';
        $param = [':etat'=>($etat),':id'=>($id)];
        return self::query($sql,$param,true,true);
    }

       public static function setPhoto($photo,$id){
        
        $sql = 'UPDATE '.self::getTable().' SET photo = :photo WHERE id = :id';
        $param = [':photo'=>($photo),':id'=>($id)];
        return self::query($sql,$param,true,true);
    }

    public static function setPassword($password,$id){
        $sql = 'UPDATE '.self::getTable().' SET password = :password WHERE id = :id';
        $param = [':password'=>($password),':id'=>($id)];
        return self::query($sql,$param,true);
    }

   

    public static function byEmail($email){
        $sql = self::selectString() . ' WHERE email = :email';
        $param = [':email' => $email];
        return self::query($sql, $param,true);
    }

   


  
    public static function countBySearchType($search = null, $sexe = null, $debut = null, $fin = null, $conDebut = null, $conFin = null, $idProfile = null) {
        $count = 'SELECT COUNT(*) AS Total FROM ' . self::getTable();
        $where = ''; // On initialise la clause WHERE à une chaîne vide
        $tab = [];
    
        if (isset($search)) {
            $tSearch = ' AND (nom LIKE :search OR prenom LIKE :search OR  email LIKE :search)';
            $tab[':search'] = '%' . $search . '%';
            $where .= $tSearch; // On ajoute la condition à $where
        }
    
        if (isset($debut)) {
            $tDebut = ' AND DATE(created_at) >= :debut';
            $tab[':debut'] = $debut;
            $where .= $tDebut; // On ajoute la condition à $where
        }
    
        if (isset($fin)) {
            $tFin = ' AND DATE(created_at) <= :fin';
            $tab[':fin'] = $fin;
            $where .= $tFin; // On ajoute la condition à $where
        }
    
        if (isset($conDebut)) {
            $tDebutCon = ' AND DATE(last_login) >= :debutCon';
            $tab[':debutCon'] = $conDebut;
            $where .= $tDebutCon; // On ajoute la condition à $where
        }
    
        if (isset($conFin)) {
            $tFinCon = ' AND DATE(last_login) <= :finCon';
            $tab[':finCon'] = $conFin;
            $where .= $tFinCon; // On ajoute la condition à $where
        }
    
       
    
        if (isset($idProfile)) {
            $tidProfile = ' AND idProfile = :idProfile';
            $tab[':idProfile'] = $idProfile;
            $where .= $tidProfile; // On ajoute la condition à $where
        }
    
        if (!empty($where)) {
            $where = ' WHERE 1 = 1' . $where; // On ajoute la clause WHERE uniquement s'il y a des conditions
        }
    
        return self::query($count . $where, $tab, true);
    }
    

    public static function searchType($nbreParPage=null,$pageCourante=null,$search = null,$sexe = null,$debut=null,$fin=null,$conDebut = null, $conFin = null, $idProfile = null){
        $limit = ' ORDER BY nom ASC, prenom ASC, last_login DESC,created_at DESC';
        $limit .= (isset($nbreParPage)&&isset($pageCourante))?' LIMIT '.(($pageCourante-1)*$nbreParPage).','.$nbreParPage:'';
        $where = ' WHERE 1 = 1';
        $tab = [];
        if(isset($search)){
            $tSearch = ' AND (nom LIKE :search OR prenom LIKE :search  OR email LIKE :search)';
            $tab[':search'] = '%'.$search.'%';
        }else{
            $tSearch = '';
        }
        if(isset($debut)){
            $tDebut = ' AND DATE(created_at) >= :debut';
            $tab[':debut'] = $debut;
        }else{
            $tDebut = '';
        }
        if(isset($fin)){
            $tFin = ' AND DATE(created_at) <= :fin';
            $tab[':fin'] = $fin;
        }else{
            $tFin = '';
        }
        if(isset($conDebut)){
            $tDebutCon = ' AND DATE(last_login) >= :debutCon';
            $tab[':debutCon'] = $conDebut;
        }else{
            $tDebutCon = '';
        }
        if(isset($conFin)){
            $tFinCon = ' AND DATE(last_login) <= :finCon';
            $tab[':finCon'] = $conFin;
        }else{
            $tFinCon = '';
        }
        
        if(isset($idProfile)){
            $tidProfile = ' AND idProfile = :idProfile';
            $tab[':idProfile'] = $idProfile;
        }else{
            $tidProfile = '';
        }
        return self::query(self::selectString().$where.$tSearch.$tDebut.$tidProfile.$tFin.$tDebutCon.$tFinCon.$limit,$tab);
    }

}