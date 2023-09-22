<?php

class gerechtInfo {

    private $connection;

    public function __construct($connection){
        $this->connection = $connection;
    }

    public function selecteerInfo($gerechtInfo_id, $user){
        $sql = "select * from gerechtinfo where id = $gerechtInfo_id";
        $result = mysqli_query($this->connection,$sql);
        $info = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if ($info["record_type"] == "O" or $info["record_type"] =="F") {
            
            $user = $user->selecteerUser($info["user_id"]);
            return(array("gerechtInfo"=> $info, "user" => $user));
        
        }
    return($info);
    }

    public function addFavorite($gerecht_id, $user_id){
        $sql = "INSERT INTO gerechtinfo (record_type, gerecht_id, user_id, datum)
                VALUES ('F', $gerecht_id , $user_id, CURDATE())";
        if (mysqli_query($this->connection,$sql) === TRUE) {
            echo "New record created successfully <br>";
            
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }

    }

    public function deleteFavorite($gerechtInfo_id){
        $sql = "DELETE FROM gerechtinfo WHERE id=$gerechtInfo_id";
        if (mysqli_query($this->connection,$sql) === TRUE) {
            echo "Record deleted successfully";
          } else {
            echo "Error deleting record: " . $conn->error;
          }
    }
}
