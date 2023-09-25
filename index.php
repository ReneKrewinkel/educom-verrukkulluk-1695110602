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

// $info = $gerechtInfo->selecteerInfo(23,$user);
// $addfavorite = $gerechtInfo->addFavorite(1,2);
// $deletefavorite = $gerechtInfo->deleteFavorite(59);
// $ingredient = $ingredient->selecteerIngredient(1,$art);
$gerecht = $gerechtTable->selecteerGerecht(1);
$user = $gerechtTable->selecteerUser($userTable,2);
$ingredient = $gerechtTable->selecteerIngredient($ingredientTable, $art,1);
$calories = $gerechtTable->calcCalories($ingredientTable, $art,2);


/// RETURN
echo '<pre>';

// var_dump($info);
// var_dump($gerecht);
// var_dump($user);
// var_dump($ingredient);
var_dump($calories);
