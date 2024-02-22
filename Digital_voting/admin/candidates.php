<?php
    session_start();
    require('../connection.php');
    if(empty($_SESSION['admin_id'])){
      header("location:access-denied.php");
    } 
    $result= mysqli_query($conn, "SELECT * FROM tbcandidates"); 
    if (mysqli_num_rows($result)<1){
        $result = null;
    }
?>

<?php
    $positions_retrieved= mysqli_query($conn,"SELECT * FROM tbPositions"); 
?>

<?php
if (isset($_POST['Submit']))
{

    $newCandidateName = addslashes( $_POST['name'] ); //prevents types of SQL injection
    $newCandidatePosition = addslashes( $_POST['position'] ); //prevents types of SQL injection
    
    $x = mysqli_query($conn,"SELECT * FROM tbcandidates WHERE candidate_name = '$newCandidateName'");
    $row = mysqli_fetch_assoc($x);
    if(!empty($row)){
      die(header("Location:candidates.php"));
    }

    $sql = mysqli_query($conn, "INSERT INTO tbcandidates(`candidate_name`,`candidate_position`) VALUES ('$newCandidateName','$newCandidatePosition')" );

    // redirect back to candidates
     header("Location: candidates.php");
    }
?>

<?php
    // deleting sql query
    // check if the 'id' variable is set in URL
     if (isset($_GET['id']))
     {
     // get id value
     $id = $_GET['id'];
     
     // delete the entry
     $result =  mysqli_query($conn, "DELETE FROM tbCandidates WHERE candidate_id='$id'"); 
     // redirect back to candidates
     header("Location: candidates.php");
     }
     else   
?>

<!DOCTYPE html>

<html>
<head>
<title>CYBERPOLLS</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">

<script language="JavaScript" src="js/user.js">
</script>

</head>
<body id="top">

<div class="wrapper row0">
  <div id="topbar" class="hoc clear"> 
    
  </div>
</div>

<div class="wrapper row1">
  <header id="header" class="hoc clear"> 
    
    <div id="logo" class="fl_left">
      <h1>DIGITAL VOTE</h1>
    </div>
    
    <nav id="mainav" class="fl_right">
      <ul class="clear">
        <li class="active"><a href="candidates.php">Home</a></li>
        <li><a class="drop" href="#">Admin Panel Pages</a>
          <ul>
            <li><a href="manage-admins.php">Manage Admin</a></li>
            <li><a href="positions.php">Manage Positions</a></li>
            <li><a href="candidates.php">Manage Candidates</a></li>
            <li><a href="refresh2.php">Results</a></li>
          </ul>
        </li>
        
        <li><a href="index.php">Voter Panel</a></li>
        <li><a href="logout.php">Logout</a></li>

      </ul>
    </nav>
    
  </header>
</div>

<div >
<table width="380" align="center">
<CAPTION><h3>ADD NEW CANDIDATE</h3></CAPTION>
<form name="fmCandidates" id="fmCandidates" action="candidates.php" method="post" onsubmit="return candidateValidate(this)">
<tr>
    <td bgcolor="#FAEBD7">Candidate Name</td>
    <td bgcolor="#FAEBD7"><input type="text" name="name" /></td>
</tr>

<tr>
    <td bgcolor="#7FFFD4">Candidate Position</td>
    
    <td bgcolor="#7FFFD4"><SELECT NAME="position" id="position">select
    <OPTION VALUE="select">select
    <?php
        //loop through all table rows
        while ($row= mysqli_fetch_array($positions_retrieved)){
          echo "<OPTION VALUE=$row[position_name]>$row[position_name]";
        }
    ?>
    </SELECT>
    </td>
</tr>
<tr>
    <td bgcolor="#BDB76B">&nbsp;</td>
    <td bgcolor="#BDB76B"><input type="submit" name="Submit" value="Add" /></td>
</tr>
</table>
<hr>
<table border="0" width="620" align="center">
<CAPTION><h3>AVAILABLE CANDIDATES</h3></CAPTION>
<tr>
<th>Candidate ID</th>
<th>Candidate Name</th>
<th>Candidate Position</th>
</tr>

<?php
    //loop through all table rows
    while ($row= mysqli_fetch_array($result, MYSQLI_BOTH)){
    echo "<tr>";
    echo "<td>" . $row['candidate_id']."</td>";
    echo "<td>" . $row['candidate_name']."</td>";
    echo "<td>" . $row['candidate_position']."</td>";
    echo '<td><a href="candidates.php?id=' . $row['candidate_id'] . '">Delete Candidate</a></td>';
    echo "</tr>";
    }
    mysqli_free_result($result);
    mysqli_close($conn);
?>

</table>
<hr>
</div>



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
  <p class="fl_left">Copyright &copy; 2024 - All Rights Reserved - <a href="#">Kaushik Bhat</a></p>
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








