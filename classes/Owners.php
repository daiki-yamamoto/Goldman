<?php

require_once("Config.php");
class Owner extends Config {

    public function save($name,$user)

    {
        $sql ="INSERT INTO owners(owner_name,user_id)

                VALUES('$name','$user')";

        $result = $this->conn->query($sql);

        if($result === TRUE){

            $_SESSION['message'] = "Owner added successfully";
            
            header("Location: owners.php");
            
        } else{
            echo $this->conn->error;
        }
        
    }

    public function getOwner()
    {
        $sql = "SELECT * FROM owners INNER JOIN users ON owners.owner_id=users.user_id";
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

    public function getSingleOwner($id)
    {
        $sql ="SELECT * FROM owners WHERE owner_id=$id";
        $result = $this->conn->query($sql);

        if($result->num_rows <= 0){
            return false;
        }elseif($this->conn->error){
            echo $this->conn->error;
        }else{
            return $result->fetch_assoc();
        }
    }

    public function updateOwner($id,$ownername)
    {
        $sql = "UPDATE owners SET owner_name='$ownername'
        WHERE owner_id=$id";

        $result = $this->conn->query($sql);

        if($this->conn->error){
            echo $this->conn->error;
        }else{
            $_SESSION['message'] = "Owner updated sucessfully.";
            header("Location: owner.php");
        }

    }

    public function deleteOwner($id)
    {
        $sql = "DELETE FROM owners WHERE owner_id=$id";
        $result = $this->conn->query($sql);

        if($this->conn->error){
            echo $this->conn->error;
        }else{
            $_SESSION['message'] = "Owner updated sucessfully.";
            header("Location: owner.php");
        }

    }

}