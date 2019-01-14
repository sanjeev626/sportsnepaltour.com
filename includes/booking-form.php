<!-- For form validation -->

	<link rel="stylesheet" href="<?php echo SITEROOT;?>validation/css/validationEngine.jquery.css" type="text/css"/>
	<script src="<?php echo SITEROOT;?>validation/js/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo SITEROOT;?>validation/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
	</script>
	<script>
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#efrm").validationEngine();
		});

		/**
		*
		* @param {jqObject} the field where the validation applies
		* @param {Array[String]} validation rules for this field
		* @param {int} rule index
		* @param {Map} form options
		* @return an error string if validation failed
		*/
		function checkHELLO(field, rules, i, options){
			if (field.val() != "HELLO") {
				// this allows to use i18 for the error msgs
				return options.allrules.validate2fields.alertText;
			}
		}
	</script>    

<!-- Form validation ends here -->
<?php
if(isset($_POST['btnSubmit']))
{
	ob_start();
	?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial, Helvetica, sans-serif;">
	  <tr>
		<td colspan="4"><strong>Personal Information</strong></td>
	  </tr>
	  <tr>
		<td> Full Name :</td>
		<td colspan="3"><?php echo $_POST['salutation'].' '.$_POST['fullname'];?></td>
	  </tr>
	  <tr>
		<td width="20%"> Email Address :</td>
		<td width="30%"><?php echo $_POST['email'];?></td>
		<td width="20%"> Contact No. :</td>
		<td width="30%"><?php echo $_POST['contactno'];?></td>
	  </tr>
	  <tr>
		<td>City :</td>
		<td><?php echo $_POST['city'];?></td>
		<td> Country :</td>
		<td><?php echo $_POST['country'];?></td>
	  </tr>
	  <tr>
		<td colspan="4">&nbsp;</td>
	  </tr>
	  <tr>
		<td colspan="4"><strong>Trip Information</strong></td>
	  </tr>
	  <tr>
		<td><span class="fld">Trip Name :</span></td>
		<td colspan="3"><?php echo $_POST['tripname'];?></td>
	  </tr>
	  <tr>
		<td><span class="fld">Duration :</span></td>
		<td colspan="3"><?php echo $_POST['duration'];?></td>
	  </tr>
    <td><span class="fld">Cost :</span></td>
    <td colspan="3"><?php echo $_POST['cost'];?></td>
    </tr>
	  <tr>
		<td><span class="fld">No. of Person :</span></td>
		<td colspan="3"><?php echo $_POST['noofperson'];?></td>
	  </tr>
	  <tr>
		<td><span class="fld">Arrival Date :</span></td>
		<td><?php echo $_POST['adate'];?></td>
		<td><label for="label'];?>lblddate">Departure Date :</label></td>
		<td><?php echo $_POST['ddate'];?></td>
	  </tr>
	  <tr>
		<td><span class="fld">Additional Requirements :</span></td>
		<td colspan="3"><?php echo stripslashes($_POST['any']);?></td>
	  </tr>
          <tr>
		<td><span class="fld">IP :</span></td>
		<td colspan="3"><?php echo $_SERVER['REMOTE_ADDR'];?></td>
	  </tr>
	</table>
	
	<?php
	$message = ob_get_clean();
	$rasAdmin = $mydb->getArray('email,title','tbl_admin','id=1');
	$toName = $rasAdmin['title'];
	$toEmail = $rasAdmin['email'];
	
	$fromName = $_POST['salutation'].' '.$_POST['fullname'];
	$fromEmail = $_POST['email'];
	$subject = "New Trip Inquiry : ".$_POST['tripname'];
	
	$send1 = $mydb->sendEmail($toName,$toEmail,$fromName,$fromEmail,$subject,$message);
	
	$subject2="Thank you for booking with ".$toName;
	$message2 = "Thank you for booking with ".$toName."<br><br>Please check your information below that you have provided to us.<br>";
	$message2 = $message2.$message;
	$send2 = $mydb->sendEmail($fromName,$fromEmail,$toName,$toEmail,$subject2,$message2);
	if($send1 && $send2)
	{
		$sendmess = "Thank you for booking with us. <br><br><br>Your information has been sent to the administrator. We will contact you soon.";
	}
}
if($cost>0)
{
    $cost = $cost;
    $currency = 'US$';      
    $currencyCode = '840';
}
else
{
    $cost = $cost_npr;
    $currency = 'NRs ';
    $currencyCode = '524';
}
?>
<div class="nav"> You are here > <a href="<?php echo SITEROOT;?>">Home</a> </div>
<!--nav-->
<h1>Enquiry</h1>
<div class="eform">
  <?php if(isset($sendmess)){?><div style="color:#00CC00; text-align:center; padding-top:20px;"><?php echo $sendmess;?></div><?php } ?>
  <form id="efrm" class="formular" method="post" action="<?php echo SITEROOT;?>thank-you.html">
    <h2>Personal Information</h2>
    <div class="box">
      <div class="line">
        <div class="fld">
          <label for="fullname" id="lblfullname">Full Name</label>
          <select name="salutation" id="salutation" class="validate[required]">
            <option>Mr</option>
            <option>Mrs</option>
            <option>Miss</option>
            <option>Mdm</option>
            <option>Ms</option>
            <option>Dr</option>
          </select>
          <input name="fullname" id="fullname" class="validate[required] text-input" type="text" />
        </div>
        <!--fld-->
      </div>
      <!--line-->
      <div class="line">
        <div class="fld">
          <label for="email" id="lblemail">Email Address</label>
          <input name="email" id="email" type="text" class="validate[required,custom[email]] text-input" />
        </div>
        <!--fld-->
        <div class="fld">
          <label for="contactno" id="lblcontactno">Contact No.</label>
          <input name="contactno" id="contactno" type="text" class="validate[required] text-input" />
        </div>
        <!--fld-->
      </div>
      <!--line-->
      <div class="line">
        <div class="fld">
          <label for="city" id="lblcity">City</label>
          <input name="city" id="city" type="text" class="validate[required] text-input"  />
        </div>
        <!--fld-->
        <div class="fld">
          <label for="country" id="lblcountry">Country</label>
          <input name="country" id="country" type="text" class="validate[required] text-input"  />
        </div>
        <!--fld-->
      </div>
      <!--line-->
    </div>
    <!--box-->
    <h2>Trip Information</h2>
    <div class="box">
      <div class="line">
        <div class="fld">
          <label for="tripname" id="lbltripname">Trip Name</label>
          <input name="tripname" id="tripname" value="<?php echo $title;?>" readonly="readonly" />
        </div>
        <!--fld-->
      </div>
      <!--line-->
      <div class="line">
        <div class="fld">
          <label for="duration" id="lblduration">Duration</label>
          <input name="duration" id="duration" value="<?php echo $duration;?>" readonly="readonly" />
        </div>
        <!--fld-->
      </div>
      <div class="line">
        <div class="fld">
          <label for="duration" id="lblduration">Cost(<?php echo $currency;?>)</label>
          <input name="cost" id="cost" value="<?php echo $cost;?>" readonly="readonly" />
        </div>
        <!--fld-->
      </div>
      <!--line-->
      <div class="line">
        <div class="fld">
          <label for="noofperson" id="lblnoofperson">No. of Person</label>
          <select name="noofperson" id="noofperson" onchange="calculateTripcost(this.value,'<?php echo $cost;?>')">
            <?php for($i=1;$i<=30;$i++){?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
            <?php } ?>
          </select>
        </div>
        <!--fld-->
      </div>
      <!--line-->
      <div class="line">
        <div class="fld">
          <label for="adate" id="lbladate">Arrival Date</label>
          <input name="adate" id="adate" type="text" class="validate[required] text-input"  />
        </div>
        <!--fld-->
        <div class="fld">
          <label for="ddate" id="lblddate">Departure Date</label>
          <input name="ddate" id="ddate" type="text" class="validate[required] text-input"  />
        </div>
        <!--fld-->
      </div>
      <!--line-->
      <div class="line">
        <div class="fld">
          <label for="any" id="lblany">Additional Requirements</label>
          <textarea name="any" id="any" rows="8"></textarea>
        </div>
        <!--fld-->
      </div>
      <!--line-->
      <div class="line">
        <div class="fld">
          <label for="reset" id="lblreset"></label>
          <input type="reset" name="btnreset" id="btnreset" />
        </div>
        <!--fld-->
        <div class="fld">
          <input type="hidden" name="currencyCode" id="currencyCode" value="<?php echo $currencyCode;?>" />
          <input type="submit" name="btnSubmit" id="btnSubmit" />
        </div>
        <!--fld-->
      </div>
      <!--line-->
    </div>
    <!--box-->
  </form>  
</div>
<!--eform-->
<script>
    function calculateTripcost(nop,cost){
        var tripcost = nop*cost;
        $('#cost').val(tripcost);
    }
</script> 
