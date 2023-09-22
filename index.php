<?php

require_once("lib/database.php");
require_once("lib/artikel.php");
require_once("lib/user.php");
require_once("lib/keukentype.php");
require_once("lib/gerechtinfo.php");
require_once("lib/ingredient.php");


/// INIT
$db = new database();
$art = new artikel($db->getConnection());
$user = new user($db->getConnection());
$keukenType = new keukenType($db->getConnection());
$gerechtInfo = new gerechtInfo($db->getConnection());
$ingredient = new ingredient($db->getConnection());


/// VERWERK 

// $info = $gerechtInfo->selecteerInfo(23,$user);
// $addfavorite = $gerechtInfo->addFavorite(1,2);
// $deletefavorite = $gerechtInfo->deleteFavorite(59);
$ingredient = $ingredient->selecteerIngredient(1,$art);



/// RETURN
echo '<pre>';

// var_dump($info);
var_dump($ingredient);
