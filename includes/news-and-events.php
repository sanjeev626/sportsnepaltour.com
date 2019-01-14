<div class="nav"> You are here > <a href="<?php echo SITEROOT;?>">Home</a> > <a href="">News and Events</a> </div>
<!--nav-->
<h1>News and Events</h1>
<?php

$url = $_SERVER['REQUEST_URI'];
$aa = explode('=',$url);
if(count($aa)>1)
	$page = $aa['1'];
else
	$page = 1;
	
//for paging
  $nor = $mydb->getCount('id','tbl_news');
  $pagesize = 25;
  $nop = ceil($nor/$pagesize);
  
  if(isset($page))
  {
	$start=($page*$pagesize)-$pagesize;
	$next_page=$page+1;
  }
  else
  {
	$next_page=2;
	$start=0;
  }

$resNews = $mydb->getQuery('*','tbl_news','1 ORDER BY id DESC LIMIT '.$start.','.$pagesize);
while($rasNews = $mydb->fetch_array($resNews))
{
$contents = strip_tags(stripslashes($rasNews['contents']));
?>
<div class="de"><strong><?php echo stripslashes($rasNews['title']);?></strong></div>
<div class="pdes">
	<?php echo substr($contents,0,240); if(strlen($contents)>240){?> <a href="<?php echo SITEROOT.$rasNews['urlcode'];?>.html" style="text-decoration:none;">more... </a><?php } ?>
</div>
<?php
}
?>
<div style="padding-top:10px;">
<?php
for($i=1;$i<=$nop;$i++)
{
?>
<div style="border:#000000 1px solid; margin-right:5px; padding-top:2px; float:left; width:25px; text-align:center; <?php if($page==$i) echo 'background:#F6821F;';?>">
<a href="<?php echo SITEROOT.'news-and-events.html?page='.$i;?>" style="text-decoration:none; 
font-weight: bold; cursor:pointer; color:#FFFFFF; <?php if($page==$i) echo 'color:FFFFFF;'; else echo 'color:#F6821F;';?>"><?php echo $i;?></a></div>
<?php
}
?>
</div>