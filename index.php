<?php
session_start();
error_reporting(E_ALL);
include('classes/call.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $metatitle;?></title>
<meta name="keywords" content="<?php echo $metakeywords;?>"> 
<meta name="description" content="<?php echo $metadescription;?>"> 
<meta name="robots" content="index, follow"> 
<meta name="revisit-after" content="5 Days"> 
<meta name="classification" content="Trekking/Tour Operator"> 
<meta name="Googlebot" content="index, follow"> 
<meta name="google-site-verification" content="WGP8qpGiNs3aYz6pg-TzgsvkznDfi2oW60oJFytWW4U" />
<meta name="msvalidate.01" content="D256B6503347323C1575CBAAF60D8097" />

<link rel="stylesheet" href="<?php echo SITEROOT;?>sports.css" />
<link rel="shortcut icon" href="<?php echo SITEROOT;?>favicon.ico">


</head>

<body>
<div class="main">
	<div class="header">
        <?php include('includes/header.php');?>        
    </div><!--header-->
    <?php if(!isset($urlcode)){?>
    <div class="banner">
    	<?php include('includes/banner.php');?> 
    </div><!--banner-->
    <?php } ?>
    <div class="cont">
    	<div class="lcont">
                <div class="lmenu">
            	<div id="TA_selfserveprop585" class="TA_selfserveprop"><ul id="SEm4Jv9" class="TA_links vgHf02adCp7X"><li id="IatzWLdKmX" class="gguivk8"><a target="_blank" href="http://www.tripadvisor.com/"><img src="http://www.tripadvisor.com/img/cdsi/img2/branding/150_logo-11900-2.png" alt="TripAdvisor"/></a></li></ul></div><script src="http://www.jscache.com/wejs?wtype=selfserveprop&uniq=585&locationId=4064555&lang=en_US&rating=true&nreviews=5&writereviewlink=true&popIdx=true&iswide=false&border=true&display_version=2"></script>

                </div><!--lmenu-->
        	<?php include('includes/leftmenu.php');?>              
        </div><!--lcont-->
        <div class="rcont">
            <?php include ($pagepath);?>
            
        </div><!--rcont-->
    </div><!--cont-->
    
    <div style="float:left; margin:10px 0;">
    	<div class="pmem">
            Proud Member of<br /><br />
            <img src="<?php echo SITEROOT;?>im/ncr-logo.jpg" title="Government of Nepal" />
            <img src="<?php echo SITEROOT;?>im/ntb-logo.jpg" title="Nepal Tourism Board" />
            <img src="<?php echo SITEROOT;?>im/natta-logo.jpg" title="NATTA" />
            <img src="<?php echo SITEROOT;?>im/vitof-logo.jpg" title="Village Tourism Promotion Forum Nepal - VITOF-Nepal" />
            <img src="<?php echo SITEROOT;?>im/ncb-logo.jpg" title="Nepal Central Bank" />
        </div><!--pmem-->
    </div>
    <div style="float:right; margin:10px 0;">
    	<div class="pmem" style="text-align:right;">
            We Accept<br /><br />
                    <img src="<?php echo SITEROOT;?>im/visa-mastercard.jpg" title="We accept Visa and Master Card" />
                    
                    
        </div><!--pmem-->
    </div>
    
    <div class="btm">
    	<?php include('includes/footer.php');?>    
    </div><!--btm-->
    
</div><!--main-->
<script type="text/javascript" src="<?php echo SITEROOT;?>js/jquery-1.6.2.js"></script>
<script type="text/javascript" src="<?php echo SITEROOT;?>js/jq-menu.js"></script>


<?php include ("includes/hoverincludes.php");?>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5b0d056b10b99c7b36d468a2/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

</body>
</html>