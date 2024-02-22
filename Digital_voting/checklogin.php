
<!DOCTYPE html>

<html>
  <body style="background-color:powderblue;">

		<?php
			ini_set ('display_errors', 1);
			error_reporting(E_ALL);
			ob_start();
			session_start();
			include('connection.php');

	  $is_user = true;

			// Defining your login details into variables
			$myusername=$_POST['myusername'];
			$mypassword=$_POST['mypassword'];
			$myusername = stripslashes($myusername);
            $mypassword = stripslashes($mypassword);
            $myusername = $conn->escape_string($myusername);
			$mypassword = $conn->escape_string($mypassword);
			
			$sq="SELECT * FROM `tbmembers` WHERE email='$myusername'";
			$result= mysqli_query($conn, $sq);

			// Checking table row
			$count=mysqli_num_rows($result);
			// If username and password is a match, the count will be 1
      if ($count == 1 && $is_user) {
          $user = $result->fetch_assoc();
          if ($user['password']==$mypassword) { 
            $log2 = 1;
            $_SESSION['log2'] = $log2;
            $_SESSION['curname'] = $myusername;
            $_SESSION['curpass'] = $mypassword;
			$_SESSION['member_id'] = $user['member_id'];   
            header("Location: voter.php");
            exit;
          }
        }
			else {
				header("Location: access-denied.php");
				exit;
			}

		ob_end_flush();

		?> 
    </body>
    </html>