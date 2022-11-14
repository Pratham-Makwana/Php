<?php

if(isset($_POST['id']) && !empty($_POST['id']))
{
    require_once "database.php";

    $sql="DELETE FROM person WHERE id=?";

    if($stmt=mysqli_prepare($link,$sql))
    {
        mysqli_stmt_bind_param($stmt,"i",$param_id);

        $param_id=trim($_POST["id"]);

        if(mysqli_stmt_execute($stmt))
        {
            header("Location:firstpage.php");
            exit();
        }else
        {
            echo "Opps Something going wrong";
        }

    }
    mysqli_stmt_close($stmt);

    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>delete page</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 md-5">delete record</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="alert alert-danger">
                        <input type="text" name="id" value="<?php echo trim($_GET['id']); ?>">
                        <p>Are you sure you want to delete this record</p>
                        <p>
                            <input type="submit" value="yes" class="btn btn-danger">
                            <a href="firstpage.php" class="btn btn-secondary">No</a>
                        </p>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>