<?php
$serverName='localhost';
$user='root';
$password="";
$dbName='web';

$conn=mysqli_connect($serverName,$user,$password,$dbName);
if(!$conn){
    echo "connection fail";
}
?>