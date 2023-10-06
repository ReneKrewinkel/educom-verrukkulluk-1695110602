<?php

class gerecht {

    private $connection;
    private $user;
    private $ingredient;
    private $gerechtInfo;
    private $keukenType;


    public function __construct($connection){
        $this->connection = $connection;
        $this->user = new user($connection);
        $this->ingredient = new ingredient($connection);
        $this->gerechtInfo = new gerechtInfo($connection);
        $this->keukenType = new keukenType($connection);

    }

    private function selectUser($user_id){
        $user = $this->user->selecteerUser($user_id);
        return($user);
    }

    private function selectIngredient($gerecht_id){
        $ingredients = $this->ingredient->selecteerIngredient($gerecht_id);
        return($ingredients);

    }

    private function berekenCalories($ingredients){
        $totaalCalories = 0;

        foreach($ingredients as $ingredient) {
            $calories = $ingredient["calories"];
            $verpakking = $ingredient["verpakking"];
            $aantal = $ingredient["aantal"];
            
            $totaalCalories += $calories / $verpakking * $aantal;
            
        }

        return(round($totaalCalories,0));
    }

    private function berekenPrijsRecept($ingredients){
        $totaalPrijs = 0;

        foreach($ingredients as $ingredient) {
            $prijs = $ingredient["prijs"];
            $verpakking = $ingredient["verpakking"];
            $aantal = $ingredient["aantal"];
            
            $totaalPrijs += $prijs / $verpakking * $aantal;
        }

        return(round($totaalPrijs,0));
    }

    private function selecteerWaardering($gerecht_id){
        $gerechten = $this->gerechtInfo->selecteerInfo($gerecht_id, "W");
        $waarderingen = [];
        foreach($gerechten as $gerecht){
            $waarderingen[] = ["waardering" => $gerecht["nummeriekveld"]];
        }
        
        
        return $waarderingen;
    }

    private function selecteerBereidingswijze($gerecht_id){
        $bereidingswijze = $this->gerechtInfo->selecteerInfo($gerecht_id, "B");
        
        return($bereidingswijze);
    }
    
    private function selecteerOpmerkingen($gerecht_id){
        $opmerkingen = $this->gerechtInfo->selecteerInfo($gerecht_id, "O");
        
        return($opmerkingen);
    }
    
    private function selecteerKeuken($keuken_id){
        $keuken = $this->keukenType->selecteerKeukenType($keuken_id);
        
        return($keuken);
    }
    
    private function selecteerType($type_id){
        $type = $this->keukenType->selecteerKeukenType($type_id);
        
        return($type);
    }
    
    private function bepaalFavoriet($gerecht_id, $user_id){
        $gerechten = $this->gerechtInfo->selecteerInfo($gerecht_id, "F");
        foreach($gerechten as $gerecht){
            if ($gerecht["user_id"] == $user_id){
                return(TRUE);
            }
        }
        return(FALSE);
    }

    public function selecteerGerecht($gerecht_id = "alle"){
        if ($gerecht_id === "alle"){
            $sql = "select * from gerecht";
        }
        else {
            $sql = "select * from gerecht where id=$gerecht_id";
        }
        
        $result = mysqli_query($this->connection,$sql);
        $gerechten = [];

        while($gerecht = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $user = $this->selectUser($gerecht["user_id"]);
            $ingredienten = $this->selectIngredient($gerecht["id"]);
            $calories = $this->berekenCalories($ingredienten);
            $prijs = $this->berekenPrijsRecept($ingredienten);
            $rating = $this-> selecteerWaardering($gerecht["id"]);
            $bereidingswijze = $this->selecteerBereidingswijze($gerecht["id"]);
            $opmerkingen = $this->selecteerOpmerkingen($gerecht["id"]);
            $keuken = $this->selecteerKeuken($gerecht["keuken_id"]);
            $type = $this->selecteerType($gerecht["type_id"]);
            $favoriet = $this->bepaalFavoriet($gerecht["id"], $user_id=1);
            
            
            
            
            $gerechten[] = [
                "id" => $gerecht["id"],
                "keuken_id" => $gerecht["keuken_id"],
                "type_id" => $gerecht["type_id"],
                "user_id" => $gerecht["user_id"],
                "datum_toegevoegd" => $gerecht["datum_toegevoegd"],
                "titel" => $gerecht["titel"],
                "korte_omschrijving" => $gerecht["korte_omschrijving"],
                "lange_omschrijving" => $gerecht["lange_omschrijving"],
                "afbeelding" => $gerecht["afbeelding"],
                
                "user" => $user,
                "ingredienten" => $ingredienten,
                "calories" => $calories,
                "prijs" => $prijs,
                "rating" => $rating,
                "bereidingswijze" => $bereidingswijze,
                "opmerkingen" => $opmerkingen,
                "keuken" => $keuken,
                "type" => $type,
                "favoriet" => $favoriet

            ];
        }
        if (count($gerechten) == 1) {
            return($gerechten[0]);
        }
        else{
            return($gerechten);
        }
        
    }
}
