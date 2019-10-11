<?php

require_once("Config.php");

class Loginout extends Config{

    public function owner($name,$password)
    {
        // encrypt the password
        $hash_password = md5($password);
        $sql = "INSERT INTO users(user_name,user_password)
         VALUES('$name','$hash_password')";
        $result = $this->conn->query($sql);

        if($result === TRUE){

            header("Location: addRoom.php");

        }else{
            
            echo $this->conn->error;
        }

    }

    public function login($name,$password)
    {
        $hash_password = md5($password);
        $sql = "SELECT * FROM users
        WHERE user_name = '$name'
        AND user_password = '$hash_password'";
        $result = $this->conn->query($sql);

        if($result->num_rows<= 0 )
        {
            return "Invalid Username or Password";
        }else{
            // set the session value

            $row = $result->fetch_assoc();
            $_SESSION['user_id'] = $row['user_id'];

            if($row['user_role'] === 'admin'){

                header("Location: pages/index.php");

            }elseif($row['user_role'] === 'user'){

                header("Locarion: pages/index.php");

            }
        }

    }

    public function logout()
    {
        session_destroy();
        header("Location: login.php");

    }
}