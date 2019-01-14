<?php
if(isset($_POST['btnSubscribe']))
{
	$email = $_POST['email'];
	$check = $mydb->getCount('id','tbl_subscriber','email="'.$email.'"');
	if($check==0)
	{
		$data='';
		$data['name'] = $_POST['name'];
		$data['email'] = $email;
		$mydb->insertQuery('tbl_subscriber',$data);
		$mess = "Thank You for subscribing with us!";
	}
	else
	{
		$mess = "You have already been subscribed.";
	}
}
?>

<div class="lcont2">
  <div class="cmenu">
    <?php include (SITEROOTDOC."includes/countrymenu.php");?>
  </div>
  <!--cmenu-->
  <div class="lmain2">
    <div class="lchead">
      <div class="tripinfo1">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="50%"><strong>Nilam Bastola (director)</strong><br />
              Asian Heritage Treks & Expeditions (P) Ltd. <br />
              <br />
              Post Office box No: 7666 <br />
              Jyatha Rd – Thamel<br />
              Kathmandu, Nepal<br />
              <br />
              Tel:  +977 1 4267352<br />
              Tel / Fax: +977 1 4215178<br />
              Mobile: +977 98510 19279 <br />
              <br />
              E-mail: info@asianheritagetreks.com</td>
            <td valign="top"><strong>Nilam Bastola (founder)</strong><br/>
              Asian Heritage Foundation Nepal</td>
          </tr>
        </table>
      </div>
      <!--tripinfo1-->
    </div>
    <!--lchead-->
  </div>
  <!--lmain-->
</div>
<!--lcont-->
<div class="rcont2">
  <div class="qnav2">
    <?php include (SITEROOTDOC."includes/quicktripnavigation.php");?>
    <!--quicknav-->
  </div>
  <!--qnav-->
</div>
<!--rcont-->
