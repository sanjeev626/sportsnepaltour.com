<?php

session_start();

error_reporting(E_ALL);

require_once("../classes/call.php");

//echo $mydb->md5_encrypt('654321', SECRETPASSWORD)."<br>";
echo $mydb->md5_decrypt('KeJ/viu+B0HhrtKD+LDx7A0uMv0iJ2xX+7A8++Rn4h4=', SECRETPASSWORD)."<br>";
//print_r($_SESSION);

if(isset($_SESSION[ADMINUSER]))

	$userid = $_SESSION[ADMINUSER];

?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>

<?php include("adminincludes.php"); ?>

<?php include("req.php"); ?>



<title><?php echo stripslashes($mydb->getValue("title", "tbl_admin",'id=1')); ?></title>

</head>

<body>

<?php if(!isset($_SESSION[ADMINUSER])){ ?>

<div id="page-wrap">

  <div class="sitename_admin" align="center">Dashboard</div>

  <div id="login-wrap">

    <?php include("login.php"); ?>

  </div>  

</div>

<?php }else{ ?>

<?php include("header.php"); ?>

<div class="adminContent">

  <div class="nav-outer-repeat">

    <div class="nav-outer">

	  <div style="color:#FFFFFF; font-weight:bold; padding-top:5px; padding-left:10px; float:left;"><?php include("adminnavigation.php"); ?></div>      

    </div>

    <div class="clear"></div>

  </div>

  <div style="background:#fff url(images/containerbg.jpg) repeat-x left top;">

    <?php

	 if(isset($_GET[ADMINACTIONNAME]))

	 {

		 if(file_exists($_GET[ADMINACTIONNAME].".php"))

		 {

		 ?>

        <div class="adminContent">

          <div class="adminContentinner">

            <?php include($_GET[ADMINACTIONNAME].".php");?>

          </div>

        </div>

    	<?php

		}

		else

		{

			echo "file doesn't exists.";

		}

	}

	else

	{

		include("home.php");

	}

?>

  </div>

</div>

<?php } ?>

</div>

</body>

</html>

