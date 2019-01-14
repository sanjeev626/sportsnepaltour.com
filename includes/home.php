<div class="nav"> You are here > <a href="index.php">Home</a> </div>
<!--nav-->

<h1>Nepal Special Tours <span style="color:#000; font-size:12px; font-weight:100;">(Get the best Trekking and Tour deals for 2019 holidays)</span></h1>
<?php
//echo $mydb->getQuery('aid,title,urlcode,packageimage,duration,description','tbl_package','showinhomepage="1" AND (aid=1 OR aid=2 OR aid=3 OR aid=6) ORDER BY rand() LIMIT 25','1');
$resPackage = $mydb->getQuery('aid,title,urlcode,iconimage,duration,description','tbl_package','showinhomepage="1" AND (aid=1 OR aid=2 OR aid=3 OR aid=6) ORDER BY rand() LIMIT 40');
while($rasPackage=$mydb->fetch_array($resPackage))
{	
	$activitycode = $mydb->getValue('urlcode','tbl_activity','id='.$rasPackage['aid']);
	$packagecode = $rasPackage['urlcode'];
	$imagepath = SITEROOT.'img/package/thumb/'.$rasPackage['iconimage'];
	
?>
<div class="tlist">
  <div class="pim"> <img src="<?php echo $imagepath;?>" title="<?php echo stripslashes($rasPackage['title']);?>" width="225" /> </div>
  <!--pim-->
  <div class="pbrf">
    <div class="pt"> <h2><a href="<?php echo SITEROOT.$activitycode.'/'.$packagecode;?>.html"><?php echo stripslashes($rasPackage['title']);?></a></h2> </div>
    <!--pt-->
    <div class="pdys"> <?php echo stripslashes($rasPackage['duration']);?> </div>
    <!--pdys-->
    <div class="pd"> <?php echo substr(stripslashes($rasPackage['description']),0,200);?>
    </div><!--pd-->
    <div class="pd">
    <b><a href="<?php echo SITEROOT.$activitycode.'/'.$packagecode;?>.html">Check This Trip</a> </b>
    </div><!--pd-->
  </div>
  <!--pbrf-->
</div>
<!--tlist-->
<?php
}
?>