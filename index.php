<?php

require_once("./vendor/autoload.php");

$loader = new \Twig\Loader\FilesystemLoader("./templates");

$twig = new \Twig\Environment($loader, ["debug" => true]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

require_once("lib/database.php");
require_once("lib/artikel.php");
require_once("lib/user.php");
require_once("lib/keukentype.php");
require_once("lib/gerechtinfo.php");
require_once("lib/ingredient.php");
require_once("lib/gerecht.php");
require_once("lib/boodschappenlijst.php");



$db = new database();
$gerecht = new gerecht($db->getConnection());
$data = $gerecht->selecteerGerecht();

$gerecht_id = isset($_GET["gerecht_id"]) ? $_GET["gerecht_id"] : "";
$action = isset($_GET["action"]) ? $_GET["action"] : "homepage";

switch($action){

    case "homepage": {
        $data = $gerecht->selecteerGerecht("alle");
        $template = 'homepage.html.twig';
        $title = "homepage";

        break;
    }
    
    case "detail": {
        $data = $gerecht->selecteerGerecht(1);
        $template = 'detail.html.twig';
        $title = "detail";
    
        break;
    }
    
    case "preperation": {
    
    
        break;
    }
    
    case "remarks": {
    
    
        break;
    }

    case "search": {
    
    
        break;
    }
    
    case "rating": {
    
    
        break;
    }
    
    case "favorites": {
    
    
        break;
    }
    
    case "groceries": {
    
    
        break;
    }

}

$template = $twig->load($template);

echo $template->render(["title" => $title, "data" => $data]);

