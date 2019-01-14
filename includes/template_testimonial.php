<div class="nav"> You are here > <a href="<?php echo SITEROOT;?>">Home</a> > <a href="javascript:void(0);">Testimonials</a> </div>
<!--nav-->
<h1>Testimonials</h1>
<?php
$resTestimonial = $mydb->getQuery('t.name,t.address,t.contents,p.title,p.aid,p.urlcode','tbl_testimonial t INNER JOIN tbl_package p ON p.id=t.package','1 ORDER BY t.ordering ASC');
while($rasTestimonial=$mydb->fetch_array($resTestimonial))
{
$pid = $rasTestimonial['package'];
$aid = $rasTestimonial['aid'];
	if(isset($aid) && $aid>0)
	{
		$activitycode = $mydb->getValue('urlcode','tbl_activity','id='.$aid);
		$packagecode = $rasTestimonial['urlcode'];
		?>
		<div class="de">
		  <div class="dn"> <a href="<?php echo SITEROOT.$activitycode.'/'.$packagecode;?>.html"><?php echo stripslashes($rasTestimonial['title']);?></a> </div>
		  <!--dn-->
		</div>
		<!--de-->
		<div class="pdes">
		  <p><?php echo stripslashes($rasTestimonial['contents']);?>
		  <br />
			<br />
			<b><?php echo stripslashes($rasTestimonial['name']);?>, <?php echo stripslashes($rasTestimonial['address']);?></b> </p>
		</div>
		<!--pdes-->
		<hr />
		<?php
	}
}
?>