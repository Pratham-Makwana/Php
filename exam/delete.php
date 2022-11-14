<?php
require_once "config.php";

if(isset($_GET['id']))
{
    $userid=$_GET['id'];
    $sql="DELETE FROM `demo` WHERE `id`='$userid'";
    $result=$conn->query($sql);

    if($result==true)
    {
        echo "delete succcessfully";
        header("Location:view.php");
    }else
    {
        echo "error".$sql."<br>".$conn->error;
    }
}

?>