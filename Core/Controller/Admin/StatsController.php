<?php


namespace Projet\Controller\Admin;


use Exception;


use Mpdf\Mpdf;
use Mpdf\MpdfException;
use Projet\Database\Candidat;
use Projet\Database\Cerfa;
use Projet\Database\Entreprise;
use Projet\Database\Formation;
use Projet\Database\Profil;
use Projet\Database\Question;
use Projet\Database\Salle;
use Projet\Database\Test;
use Projet\Model\DateParser;
use Projet\Model\FileHelper;
use Projet\Model\Privilege;
use TCPDF;









class StatsController extends AdminController {
   


    public function cerfas()
    {
        Privilege::hasPrivilege(Privilege::$AllView, $this->user->privilege);
    
       
        $data = (isset($_GET['data']) && !empty($_GET['data'])) ? $_GET['data'] : null;
        
        
        $cerfas = Cerfa::find( base64_decode( $data ) );

        $ligneemployeur = Entreprise::find( $cerfas->idemployeur);
        $ligneformation = Formation::find( $cerfas->idformation);
        
        
    
        // Chemin vers le modèle de PDF dans les assets
        $pdfTemplatePaths = [
            
            FileHelper::url('assets/pdf/cerfa1.jpg'),
            FileHelper::url('assets/pdf/cerfa2.jpg'),
            
        ];
    
        try {
            // Créer une instance de TCPDF
            $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
    
            // Paramètres de page
            $pdf->SetMargins(0, 0, 0);
            $pdf->SetAutoPageBreak(true, 0);
    
            // Compteur de page
            $pageNumber = 1;
    
            // Insérer les informations sur chaque page
            foreach ($pdfTemplatePaths as $templatePath) {
                $pdf->AddPage();
    
                // Charger le modèle PDF pour cette page
                $pdf->Image($templatePath, 0, 0, $pdf->getPageWidth(), $pdf->getPageHeight(), 'JPEG');
    
             
    
                // Insérer les informations de Cerfa à la position spécifiée
                $pdf->SetFont('helvetica', '', 14);
    
                // Afficher l'information en fonction du numéro de page
                if ($pageNumber == 1) {


                    if($cerfas->priveO == "oui"){
                        $pdf->SetXY(77, 29.3);
                        $pdf->Cell(0, 10,  "x", 0, 1, 'L');
                    }elseif($cerfas->priveO == "non"){
                        $pdf->SetXY(123, 29.3);
                        $pdf->Cell(0, 10,  "x", 0, 1, 'L');
                    }

                    $pdf->SetXY(10, 39);
                    $pdf->Cell(0, 10,  $ligneemployeur->nomE, 0, 1, 'L');
                    
    
                    $pdf->SetXY(105, 39);
                    $pdf->Cell(0, 10,  $ligneemployeur->siretE, 0, 1, 'L');


                    $pdf->SetXY(140, 43);
                    $pdf->Cell(0, 10,  $ligneemployeur->typeE, 0, 1, 'L');



                    $pdf->SetXY(145, 48);
                    $pdf->Cell(0, 10,  $ligneemployeur->specifiqueE, 0, 1, 'L');


                    $pdf->SetXY(168, 55);
                    $pdf->Cell(0, 10,  $ligneemployeur->codeaE, 0, 1, 'L');



                    $pdf->SetXY(105, 65.5);
                    $pdf->Cell(0, 10,  $ligneemployeur->totalE, 0, 1, 'L');


                    $pdf->SetXY(105, 79.2);
                    $pdf->Cell(0, 10,  $ligneemployeur->codeiE, 0, 1, 'L');




                    $pdf->SetXY(15, 48);
                    $pdf->Cell(0, 10,  $ligneemployeur->rueE, 0, 1, 'L');



                    $pdf->SetXY(55, 48);
                    $pdf->Cell(0, 10,  $ligneemployeur->voieE, 0, 1, 'L');



                    $pdf->SetXY(33, 55);
                    $pdf->Cell(0, 10,  $ligneemployeur->complementE, 0, 1, 'L');



                    $pdf->SetXY(33, 61);
                    $pdf->Cell(0, 10,  $ligneemployeur->postalE, 0, 1, 'L');


                    $pdf->SetXY(33, 67);
                    $pdf->Cell(0, 10,  $ligneemployeur->communeE, 0, 1, 'L');


                    $pdf->SetXY(33, 73.5);
                    $pdf->Cell(0, 10,  $ligneemployeur->numeroE, 0, 1, 'L');


                    $pdf->SetXY(33, 79);
                    $pdf->Cell(0, 10,  $ligneemployeur->emailE, 0, 1, 'L');

                    $pdf->SetXY(75, 101.2);
                    $pdf->Cell(0, 10,  $cerfas->nomA, 0, 1, 'L');

                    $pdf->SetXY(37, 107);
                    $pdf->Cell(0, 10,  $cerfas->nomuA, 0, 1, 'L');

                    $pdf->SetXY(103, 112.5);
                    $pdf->Cell(0, 10,  $cerfas->prenomA, 0, 1, 'L');

                    $pdf->SetXY(46, 119);
                    $pdf->Cell(0, 10,  $cerfas->securiteA, 0, 1, 'L');

                    $pdf->SetXY(12.6, 129.5);
                    $pdf->Cell(0, 10,  $cerfas->rueA, 0, 1, 'L');

                    $pdf->SetXY(37, 129.8);
                    $pdf->Cell(0, 10,  $cerfas->voieA, 0, 1, 'L');

                    $pdf->SetXY(35, 136);
                    $pdf->Cell(0, 10,  $cerfas->complementA, 0, 1, 'L');

                    $pdf->SetXY(33, 142);
                    $pdf->Cell(0, 10,  $cerfas->postalA, 0, 1, 'L');

                    $pdf->SetXY(32, 148.8);
                    $pdf->Cell(0, 10,  $cerfas->communeA, 0, 1, 'L');

                    $pdf->SetXY(31, 155);
                    $pdf->Cell(0, 10,  $cerfas->numeroA, 0, 1, 'L');

                    $pdf->SetXY(27, 160.5);
                    $pdf->Cell(0, 10,  $cerfas->emailA, 0, 1, 'L');


                    $pdf->SetXY(8.5, 184);
                    $pdf->Cell(0, 10,  $cerfas->nomR, 0, 1, 'L');


                    $pdf->SetXY(13, 193.5);
                    $pdf->Cell(0, 10,  $cerfas->rueR, 0, 1, 'L');

                    $pdf->SetXY(37, 193.5);
                    $pdf->Cell(0, 10,  $cerfas->voieR, 0, 1, 'L');

                    $pdf->SetXY(34, 199.7);
                    $pdf->Cell(0, 10,  $cerfas->complementR, 0, 1, 'L');

                    $pdf->SetXY(33, 205.5);
                    $pdf->Cell(0, 10,  $cerfas->postalR, 0, 1, 'L');

                    $pdf->SetXY(30, 211.7);
                    $pdf->Cell(0, 10,  $cerfas->communeR, 0, 1, 'L');

                    $pdf->SetXY(27, 217.5);
                    $pdf->Cell(0, 10,  $cerfas->emailR, 0, 1, 'L');

                    if ($cerfas->naissanceA == '') {

                    }else{
                        $date_formatee = date("d/m/Y", strtotime($cerfas->naissanceA));
                        $pdf->SetXY(142, 120.5);
                        $pdf->Cell(0, 10,  $date_formatee, 0, 1, 'L');
                    }

                    if($cerfas->sexeA == "M"){
                        $pdf->SetXY(117, 127);
                        $pdf->Cell(0, 10,  "X", 0, 1, 'L');
                    }elseif($cerfas->sexeA == "F"){
                        $pdf->SetXY(127, 127);
                        $pdf->Cell(0, 10,  "X", 0, 1, 'L');
                    }
                    
                    $pdf->SetXY(155.5, 133);
                    $pdf->Cell(0, 10, $cerfas->departementA , 0, 1, 'L');

                    $pdf->SetXY(105, 144.5);
                    $pdf->Cell(0, 10, $cerfas->communeNA , 0, 1, 'L');

                    $pdf->SetXY(127, 151);
                    $pdf->Cell(0, 10, $cerfas->nationaliteA , 0, 1, 'L');

                    $pdf->SetXY(165, 151);
                    $pdf->Cell(0, 10, $cerfas->regimeA , 0, 1, 'L');
                   
                    if($cerfas->declareSA == "oui"){
                        $pdf->SetXY(120, 160.5);
                        $pdf->Cell(0, 10,  "X", 0, 1, 'L');
                    }elseif($cerfas->declareSA == "non"){
                        $pdf->SetXY(140, 160.5);
                        $pdf->Cell(0, 10,  "X", 0, 1, 'L');
                    }

                    
                    if($cerfas->declareHA == "oui"){
                        $pdf->SetXY(127, 170.8);
                        $pdf->Cell(0, 10,  "X", 0, 1, 'L');
                    }elseif($cerfas->declareHA == "non"){
                        $pdf->SetXY(146, 170.8);
                        $pdf->Cell(0, 10,  "X", 0, 1, 'L');
                    }

                    if($cerfas->declareRA == "oui"){
                        $pdf->SetXY(129.5, 220);
                        $pdf->Cell(0, 10,  "X", 0, 1, 'L');
                    }elseif($cerfas->declareRA == "non"){
                        $pdf->SetXY(148.5, 220);
                        $pdf->Cell(0, 10,  "X", 0, 1, 'L');
                    }

                    $pdf->SetXY(153, 177);
                    $pdf->Cell(0, 10, $cerfas->situationA , 0, 1, 'L');

                    $pdf->SetXY(164, 183);
                    $pdf->Cell(0, 10, $cerfas->titrePA , 0, 1, 'L');

                    $pdf->SetXY(161, 189.5);
                    $pdf->Cell(0, 10, $cerfas->derniereCA , 0, 1, 'L');

                    $pdf->SetXY(106, 200.5);
                    $pdf->Cell(0, 10, $cerfas->intituleA , 0, 1, 'L');

                    $pdf->SetXY(172, 206.3);
                    $pdf->Cell(0, 10, $cerfas->titreOA , 0, 1, 'L');



                    $pdf->SetXY(8.5, 243.5);
                    $pdf->Cell(0, 10, $cerfas->nomM , 0, 1, 'L');

                    $pdf->SetXY(25.5, 250);
                    $pdf->Cell(0, 10, $cerfas->prenomM , 0, 1, 'L');

                   
                    if($cerfas->naissanceM == ""){}else{
                        $date_formateeM = date("d/m/Y", strtotime($cerfas->naissanceM));
                        $pdf->SetXY(43, 256);
                        $pdf->Cell(0, 10,  $date_formateeM, 0, 1, 'L');
    
                    }
                    $pdf->SetXY(18.5, 261.5);
                    $pdf->Cell(0, 10,  $cerfas->securiteM, 0, 1, 'L');

                    $pdf->SetXY(8.5, 270.7);
                    $pdf->Cell(0, 10,  $cerfas->emailM, 0, 1, 'L');

                    $pdf->SetXY(8.5, 279.8);
                    $pdf->Cell(0, 10,  $cerfas->emploiM, 0, 1, 'L');


                    $pdf->SetXY(105.5, 243.5);
                    $pdf->Cell(0, 10, $cerfas->nomM1 , 0, 1, 'L');

                    $pdf->SetXY(123, 250);
                    $pdf->Cell(0, 10, $cerfas->prenomM1 , 0, 1, 'L');

                    if($cerfas->naissanceM1 == ""){}else{
                        $date_formateeM1 = date("d/m/Y", strtotime($cerfas->naissanceM1));
                        $pdf->SetXY(141, 256);
                        $pdf->Cell(0, 10,  $date_formateeM1, 0, 1, 'L');
    
                    }

                   

                    $pdf->SetXY(116, 261.5);
                    $pdf->Cell(0, 10,  $cerfas->securiteM1, 0, 1, 'L');

                    $pdf->SetXY(105.5, 270.7);
                    $pdf->Cell(0, 10,  $cerfas->emailM1, 0, 1, 'L');

                    $pdf->SetXY(105.5, 279.8);
                    $pdf->Cell(0, 10,  $cerfas->emploiM1, 0, 1, 'L');

                    
       
                    
                   
                } else {
                    $pdf->SetXY(8.5, 6.5);
                    $pdf->Cell(0, 10, $cerfas->diplomeM , 0, 1, 'L');

                    $pdf->SetXY(92, 11);
                    $pdf->Cell(0, 10, $cerfas->niveauM , 0, 1, 'L');

                    $pdf->SetXY(105.5, 6.5);
                    $pdf->Cell(0, 10, $cerfas->diplomeM1 , 0, 1, 'L');

                    $pdf->SetXY(189, 11);
                    $pdf->Cell(0, 10, $cerfas->niveauM1 , 0, 1, 'L');

                    $pdf->SetXY(63, 29);
                    $pdf->Cell(0, 10, $cerfas->typeC , 0, 1, 'L');

                    $pdf->SetXY(143, 29);
                    $pdf->Cell(0, 10, $cerfas->derogationC , 0, 1, 'L');

                    $pdf->SetXY(131, 36.8);
                    $pdf->Cell(0, 10, $cerfas->numeroC , 0, 1, 'L');


                    if($cerfas->conclusionC == ''){}else{

                        $date_formateeC = date("d/m/Y", strtotime($cerfas->conclusionC));
                        $pdf->SetXY(8.5, 50);
                        $pdf->Cell(0, 10,  $date_formateeC, 0, 1, 'L');

                    }

                    if($cerfas->executionC == ''){}else{

                        $date_formateeE = date("d/m/Y", strtotime($cerfas->executionC));
                        $pdf->SetXY(68, 50);
                        $pdf->Cell(0, 10,  $date_formateeE, 0, 1, 'L');
                    }


                    if($cerfas->debutC == ''){}else{

                        $date_formateeD = date("d/m/Y", strtotime($cerfas->debutC));
                        $pdf->SetXY(135, 50);
                        $pdf->Cell(0, 10,  $date_formateeD, 0, 1, 'L');
                    }

                    if($cerfas->avenantC == ''){}else{

                        $date_formateeA = date("d/m/Y", strtotime($cerfas->avenantC));
                        $pdf->SetXY(51, 55.3);
                        $pdf->Cell(0, 10,  $date_formateeA, 0, 1, 'L');
                    }

                    if($cerfas->finC == ''){}else{

                        $date_formateeF = date("d/m/Y", strtotime($cerfas->finC));
                        $pdf->SetXY(39, 66.3);
                        $pdf->Cell(0, 10,  $date_formateeF, 0, 1, 'L');
                    }

                   
                    $pdf->SetXY(105.8, 61.8);
                    $pdf->Cell(0, 10, $cerfas->dureC , 0, 1, 'L');

                   

                    

                    if($cerfas->travailC == "oui"){
                        $pdf->SetXY(139, 71.5);
                        $pdf->Cell(0, 10,  "X", 0, 1, 'L');
                    }elseif($cerfas->travailC == "non"){
                        $pdf->SetXY(158, 71.5);
                        $pdf->Cell(0, 10,  "X", 0, 1, 'L');
                    }

                    if($cerfas->rdC == ''){}else{

                        $date_formateeR = date("d/m/Y", strtotime($cerfas->rdC));
                        $pdf->SetFontSize(11.5);
                        $pdf->SetXY(27, 81.4);
                        $pdf->Cell(0, 10,  $date_formateeR, 0, 1, 'L');
                    }

                    if($cerfas->raC == ''){}else{

                        $date_formateeA = date("d/m/Y", strtotime($cerfas->raC));
                        $pdf->SetFontSize(11.5);
                        $pdf->SetXY(55, 81.4);
                        $pdf->Cell(0, 10,  $date_formateeA, 0, 1, 'L');
                    }




                   

                   

                    $pdf->SetFontSize(11.5);
                    $pdf->SetXY(83, 81.4);
                    $pdf->Cell(0, 10, $cerfas->rpC , 0, 1, 'L');

                    $pdf->SetFontSize(11.5);
                    $pdf->SetXY(98, 81.4);
                    $pdf->Cell(0, 10, $cerfas->rsC , 0, 1, 'L');


                    if($cerfas->rdC1 == ''){}else{

                        $date_formateeR1 = date("d/m/Y", strtotime($cerfas->rdC1));
                        $pdf->SetFontSize(11.5);
                        $pdf->SetXY(27, 86.4);
                        $pdf->Cell(0, 10,  $date_formateeR1, 0, 1, 'L');
                    }

                    if($cerfas->raC1 == ''){}else{

                        $date_formateeA1 = date("d/m/Y", strtotime($cerfas->raC1));
                        $pdf->SetFontSize(11.5);
                        $pdf->SetXY(55, 86.4);
                        $pdf->Cell(0, 10,  $date_formateeA1, 0, 1, 'L');
                    }
                  

                    

                    $pdf->SetFontSize(11.5);
                    $pdf->SetXY(83, 86.4);
                    $pdf->Cell(0, 10, $cerfas->rpC1 , 0, 1, 'L');

                    $pdf->SetFontSize(11.5);
                    $pdf->SetXY(98, 86.4);
                    $pdf->Cell(0, 10, $cerfas->rsC1 , 0, 1, 'L');


                    if($cerfas->rdC2 == ''){}else{

                        $date_formateeR2 = date("d/m/Y", strtotime($cerfas->rdC2));
                        $pdf->SetFontSize(11.5);
                        $pdf->SetXY(27,91);
                        $pdf->Cell(0, 10,  $date_formateeR2, 0, 1, 'L');
                    }

                    if($cerfas->raC2 == ''){}else{

                        $date_formateeA2 = date("d/m/Y", strtotime($cerfas->raC2));
                        $pdf->SetFontSize(11.5);
                        $pdf->SetXY(55, 91);
                        $pdf->Cell(0, 10,  $date_formateeA2, 0, 1, 'L');
                    }

                    $pdf->SetFontSize(11.5);
                    $pdf->SetXY(83, 91);
                    $pdf->Cell(0, 10, $cerfas->rpC2 , 0, 1, 'L');

                    $pdf->SetFontSize(11.5);
                    $pdf->SetXY(98, 91);
                    $pdf->Cell(0, 10, $cerfas->rsC2 , 0, 1, 'L');
                  


                    $pdf->SetXY(75, 100.5);
                    $pdf->Cell(0, 10, $cerfas->salaireC. " €" , 0, 1, 'L');

                    $pdf->SetXY(105.5, 104.5);
                    $pdf->Cell(0, 10, $cerfas->caisseC , 0, 1, 'L');

                    $pdf->SetXY(87, 109.5);
                    $pdf->Cell(0, 10, $cerfas->avantageC , 0, 1, 'L');

                    $pdf->SetXY(141, 109.5);
                    $pdf->Cell(0, 10, $cerfas->logementC , 0, 1, 'L');

                    if($cerfas->autreC == "oui"){
                        $pdf->SetXY(195, 109.5);
                        $pdf->Cell(0, 10,  "X", 0, 1, 'L');
                    }elseif($cerfas->autreC == "non"){
                        $pdf->SetXY(141, 109.5);
                        $pdf->Cell(0, 10,  "", 0, 1, 'L');
                    }
 
                    // formation 
                    if( $cerfas->idformation == 0){

                    }else{

                        if($ligneformation->entrepriseF == "oui"){
                            $pdf->SetXY(41, 119.5);
                            $pdf->Cell(0, 10,  "X", 0, 1, 'L');
                        }elseif($ligneformation->entrepriseF == "non"){
                            $pdf->SetXY(60, 119.5);
                            $pdf->Cell(0, 10,  "X", 0, 1, 'L');
                        }
    
                        $pdf->SetXY(8.5, 128.5);
                        $pdf->Cell(0, 10, $ligneformation->nomF , 0, 1, 'L');
    
                        $pdf->SetXY(38, 133.5);
                        $pdf->Cell(0, 10, $ligneformation->numeroF , 0, 1, 'L');
    
                        $pdf->SetXY(38, 138.5);
                        $pdf->Cell(0, 10, $ligneformation->siretF , 0, 1, 'L');
    
                        $pdf->SetXY(12.8, 148);
                        $pdf->Cell(0, 10, $ligneformation->rueF , 0, 1, 'L');
    
                        $pdf->SetXY(38, 148);
                        $pdf->Cell(0, 10, $ligneformation->voieF , 0, 1, 'L');
    
                        $pdf->SetXY(34, 154);
                        $pdf->Cell(0, 10, $ligneformation->complementF , 0, 1, 'L');
    
                        $pdf->SetXY(33, 160);
                        $pdf->Cell(0, 10, $ligneformation->postalF , 0, 1, 'L');
    
                        $pdf->SetXY(30, 166.5);
                        $pdf->Cell(0, 10, $ligneformation->communeF , 0, 1, 'L');
    
                        if($ligneformation->responsableF == "oui"){
                            $pdf->SetXY(8.5, 176.5);
                            $pdf->Cell(0, 10,  "X", 0, 1, 'L');
                        }elseif($ligneformation->entrepriseF == "non"){
                            $pdf->SetXY(8.5, 176.5);
                            $pdf->Cell(0, 10,  "", 0, 1, 'L');
                        }
    
                        $pdf->SetXY(168, 119.3);
                        $pdf->Cell(0, 10, $ligneformation->diplomeF , 0, 1, 'L');
    
                        $pdf->SetXY(105.5, 128.5);
                        $pdf->Cell(0, 10, $ligneformation->intituleF , 0, 1, 'L');
    
                        $pdf->SetXY(138.5, 133.8);
                        $pdf->Cell(0, 10, $ligneformation->codeF , 0, 1, 'L');
    
                        $pdf->SetXY(132.5, 138.4);
                        $pdf->Cell(0, 10, $ligneformation->rnF , 0, 1, 'L');
    
                        if($ligneformation->debutO == ''){}else{
    
                            $date_formateeO = date("d/m/Y", strtotime($ligneformation->debutO));
                            $pdf->SetFontSize(11.5);
                            $pdf->SetXY(105.5, 152.4);
                            $pdf->Cell(0, 10,  $date_formateeO, 0, 1, 'L');
                        }
    
                        if($ligneformation->prevuO == ''){}else{
    
                            $date_formateeP = date("d/m/Y", strtotime($ligneformation->prevuO));
                            $pdf->SetFontSize(11.5);
                            $pdf->SetXY(105.5, 162.4);
                            $pdf->Cell(0, 10,  $date_formateeP, 0, 1, 'L');
                        }
    
                        
    
                       
    
                        $pdf->SetXY(147, 167.4);
                        $pdf->Cell(0, 10, $ligneformation->dureO , 0, 1, 'L');
    
                        $pdf->SetXY(105.5, 187.8);
                        $pdf->Cell(0, 10, $ligneformation->nomO , 0, 1, 'L');
    
                        $pdf->SetXY(121.5, 192.6);
                        $pdf->Cell(0, 10, $ligneformation->numeroO , 0, 1, 'L');
    
                        $pdf->SetXY(126.5, 197.6);
                        $pdf->Cell(0, 10, $ligneformation->siretO , 0, 1, 'L');
    
                        $pdf->SetXY(110.9, 207);
                        $pdf->Cell(0, 10, $ligneformation->rueO , 0, 1, 'L');
    
                        $pdf->SetXY(135.7, 207.2);
                        $pdf->Cell(0, 10, $ligneformation->voieO , 0, 1, 'L');
    
                        $pdf->SetXY(131.7, 212.2);
                        $pdf->Cell(0, 10, $ligneformation->complementO , 0, 1, 'L');
    
                        $pdf->SetXY(130, 218.2);
                        $pdf->Cell(0, 10,$ligneformation->postalO , 0, 1, 'L');
    
                        $pdf->SetXY(128, 224.5);
                        $pdf->Cell(0, 10, $ligneformation->communeO , 0, 1, 'L');
                    }

                    



                    $pdf->SetXY(22, 234.5);
                    $pdf->Cell(0, 10, $cerfas->lieuO , 0, 1, 'L');

                    

                    if($cerfas->attesteO == "oui"){
                        $pdf->SetXY(8.5, 229.5);
                        $pdf->Cell(0, 10,  "X", 0, 1, 'L');
                    }elseif($cerfas->attesteO == "non"){
                        $pdf->SetXY(8.5, 229.5);
                        $pdf->Cell(0, 10,  "", 0, 1, 'L');
                    }
 


                }
    
             
               
                $pageNumber++;
                
            }
    
            if($cerfas->nomA == ""){ $pdf->Output($cerfas->emailA.'_Pdf_cerfas' . date('Y-m-d_i:s') . '_' . time() . '.pdf', 'I');}
            else{  $pdf->Output($cerfas->nomA.'_Pdf_cerfas' . date('Y-m-d_i:s') . '_' . time() . '.pdf', 'I');}
           
        } catch (Exception $e) {
            // Gérer les exceptions
        }
    }
    




  



   


 
    

    


   
    

   



   


    


    function collerleNom($nom){
        return str_replace(' ','_',$nom);
    }

}