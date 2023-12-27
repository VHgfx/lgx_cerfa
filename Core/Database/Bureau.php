<?php

namespace Projet\Database;


use Projet\Model\Table;

class Bureau extends Table{

    protected static $table = 'bureau';

    public static function save($nom,$type,$couleur, $id = null){
       
        $sql = 'INSERT INTO ';
        $baseSql = self::getTable().' SET nom = :nom, type = :type, couleur = :couleur';

        $baseParam = [
        ':nom' => $nom,
        ':type' => $type,
        ':couleur' => $couleur
       ];

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
        $sql = self::selectString() . ' WHERE nom = :nom';
        $param = [':nom' => $nom];
        return self::query($sql, $param,true);
    }

    public static function byCouleur($couleur){
        $sql = self::selectString() . ' WHERE couleur = :couleur';
        $param = [':couleur' => $couleur];
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
            $tSearch = ' AND (nom LIKE :search)';
            $tab[':search'] = '%'.$search.'%';
        }else{
            $tSearch = '';
        }
        
        

        return self::query($count.$where.$tSearch,$tab,true);
    }

    public static function searchType($nbreParPage=null,$pageCourante=null,$search = null,$debut=null,$fin=null,$etat=null){
        $limit = ' ORDER BY nom ';
        $limit .= (isset($nbreParPage)&&isset($pageCourante))?' LIMIT '.(($pageCourante-1)*$nbreParPage).','.$nbreParPage:'';
        $where = ' WHERE 1 = 1';
        $tab = [];
        if(isset($search)){
            $tSearch = ' AND (nom LIKE :search )';
            $tab[':search'] = '%'.$search.'%';
        }else{
            $tSearch = '';
        }
      
        
        return self::query(self::selectString().$where.$tSearch.$limit,$tab);
    }



 


   

}