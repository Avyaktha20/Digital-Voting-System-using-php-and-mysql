<?php
require_once('../connection.php');

session_start();
// If your session isn't valid, it returns you to the login screen for protection
if (empty($_SESSION['admin_id'])) {
    header("location:access-denied.php");
    exit(); // It's a good practice to add an exit after a header redirect to stop further execution
}

// Retrieve positions from the database
$positions = mysqli_query($conn, "SELECT * FROM tbPositions");

// Process form submission to retrieve candidate results
if (isset($_POST['Submit'])) {
    $position = addslashes($_POST['position']);

    $results = mysqli_query($conn, "SELECT * FROM tbCandidates WHERE candidate_position='$position'");
    $totalVotes = 0;
    while ($row = mysqli_fetch_assoc($results)) {
       $totalVotes += $row['candidate_cvotes'];
    }

}

?>

<!DOCTYPE html>
<html>

<head>
    <title>CYBERPOLLS</title>
    <link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
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
                    <li class="active"><a href="admin.php">Home</a></li>
                    <li><a class="drop" href="#">Admin Panel Pages</a>
                        <ul>
                            <li><a href="manage-admins.php">Manage Admin</a></li>
                            <li><a href="positions.php">Manage Positions</a></li>
                            <li><a href="candidates.php">Manage Candidates</a></li>
                            <li><a href="refresh.php">Results</a></li>
                        </ul>
                    </li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </header>
    </div>

    <div>
        <div>
            <table width="100%" align="center">
                <form name="fmNames" id="fmNames" method="post" action="refresh2.php">
                    <tr>
                        <td>Choose Position</td>
                        <td>
                            <select name="position" id="position">
                                <option value="select">Select</option>
                                <?php while ($row = mysqli_fetch_array($positions)) : ?>
                                    <option value="<?= $row['position_name'] ?>"><?= $row['position_name'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </td>
                        <td><input type="submit" name="Submit" value="See Results" /></td>
                    </tr>
                </form>
            </table>

            <?php if (isset($_POST['Submit']) && mysqli_num_rows($results) > 0) : ?>
                <table width="100%" align="center" border="1">
                    <tr>
                        <th>Candidate Name</th>
                        <th>Votes</th>
                        <th>Percentage</th>
                    </tr>
                    <?php 
                    $result = mysqli_query($conn,"SELECT * FROM tbCandidates WHERE candidate_position='$position' ORDER BY candidate_cvotes DESC");
                    while ($row = mysqli_fetch_array($result)) : ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row['candidate_name'] ?></td>
                            <td style="text-align: center;"><?php echo $row['candidate_cvotes'] ?></td>
                            <?php if ($totalVotes == 0){
                                ?><td style="text-align: center;"><?= number_format(($row['candidate_cvotes'] / 1) * 100, 2) ?>%</td><?php }
                            else{ 
                                ?><td style="text-align: center;"><?= number_format(($row['candidate_cvotes'] / $totalVotes) * 100, 2) ?>%</td><?php }?>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php endif; ?>
        </div>
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