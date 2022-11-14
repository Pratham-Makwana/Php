<?php
require_once "config.php";

if(isset($_POST['update']))
{
    $userid=$_GET['id'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    $sql="UPDATE `demo` SET `username`='$username', `email`='$email', `password`='$password' WHERE `id`='$userid'";

    $result=$conn->query($sql);
    if($result==true)
    {
        echo "update successfully";
        header("Location:view.php");
    }
    else
    {
        echo "error".$sql."<br>".$conn->error;
    }
}

if(isset($_GET['id']))
{
    $userid=$_GET['id'];
    $sql="SELECT * FROM `demo` WHERE `id`='$userid'";
    $result=$conn->query($sql);
    if($result->num_rows>0)
    {
        while($row=$result->fetch_assoc())
        {
            $username=$row['username'];
            $email=$row['email'];
            $password=$row['password'];
            $id=$row['id'];
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
    <title>update page</title>
</head>
<body>
    <div class="container">
        <table class="table">
            <h1 class="my-5">Upadte Record</h1>
            <form method="POST">
            <tr>
                <td><label><h5>Username</h5></label></td>
                <td><input type="text" name="username" style="border: radius 5px;" value="<?php echo $username; ?>"></td>
                <input type="hidden" name="user_id" value=<?php echo $id ?>>
            </tr>
            <tr>
                <td><label><h5>Email</h5></label></td>
                <td><input type="text" name="email" style="border: radius 5px;" value="<?php echo $email; ?>"></td>
            </tr>
            <tr>
                <td><label><h5>Password</h5></label></td>
                <td><input type="text" name="password" style="border: radius 5px;" value="<?php echo $password; ?>"></td>
            </tr>
        </table>
        <input type="submit" value="update" name="update" class="btn btn-success">
</form>
    </div>
<?php
    }
}


?>


</body>
</html>