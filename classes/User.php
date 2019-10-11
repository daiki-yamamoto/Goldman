<?php

require_once("Config.php");
class User extends Config {

    public function save($name,$email,$phonenumber,$password)
    {
        $sql ="INSERT INTO users(user_name,user_mail,user_phonenumber,user_password)
                VALUES('$name','$email','$phonenumber','$password')";

        $result = $this->conn->query($sql);

        if($result === TRUE){
            $_SESSION['message'] = "User added successfully";
            
            header("Location: users.php");
            
        } else{
            echo $this->conn->error;

        }
    }

    public function getUsers()
    {
        $sql = "SELECT * FROM users";
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

    public function getSingleUser($id)
    {
        $sql ="SELECT * FROM users WHERE user_id=$id";
        $result = $this->conn->query($sql);

        if($result->num_rows <= 0){
            return false;
        }elseif($this->conn->error){
            echo $this->conn->error;
        }else{
            return $result->fetch_assoc();
        }
    }

    public function updateUser($id,$username,$usermail,$userphonenumber)
    {
        $sql = "UPDATE users SET user_name='$username',
        user_mail='$usermail',
        user_phonenumber='$userphonenumber'
        WHERE user_id=$id";

        $result = $this->conn->query($sql);

        if($this->conn->error){
            echo $this->conn->error;
        }else{
            $_SESSION['message'] = "User updated sucessfully.";
            header("Location: users.php");
        }

    }

    public function deleteUser($id)
    {
        $sql = "DELETE FROM users WHERE user_id=$id";
        $result = $this->conn->query($sql);

        if($this->conn->error){
            echo $this->conn->error;
        }else{
            $_SESSION['message'] = "User updated sucessfully.";
            header("Location: users.php");
        }

    }

}