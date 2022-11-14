<?php

require_once "database.php";

$name=$email=$salary="";
$name_err=$email_err=$salary_err="";

if(isset($_POST['id']) && !empty($_POST['id']))
{
    $id=$_POST['id'];

    $input_name=trim($_POST['name']);

    if(empty($input_name))
    {
        $name_err="Please enter your name";
    }elseif (!preg_match("/^[a-zA-z]*$/",$input_name)) 
    {
        $name_err="only aplphabets and whitespace allowed";        
    }else
    {
        $name=$input_name;
    }

    $input_email=trim($_POST['email']);

    if(empty($input_email))
    {
        $email_err="Please enter your email";
    }
    elseif(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$input_email))
    {
        $email_err="enter valid email";
    }else   
    {
        $email=$input_email;
    }

    $input_salary=trim($_POST['salary']);

    if(empty($input_salary))
    {
        $salary_err="please enter your salary";
    }
    elseif(!ctype_digit($input_salary))
    {
        $salary_err="enter in digit";
    }
    else
    {
        $salary=$input_salary;
    }

    if(empty($name_err) && empty($eamil_err) && empty($salary_err))
    {
        $Sql="UPDATE person SET name=?, email=?, salary=? WHERE id=?";

        if($stmt=mysqli_prepare($link,$Sql))
        {
            mysqli_stmt_bind_param($stmt,"sssi",$param_name,$param_email,$param_salary,$param_id);

            $param_name=$name;
            $param_email=$email;
            $param_salary=$salary;
            $param_id=$id;

            if(mysqli_stmt_execute($stmt))
            {
                header("Location:firstpage.php");
                exit();
            }
            else {
                echo "OPPS something going wrong";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
else {
    if(isset($_GET['id']) && !empty(trim($_GET['id'])));

    $id=trim($_GET['id']);

    $Sql="SELECT * FROM person WHERE id=?";

    if($stmt=mysqli_prepare($link,$Sql))
    {
        mysqli_stmt_bind_param($stmt,"i",$param_id);

        $param_id=$id;

        if(mysqli_stmt_execute($stmt))
        {
            $result=mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($result)==1)
            {
                $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

                $name=$row['name'];
                $email=$row['email'];
                $salary=$row['salary'];
            }
            else
            {
                echo "No row selected";
            }
        }
        else
        {
            echo "Opps something going wrong";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Upadate page</title>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2>Update records</h2>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="<?php echo $name; ?>"><br><?php if(!empty($name_err)) echo $name_err; else ""; ?>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" value="<?php echo $email; ?>"><br><?php if(!empty($eamil_err)) echo $email_err; else "";?>
                    </div>
                    <div class="form-group">
                        <label>Salary</label>
                        <input type="text" name="salary" value="<?php echo $salary ?>"><br><?php if(!empty($salary_err)) echo $salary_err; else ""; ?>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <input type="submit" value="submit" class="btn btn-primary">
                    <a href="firstpage.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
    </div>

    </div>
</body>
</html>