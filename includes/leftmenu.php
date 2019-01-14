<?php
$resActivity = $mydb->getQuery('*','tbl_activity','1 ORDER BY ordering LIMIT 6');
while($rasActivity=$mydb->fetch_array($resActivity))
{
$activitycode = $rasActivity['urlcode'];
$aid = $rasActivity['id'];
?> 



<div class="lmenu">
  <div class="lmtit"> <?php echo $rasActivity['title'];?> </div>
  <!--lmtit-->
  <div class="list">
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
  <!--list-->
</div>
<!--lmenu-->
<?php
}
?>

<div class="lmenu">
            	<div id="CDSWIDWRM" style="margin:0; padding:0; width:204px; border:none; background-color:#589442; overflow:hidden; height:auto; position:relative; ">
<div style="padding:13px 11px;background-color:#fff;  border: 1px solid #589442; position:relative; ">
<div style="margin:3px 0 3px; padding:0 0 8px; overflow:hidden; border-bottom:1px solid #CCCCCC; border-top:none; border-left:none; border-right:none; text-align:center;">
<a target="_blank" style="border:none; background:transparent;" href="http://www.tripadvisor.com"> <script type="text/javascript" src="http://www.jscache.com/weimg?itype=img2/branding/medium-logo-12096-2.png&amp;lang=en_US"></script></a>
</div>
<div style="margin:0; padding:10px 0 8px; border:none; font:bold 14px Arial,Verdana,Tahoma,'Bitstream Vera Sans',sans-serif; color:#2c2c2c; text-align:center; line-height:normal; letter-spacing:0">
Review <a target="_blank" style="margin:0;padding:0;border:none;background:transparent;text-decoration:none;outline:none;font-weight:bold;font-size:14px;font-family:Arial,Verdana,Tahoma;color:#2c2c2c;text-align:center;line-height:normal;letter-spacing:0" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'" href="http://www.tripadvisor.com/Attraction_Review-g293890-d4064555-Reviews-Private_Day_Tours_Nepal_Day_Tours-Kathmandu_Kathmandu_Valley_Bagmati_Zone_Central.html">Private Day Tours Nepal -Day Tours</a>
</div>
<div style="margin:0px 0 0 0; padding:6px 0; border:none; background-color:none; white-space:nowrap;  text-align:center; margin-left:auto; margin-right:auto; position:relative; ">
<input type="button" onclick="window.open('http://www.tripadvisor.com/UserReview-g293890-d4064555-m12096-Private_Day_Tours_Nepal_Day_Tours-Kathmandu_Kathmandu_Valley_Bagmati_Zone_Central_Region.html')" style="border:1px solid #EA9523; border:active:border:none;background:url(http://c1.tacdn.com/img2/sprites/yellow-button.png) 0 0 repeat-x #EA9523;  cursor:pointer; text-decoration:none; outline:none; font: bold 13px Arial,Tahoma,'Bitstream Vera Sans',sans-serif; color:#000; letter-spacing:0; vertical-align:center; text-align:center; width:auto; height:27px; position:relative;" value="Write Review"/> </div>
</div>
</div>

			</div><!--lmenu-->

<div class="lmenu"> <a href="http://www.wunderground.com/global/np.html" target="_new"><img src="<?php echo SITEROOT;?>im/weather-report.jpg" title="Weather Report" /></a><br /><br />
<iframe src="http://free.timeanddate.com/clock/i2kmkxx3/n117/tct/pct" frameborder="0" width="170" height="18" allowTransparency="true" name="I2">Time</iframe>
 </div>
<!--lmenu-->
<div class="lmenu">
  <div class="lmtit"> News and Events </div>
  <!--lmtit-->
  <div class="news">
    <ul>
      <?php
	  $resNews = $mydb->getQuery('urlcode,title','tbl_news','1 ORDER BY id DESC LIMIT 5');
	  while($rasNews = $mydb->fetch_array($resNews))
	  {
	  ?>
      <li><a href="<?php echo SITEROOT.$rasNews['urlcode'];?>.html"><?php echo stripslashes($rasNews['title']);?></a></li>
      <?php
	  }
	  ?>
      <li style="text-align:right;"><a href="<?php echo SITEROOT;?>news-and-events.html">More &raquo;</a></li>
    </ul>
  </div>
  <!--news-->
</div>
<!--lmenu-->

 <div class="lmenu">
            	<a class="twitter-timeline" href="https://twitter.com/sportsnepaltour" data-widget-id="345091354642247680">Tweets by @sportsnepaltour</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

            </div><!--lmenu-->
<div class="lmenu">
  <div class="pmem"> Proud Member of<br />
    <br />
    <img src="<?php echo SITEROOT;?>im/ntb-ico.jpg" title="Nepal Tourism Board" /> <img src="<?php echo SITEROOT;?>im/vitofnepal-ico.png" title="Village Tourism Promotion Forum Nepal - VITOF-Nepal" width="50" /></div>
  <!--pmem-->
</div>
<!--lmenu-->