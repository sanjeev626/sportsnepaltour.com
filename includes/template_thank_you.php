<?php
//print_r($_POST);
if(isset($_POST['btnSubmit'])) {
    $booking_number = "BKN" . rand(11111, 99999);
    $tripcost = $_POST['cost'];
    //$fromName = $_POST['name'];
    //$fromEmail = $_POST['email'];
    //$toName = SITENAME;
    //$toName = "Sports Tours & Travel";
    //$toEmail = SITEEMAIL;
    //$toEmail = "masanjeev@gmail.com";

    //insert into database
    $data='';
    $data['booking_number'] = $booking_number;
    $data['client_name'] = $_POST['fullname'];
    $data['tripname'] = $_POST['tripname'];
    $data['tripdate'] = $_POST['adate'];
    $mydb->insertQuery('tbl_booking',$data);
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

    $merchantID = "9103334686"; //9103334686
    $invoiceNumber = $booking_number;
    $productDesc = stripslashes($_POST['tripname']).' - '.stripslashes($_POST['duration']);
    $tripcost = $_POST['cost']*100;
    $amount = str_pad($tripcost, 12, '0', STR_PAD_LEFT);
    //echo $amount;
    $currencyCode = $_POST['currencyCode']; //USD = 840
    $nonSecure = 'Y';
    $signatureString = $merchantID . $invoiceNumber . $amount . $currencyCode . $nonSecure;
    $hashValue = hash_hmac('SHA256', $signatureString, '1U46HJE564KRB5G2RRHGMGLZU4XV7DMK', false);
    $hashValue = strtoupper($hashValue);
    $hashValue = urlencode($hashValue);
    $responseUrl='http://www.besttoursinnepal.com/payment-confirmation.html';
    ?>
<div class="nav"> You are here > Thank You </div>
<!--nav-->
<h1>Thank you for Booking with Us</h1>
<div class="eform">
  <form name="rform" id="rform" class="formular" method="post" action="https://hblpgw.2c2p.com/HBLPGW/Payment/Payment/Payment">
  <h2>Please make a Payment to confirm your Booking.</h2>
  <div class="box">    
    <h3>Trip Detail</h3>
    <div class="line">
      <div class="fld">
        <label style="width:200px;">Booking Number or Invoice Number:</label>
        <input type="text" name="invoiceNo" id="invoiceNo" value="<?php echo $booking_number; ?>" readonly>
      </div>
      <!--fld-->
    </div>
    <div class="line">
      <div class="fld">
        <label style="width:200px;">Trip Cost</label>
        <input type="text" name="tripcost" id="tripcost" value="<?php echo $_POST['cost']; ?>" readonly>
      </div>
      <!--fld-->
    </div>
    <div class="line">
      <div class="fld">
      <input type="hidden" id="paymentGatewayID" name="paymentGatewayID" value="<?php echo $merchantID; ?>"/>
      <input type="hidden" id="productDesc" name="productDesc" value="<?php echo $productDesc; ?>"/>
      <input type="hidden" id="amount" name="amount" value="<?php echo $amount; ?>"/>
      <input type="hidden" name="currencyCode" value="<?php echo $currencyCode;?>">
      <input type="hidden" id="hashValue" name="hashValue" value="<?php echo $hashValue; ?>"/>
      <input type="hidden" id="nonSecure" name="nonSecure" value="Y"/>
      <input type="hidden" id="returnUrl" name="responseUrl" value="<?php echo $responseUrl; ?>"/>
      <button type="submit" class="btn btn-primary" id="submit" name="btnSubmit">Pay Now </button>
      </div>
    </div>
  </div>
</form>
</div>
<?php
}
?>