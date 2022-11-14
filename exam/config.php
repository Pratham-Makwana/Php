<?php

define('server','localhost');
define('username','root');
define('password','');
define('database','bb');

$conn=mysqli_connect(server,username,password,database);

if($conn==false)
{
    die("opps somthing going wrong".mysqli_connect_error());
}

?>