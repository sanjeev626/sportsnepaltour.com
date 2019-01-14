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
  <div class="cmenu"><?php include (SITEROOTDOC."includes/countrymenu.php");?></div>
  <!--cmenu-->
  <div class="lmain2">
    <div class="lchead">
      <div class="tripinfo1">
      
      	<form action="" method="post" name="subscribe">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><h1>Newsletter</h1></td>
          </tr>          
          <?php if(isset($mess)){?>
          <tr>
            <td style="color:#006600; font-weight:bold; border:#006600 1px solid; background-color:#E6FFE6; padding:5px;"><?php echo $mess;?></td>
          </tr>
          <?php } ?>
          <tr>
            <td>If you want to stay in touch with the Asian Heritage family and all its happenings in and outside the office, updates on our staff and news about new treks & tours then please subscribe!</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><strong>Subscribe for e-Newsletter</strong></td>
          </tr>
          <tr>
            <td><input name="name" type="text" value="Your name here" onfocus="if(this.value=='Your name here') this.value='';" onblur="if(this.value=='') this.value='Your name here';" /><input name="email" type="text" value="Email address here" onfocus="if(this.value=='Email address here') this.value='';" onblur="if(this.value=='') this.value='Email address here';" /><input name="btnSubscribe" type="submit" value="Subscribe" /></td>
          </tr>
        </table>
        </form>
        <form action="" method="post" name="unsubscribe">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><strong>Unsubscribe from e-Newsletter</strong></td>
          </tr>
          <tr>
            <td>To unsubscribe from our mailing list please enter your email address and click Unsubscribe</td>
          </tr>
          <tr>
            <td>Email address: <input name="unsubsemail" type="text" /><input name="btnUnsubscribe" type="submit" value="Unsubscribe" /></td>
          </tr>
        </table>
        </form>        
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