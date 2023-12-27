<?php

namespace Projet\Database;


use Projet\Model\Table;

class Entreprise extends Table{

    protected static $table = 'entreprise';

    public static function save($nomE,$typeE=null, $specifiqueE=null, $totalE=null, $siretE=null,   $codeaE=null,
    $codeiE=null, $rueE=null, $voieE=null, $complementE=null, $postalE=null, $communeE=null, $emailE=null, $numeroE=null, 
    $id = null){
       
        $sql = 'INSERT INTO ';
        $baseSql = self::getTable().' SET nomE = :nomE, typeE = :typeE, specifiqueE = :specifiqueE, totalE = :totalE,
         siretE = :siretE, codeaE = :codeaE, codeiE = :codeiE,
         rueE = :rueE, voieE = :voieE, complementE = :complementE, postalE = :postalE, 
         communeE = :communeE, emailE = :emailE, numeroE = :numeroE';


        $baseParam = [
        ':nomE' => $nomE,
        ':typeE' => $typeE,
        ':specifiqueE' => $specifiqueE,
        ':totalE' => $totalE,
        ':siretE' => $siretE,
        ':codeaE' => $codeaE,
        ':codeiE' => $codeiE,
        ':rueE' => $rueE,
        ':voieE' => $voieE,
        ':complementE' => $complementE,
        ':postalE' => $postalE,
        ':communeE' => $communeE,
        ':emailE' => $emailE,
        ':numeroE' => $numeroE ];

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
        $sql = self::selectString() . ' WHERE nomE = :nomE';
        $param = [':nomE' => $nom];
        return self::query($sql, $param,true);
    }

    public static function countBySearchType($search = null){
        $count = 'SELECT COUNT(*) AS Total FROM '.self::getTable();
        $where = ' WHERE 1 = 1';
        $tab = [];
        if(isset($search)){
            $tSearch = ' AND (nomE LIKE :search)';
            $tab[':search'] = '%'.$search.'%';
        }else{
            $tSearch = '';
        }
        
        

        return self::query($count.$where.$tSearch,$tab,true);
    }

    public static function searchType($nbreParPage=null,$pageCourante=null,$search = null){
        $limit = ' ORDER BY nomE ';
        $limit .= (isset($nbreParPage)&&isset($pageCourante))?' LIMIT '.(($pageCourante-1)*$nbreParPage).','.$nbreParPage:'';
        $where = ' WHERE 1 = 1';
        $tab = [];
        if(isset($search)){
            $tSearch = ' AND (nomE LIKE :search )';
            $tab[':search'] = '%'.$search.'%';
        }else{
            $tSearch = '';
        }
      
        
        return self::query(self::selectString().$where.$tSearch.$limit,$tab);
    }



 


   

}