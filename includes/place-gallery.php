<link rel="stylesheet" href="NST.css" type="text/css">
<style type="text/css">
table.menuBox {
	width:100%;
	height:24px;
	background-color:#000000;
	border-collapse: collapse;
	border-top-color:#000000;
	border-top-style:solid;
	border-top-width:2px;
}
table.menuBox td {
	text-align:center;
}
table.menuBox a {
	text-decoration:none;
	color:#FFFFFF;
	font-weight:bold;
	font-size:11pt;
}
td.selectedTab {
	background-color:#ffffff;
}
td.selectedTab a {
	color:#000000;
}
table.Thumbnail img {
	border-style:solid;
	border-width:1px;
	border-color:#666666;
}
table.ImgDispayPanel {
	width:484px;
	height:350px;
	border-collapse: collapse;
	border-style:solid;
	border-width:1px;
	border-color:#666666;
}
</style>
<div>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tbody>
        <tr>
          <td align="center"><table>
              <tbody>
                <tr>
                  <td valign="top"><table width="100%" cellpadding="0" cellspacing="0">
                      <tbody>
                        <tr>
                          <td align="center"><a href="javascript:MoveUp()" title="Previous Set of Thumbnails"><img id="UpImg" src="img/AttractionImgUp.gif" border="0"></a></td>
                        </tr>
                        <tr>
                          <td style="height:3px;"></td>
                        </tr>
                        <tr>
                          <td align="center"><div id="PicMain" style="overflow:hidden; height:337px; width:122px;">
                            <div id="PicIndex">
                              <table class="Thumbnail" cellpadding="0" cellspacing="0">
                                <tbody>
                                <?php
								$firstimage = '';
								$counter=0;
								$resImg = $mydb->getQuery('*','tbl_image','gid='.$pid);
								while($rasImg = $mydb->fetch_array($resImg))
								{
								$imagepath = SITEROOT.'img/place/'.$rasImg['imagename'];
								
								if(empty($firstimage))
									$firstimage = $imagepath;
								?>
                                  <tr>
                                    <td><a href="javascript:void(0);" onClick="ChangeImage(&#39;<?php echo $imagepath;?>&#39;)"><img src="<?php echo $imagepath;?>" width="120px" alt="<?php echo $imagepath;?>"></a></td>
                                  </tr>
                                  <tr>
                                    <td style="height:3px;"></td>
                                  </tr>
                                  <?php
								  }
								  ?>
                                </tbody>
                              </table>
                            </div>
                            <div style="height:337px; width:122px;"></div>
                          </div></td>
                        </tr>
                        <tr>
                          <td style="height:3px;"></td>
                        </tr>
                        <tr>
                          <td align="center"><a href="javascript:MoveDown()" title="Next Set of Thumbnails"><img id="DownImg" src="img/AttractionImgDownU.gif" border="0"></a></td>
                        </tr>
                      </tbody>
                    </table></td>
                  <td valign="top"><table class="ImgDispayPanel">
                      <tbody>
                        <tr>
                          <td align="center" valign="middle"><img id="ImgPanel" style="" onload="ImageLoaded()" src="<?php echo $firstimage;?>">
                            <table id="ImgLoadingPanel" style="display: none; ">
                              <tbody>
                                <tr>
                                  <td><img src="loading.gif"></td>
                                  <td>Downloading Photo...</td>
                                </tr>
                              </tbody>
                            </table></td>
                        </tr>
                      </tbody>
                    </table></td>
                </tr>
              </tbody>
            </table>
            <script language="javascript">var speed = 1;var iTimer;var pageNo = 0;function ImageLoaded() {document.getElementById('ImgPanel').style.display = '';document.getElementById('ImgLoadingPanel').style.display = 'none';}function ChangeImage(URL) {document.getElementById('ImgPanel').style.display = 'none';document.getElementById('ImgLoadingPanel').style.display = '';document.getElementById('ImgPanel').src = URL;}function MoveDown() {var H = document.getElementById('PicIndex').offsetHeight;var T = document.getElementById('PicMain').scrollTop;if ((H - T) > 340) {pageNo++;document.getElementById('UpImg').src = 'img/AttractionImgUp.gif';iTimer = setInterval(MoveDownDoing, speed);}if ((H - (T+340)) <= 340) {document.getElementById('DownImg').src = 'img/AttractionImgDownU.gif';}}function MoveDownDoing() {if (document.getElementById('PicMain').scrollTop < (340 * pageNo)) {document.getElementById('PicMain').scrollTop += 17;} else {clearInterval(iTimer);}}function MoveUp() {var T = document.getElementById('PicMain').scrollTop;if (T >= 340) {pageNo--;document.getElementById('DownImg').src = 'img/AttractionImgDown.gif';iTimer = setInterval(MoveUpDoing, speed);}if ((T - 340) < 340) {document.getElementById('UpImg').src = 'img/AttractionImgUpU.gif';}}function MoveUpDoing() {if (document.getElementById('PicMain').scrollTop > (340 * pageNo)) {document.getElementById('PicMain').scrollTop -= 17;} else {clearInterval(iTimer);}}</script>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
