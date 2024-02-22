<?php
include("../connection.php");

mysqli_query($conn,"DELETE FROM votes");
mysqli_query($conn,"UPDATE tbcandidates SET candidate_cvotes = 0");
header("Location: admin.php");
exit;
  ?>