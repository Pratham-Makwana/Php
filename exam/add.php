<?php
require_once "config.php";

if(isset($_POST['submit']))
{
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    $qry="INSERT INTO `demo` (`username`, `email`, `password`) VALUES ('$username', '$email', '$password')";
    $result=$conn->query($qry);
    if($result==true){
        echo "insert successfully";
        header("Location:view.php");
    }else
    {
        echo "Error".$sql."<br>".$conn->error;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Add page</title>
</head>
<body>
    <div class="container">
        <table class="table">
            <h1 class="my-5">Add recored</h1>
            <form method="POST">
                <tr>
                <td><label><h5>username</h5></label></td>
                <td><input type="text" name="username" style="border: radius 5px;"></td>
                </tr>
                <tr>
                    <td><label><h5>Email</h5></label></td>
                    <td><input type="text" name="email" style="border: radius 5px;"></td>
                </tr>
                <tr>
                    <td><label><h5>Password</h5></label></td>
                    <td><input type="text" name="password" style="border: radius 5px;"></td>
                </tr> 
                </table>
                <input type="submit" name="submit" value="submit" class="btn btn-primary"> 
            </form>
    </div>
</body>
</html>