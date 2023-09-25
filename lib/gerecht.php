<?php

class gerecht {

    private $connection;

    public function __construct($connection){
        $this->connection = $connection;
    }


    public function selecteerGerecht($gerecht_id){
        $sql = "select * from gerecht where id=$gerecht_id";

        $result = mysqli_query($this->connection,$sql);
        $gerecht = mysqli_fetch_array($result, MYSQLI_ASSOC);

        return($gerecht);

    }

    public function selecteerUser($user, $gerecht_id){
        $gerecht = $this->selecteerGerecht($gerecht_id); 
        $user = $user->selecteerUser($gerecht["user_id"]); 
        return($user);
    }

    public function selecteerIngredient($ingredient, $art, $ingredient_id){
        $ingredient = $ingredient->selecteerIngredient($ingredient_id,$art);
        return($ingredient);

    }

    public function calcCalories($ingredientTable, $art,$gerecht_id) {
        $totalCalories = 0;
        $sql = "select * from ingredient where gerecht_id = $gerecht_id";

        $result = mysqli_query($this->connection,$sql);
        while($row = mysqli_fetch_assoc($result)) {
            $ingredient = $ingredientTable->selecteerIngredient($row["id"], $art);
            $aantal = $ingredient["ingredient"]["aantal"];
            $verpakking = $ingredient["artikel"]["verpakking"];
            $caloriesVerpakking = $ingredient["artikel"]["calories"];
            $totalCalories += ($caloriesVerpakking / $verpakking * $aantal);

        }
        return($totalCalories);
    }

    public function calcPrice($ingredientTable, $art,$gerecht_id) {
        $totalPrice = 0;
        $sql = "select * from ingredient where gerecht_id = $gerecht_id";

        $result = mysqli_query($this->connection,$sql);
        while($row = mysqli_fetch_assoc($result)) {
            $ingredient = $ingredientTable->selecteerIngredient($row["id"], $art);
            $aantal = $ingredient["ingredient"]["aantal"];
            $verpakking = $ingredient["artikel"]["verpakking"];
            $priceVerpakking = $ingredient["artikel"]["prijs"];
            echo $priceVerpakking . "<br>";
            $totalPrice += ($priceVerpakking / $verpakking * $aantal);
        }
        return(round($totalPrice,0));
    }
}
