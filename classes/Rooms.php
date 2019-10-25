<?php

require_once("Config.php");

class Room extends Config {

    public function save($title,$roomcapacity,$roomprice,$userid,$cityid,$directory,$filename,$tmp_name)

    {
        $sql ="INSERT INTO rooms(room_title,room_capacity,room_price,user_id,city_id,room_image)

                VALUES('$title','$roomcapacity','$roomprice','$userid','$cityid','$filename')";

        $result = $this->conn->query($sql);

        if($result === TRUE){

            if(move_uploaded_file($tmp_name,"../$directory".basename($filename))){

                $_SESSION['message'] = "Employee added successfully";
                
                header("Location: home01.php");

            }
            
        } else{

            echo $this->conn->error;

        }
    }

    public function getRoom()
    {
        $sql = "SELECT * FROM rooms INNER JOIN users ON rooms.user_id=users.user_id
                                    INNER JOIN citys ON rooms.city_id=citys.city_id";
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

    public function getRoomByCity($city_id)
    {
        $sql = "SELECT * FROM rooms 
        INNER JOIN citys ON citys.city_id=rooms.city_id
        WHERE rooms.city_id=$city_id";
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

    public function updateRoom($id,$title,$roomcapacity,$roomprice,$userid,$cityid)
    {
        $sql = "UPDATE rooms SET room_title='$title',room_capacity='$roomcapacity',room_price='$roomprice',user_id='$userid',city_id='$cityid'
        WHERE room_id=$id";

        $result = $this->conn->query($sql);

        if($this->conn->error){
            echo $this->conn->error;
        }else{
            $_SESSION['message'] = "Room updated sucessfully.";
            header("Location: rooms.php");
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
            header("Location: rooms.php");
        }

    }

}