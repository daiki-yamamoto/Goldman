<?php

session_start();
require_once("classes/Loginout.php");
$login = new Loginout;

if (isset($_POST['loginOwner'])){
    $name = $_POST['name'];
    $password = $_POST['password'];


    $user->owner($name,$password);
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b79203f29b.js"></script>
	<title>Owner</title>
</head>
<body>



        <div class="bg-primary text-white d-flex flex-wrap align-content-start"> 
        <i class="far fa-star fa-5x my-blue  faa-spin animated"></i>
        <h1>Owner</h1>
        </div>

        <form method="post" action="">
            <div class="form-group">
                <label for="username">User Name</label>
                <input type="text"  class="form-control" name="name" placeholder="User Name"><br>

                <label for="Password">Password</label>
                <input type="password"  class="form-control" name="password" placeholder="Password"><br>

                <input type="submit"  class="form-control btn btn-primary" name="loginOwner" value="Regist">
            </div>
        </form>
        


</body>
</html>