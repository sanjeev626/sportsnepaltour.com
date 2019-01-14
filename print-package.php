<?php
include('classes/call.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $metatitle;?></title>
<meta name="keywords" content="<?php echo $metakeywords;?>">
<meta name="description" content="<?php echo $metadescription;?>">
<meta name="robots" content="index, follow">
<meta name="revisit-after" content="5 Days">
<meta name="classification" content="Trekking/Tour Operator">
<meta name="Googlebot" content="index, follow">
<link rel="stylesheet" href="<?php echo SITEROOT;?>sports.css" />
<link rel="shortcut icon" href="favicon.ico">
</head>
<body style="margin:10px auto;">
<div class="main">
  <div class="cont">
    <div class="lcont">
      <?php //include('includes/leftmenu.php');?>
    </div>
    <!--lcont-->
    <div class="rcont">
      <?php
			$pid = $_POST['id'];
			$rasPackage = $mydb->getArray('*','tbl_package','id='.$pid);
			
			$urlcode = $rasPackage['urlcode'];
			$id 				= 	$rasPackage['id'];
			$acid 				= 	$rasPackage['aid'];	
			$packagecode 		= 	$rasPackage['urlcode'];
			$imagepath 			= 	SITEROOT.'img/package/'.$rasPackage['packageimage'];
			//$pdffile			=	$rasPackage['pdffile'];
			$title				= 	stripslashes($rasPackage['title']);
			$duration 			= 	stripslashes($rasPackage['duration']);
			$description 		= 	stripslashes($rasPackage['description']);
			$highlights 		= 	stripslashes($rasPackage['highlights']);
			$accomodations 		= 	stripslashes($rasPackage['accomodations']);
			$itinerary 			= 	stripslashes($rasPackage['itinerary']);
			$additionalremarks 	= 	stripslashes($rasPackage['additionalremarks']);
			?>
      <h1><?php echo $title;?></h1>
      <div class="de">
        <div class="dn"> <?php echo $duration;?> </div>
        <!--dn-->
      </div>
      <!--de-->
      <div class="pdes">
        <p><?php echo $description;?></p>
      </div>
      <!--pdes-->
      <div class="pim1"> <img src="<?php echo $imagepath;?>" width="724" height="251" title="<?php echo $title;?>" /> </div>
      <!--pim1-->
      <div class="ha">
        <div class="hls">
          <div class="hti"> Highlights </div>
          <!--hti-->
          <?php echo $highlights;?> </div>
        <!--hls-->
        <div class="acc">
          <div class="ati"> Accomodations </div>
          <?php echo $accomodations;?> </div>
        <!--acc-->
      </div>
      <!--ha-->
      <div class="ite">
        <div class="it"> Itinerary - <?php echo $title;?> </div>
      </div>
      <!--ite-->
      <div class="itinerary">
        <?php
  $resItinerary=$mydb->getQuery('*','tbl_itinerary','pid='.$id);
  while($rasItinerary=$mydb->fetch_array($resItinerary))
  {
  ?>
        <div class="dbyd">
          <div class="dy"> <?php echo $rasItinerary['day'];?> </div>
          <!--dy-->
          <div class="www">
            <div class="whwh"> <?php echo $rasItinerary['place'];?> </div>
            <!--whwh-->
            <div class="bld"> (<?php echo $rasItinerary['food'];?>) <img src="<?php echo SITEROOT;?>im/icon-food.gif" /> </div>
            <!--bld-->
            <div class="dbrf"> <?php echo stripslashes($rasItinerary['description']);?> </div>
            <!--dbrf-->
          </div>
          <!--www-->
        </div>
        <!--dbyd-->
        <?php
  }
  ?>
      </div>
      <!--itinerary-->
      <?php
	  if(!empty($additionalremarks))
	  {
	  ?>
      <div class="adinf">
        <div class="adt"> Additional Remarks </div>
        <!--adt-->
        <div class="ad"> <?php echo $additionalremarks;?> </div>
        <!--ad-->
      </div>
      <?php
	  }
	  ?>
    </div>
    <!--rcont-->
  </div>
  <!--cont-->
</div>
<!--main-->
</body>
</html>
<script type="text/javascript">
	window.print();
</script>