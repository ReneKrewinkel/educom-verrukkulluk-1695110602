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
$groceryList = new boodschappenlijst($db->getConnection());
$data = $gerecht->selecteerGerecht();
$groceries = "";
$search = "";



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
        $data = $gerecht->selecteerGerecht($gerecht_id);
        $template = 'detail.html.twig';
        $title = "detail";
    
        break;
    }

    
    case "rating": {
        $rating = $_GET["rating"];

        $sql = "INSERT INTO `gerechtinfo`(`record_type`, `gerecht_id`, `user_id`, `datum`, `nummeriekveld`, `tekstveld`) 
                VALUES ('W',$gerecht_id, null, null, $rating, null)";
        $insert = mysqli_query($db->getConnection(),$sql);
        
        $data = $gerecht->selecteerGerecht($gerecht_id);
        $average = ["average" => ($data["rating"])];

        header('Content-type: application/json');
        echo json_encode($average);
        die();

        break;
    }

    case "grocery_list": {
        $user_id = 1;
        $groceries = $groceryList->getGroceryList($user_id);
        
        $template = 'grocery_list.html.twig';
        $title = "grocery_list";
    }
    
    case "search": {
        $input = ["input"=> $_GET["input"]];
        $search = $gerecht->selecteerGerecht($input);
        header('Content-type: application/json');
        echo json_encode($search);
        die();
    
        break;
    }
    
    case "favorites": {
        
        
        break;
    }
    
    
}

$template = $twig->load($template);
if ($groceries) {
    echo $template->render(["title" => $title, "data" => $data, "groceries" => $groceries]);
}
else {
    echo $template->render(["title" => $title, "data" => $data]);
}