<?php







use Core\Router;

use Model\UserAdmin;



 $encodedData = $_GET['data'];

 $decodedData = json_decode(base64_decode(urldecode($encodedData)), true);

 setcookie("info", $decodedData);

    

  

    







    

require_once 'config/DbAuth.php';

require 'autoload.php';

require_once "Core/Router.php";

require_once "Model/Form.php";





$routes = require 'routes.php';

$url = $_GET['url'];



Router::handleRequest($url, $routes);



// N'oubli pas d'activiter la gestion du routing dans appache avec le fichier .htaccess 

// et aussi ajouter les droits ( ALL) dans  le fichier 000defaut de appache



?>



