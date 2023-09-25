<?php

class gerechtInfo {

    private $connection;
    private $user;

    public function __construct($connection){
        $this->connection = $connection;
        $this->user = new user($connection);
    }

    private function selectUser($user_id){
        $user = $this->user->selecteerUser($user_id);
        return($user);
    }

    public function selecteerInfo($gerecht_id, $typeInfo){
        $sql = "select * from gerechtinfo where gerecht_id = $gerecht_id and record_type = '$typeInfo'";
        $result = mysqli_query($this->connection,$sql);
        $info = [];
        
        while ($gerechtInfo = mysqli_fetch_array($result, MYSQLI_ASSOC)){

            if ($typeInfo == "O" or $typeInfo =="F") {
                $user = $this->selectUser($gerechtInfo["user_id"]);
                $info[] = [
                
                "id" => $gerechtInfo["id"],
                "record_type" => $gerechtInfo["record_type"],
                "gerecht_id" => $gerechtInfo["gerecht_id"],
                "datum" => $gerechtInfo["datum"],
                "nummeriekveld" => $gerechtInfo["nummeriekveld"],
                "tekstveld" => $gerechtInfo["tekstveld"],

                "user_id" => $user["id"],
                "user_name" => $user["user_name"],
                "password" => $user["password"],
                "email" => $user["email"],
                "afbeelding" => $user["afbeelding"]
            ];
            }
            else {
                $info[] = $gerechtInfo;
            }
        }
        return($info);
    }

    public function addFavorite($gerecht_id, $user_id){
        $sql = "INSERT INTO gerechtinfo (record_type, gerecht_id, user_id, datum)
                VALUES ('F', $gerecht_id , $user_id, CURDATE())";
        if (mysqli_query($this->connection,$sql) === TRUE) {
            return TRUE;
        }
    }

    public function deleteFavorite($gerechtInfo_id){
        $sql = "DELETE FROM gerechtinfo WHERE id=$gerechtInfo_id";
        if (mysqli_query($this->connection,$sql) === TRUE) {
            return TRUE;
        }
    }
}
