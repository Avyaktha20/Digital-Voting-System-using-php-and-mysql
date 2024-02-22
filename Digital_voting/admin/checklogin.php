<!DOCTYPE html>
<html>
<body style="background-color:powderblue;">

<?php
//session_start();
ini_set("display_errors", "1");
error_reporting(E_ALL);

ob_start();
session_start();
require('../connection.php');

$tl_name = "tbadministrators"; // Table name

$myusername = $_POST['myusername'];
$mypassword = $_POST['mypassword'];

$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = $conn->escape_string($myusername);
$hashed_password = password_hash($mypassword, PASSWORD_DEFAULT);

$sql = "SELECT * FROM $tl_name WHERE email='$myusername'";
$result = mysqli_query($conn, $sql);

$count = mysqli_num_rows($result);

if ($count == 1) {
    $user = $result->fetch_assoc();
    // Verify the password
    if (password_verify($user['password'], $hashed_password)) {
        // Password is correct
        if (isset($_POST['remember'])) {
            setcookie('$email', $_POST['myusername'], time() + 30 * 24 * 60 * 60); // 30 days
            setcookie('$pass', $_POST['mypassword'], time() + 30 * 24 * 60 * 60); // 30 days
            $_SESSION['curname'] = $myusername;
            $_SESSION['curpass'] = $mypassword;
            $_SESSION['admin_id'] = $user['admin_id'];
            header("Location: admin.php");
            exit;
        } else {
            $log1 = 11;
            $_SESSION['log1'] = $log1;
            $_SESSION['curname'] = $myusername;
            $_SESSION['curpass'] = $mypassword;
            $_SESSION['admin_id'] = $user['admin_id'];
            header("Location: admin.php");
            exit;
        }
    } else {
        header("Location: access-denied.php");
        exit;
    }
}
    
    // Query to retrieve the admin ID from the database based on username and p

ob_end_flush();
?>





</body>
</html>
