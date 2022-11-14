<?php

require_once "database.php";

$name=$eamil=$salary="";
$name_err=$eamil_err=$salary_err="";

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $input_name=trim($_POST['name']);
    if(empty($input_name))
    {
        $name_err="Please Enter your name";
    }
    elseif(!preg_match("/^[a-zA-Z]*$/",$input_name))
    {
        $name_err="only alphabets and whitespace are allowed";
    }
    else
    {
        $name=$input_name;
    }

    $input_email=trim($_POST['email']);
    if(empty($input_email))
    {
        $eamil_err="Please enter your email";
    }elseif(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$input_email))
    {
        $eamil_err="enter valid email";
    }
    else
    {
        $eamil=$input_email;
    }

    $input_salary=trim($_POST['salary']);
    if(empty($input_salary))
    {
        $salary_err="please enter salary";
    }elseif(!ctype_digit($input_salary))
    {
        $salary_err="salary must be in digit";
    }
    else
    {
        $salary=$input_salary;
    }

    if(empty($name_err) && empty($eamil_err) && empty($salary_err))
    {
        $sql="INSERT INTO person (name,email,salary) VALUES (?, ?, ?)";

        if($stmt=mysqli_prepare($link,$sql))
        {
            mysqli_stmt_bind_param($stmt,'sss',$param_name,$param_email,$param_salary);

            $param_name=$name;
            $param_email=$eamil;
            $param_salary=$salary;

            if(mysqli_stmt_execute($stmt))
            {
                header('Location:firstpage.php');
                exit();
            }else{
                echo"oops somthing going wrong";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>

<html lang="en">
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>add page</title>
    </head>
    <body>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" value="<?php echo $name; ?>"><br><?php if(!empty($name_err)) echo $name_err; else echo ''; ?>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="text" name="email" value="<?php echo $eamil; ?>"><br><?php if(!empty($eamil_err)) echo $eamil_err; else echo ''; ?>
        </div>
        <div>
            <label for="salary">Salary</label>
            <input type="text" name="salary" value="<?php echo $salary; ?>"><br><?php if(!empty($salary_err)) echo $salary_err; else echo '';?>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </body>
</html>