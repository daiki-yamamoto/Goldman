<?php

require_once("Config.php");
class Countries extends Config {

    public function save($name)
    {
        $sql ="INSERT INTO countries(countries_name)
        
                VALUES('$name')";

        $result = $this->conn->query($sql);

        if($result === TRUE){

            $_SESSION['message'] = "Countries added successfully";
            
            header("Location: countries.php");
            
        } else{

            echo $this->conn->error;

        }
    }

    public function getCountries()
    {
        $sql = "SELECT * FROM countries";
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

    public function getSingleCountries($id)
    {
        $sql ="SELECT * FROM countries WHERE countries_id=$id";
        $result = $this->conn->query($sql);

        if($result->num_rows <= 0){
            return false;
        }elseif($this->conn->error){
            echo $this->conn->error;
        }else{
            return $result->fetch_assoc();
        }
    }

    public function updateCountries($id,$countriesname)
    {
        $sql = "UPDATE countries SET countries_name='$countriesname'
        WHERE countries_id=$id";

        $result = $this->conn->query($sql);

        if($this->conn->error){
            echo $this->conn->error;
        }else{
            $_SESSION['message'] = "Countries updated sucessfully.";
            header("Location: countries.php");
        }

    }

    public function deleteCountries($id)
    {
        $sql = "DELETE FROM countries WHERE countries_id=$id";
        $result = $this->conn->query($sql);

        if($this->conn->error){
            echo $this->conn->error;
        }else{
            $_SESSION['message'] = "Countries updated sucessfully.";
            header("Location: countries.php");
        }

    }

}