<?php

class boodschappenlijst {

    private $connection;
    private $ingredienten;

    public function __construct($connection){
        $this->connection = $connection;
        $this->ingredienten = new ingredient($connection);
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
}
