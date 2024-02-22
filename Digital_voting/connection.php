<?php
$DB_SERVER = "localhost";
$DB_USER = "root";
$DB_PASS = "@vyakthak03";
$DB_NAME ="poll";
$conn = mysqli_connect($DB_SERVER,$DB_USER,$DB_PASS,$DB_NAME);
if(!$conn){
    die("COnnection failed! ".mysqli_connect_errno());
}
?>
