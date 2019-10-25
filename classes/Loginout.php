<?php

require_once("Config.php");

class Loginout extends Config{
    
    public function loginUser($name,$password,$roomid)
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

            if($row['user_status'] === 'A'){

                header("Location: addBooking.php?room_id=$roomid");

            }elseif($row['user_status'] === 'U'){

                header("Locarion: index.php");

            }
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

            if($row['user_status'] === 'A'){

                header("Location: addRoom.php");

            }elseif($row['user_status'] === 'U'){

                header("Locarion: addRoom.php");

            }
        }

    }

    public function logout()
    {
        session_destroy();
        header("Location: login.php");

    }
}