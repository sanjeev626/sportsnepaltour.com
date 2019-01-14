<meta http-equiv="refresh" content="0; url=http://www.sportsnepaltour.com/404.php" />
<?php
exit();
session_start();
include('classes/call.php');

$pid = $_GET['pid'];
$description = stripslashes(nl2br($mydb->getValue('description','tbl_place','id='.$pid)));
?>
<link rel="stylesheet" href="<?php echo SITEROOT;?>sports.css" />
<script type="text/javascript" src="<?php echo SITEROOT;?>js/jquery-1.6.2.js"></script>
<script language="javascript">
    function openAttraction(pid) {
        //var AttractionURL = "http://www.newshan.com/tour/AttractionBox.aspx?Code=" + AttractionCode;
		//alert(pid);
		 var AttractionURL = "<?php echo SITEROOT;?>popup.php?pid="+pid;
        if (window.XMLHttpRequest) {
            AttractionLoading();
            document.getElementById("AttractionPanel").style.display = "";
            document.getElementById("AttractionPanel_iframe").src = AttractionURL;
        } else {
            window.open(AttractionURL, '', 'scrollbars=no,menubar=no,height=405,width=640,resizable=no,toolbar=no,location=no,status=no');
        }
    }
    function closeAttraction(PanelName) {
        document.getElementById(PanelName).style.display = "none";
    }
    function AttractionLoading() {
        document.getElementById("AttractionPanel_Loading").style.display = "";
        document.getElementById("AttractionPanel_iframe").style.display = "none";
    }
    function AttractionLoaded() {
        //alert("hello");
        document.getElementById("AttractionPanel_iframe").style.display = "";
        document.getElementById("AttractionPanel_Loading").style.display = "none";
    }
    function openLegendsPanel() {
        document.getElementById("LegendsPanel").style.display = "";
    }
</script>
<div style="font-family:Arial, Helvetica, sans-serif; font-size:12px;">
<div style="padding-bottom:5px;"><?php echo substr($description,0,200);?> <a href="javascript:void(0);" onclick="openAttraction('<?php echo $pid;?>')">more..</a></div>
<div align="center">
<?php
$resImg = $mydb->getQuery('*','tbl_image','gid='.$pid.' LIMIT 2');
while($rasImg = $mydb->fetch_array($resImg))
{
?>
<img src="<?php echo SITEROOT;?>img/place/<?php echo $rasImg['imagename'];?>" title="<?php echo stripslashes($rasImg['imagetitle']);?>" alt="<?php echo stripslashes($rasImg['imagetitle']);?>" width="125px;" />
<?php
}
?>
</div>
</div>
<table id="AttractionPanel" width="100%" style="position: fixed; bottom: 0px; z-index: 999; width: 100%; height: 100%; top: 0px; left: 0px; background-image: url(<?php echo SITEROOT;?>cluetip/bg_b.png); display: none; border:1px solid; ">
    <tbody>
      <tr>
        <td valign="middle" align="center"><table style="background-color:#ffffff;" border="0" cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td valign="top"></td>
                <td valign="top"><iframe src="" onload="AttractionLoaded()" id="AttractionPanel_iframe" width="640px" height="405px" marginheight="0" marginwidth="0" frameborder="0" scrolling="no" style=""></iframe>
                  <table id="AttractionPanel_Loading" style="display: none; " width="640px" height="405px">
                    <tbody>
                      <tr>
                        <td valign="middle" align="center"><table>
                            <tbody>
                              <tr>
                                <td></td>
                                <td><img src="<?php echo SITEROOT;?>cluetip/loading.gif" alt="Loading..." /></td>
                              </tr>
                            </tbody>
                          </table></td>
                      </tr>
                    </tbody>
                  </table></td>
                <td valign="top"><a style="position:absolute; margin-left:-15px; margin-top:-15px;" href="javascript:closeAttraction('AttractionPanel')" title="Close"><img src="<?php echo SITEROOT;?>images/AttractionClose.png" border="0"></a></td>
              </tr>
            </tbody>
          </table></td>
      </tr>
    </tbody>
  </table>