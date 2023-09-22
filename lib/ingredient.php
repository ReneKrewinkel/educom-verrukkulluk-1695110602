<?php

class ingredient {

    private $connection;

    public function __construct($connection){
        $this->connection = $connection;
    }


    public function selecteerIngredient($ingredient_id, $art){
        $sql = "select * from ingredient where id=$ingredient_id";

        $result = mysqli_query($this->connection,$sql);
        $ingredient = mysqli_fetch_array($result, MYSQLI_ASSOC);

        $artikel = $art->selecteerArtikel($ingredient["artikel_id"]);
        

        return(array("ingredient"=>$ingredient, "artikel"=>$artikel));

    }

    
}
