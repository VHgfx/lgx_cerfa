<?php

namespace Projet\Database;


use Projet\Model\Table;

class Formation extends Table{

    protected static $table = 'formation';

    public static function save(
      $nomF,$diplomeF= null,$intituleF= null,$numeroF= null,$siretF= null,$codeF= null,$rnF= null,$entrepriseF= null,$responsableF= null,$rueF= null,$voieF= null,$complementF= null,$postalF= null,$communeF= null,
      $debutO= null,$prevuO= null,$dureO= null,$nomO= null,$numeroO= null,$siretO= null,$rueO= null,$voieO= null,$complementO= null,$postalO= null,$communeO= null,
      $id = null){
       
        $sql = 'INSERT INTO ';
        $baseSql = self::getTable().' SET 
         nomF = :nomF,diplomeF = :diplomeF,intituleF = :intituleF,numeroF = :numeroF,siretF = :siretF,codeF = :codeF,rnF = :rnF,entrepriseF = :entrepriseF,
         responsableF = :responsableF,rueF = :rueF,voieF = :voieF,complementF = :complementF,postalF = :postalF,communeF = :communeF,debutO = :debutO,prevuO = :prevuO,dureO = :dureO,
         nomO = :nomO,numeroO = :numeroO,siretO = :siretO,rueO = :rueO,voieO = :voieO,complementO = :complementO,postalO = :postalO,communeO = :communeO
         ';


        $baseParam = [ 
        ':nomF' => $nomF,
        ':diplomeF' => $diplomeF,
        ':intituleF' => $intituleF, 
        ':numeroF' => $numeroF,
        ':siretF' => $siretF,
        ':codeF' => $codeF,
        ':rnF' => $rnF,
        ':entrepriseF' => $entrepriseF,
        ':responsableF' => $responsableF,
        ':rueF' => $rueF,
        ':voieF' => $voieF,
        ':complementF' => $complementF,
        ':postalF' => $postalF,
        ':communeF' => $communeF,
        ':debutO' => $debutO,
        ':prevuO' => $prevuO,
        ':dureO' => $dureO,
        ':nomO' => $nomO,
        ':numeroO' => $numeroO,
        ':siretO' => $siretO,
        ':rueO' => $rueO,
        ':voieO' => $voieO,
        ':complementO' => $complementO,
        ':postalO' => $postalO,
        ':communeO' => $communeO ];

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
        $sql = self::selectString() . ' WHERE nomF = :nomF';
        $param = [':nomF' => $nom];
        return self::query($sql, $param,true);
    }

    public static function countBySearchType($search = null){
        $count = 'SELECT COUNT(*) AS Total FROM '.self::getTable();
        $where = ' WHERE 1 = 1';
        $tab = [];
        if(isset($search)){
            $tSearch = ' AND (nomF LIKE :search)';
            $tab[':search'] = '%'.$search.'%';
        }else{
            $tSearch = '';
        }


        return self::query($count.$where.$tSearch,$tab,true);
    }

    public static function searchType($nbreParPage=null,$pageCourante=null,$search = null){
        $limit = ' ORDER BY nomF ';
        $limit .= (isset($nbreParPage)&&isset($pageCourante))?' LIMIT '.(($pageCourante-1)*$nbreParPage).','.$nbreParPage:'';
        $where = ' WHERE 1 = 1';
        $tab = [];
        if(isset($search)){
            $tSearch = ' AND (nomF LIKE :search )';
            $tab[':search'] = '%'.$search.'%';
        }else{
            $tSearch = '';
        }
        
        
        return self::query(self::selectString().$where.$tSearch.$limit,$tab);
    }



 


   

}