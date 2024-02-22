<!DOCTYPE html>
<html>
<head>
<title>CYBERPOLLS</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<!-- <link href="css/user_styles.css" rel="stylesheet" type="text/css" /> -->
<script language="JavaScript" src="js/user.js">
</script>

</head>
<body id="top">
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row0">
  <div id="topbar" class="hoc clear"> 
    <!-- ################################################################################################ -->
  </div>
</div>
<div class="wrapper row1">
  <header id="header" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <div id="logo" class="fl_left">
      <h1>DIGITAL VOTE</h1>
    </div>
    <!-- ################################################################################################ -->
    <nav id="mainav" class="fl_right">
      <ul class="clear">
        <li class="active"><a href="admin.php">Home</a></li>
        
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
    <!-- ################################################################################################ -->
  </header>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->

<div class="wrapper bgded overlay" style="background-image:url('images/bg.jpg');">
  <section id="testimonials" class="hoc container clear"> 
    <!-- ################################################################################################ -->
    <h2 class="font-x3 uppercase btmspace-80 underlined">CYBERPOLLS</h2>
    <ul class="nospace group">
      <li class="one_half">
        <blockquote>


<div >

<?php
session_start();
        include('../connection.php');
				//If your session isn't valid, it returns you to the login screen for protection
				if(empty($_SESSION['admin_id'])){
				 	header("location:access-denied.php");
				}
				
				//Process
				if (isset($_POST['submit']))
				{

					$myFirstName = addslashes( $_POST['firstname'] ); //prevents types of SQL injection
					$myLastName = addslashes( $_POST['lastname'] ); //prevents types of SQL injection
					$myEmail = $_POST['email'];
					$myPassword = $_POST['password'];

					$newpass = password_hash($myPassword,PASSWORD_DEFAULT); //This will make your password encrypted into md5, a high security hash
          $x = mysqli_query($conn,"SELECT * FROM tbadministrators WHERE email = '$myEmail'");
          if(!empty($x)){
            die(header("Location:manage-admins.php"));
          }
					$sql = mysqli_query($conn, "INSERT INTO tbAdministrators(first_name, last_name, email, password) VALUES ('$myFirstName','$myLastName', '$myEmail', '$newpass')" );

					die( "A new administrator account has been created." );
				}

				//Process
				if (isset($_POST['update'])) {
				
					// Sanitize and retrieve data from the form
					$myId = $_SESSION['admin_id']; // Convert to integer to prevent SQL injection
					$myFirstName = addslashes ($_POST['firstname']);
					$myLastName = addslashes($_POST['lastname']);
					$myEmail = $_POST['email'];
					$myPassword = $_POST['password'];
					$newpass = password_hash($myPassword, PASSWORD_DEFAULT);
				
					// Prepare and execute the SQL update query
					$sql = mysqli_query($conn, "UPDATE tbadministrators SET first_name='$myFirstName', last_name='$myLastName', email='$myEmail', password='$newpass' WHERE admin_id = '$myId'");
					// Check if the update was successful
					if ($sql) {
						echo "An administrator account has been updated.";
					} else {
						echo "Error updating administrator account: " . mysqli_error($conn);
					}
				}
				?>
	</div> 
	
		<table style="background-color:powderblue;" width="300" border="0" align="center" cellpadding="0" cellspacing="1">
<tr>
<form name="form1" method="post" action="manage-admins.php" onSubmit="return updateProfile(this)">
<td>
<table style="background-color:powderblue;" width="100%" border="0" cellpadding="3" cellspacing="1" >

    <tr>
	<td style="color:#000000"; width="120" >First Name</td>
	<td style="color:#000000"; width="6">:</td>
	<td style="color:#000000"; width="294"><input name="firstname" type="text" ></td>
	</tr>

	<tr>
	<td style="color:#000000"; width="120" >Last Name</td>
	<td style="color:#000000"; width="6">:</td>
	<td style="color:#000000"; width="294"><input name="lastname" type="text" ></td>
	</tr>

	<tr>
	<td style="color:#000000"; width="150" >Email</td>
	<td style="color:#000000"; width="6">:</td>
	<td style="color:#000000"; width="294"><input name="email" type="text" ></td>
	</tr>

	<tr>
	<td style="color:#000000"; >Password</td>
	<td style="color:#000000"; >:</td>
	<td style="color:#000000"; ><input name="password" type="password" ></td>
	</tr>

	<tr>
	<td style="color:#000000"; >Confirm Password</td>
	<td style="color:#000000"; >:</td>
	<td style="color:#000000"; ><input name="ConfirmPassword" type="password" ></td>
	</tr>

	<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td style="color:#000000";><input type="submit" name="submit" value="Register Account"></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>	
	<td style="color:#000000";><input type="submit" name="update" value="Update Account"></td>
	</tr>

</table>
</td>
</form>
</tr>
</table>
</blockquote>
      
      </li>
    </ul>
    <!-- ################################################################################################ -->
  </section>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row4">
<footer id="footer" class="hoc clear"> 
    
    <div class="one_third first">
      <h6 class="title">Team Members</h6>
      <ul class="nospace linklist contact">
        <li><i class="fa fa-map-marker"></i>
          <address>
         
          <p>
          Avyaktha K<br>
          Kaushik Bhat<br>
          Nagarjun C S<br>
          </p>
          </address>
        </li>
      </ul>
    </div>

    <div class="one_third">
      <h6 class="title">Phone</h6>
      <ul class="nospace linklist contact">
       
        <li><i class="fa fa-phone"></i> +917619239132<br>
          +917829087110<br>
          +919481216694</li>


      </ul>
    </div>

    <div class="one_third">
      <h6 class="title">Email</h6>
      <ul class="nospace linklist contact">
        
        <li><i class="fa fa-envelope-o"></i>kaushikbhat1205@gmail.com</li>

      </ul>
    </div>


  </footer>
</div>

<div class="wrapper row5">
  <div id="copyright" class="hoc clear"> 
    <!-- ################################################################################################ -->
	<p class="fl_left">Copyright &copy; 2024 - All Rights Reserved - <a href="#">Kaushik Bhat</a></p>
    <!-- ################################################################################################ -->
  </div>
</div>
<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
<!-- IE9 Placeholder Support -->
<script src="layout/scripts/jquery.placeholder.min.js"></script>
<!-- / IE9 Placeholder Support -->
</body>
</html>

		
