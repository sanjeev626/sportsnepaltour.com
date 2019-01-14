<?php
session_start();
include('classes/call.php');
if(isset($_GET['pid']))
	$pid = $_GET['pid'];
else
	$pid = 1;
	
$imgCount = $mydb->getCount('id','tbl_image','gid='.$pid);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet"  href="<?php echo SITEROOT;?>lightbox/jquery-ui.css" type="text/css" media="all">
<script type="text/javascript" src="<?php echo SITEROOT;?>js/jquery-1.6.2.js"></script>
<script src="<?php echo SITEROOT;?>lightbox/jquery-ui.min.js" type="text/javascript"></script>
<script type="text/javascript"> 
     $(document).ready(function(){ 
	   <?php
	   for($i=0;$i<$imgCount;$i++)
	   {
	   ?>
       $('#imageclick<?php echo $i;?>').bind('click', function(){ 
         var imgtitle = this.title;
		 $("#mdw").dialog({ 
           modal: true, 
           width: 600, 
           title: imgtitle 
         }); 
		 var imgpath = this.href;
		 var imgsrc = '<img src="'+imgpath+'" height="350">';
		 //alert(imgsrc);
		 $("#mdw").html(imgsrc);
		 
		 $("#mdw").css('height','100%');
		 $(".ui-dialog-title").css('margin-top','-6px');
		 $(".ui-dialog-titlebar").css('height','10px');
		 $(".ui-dialog").css('top','2px');
		 $(".ui-dialog").css('height','390px');
         return false; 
       });
	   <?php
	   }
	   ?>
     }); 	 
  </script>
<?php /*?><script type="text/javascript" src="<?php echo SITEROOT;?>js/jquery-1.6.2.js"></script>
<script type="text/javascript" src="<?php echo SITEROOT;?>js/thumbnailviewer2.js"></script><?php */?>
<title>Enlarge Image on mousehover</title>
</head>
<body>
<div id="mdw" align="center"></div>
<div style="padding:20px; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
<?php
$rasPlace = $mydb->getArray('title,description','tbl_place','id='.$pid);
$title = stripslashes($rasPlace['title']);
$description = stripslashes(nl2br($rasPlace['description']));
?>
  <div style="font-size:18px;"><?php echo $title;?></div>
  <div style="padding-bottom:20px;"><?php echo $description;?></div>
  <?php
$counter=0;
$resImg = $mydb->getQuery('*','tbl_image','gid='.$pid);
while($rasImg = $mydb->fetch_array($resImg))
{
?>
  <a href="<?php echo SITEROOT;?>img/place/<?php echo $rasImg['imagename'];?>" rel="enlargeimage" rev="targetdiv:loadarea" id="imageclick<?php echo $counter;?>" title="<?php echo stripslashes($rasImg['imagetitle']);?>"><img src="<?php echo SITEROOT;?>img/place/<?php echo $rasImg['imagename'];?>" alt="<?php echo stripslashes($rasImg['imagetitle']);?>" height="75px;" /></a>
  <?php
++$counter;
}
?>
</div>
</body>
</html>
