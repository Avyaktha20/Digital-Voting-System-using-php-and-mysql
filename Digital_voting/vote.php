<!DOCTYPE html>

<html>
<head>
<title>CYBERPOLLS</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">

<script language="JavaScript" src="js/user.js"></script>

</head>
<body id="top">

<div class="wrapper row0">
  <div id="topbar" class="hoc clear"> 
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
        <li class="active"><a href="voter.php">Home</a></li>
        <li><a class="drop" href="#">Voter Pages</a>
          <ul>
            <li><a href="vote.php">Vote</a></li>
            <li><a href="manage-profile.php">Manage my profile</a></li>
          </ul>
        </li>
        
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
    <!-- ################################################################################################ -->
  </header>
</div>
<?php
// Include the database connection file
require_once 'connection.php';
session_start();
// Check if the user is logged in
if (!isset($_SESSION['member_id'])) {
    header("location:access-denied.php");
    exit();
}

$x = $_SESSION['member_id'];
$result = mysqli_query($conn,"SELECT * from votes WHERE member_id = $x");
$count=mysqli_num_rows($result);
if($count) {
  die("ALREADY VOTED!!!");
}
// Check if the form is submitted for voting
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Submit'])) {
    $candidate_id = $_POST['candidate_id'];
    // Perform the voting process
    // Example: Update the vote count in the database for the selected candidate
    $query = "UPDATE tbCandidates SET candidate_cvotes = candidate_cvotes + 1 WHERE candidate_id = $candidate_id";
   
    $sql = "INSERT INTO votes VALUES($x)";
    $res = mysqli_query($conn,$sql);

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Vote successfully submitted');</script>";
        header("Location: voter.php");
        exit;
    } else {
        echo "<script>alert('Error in submitting vote');</script>";
    }
}
if(isset($_POST['search'])){
  $position = addslashes($_POST['position']);
}
// Retrieve the list of candidates from the database
?>

<!-- Display the form for voting -->
<form name="fmPositions" id="fmPositions" method="post">
<table>
<tr>
<td bgcolor="#00ff80">Position Name</td>
<td bgcolor="#808080"><input type="text" name="position" ></td>
<td bgcolor="#00FF00"><input type="submit" name="search" value="search" /></td>
</tr> 
</table>
</form>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
 <table>
     <tr>
       <td><label for="candidate_id">Select Candidate:</label>
            <select name="candidate_id" id="candidate_id">
              <option value="select">Select</option>
            <?php
              if(isset($_POST['search'])){
                
                $result = mysqli_query($conn, "SELECT * from tbcandidates WHERE candidate_position = '$position'");

              while ($rows = mysqli_fetch_assoc($result)) {
               echo "<option value='" . $rows['candidate_id'] . "'>" . $rows['candidate_name'] . "</option>";
              }
            }

            ?>
            </select>
      </td>
      <td><input type="submit" name="Submit" value="Vote"></td></tr>
      </table>
</form>

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

