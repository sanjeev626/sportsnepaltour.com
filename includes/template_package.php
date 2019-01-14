<link rel="stylesheet" href="<?php echo SITEROOT;?>lightbox/css/lightbox.css" type="text/css" media="screen" />
<?php
//echo $packagecode;
//include ("includes/hoverincludes.php");

$rasActivity = $mydb->getArray('urlcode,title','tbl_activity','id='.$acid);

$activitycode = $rasActivity['urlcode'];
$packagecode = $rasPackage = $mydb->getValue('urlcode','tbl_package','id="'.$id.'"');
?>
<link rel="stylesheet" href="<?php echo SITEROOT;?>cluetip/jquery.cluetip.css" type="text/css" />

<div class="nav"> You are here > <a href="<?php echo SITEROOT;?>">Home</a> > <a href="<?php echo SITEROOT.$activitycode;?>.html"><?php echo $rasActivity['title'];?></a> > <a href=""><?php echo $title;?></a> </div>

<!--nav-->

<h1><?php echo $title; ?></h1>
<div class="de">
  <div class="dn"> <?php echo $duration;?> </div>
  
  <!--dn-->
  
  <div class="enq">
    <form name="frmEnq" method="post" action="<?php echo SITEROOT;?>booking-form.html">
      <input name="packagecode" type="hidden" value="<?php echo $packagecode;?>" />
      <a href="javascript:void(0);" onclick="frmEnq.submit();" >Enquiry</a>
    </form>
  </div>
  
  <!--enq-->
  
  <div class="pdf">
    <form action="" method="post" name="frmPrint" target="_blank">
      <input name="id" type="hidden" value="<?php echo $id;?>" />
      <img src="<?php echo SITEROOT;?>im/pdf-icon.png" alt="Download PDF" title="Download PDF" border="0" onclick="frmPrint.action='<?php echo SITEROOT;?>generate.html'; frmPrint.submit();" style="cursor:pointer;" /> <img src="<?php echo SITEROOT;?>im/printButton.png" alt="Print this Package" title="Print this Package" border="0" onclick="frmPrint.action='<?php echo SITEROOT;?>print-package.php'; frmPrint.submit();" style="cursor:pointer;" />
    </form>
  </div>
  
  <!--pdf--> 
  
</div>

<!--de-->
<div class="pdes">
  <p>
    <div class="dn"> Cost : 
    <?php 
    if($cost>0)
    {
        $cost = $cost;
        $currencyCode = 'US$ ';
    }
    elseif($cost_npr>0)
    {
        $cost = $cost_npr;
        $currencyCode = 'Nrs ';
    }
    else
    {
        $cost = 'PRICE ON REQUEST';
        $currencyCode = '';
    }
    echo $currencyCode.' '.$cost;
    ?> 
    </div>
  </p>
</div>
<div class="pdes">
  <p><?php echo $description;?></p>
</div>

<!--pdes-->

<div class="pim1"> <img src="<?php echo $imagepath;?>" width="724" title="<?php echo $title;?>" /> </div>

<!--pim1-->

<div class="ha">
  <div class="hls">
    <div class="hti"> Highlights </div>
    
    <!--hti--> 
    
    <?php echo $highlights;?> </div>
  
  <!--hls-->
  
  <div class="acc">
    <div class="ati"> Accomodations </div>
    <?php echo $accomodations;?> </div>
  
  <!--acc--> 
  
</div>

<!--ha-->

<?php if(!empty($mapdocpath) && file_exists($mapdocpath)){?>
<h2><a href="<?php echo $mappath;?>" rel="lightbox" title="Map - <?php echo $title;?>">Map - <?php echo $title;?></a></h2>
<?php } ?>
<div class="ite">
  <div class="it"> Itinerary - <?php echo $title;?> </div>
  
  <!--it-->
  
  <div class="enq"><a href="javascript:void(0);" onclick="frmEnq.submit();" >Enquiry</a></div>
  
  <!--enq-->
  
  <div class="pdf"> <img src="<?php echo SITEROOT;?>im/pdf-icon.png" alt="Download PDF" title="Download PDF" border="0" onclick="frmPrint.action='<?php echo SITEROOT;?>generate.html'; frmPrint.submit();" style="cursor:pointer;" /> <img src="<?php echo SITEROOT;?>im/printButton.png" alt="Print this Package" title="Print this Package" border="0" onclick="frmPrint.action='<?php echo SITEROOT;?>print-package.php'; frmPrint.submit();" style="cursor:pointer;" /> </div>
  
  <!--pdf--> 
  
</div>

<!--ite-->

