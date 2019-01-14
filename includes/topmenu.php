<div class="menu">
  <ul id="topnav">
    <li id="home"><a href="<?php echo SITEROOT;?>">Home</a></li>
    <?php
    $resActivity = $mydb->getQuery('*','tbl_activity','1 ORDER BY ordering LIMIT 6');
	while($rasActivity=$mydb->fetch_array($resActivity))
	{
	?>
    <li id="<?php echo $rasActivity['liid'];?>"><a href="<?php echo SITEROOT.$rasActivity['urlcode'];?>.html"><?php echo $rasActivity['title'];?></a></li>
    <?php
	}
    ?>
  </ul>
  <?php
    $resActivity = $mydb->getQuery('*','tbl_activity','1 ORDER BY ordering LIMIT 6');
	while($rasActivity=$mydb->fetch_array($resActivity))
	{
	$aid = $rasActivity['id'];
	$aa = $aid-1;
	if($aa==0)
		$aa='';
	
	$activitycode = $rasActivity['urlcode'];
	?>
  <div class="sub<?php echo $aa;?>">
    <div class="subcont">
      <div class="tlink">
        <ul>
          <?php
			$resPackage = $mydb->getQuery('*','tbl_package','aid='.$aid.' ORDER BY ordering');
			while($rasPackage=$mydb->fetch_array($resPackage))
			{			
				$packagecode = $rasPackage['urlcode'];
			?>
          <li><a href="<?php echo SITEROOT.$activitycode.'/'.$packagecode;?>.html"><?php echo $rasPackage['title'];?></a></li>
          <?php
			}
			?>
        </ul>
      </div>     
      <!--tlink--> 
    </div>
    <!--subcont--> 
  </div>
  <?php
    }
    ?>
</div>
<!--menu--> 