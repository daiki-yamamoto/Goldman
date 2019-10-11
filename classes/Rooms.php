<?php

require_once("Config.php");
class Room extends Config {

    public function save($name,$countries,)

    {
        $sql ="INSERT INTO rooms(room_name,countries_id)

                VALUES('$name','$countries')";

        $result = $this->conn->query($sql);

        if($result === TRUE){

            $_SESSION['message'] = "room added successfully";
            
            header("Location: rooms.php");
            
        } else{
            echo $this->conn->error;

        }
    }

    public function getRoom()
    {
        $sql = "SELECT * FROM rooms INNER JOIN countries ON rooms.countries_id=citys.city_id
        INNER JOIN countries ON rooms.countries_id=countries.countries_id";
        $result = $this->conn->query($sql);

        if($result->num_rows <= 0){ 

            return false;

        }else{
            $rows = array();

            while($row = $result->fetch_assoc())
            {
                $rows[] = $row;
            }

            return $rows;
        }
    }

    public function getSingleRoom($id)
    {
        $sql ="SELECT * FROM rooms WHERE room_id=$id";
        $result = $this->conn->query($sql);

        if($result->num_rows <= 0){
            return false;
        }elseif($this->conn->error){
            echo $this->conn->error;
        }else{
            return $result->fetch_assoc();
        }
    }

    public function updateRoom($id,$roomname)
    {
        $sql = "UPDATE rooms SET room_name='$roomname'
        WHERE room_id=$id";

        $result = $this->conn->query($sql);

        if($this->conn->error){
            echo $this->conn->error;
        }else{
            $_SESSION['message'] = "Room updated sucessfully.";
            header("Location: room.php");
        }

    }

    public function deleteRoom($id)
    {
        $sql = "DELETE FROM rooms WHERE room_id=$id";
        $result = $this->conn->query($sql);

        if($this->conn->error){
            echo $this->conn->error;
        }else{
            $_SESSION['message'] = "Room updated sucessfully.";
            header("Location: room.php");
        }

    }

}