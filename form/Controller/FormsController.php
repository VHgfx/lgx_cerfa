<?php
use Model\Form;

class FormsController {
    public function index() {
        // Logique du contrôleur pour la page de connexion
        include 'Views/form.php';
    }

    public function sendData() {
    // Récupérez toutes les données du formulaire
    $nomA = $_POST['nomA'];
    $nomuA = $_POST['nomuA'];
    $prenomA = $_POST['prenomA'];
    $sexeA = $_POST['sexeA'];
    $naissanceA = $_POST['naissanceA'];
    $departementA = $_POST['departementA'];
    $communeNA = $_POST['communeNA'];
    $nationaliteA = $_POST['nationaliteA'];
    $regimeA = $_POST['regimeA'];
    $situationA = $_POST['situationA'];
    $titrePA = $_POST['titrePA'];
    $derniereCA = $_POST['derniereCA'];
    $securiteA = $_POST['securiteA'];
    $intituleA = $_POST['intituleA'];
    $titreOA = $_POST['titreOA'];
    $declareSA = $_POST['declareSA'];
    $declareHA = $_POST['declareHA'];
    $declareRA = $_POST['declareRA'];
    $rueA = $_POST['rueA'];
    $voieA = $_POST['voieA'];
    $complementA = $_POST['complementA'];
    $postalA = $_POST['postalA'];
    $communeA = $_POST['communeA'];
    $numeroA = $_POST['numeroA'];
    $nomR = $_POST['nomR'];
    $emailR = $_POST['emailR'];
    $rueR = $_POST['rueR'];
    $voieR = $_POST['voieR'];
    $complementR = $_POST['complementR'];
    $postalR = $_POST['postalR'];
    $communeR = $_POST['communeR'];

    // Assurez-vous que les données requises sont définies, par exemple, nom et prénom
    if (!empty($nomA) && !empty($prenomA)) {
        // Maintenant, appelez la méthode `sendData` en passant toutes les données
        $result = Form::sendData(
            $nomA, $nomuA, $prenomA, $sexeA, $naissanceA, $departementA, $communeNA, $nationaliteA, $regimeA, 
            $situationA, $titrePA, $derniereCA, $securiteA, $intituleA, $titreOA, $declareSA, $declareHA, $declareRA,
            $rueA, $voieA, $complementA, $postalA, $communeA, $numeroA, $nomR, $emailR, $rueR, $voieR, 
            $complementR, $postalR, $communeR
        );

        if ($result) {
               echo "Le formulaire a été soumis avec 'succès'";
        } else {
            echo "Une erreur s'est produite lors de l'envoi des données  ";
        }
    } else {
        echo "Veuillez remplir les champs obligatoires.";
    }
}

}
?>