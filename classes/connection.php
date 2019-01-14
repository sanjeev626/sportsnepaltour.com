<?php
if($_SERVER['REMOTE_ADDR'] == '127.0.0.1')
{
	define("DBSERVER","localhost");
	define("DBUSER","root");
	define("DBPASSW",'');
	define("DBNAME","sportsnepaltour");
}
else
{	
	/*define("DBSERVER","localhost");
	define("DBUSER","clprj021_sports");
	define("DBPASSW",'UEz51UqU');
	define("DBNAME","clprj021_sportsdb");*/
	
	define("DBSERVER","localhost");
	define("DBUSER","clprj037_npltour");
	define("DBPASSW",'UEz51UqU');
	define("DBNAME","clprj037_nepaltour");
}
	
?>