<?php

class ingredient {

    private $connection;
    private $artikel;

    public function __construct($connection){
        $this->connection = $connection;
        $this->artikel = new artikel($connection);
    }

    private function selectArtikel($artikel_id) {
        $art = $this->artikel->selecteerArtikel($artikel_id);
        return($art);
    }

    public function selecteerIngredient($gerecht_id){
        $sql = "select * from ingredient where gerecht_id=$gerecht_id";
        $result = mysqli_query($this->connection,$sql);
        $ingredients = [];
        
        while ($ingredient = mysqli_fetch_array($result, MYSQLI_ASSOC)){

            $artikel = $this->selectArtikel($ingredient["artikel_id"]);
         
            $ingredients[] = [
                "id" => $ingredient["id"],
                "gerecht_id" => $ingredient["gerecht_id"],
                "artikel_id" => $ingredient["artikel_id"],
                "aantal" => $ingredient["aantal"],
                
                "naam" => $artikel["naam"],
                "omschrijving" => $artikel["omschrijving"],
                "prijs" => $artikel["prijs"],
                "verpakking" => $artikel["verpakking"],
                "calories" => $artikel["calories"]
            ];
        }
        return($ingredients);
    }
}
