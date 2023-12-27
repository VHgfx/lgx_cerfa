<?php

namespace Projet\Database;


use Projet\Model\Table;

class Cerfa extends Table{

    protected static $table = 'cerfa';

    public static function save($idemployeur,$idformation = null,
      $nomA = null, $nomuA = null, $prenomA = null, $sexeA = null,
      $naissanceA = null, $departementA = null, $communeNA = null, 
      $nationaliteA = null, $regimeA = null, $situationA = null, $titrePA = null,
      $derniereCA = null, $securiteA = null, $intituleA = null, $titreOA = null, 
      $declareSA = null, $declareHA = null, $declareRA = null, $rueA = null, 
      $voieA = null, $complementA = null, $postalA = null, $communeA = null, 
      $numeroA = null, $emailA = null,
      $nomR = null,$emailR = null, $rueR = null, $voieR = null, $complementR = null, $postalR = null, $communeR = null, 
      $nomM = null,$prenomM = null,$naissanceM = null,$securiteM = null,$emailM = null,$emploiM = null,$diplomeM = null,$niveauM = null, 
      $nomM1 = null,$prenomM1 = null,$naissanceM1 = null,$securiteM1 = null,$emailM1= null,$emploiM1= null,$diplomeM1= null,$niveauM1 = null, 
      $travailC= null,$derogationC= null,$numeroC= null,$conclusionC= null,$debutC= null,$finC= null,$avenantC= null,$executionC= null,$dureC= null,$typeC= null,
      $rdC= null,$raC= null,$rpC= null,$rsC= null,$rdC1= null,$raC1= null,$rpC1= null,$rsC1= null,
      $rdC2= null,$raC2= null,$rpC2= null,$rsC2= null,
      $salaireC= null,$caisseC= null,$logementC= null,$avantageC= null,$autreC= null,
      $lieuO= null,$priveO= null,$attesteO= null,
      $id = null){
       
        $sql = 'INSERT INTO ';
        $baseSql = self::getTable().' SET idemployeur = :idemployeur,idformation = :idformation,
        nomA = :nomA,nomuA = :nomuA,prenomA = :prenomA,sexeA = :sexeA, naissanceA = :naissanceA,
         departementA = :departementA,communeNA = :communeNA,nationaliteA = :nationaliteA,
         regimeA = :regimeA,situationA = :situationA,titrePA = :titrePA,derniereCA = :derniereCA,
         securiteA = :securiteA,intituleA = :intituleA,titreOA = :titreOA,
         declareSA = :declareSA,declareHA = :declareHA,declareRA = :declareRA,rueA = :rueA,
         voieA = :voieA,complementA = :complementA,postalA = :postalA,communeA = :communeA,
         numeroA = :numeroA,emailA = :emailA,
         nomR = :nomR,emailR = :emailR,rueR = :rueR,voieR = :voieR,complementR = :complementR,postalR = :postalR,communeR = :communeR,
         nomM = :nomM,prenomM = :prenomM,naissanceM = :naissanceM, securiteM = :securiteM,emailM = :emailM,emploiM = :emploiM, diplomeM = :diplomeM,niveauM = :niveauM,
         nomM1 = :nomM1,prenomM1 = :prenomM1,naissanceM1 = :naissanceM1, securiteM1 = :securiteM1,emailM1 = :emailM1,emploiM1 = :emploiM1, diplomeM1 = :diplomeM1,niveauM1 = :niveauM1, 
         travailC = :travailC,derogationC = :derogationC,numeroC = :numeroC,conclusionC = :conclusionC,debutC = :debutC,finC = :finC,avenantC = :avenantC,executionC = :executionC,dureC = :dureC,
         typeC = :typeC,rdC = :rdC,raC = :raC,rpC = :rpC,rsC = :rsC,rdC1 = :rdC1,raC1 = :raC1,rpC1 = :rpC1,rsC1 = :rsC1,
         rdC2 = :rdC2,raC2 = :raC2,rpC2 = :rpC2,rsC2 = :rsC2,
         salaireC = :salaireC,caisseC = :caisseC,logementC = :logementC,
         avantageC = :avantageC,autreC = :autreC,lieuO = :lieuO,priveO = :priveO,attesteO = :attesteO
         ';


        $baseParam = [
        ':idemployeur' => $idemployeur,
        ':idformation' => $idformation,
        ':nomA' => $nomA,
        ':nomuA' => $nomuA,
        ':prenomA' => $prenomA,
        ':sexeA' => $sexeA,
        ':naissanceA' => $naissanceA,
        ':departementA' => $departementA,
        ':communeNA' => $communeNA,
        ':nationaliteA' => $nationaliteA,
        ':regimeA' => $regimeA,
        ':situationA' => $situationA,
        ':titrePA' => $titrePA,
        ':derniereCA' => $derniereCA,
        ':securiteA' => $securiteA,
        ':intituleA' => $intituleA,
        ':titreOA' => $titreOA,
        ':declareSA' => $declareSA,
        ':declareHA' => $declareHA,
        ':declareRA' => $declareRA,
        ':rueA' => $rueA,
        ':voieA' => $voieA,
        ':complementA' => $complementA,
        ':postalA' => $postalA,
        ':communeA' => $communeA,
        ':numeroA' => $numeroA,
        ':emailA' => $emailA, 
        ':nomR' => $nomR, 
        ':emailR' => $emailR, 
        ':rueR' => $rueR,
        ':voieR' => $voieR,
        ':complementR' => $complementR,
        ':postalR' => $postalR,
        ':communeR' => $communeR,
        ':nomM' => $nomM, 
        ':prenomM' => $prenomM,
        ':naissanceM' => $naissanceM,  
        ':securiteM' => $securiteM,
        ':emailM' => $emailM,
        ':emploiM' => $emploiM,
        ':diplomeM' => $diplomeM,
        ':niveauM' => $niveauM, 
        ':nomM1' => $nomM1, 
        ':prenomM1' => $prenomM1,
        ':naissanceM1' => $naissanceM1,  
        ':securiteM1' => $securiteM1,
        ':emailM1' => $emailM1,
        ':emploiM1' => $emploiM1,
        ':diplomeM1' => $diplomeM1,
        ':niveauM1' => $niveauM1,
        ':travailC' => $travailC,
        ':derogationC' => $derogationC,
        ':numeroC' => $numeroC,
        ':conclusionC' => $conclusionC,
        ':debutC' => $debutC,
        ':finC' => $finC,
        ':avenantC' => $avenantC,
        ':executionC' => $executionC,
        ':dureC' => $dureC,
        ':typeC' => $typeC,
        ':rdC' => $rdC,
        ':raC' => $raC,
        ':rpC' => $rpC,
        ':rsC' => $rsC,
        ':rdC1' => $rdC1,
        ':raC1' => $raC1,
        ':rpC1' => $rpC1,
        ':rsC1' => $rsC1,
        ':rdC2' => $rdC2,
        ':raC2' => $raC2,
        ':rpC2' => $rpC2,
        ':rsC2' => $rsC2,
        ':salaireC' => $salaireC,
        ':caisseC' => $caisseC,
        ':logementC' => $logementC,
        ':avantageC' => $avantageC,
        ':autreC' => $autreC, 
        ':lieuO' => $lieuO,
        ':priveO' => $priveO,
        ':attesteO' => $attesteO ];

        if(isset($id)){
            $sql = 'UPDATE ';
            $baseSql .= ' WHERE id = :id';
            $baseParam [':id'] = $id;
        }
        return self::query($sql.$baseSql, $baseParam, true, true);
    }

