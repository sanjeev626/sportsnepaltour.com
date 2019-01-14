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
$imagepath 			= 	SITEROOT.'img/package/'.$rasPackage['packageimage'];
//$pdffile			=	$rasPackage['pdffile'];
$title				= 	stripslashes($rasPackage['title']);
$duration 			= 	stripslashes($rasPackage['duration']);
$description 		= 	stripslashes($rasPackage['description']);
$highlights 		= 	stripslashes($rasPackage['highlights']);
$accomodations 		= 	stripslashes($rasPackage['accomodations']);
$itinerary 			= 	stripslashes($rasPackage['itinerary']);
$additionalremarks 	= 	stripslashes($rasPackage['additionalremarks']);
ob_start();
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial, Helvetica, sans-serif;">
  <tr>
    <td><?php echo $title;?></td>
    <td align="right"><?php echo $duration;?></td>
  </tr>
  <tr>
    <td colspan="2"><?php echo $description;?></td>
  </tr>
  <tr>
    <td colspan="2"><img src="<?php echo $imagepath;?>" width="724" height="251" title="<?php echo $title;?>" /></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="50%"><strong>Highlights :</strong></td>
    <td><strong>Accomodations :</strong></td>
  </tr>
  <tr>
    <td valign="top"><?php echo $highlights;?></td>
    <td valign="top"><?php echo $accomodations;?></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><span class="it">Itinerary</span></td>
  </tr>
  <?php
  $resItinerary=$mydb->getQuery('*','tbl_itinerary','pid='.$id);
  while($rasItinerary=$mydb->fetch_array($resItinerary))
  {
  ?>
  <tr>
    <td colspan="2">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="7%"><?php echo $rasItinerary['day'];?></td>
            <td><?php echo $rasItinerary['place'];?></td>
            <td width="17%" align="right" style="padding-left:20px;"><?php echo $rasItinerary['food'];?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><?php echo stripslashes($rasItinerary['description']);?></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>    </td>
  </tr>
  <?php
  }
  if(!empty($additionalremarks))
  {
  ?>
  <tr>
    <td colspan="2">Additional Remarks</td>
  </tr>
  <tr>
    <td colspan="2"><?php echo $additionalremarks;?></td>
  </tr>
  <?php
  }
  ?>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
<?php

$contents = ob_get_clean();
//echo $contents; exit();


require_once("dompdf_config.inc.php");

  if ( get_magic_quotes_gpc() )
    $_POST["html"] = stripslashes($_POST["html"]);
  
  $old_limit = ini_set("memory_limit", "16M");
  
  $dompdf = new DOMPDF();
  $dompdf->load_html($contents);
  $dompdf->set_paper('portrait', 'letter');  //landscape
  $dompdf->render();

  $dompdf->stream($urlcode.".pdf");

  exit(0);

?>

