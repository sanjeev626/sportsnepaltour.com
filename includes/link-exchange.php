<div class="nav"> You are here > <a href="<?php echo SITEROOT;?>">Home</a> > <a href="javascript:void(0)">Link Exchange</a> </div>
<!--nav-->
<h1>Link Exchange</h1>
<div class="pdes">
  <p style="padding:20px 0px;">Please Use This Link<br>

Title: Nepal Trekking - Nepal Tour - Nepal Travel Agency.<br>

Description: Nepal Tour - Nepal travel agency for Nepal tour packages, Nepal short hiking, travel packages, Nepal trekking, Nepal Holidays.<br>
 
Web Site: http://www.sportsnepaltour.com<br>
Or<br>
Our Links Code:<br>
<textarea name="linkcode" cols="1" rows="5" style="width:100%"><b><a href="http://www.sportsnepaltour.com" target="_blank">Nepal Tour - Nepal Travel Agency.</a></b><br /><br />
Tour in Nepal - Nepal Tour Packages, Tibet & Bhutan tours & holidays, adventure travel, cultural tour, trekking and rafting trips, wildlife safaris. Nepal Tour, Activity Holiday, Family Adventure.</textarea>
 </p>
</div>
<div>
<div style="padding-top:20px;"><strong>Link Category</strong></div>
<?php
$resLinkexchange = $mydb->getQuery('*','tbl_linkexchange');
while($rasLinkexchange = $mydb->fetch_array($resLinkexchange))
{	
	$lid = $rasLinkexchange['id'];
?>
	<a href="<?php echo SITEROOT.'link-exchange/'.$rasLinkexchange['urlcode'].'.html';?>" onclick="changeContents('<?php echo $lid;?>');"><?php echo $rasLinkexchange['title'].'('.$mydb->getCount('id','tbl_linkexchange_content','lid='.$lid).')';?></a><br>
<?php
}
?>
</div>
<div id="linkcontent">
<?php
$url = $_SERVER['REQUEST_URI'];
$aa = explode('=',$url);
if(count($aa)>1)
	$page = $aa['1'];
else
	$page = 1;
	
//for paging
  $nor = $mydb->getCount('id','tbl_linkexchange_content');
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
	
$resLinkexchange = $mydb->getQuery('*','tbl_linkexchange_content','1 ORDER BY id DESC LIMIT '.$start.','.$pagesize);
while($rasLinkexchange = $mydb->fetch_array($resLinkexchange))
{	
	$lid = $rasLinkexchange['id'];
	$url = str_replace('http://','',$rasLinkexchange['url']);
	$url = str_replace('www.','',$url);
	$url = 'http://www.'.$url;
?>
<div style="padding:20px 0px;">
	<div><strong><?php echo $rasLinkexchange['title'];?></strong></div> 
    <div><a href="<?php echo $url;?>" target="_blank"><?php echo str_replace('http://www.','',$rasLinkexchange['url']);?></a></div>
	<p><?php echo stripslashes($rasLinkexchange['description']);?></p>
</div>
<?php
}
?>
<?php
for($i=1;$i<=$nop;$i++)
{
?>
<div style="border:#000000 1px solid; margin-right:5px; padding-top:2px; float:left; width:25px; text-align:center; <?php if($page==$i) echo 'background:#F6821F;';?>">
<a href="<?php echo SITEROOT.'link-exchange.html?page='.$i;?>" style="text-decoration:none; 
font-weight: bold; cursor:pointer; color:#FFFFFF; <?php if($page==$i) echo 'color:FFFFFF;'; else echo 'color:#F6821F;';?>"><?php echo $i;?></a></div>
<?php
}
?>
</div>
<script type="text/javascript">
	function changeContents(lid)
	{
		$('#linkcontent').load('includes/linkcontents.php',{'lid':lid});
	}

$(document).ready(function() {
	
	$(".paging_no").click(function () {
      var page = $(this).html();
	  
	  $("#linkcontent").load("<?php echo SITEROOT;?>includes/linkexchangeallpaging.php", { 'page': page } );
		$(".paging_no").css('color','#F6821F');
		$(this).css('color','#6B1F2C');
		//alert(aa);
    });
	
});
</script>