    public static function find($id){
        $sql = static::selectString().' WHERE id = :id';
        return self::query($sql,[':id'=>$id],true);
    }

    public static function byNom($nom){
        $sql = self::selectString() . ' WHERE nomA = :nomA';
        $param = [':nomA' => $nom];
        return self::query($sql, $param,true);
    }

    public static function byEmail($email){
        $sql = self::selectString() . ' WHERE emailA = :emailA';
        $param = [':emailA' => $email];
        return self::query($sql, $param,true);
    }

    public static function countBySearchType($search = null,$debut=null,$fin=null,$etat=null){
        $count = 'SELECT COUNT(*) AS Total FROM '.self::getTable();
        $where = ' WHERE 1 = 1';
        $tab = [];
        if(isset($search)){
            $tSearch = ' AND (nomA LIKE :search)';
            $tab[':search'] = '%'.$search.'%';
        }else{
            $tSearch = '';
        }
        
        

        return self::query($count.$where.$tSearch,$tab,true);
    }

    public static function searchType($nbreParPage=null,$pageCourante=null,$search = null,$debut=null,$fin=null,$etat=null){
        $limit = ' ORDER BY nomA ';
        $limit .= (isset($nbreParPage)&&isset($pageCourante))?' LIMIT '.(($pageCourante-1)*$nbreParPage).','.$nbreParPage:'';
        $where = ' WHERE 1 = 1';
        $tab = [];
        if(isset($search)){
            $tSearch = ' AND (nomA LIKE :search )';
            $tab[':search'] = '%'.$search.'%';
        }else{
            $tSearch = '';
        }
      
        
        return self::query(self::selectString().$where.$tSearch.$limit,$tab);
    }



 


   

}