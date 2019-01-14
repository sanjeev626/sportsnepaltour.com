<?php

$rasActivity = $mydb->getArray('*','tbl_activity','id='.$id);

$activitycode = $rasActivity['urlcode'];

//echo $id;

?>

<h1><?php echo $rasActivity['title'];?></h1>

<p><?php echo stripslashes($rasActivity['description']);?></p>

<?php

$resPackage = $mydb->getQuery('*','tbl_package','aid='.$id.' ORDER BY ordering');

while($rasPackage = $mydb->fetch_array($resPackage))

{

	$packagecode = $rasPackage['urlcode'];

	$packagelink = SITEROOT.$activitycode.'/'.$packagecode.'.html';

?>

<div class="tlist">

    <div class="pim">

        <img src="img/package/thumb/<?php echo $rasPackage['iconimage'];?>" title="<?php echo $rasPackage['title'];?>" width="225" />

    </div><!--pim-->

    <div class="pbrf">

        <div class="pt">
            <h2>
            <a href="<?php echo $packagelink;?>"><?php echo $rasPackage['title'];?></a>
            </h2>
        </div><!--pt-->

        <div class="pdys">

            <?php echo $rasPackage['duration'];?>

        </div><!--pdys-->

        <div class="pd">

            <?php echo substr($rasPackage['description'],0,300);?>
        </div><!--pd-->
        <div class="pd">
        <b><a href="<?php echo SITEROOT.$activitycode.'/'.$packagecode;?>.html">Check This Trip</a> </b>

        </div><!--pd-->

    </div><!--pbrf-->

</div><!--tlist-->

<?php

}

?>