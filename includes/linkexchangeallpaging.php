<?php
session_start();
include('../classes/call.php');

$nor = $mydb->getCount('id','tbl_linkexchange_content');
$pagesize = 15;
$nop = ceil($nor/$pagesize);
$page = $_POST['page'];
  
  if(isset($_POST['page']))
  {
	$start=($_POST['page']*$pagesize)-$pagesize;
	$next_page=$_POST['page']+1;
  }
  else
  {
	$next_page=2;
	$start=0;
  }

$resLinkexchange = $mydb->getQuery('*','tbl_linkexchange_content','1 ORDER BY id DESC LIMIT '.$start.', '.$pagesize);
while($rasLinkexchange = $mydb->fetch_array($resLinkexchange))
{	
	$id = $rasLinkexchange['id'];
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
if($nop>1)
{
	for($i=1;$i<=$nop;$i++)
	{
	?>
	<div style="border:#000000 1px solid; margin-right:5px; float:left; width:25px; text-align:center;">
	<span class="paging_no" href="javascript:void(0);" style="text-decoration:none; color:#F6821F;
	font-weight: bold; cursor:pointer;"><?php echo $i;?></span></div>
	<?php
	}
}
?>
<script type="text/javascript">
$(document).ready(function() {
	
	$(".paging_no").click(function () {
      var page = $(this).html();
	  
	  $("#linkcontent").load("<?php echo SITEROOT;?>includes/linkexchangeallpaging.php", { 'page': page } );
		$(".paging_no").css('color','#F6821F');
		$(this).css('color','#6B1F2C');
    });
	
});
</script>