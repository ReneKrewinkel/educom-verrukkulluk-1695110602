<?php

class boodschappenlijst {

    private $connection;
    private $ingredienten;
    private $artikel;

    public function __construct($connection){
        $this->connection = $connection;
        $this->ingredienten = new ingredient($connection);
        $this->artikel = new artikel($connection);
    }

    private function selectArtikel($artikel_id) {
        $art = $this->artikel->selecteerArtikel($artikel_id);
        return($art);
    }

    private function ophalenBoodschappen($user_id){
        $sql = "select * from boodschappenlijst where user_id = $user_id";
        $result = mysqli_query($this->connection, $sql);
        $boodschappen = [];

        while ($boodschap = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $boodschappen[] = [
                "id" => $boodschap["id"],
                "user_id" => $boodschap["user_id"],
                "artikel_id" => $boodschap["artikel_id"],
                "aantal" => $boodschap["aantal"],
            ];
        }
        return $boodschappen;
    }



    private function artikelOpLijst($artikel_id,$user_id){
        $boodschappen = $this->ophalenBoodschappen($user_id);
        if ($boodschappen){
            foreach ($boodschappen as $boodschap){
                if ($boodschap["artikel_id"] != $artikel_id){
                }
                else {
                    return($boodschap);
                }
            }
        }
        return(false);
    }

    private function artikelToevoegen($user_id, $artikel_id, $aantal){
        $sql =  "INSERT INTO `boodschappenlijst`(user_id, artikel_id, aantal) 
                VALUES ($user_id, $artikel_id, $aantal)";
        $result = mysqli_query($this->connection,$sql);
    }

    private function artikelBijwerken($user_id, $artikel_id, $aantal){
        $sql = "UPDATE boodschappenlijst SET aantal = aantal + $aantal WHERE user_id = $user_id AND artikel_id=$artikel_id";
        $result = mysqli_query($this->connection,$sql);
    }


    public function boodschappenToevoegen($gerecht_id, $user_id){
        $ingredienten = $this->ingredienten->selecteerIngredient($gerecht_id);
        foreach($ingredienten as $ingredient){
            if(!$this->artikelOpLijst($ingredient["artikel_id"], $user_id)){
                $this->artikelToevoegen($user_id,$ingredient["artikel_id"],$ingredient["aantal"]);
                
            }
            else{
                $this->artikelBijwerken($user_id,$ingredient["artikel_id"],$ingredient["aantal"]);
            }
        }
    }

    public function getGroceryList($user_id) {
        $groceryList = [];
        $groceries = $this->ophalenBoodschappen($user_id);
        foreach($groceries as $grocery) {
            $artikel = $this->selectArtikel($grocery["artikel_id"]);
            $groceryList[] = [
                "id" => $grocery["id"],
                "user_id" => $grocery["user_id"],
                "artikel_id" => $grocery["artikel_id"],
                "aantal" => $grocery["aantal"],
                
                "naam" => $artikel["naam"],
                "omschrijving" => $artikel["omschrijving"],
                "prijs" => $artikel["prijs"],
                "verpakking" => $artikel["verpakking"],
                "calories" => $artikel["calories"],
                "eenheid" => $artikel["eenheid"],
                "afbeelding" => $artikel["afbeelding"]
            ];

        }
        
        return($groceryList);

    }
}
