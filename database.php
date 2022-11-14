<?php

define('server','localhost');
define('username','root');
define('password','');
define('database','exam');

$link=mysqli_connect(server,username,password,database);

if($link==false)
{
    die("Error".mysqli_connect_error());
}


?>