<div class="itinerary">
  <div id="examples">
    <?php

  $resItinerary=$mydb->getQuery('*','tbl_itinerary','pid='.$id);

  while($rasItinerary=$mydb->fetch_array($resItinerary))

  {

  ?>
    <div class="dbyd">
      <div class="dy"> <?php echo $rasItinerary['day'];?> </div>
      
      <!--dy-->
      
      <div class="www">
        <div class="whwh"> <?php echo $rasItinerary['place'];?> </div>
        
        <!--whwh-->
        
        <div class="bld"> (<?php echo $rasItinerary['food'];?>) <img src="<?php echo SITEROOT;?>im/icon-food.gif" /> </div>
        
        <!--bld-->
        
        <div class="dbrf"> <?php echo stripslashes($rasItinerary['description']);?> </div>
        
        <!--dbrf--> 
        
      </div>
      
      <!--www--> 
      
    </div>
    
    <!--dbyd-->
    
    <?php

  }

  ?>
  </div>
</div>

<!--itinerary-->

<?php

if(!empty($additionalremarks))

{

?>
<div class="adinf">
  <div class="adt"> Additional Remarks </div>
  
  <!--adt-->
  
  <div class="enq"><a href="javascript:void(0);" onclick="frmEnq.submit();" >Enquiry</a></div>
  
  <!--enq-->
  
  <div class="pdf"> <img src="<?php echo SITEROOT;?>im/pdf-icon.png" alt="Download PDF" title="Download PDF" border="0" onclick="frmPrint.action='<?php echo SITEROOT;?>generate.html'; frmPrint.submit();" style="cursor:pointer;" /> <img src="<?php echo SITEROOT;?>im/printButton.png" alt="Print this Package" title="Print this Package" border="0" onclick="frmPrint.action='<?php echo SITEROOT;?>print-package.php'; frmPrint.submit();" style="cursor:pointer;" /> </div>
  
  <!--pdf-->
  
  <div class="ad"> <?php echo $additionalremarks;?> </div>
  
  <!--ad--> 
  
</div>
<?php

}

?>

<!--adinf-->

<div class="adinf">
  <div class="enq"><a href="javascript:void(0);" onclick="frmEnq.submit();" >Enquiry</a></div>
  
  <!--enq-->
  
  <div class="pdf"> <img src="<?php echo SITEROOT;?>im/pdf-icon.png" alt="Download PDF" title="Download PDF" border="0" onclick="frmPrint.action='<?php echo SITEROOT;?>generate.html'; frmPrint.submit();" style="cursor:pointer;" /> <img src="<?php echo SITEROOT;?>im/printButton.png" alt="Print this Package" title="Print this Package" border="0" onclick="frmPrint.action='<?php echo SITEROOT;?>print-package.php'; frmPrint.submit();" style="cursor:pointer;" /> </div>
  
  <!--pdf--> 
  
</div>

<!--adinf--> 

<script type="text/javascript">

  var url='<?php echo SITEROOT;?>';

</script> 
<script src="<?php echo SITEROOT;?>cluetip/jquery.cluetip.js"></script> 
<script src="<?php echo SITEROOT;?>cluetip/demo.js"></script> 

<!-- add rel dynamically --> 

<script type="text/javascript">

  $('#examples a').each(function(index) {

    //$(this).attr('rel','test'.index);

    var ids = $(this).attr('id');

    //alert(ids);

    var html = $(this).attr('href');

    $(this).attr('class','jt');

    $(this).attr('rel',html);

    $(this).attr('href','javascript:void(0);');

    $(this).attr('onClick','openAttraction('+ids+');');

    //alert($(this).href);

    //alert(index + ': ' + $(this).text());

});

</script> 
<script src="<?php echo SITEROOT;?>lightbox/js/jquery-1.7.2.min.js"></script> 
<script src="<?php echo SITEROOT;?>lightbox/js/jquery-ui-1.8.18.custom.min.js"></script> 
<script src="<?php echo SITEROOT;?>lightbox/js/jquery.smooth-scroll.min.js"></script> 
<script type="text/javascript">
  var baseurl = '<?php echo SITEROOT;?>lightbox/';
</script> 
<script src="<?php echo SITEROOT;?>lightbox/js/lightbox.js"></script> 
<script>
  jQuery(document).ready(function($) {
      $('a').smoothScroll({
        speed: 1000,
        easing: 'easeInOutCubic'
      });

      $('.showOlderChanges').on('click', function(e){
        $('.changelog .old').slideDown('slow');
        $(this).fadeOut();
        e.preventDefault();
      })
  });
</script>
<table id="AttractionPanel" width="100%" style="position: fixed; bottom: 0px; z-index: 999; width: 100%; height: 100%; top: 0px; left: 0px; background-image: url(<?php echo SITEROOT;?>cluetip/bg_b.png); display: none;">
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