<?php

require_once("Config.php");
class City extends Config {

    public function save($name,$countries)

    {
        $sql ="INSERT INTO citys(city_name,countries_id)

                VALUES('$name','$countries')";

        $result = $this->conn->query($sql);

        if($result === TRUE){

            $_SESSION['message'] = "City added successfully";
            
            header("Location: citys.php");
            
        } else{
            echo $this->conn->error;

        }
    }

    public function getCity()
    {
        $sql = "SELECT * FROM citys INNER JOIN countries ON citys.countries_id=countries.countries_id";
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

    public function getSingleCity($id)
    {
        $sql ="SELECT * FROM citys WHERE city_id=$id";
        $result = $this->conn->query($sql);

        if($result->num_rows <= 0){
            return false;
        }elseif($this->conn->error){
            echo $this->conn->error;
        }else{
            return $result->fetch_assoc();
        }
    }

    public function updateCity($id,$cityname)
    {
        $sql = "UPDATE citys SET city_name='$cityname'
        WHERE city_id=$id";

        $result = $this->conn->query($sql);

        if($this->conn->error){
            echo $this->conn->error;
        }else{
            $_SESSION['message'] = "City updated sucessfully.";
            header("Location: city.php");
        }

    }

    public function deleteCity($id)
    {
        $sql = "DELETE FROM citys WHERE city_id=$id";
        $result = $this->conn->query($sql);

        if($this->conn->error){
            echo $this->conn->error;
        }else{
            $_SESSION['message'] = "City updated sucessfully.";
            header("Location: city.php");
        }

    }

}