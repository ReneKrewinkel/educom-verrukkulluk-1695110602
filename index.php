<?php

require_once("lib/database.php");
require_once("lib/artikel.php");
require_once("lib/user.php");
require_once("lib/keukentype.php");
require_once("lib/gerechtinfo.php");
require_once("lib/ingredient.php");
require_once("lib/gerecht.php");


/// INIT
$db = new database();
$art = new artikel($db->getConnection());
$userTable = new user($db->getConnection());
$keukenTypeTable = new keukenType($db->getConnection());
$gerechtInfoTable = new gerechtInfo($db->getConnection());
$ingredientTable = new ingredient($db->getConnection());
$gerechtTable = new gerecht($db->getConnection());


/// VERWERK 

// $keukenType = $keukenTypeTable->selecteerKeukenType(1);
// $info = $gerechtInfoTable->selecteerInfo(1,"O");
// $addfavorite = $gerechtInfoTable->addFavorite(1,2);
// $deletefavorite = $gerechtInfoTable->deleteFavorite(59);
// $ingredients = $ingredientTable->selecteerIngredient(1);
$gerecht = $gerechtTable->selecteerGerecht(3);



/// RETURN
echo '<pre>';
var_dump($gerecht);



