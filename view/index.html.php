<?php
require_once("../lib/require.php");
require_once("../helper/user.php");
User::checkLogin();
?>

<?php if(! User::isTeacher()){ ?>
<?php include("student.index.php");?>
<?php }else{ ?>
<?php include("teacher.index.php"); ?>
<?php } ?>
