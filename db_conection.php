<?php 

# server name
$host = "localhost:3310";
# user name
$username = "root";
# password
$password= "";

# database name
$db_name = "t_school";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", 
                    $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connection failed : ". $e->getMessage();
}