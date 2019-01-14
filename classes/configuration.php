<?php
// client
define("ACTIONNAME","manager");
define("URLPATH","index.php?".ACTIONNAME."=");
if($_SERVER['REMOTE_ADDR'] == '127.0.0.1')
{
	define("SITEROOT","http://sportsnepaltour.dac/");
	define("SITEROOTDOC",$_SERVER['DOCUMENT_ROOT']."/");
}
else
{
	/*define("SITEROOT","http://freelancenepal.com/sportstoursandtravel/");
	define("SITEROOTDOC",$_SERVER['DOCUMENT_ROOT']."/sportstoursandtravel/");*/
	define("SITEROOT","http://www.sportsnepaltour.com/");
	define("SITEROOTDOC",$_SERVER['DOCUMENT_ROOT']."/");
}

define("FILEPATH","includes/");
define("PAGING","dashboard/");
define("IMAGEPATH","images/");

define("USERID","sanjeevdbclientuser");

$allowedimageext = array ("jpg", "jpeg", "gif", "png");

$allowedextfile = array ("pdf", "doc", "docx", "txt", "xls");



// admin
define("SITEADMINHEADER","sportsnepaltour.com");
define("SITEADMINFOOTER","2012 Sports Nepal Tour");

define("ADMINACTIONNAME","manager");
define("ADMINURLPATH","index.php?".ADMINACTIONNAME."=");
define("ADMINUSER","sanjeevdbdfg546gfddgdfg");
define("SECRETPASSWORD","sanjeevsinghdbementendc");

?>