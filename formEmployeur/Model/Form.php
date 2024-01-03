<?php

namespace Model;



use config\DbAuth;



class Form {
   
   
   public static function sendData(
    $nomA, $nomuA, $prenomA, $sexeA, $naissanceA, $departementA, $communeNA, $nationaliteA, $regimeA, 
    $situationA, $titrePA, $derniereCA, $securiteA, $intituleA, $titreOA, $declareSA, $declareHA, $declareRA,
    $rueA, $voieA, $complementA, $postalA, $communeA, $numeroA, $nomR, $emailR, $rueR, $voieR, 
    $complementR, $postalR, $communeR,
    $nomM,  $prenomM,$naissanceM ,$securiteM, $emailM, $emploiM, $diplomeM, $niveauM,
    $nomM1,  $prenomM1,$naissanceM1 ,$securiteM1, $emailM1, $emploiM1, $diplomeM1, $niveauM1
) {

   
    global $mysqlClient;

    $id = $_COOKIE['info'];

    // Vérifie si l'id est vide ou non
    if (empty($id)) {
        return [
            'error' => true,
            'message' => 'L\'id est vide',
        ];
    }

    $sqlQuery = 'UPDATE cerfa SET
        nomA = :nomA, nomuA = :nomuA, prenomA = :prenomA, sexeA = :sexeA, naissanceA = :naissanceA,
        departementA = :departementA, communeNA = :communeNA, nationaliteA = :nationaliteA, regimeA = :regimeA,
        situationA = :situationA, titrePA = :titrePA, derniereCA = :derniereCA, securiteA = :securiteA,
        intituleA = :intituleA, titreOA = :titreOA, declareSA = :declareSA, declareHA = :declareHA,
        declareRA = :declareRA, rueA = :rueA, voieA = :voieA, complementA = :complementA,
        postalA = :postalA, communeA = :communeA, numeroA = :numeroA, nomR = :nomR, emailR = :emailR,
        rueR = :rueR, voieR = :voieR, complementR = :complementR, postalR = :postalR, communeR = :communeR,
        nomM = :nomM,prenomM = :prenomM,naissanceM = :naissanceM,securiteM = :securiteM,emailM = :emailM,emploiM = :emploiM,diplomeM = :diplomeM,niveauM = :niveauM,
        nomM1 = :nomM1,prenomM1 = :prenomM1,naissanceM1 = :naissanceM1,securiteM1 = :securiteM1,emailM1 = :emailM1,emploiM1 = :emploiM1,diplomeM1 = :diplomeM1,niveauM1 = :niveauM1
        WHERE id = :id';

    try {
        $updateUser = $mysqlClient->prepare($sqlQuery);

        $updated = $updateUser->execute([
            'id' => $id,
            'nomA' => $nomA,
            'nomuA' => $nomuA,
            'prenomA' => $prenomA,
            'sexeA' => $sexeA,
            'naissanceA' => $naissanceA,
            'departementA' => $departementA,
            'communeNA' => $communeNA,
            'nationaliteA' => $nationaliteA,
            'regimeA' => $regimeA,
            'situationA' => $situationA,
            'titrePA' => $titrePA,
            'derniereCA' => $derniereCA,
            'securiteA' => $securiteA,
            'intituleA' => $intituleA,
            'titreOA' => $titreOA,
            'declareSA' => $declareSA,
            'declareHA' => $declareHA,
            'declareRA' => $declareRA,
            'rueA' => $rueA,
            'voieA' => $voieA,
            'complementA' => $complementA,
            'postalA' => $postalA,
            'communeA' => $communeA,
            'numeroA' => $numeroA,
            'nomR' => $nomR,
            'emailR' => $emailR,
            'rueR' => $rueR,
            'voieR' => $voieR,
            'complementR' => $complementR,
            'postalR' => $postalR,
            'communeR' => $communeR,

            'nomM' => $nomM,
            'prenomM' => $prenomM,
            'naissanceM' => $naissanceM,
            'securiteM' => $securiteM,
            'emailM' => $emailM,
            'emploiM' => $emploiM,
            'diplomeM' => $diplomeM,
            'niveauM' => $niveauM,
            'nomM1' => $nomM1,
            'prenomM1' => $prenomM1,
            'naissanceM1' => $naissanceM1,
            'securiteM1' => $securiteM1,
            'emailM1' => $emailM1,
            'emploiM1' => $emploiM1,
            'diplomeM1' => $diplomeM1,
            'niveauM1' => $niveauM1

        ]);

        if ($updated === 1) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        // Gérer l'exception ici, par exemple, en enregistrant le message d'erreur.
        $errorInfo = $updateUser->errorInfo();
        $errorMessage = $errorInfo[2]; // Le message d'erreur est à l'index 2 du tableau

        // Vous pouvez faire un retour spécifique en cas d'erreur si nécessaire.
        return [
            'error' => true,
            'message' => $errorMessage,
        ];
    }
}


    


    public static function isLogin() {
      
        if (isset($_SESSION['emailUser'])) {
            return true;
        }
    
        return false;
    }
}
?>