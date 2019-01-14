<?php

session_start();

error_reporting(E_ALL);



require_once("classes/call.php");

$pid = $_POST['id'];

$rasPackage = $mydb->getArray('*','tbl_package','id='.$pid);



$urlcode = $rasPackage['urlcode'];

$id 				= 	$rasPackage['id'];

$acid 				= 	$rasPackage['aid'];	

$packagecode 		= 	$rasPackage['urlcode'];

$imagepath 			= 	'img/package/'.$rasPackage['packageimage'];

//$pdffile			=	$rasPackage['pdffile'];

$title				= 	stripslashes($rasPackage['title']);

$duration 			= 	stripslashes($rasPackage['duration']);

$description 		= 	nl2br(strip_tags(stripslashes($rasPackage['description'])));

$highlights 		= 	nl2br(strip_tags(stripslashes($rasPackage['highlights'])));

$accomodations 		= 	nl2br(strip_tags(stripslashes($rasPackage['accomodations'])));

$additionalremarks 	= 	nl2br(strip_tags(stripslashes($rasPackage['additionalremarks'])));



ob_start();

?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title><?php echo $title;?></title>

<style type="text/css">

body{ font-family:Arial, Helvetica, sans-serif; font-size:12px !important; }

div { font-size:12px !important; }

.maintitle{ padding: 8px 0 8px 0; color: #E87901; font-size: 18px; font-weight: 600; border-bottom: 1px solid #E87901; }

.duration{ color: #7A93A4; font-size: 14px; font-weight: 600;}

.description{ padding:10px 0px; }

.itinerary{ color: #E87901; font-size: 14px; font-weight: 600; padding-top:20px;}

.title{ width:100%; font-size:14px !important; font-weight:bold; padding-top:20px; }

.itititle{ font-weight:bold; }

.itidesc{ padding-bottom:20px; }

.alignright{ text-align:right; }

.valigntop{ vertical-align:top;}

</style>

</head>

<body>

<div class="maintitle"><?php echo $title;?></div>

<div class="duration"><?php echo $duration;?></div>

<div class="description"><?php echo $description;?></div>

<div><img src="<?php echo $imagepath;?>" width="724" height="251" title="<?php echo $title;?>" /></div>

<div class="title">Highlights :</div>

<div><?php echo $highlights;?></div>

<div class="title">Accomodations :</div>

<div><?php echo $accomodations;?></div>

<div class="itinerary">Itinerary</div>



  <?php

  $resItinerary=$mydb->getQuery('*','tbl_itinerary','pid='.$id);

  while($rasItinerary=$mydb->fetch_array($resItinerary))

  {

  ?>

    <div class="itititle"><?php echo $rasItinerary['day'];?> -- <?php echo $rasItinerary['place'];?> (<?php echo $rasItinerary['food'];?>)</div>

    <div class="itidesc"><?php echo nl2br(strip_tags(stripslashes($rasItinerary['description'])));?></div>

  <?php 

  } 

  if(!empty($additionalremarks))

  {

  ?>

  	<div class="title">Additional Remarks</div>

    <div><?php echo $additionalremarks;?></div>

  <?php

  }

  ?>

</body>

</html>

<?php

$contents = ob_get_clean();

  

/*echo $contents;

exit();*/



  require_once("dompdf_0-6-0/dompdf_config.inc.php");

  $old_limit = ini_set("memory_limit", "16M");

  

  $dompdf = new DOMPDF();

  $dompdf->load_html(stripslashes($contents));

  $dompdf->set_paper("a4", "portrait");

  //$dompdf->set_paper("a4", "landscape");

  $dompdf->render();



  $dompdf->stream($urlcode.".pdf");



  exit(0);



?>

<?php echo '<?' . 'xml version="1.0" encoding="iso-8859-1"?' . '>'; ?>