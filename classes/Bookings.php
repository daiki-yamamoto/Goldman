<?php

require_once("Config.php");

class Booking extends Config {

    public function saveBooking($stertdate,$enddate,$numberofguests,$userid,$roomid,$paymethod,$cardnumber)

    {

        $sql ="INSERT INTO bookings(stert_datetime,end_datetime,user_id,room_id,number_of_guests,payment_method,card_number)

                VALUES('$stertdate','$enddate','$userid','$roomid','$numberofguests','$paymethod','$cardnumber')";

        $result = $this->conn->query($sql);

        if($result === TRUE){

            $_SESSION['message'] = "booking added successfully";
            
            header("Location: bookings01.php");
            
        } else{

            echo $this->conn->error;

        }

    }

    public function getBooking()

    {

        $sql = "SELECT * FROM bookings INNER JOIN users ON bookings.user_id=users.user_id

                                    INNER JOIN rooms ON bookings.room_id=rooms.room_id

                                    INNER JOIN rooms ON rooms.room_id=citys.city_id";

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

   

    public function getUserBooking($id)

    {

        $sql = "SELECT * FROM bookings INNER JOIN users ON bookings.user_id=users.user_id

                                    INNER JOIN rooms ON bookings.room_id=rooms.room_id

                                    INNER JOIN citys ON rooms.city_id=citys.city_id
                                    WHERE bookings.user_id=$id";

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

    public function getSingleBooking($id)
    {
        $sql ="SELECT * FROM bookings WHERE booking_id=$id";
        $result = $this->conn->query($sql);

        if($result->num_rows <= 0){
            return false;
        }elseif($this->conn->error){
            echo $this->conn->error;
        }else{
            return $result->fetch_assoc();
        }
    }

    public function updateBooking($id,$title,$bookingcapacity,$bookingprice,$userid,$cityid)
    {
        $sql = "UPDATE bookings SET booking_title='$title',booking_capacity='$bookingcapacity',booking_price='$bookingprice',user_id='$userid',city_id='$cityid'
        WHERE booking_id=$id";

        $result = $this->conn->query($sql);

        if($this->conn->error){
            echo $this->conn->error;
        }else{
            $_SESSION['message'] = "Booking updated sucessfully.";
            header("Location: bookings.php");
        }

    }

    public function deleteBooking($id)

    {

        $sql = "DELETE FROM bookings WHERE booking_id=$id";
        $result = $this->conn->query($sql);

        if($this->conn->error){
            echo $this->conn->error;
        }else{
            $_SESSION['message'] = "Booking updated sucessfully.";
            header("Location: bookings.php");
        }

    }
}