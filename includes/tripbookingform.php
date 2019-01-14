<?php
if(isset($urlcode) && !empty($urlcode))
{
	$rasPackage = $mydb->getArray('*','tbl_package','urlcode="'.$urlcode.'"');
}
else if(isset($_POST['package']))
{
	$urlcode = $_POST['package'];
	$rasPackage = $mydb->getArray('*','tbl_package','urlcode="'.$urlcode.'"');
}
else
{
	$rasPackage = $mydb->getArray('*','tbl_package','urlcode=""');
}
if(isset($_POST['btnSubmit']))
{
	ob_start();
	include (SITEROOTDOC."includes/emailbooking_template.php");
	$message = ob_get_clean();
	//echo $message;
	
	$toName = $_POST['name'];
	$toEmail = $_POST['email'];
	$fromName = $mydb->getValue('title','tbl_config','id=1');
	$fromEmail = $mydb->getValue('email','tbl_admin','id=1');
	
	//To the customer
	$subject = "Thank You for booking with us";
	$messagetocustomer = "Thank You for booking with us.<br><br> Please find the booking details below.<br>";
	$messagetocustomer .= $message;
	$mail1 = $mydb->sendEmail($toName,$toEmail,$fromName,$fromEmail,$subject,$messagetocustomer);
	
	
	//To the Website owner
	$subject = "There is a new booking in ".$fromName.' from '.$toName;
	$messagetoowner = $subject.'<br>Please find the customer details below';
	$messagetoowner .= $message;
	$mail2 = $mydb->sendEmail($fromName,$fromEmail,$toName,$toEmail,$subject,$messagetoowner);
	if($mail1 && $mail2)
		$message='Thank You for booking with us';
}

?>
<script src="<?php echo SITEROOT;?>admin/js/functions.js"></script>
<script type="text/javascript">
	var SITEROOT = '<?php echo SITEROOT;?>/calendar/';
</script>
<link type="text/css" rel="stylesheet" href="<?php echo SITEROOT;?>calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
<SCRIPT type="text/javascript" src="<?php echo SITEROOT;?>calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<div class="lcont2">
  <div class="cmenu">
    <?php include (SITEROOTDOC."includes/countrymenu.php");?>
  </div>
  <!--cmenu-->
  <div class="lmain2">
    <div class="lchead">
      <div class="tripinfo1">
        <h1>Trip Booking Form</h1>
        <b style="color:#F00">NB: Fields marked with <span style="color:#000;">* asterisk</span> are required fileds.</b><br />
        <br />
        <?php if(isset($message)){?><div><?php echo $message;?></div><?php } ?>
        <form class="tform" name="tform" action="" method="post" onsubmit="return call_validate(this,0,this.length);">
          <div class="seg"> <b>Trip Details</b>
            <div class="box">
              <div class="line">
                <div class="fld">
                  <label for="tripname" id="lbltripname">Trip Name :</label>
                  <input type="text" name="tripname" id="tripname" value="<?php echo $rasPackage['title'];?>" style="width:250px;" valiclass="required" valimessage="Trip Name is Mandatory." req="1" <?php if(isset($urlcode) && !empty($urlcode)){?> readonly="readonly"<?php } ?>  />
                  <span class="ast">*</span> </div>
                <!--fld-->
                <div class="fld">
                  <label for="tripduration" id="lbltripduration">Trip Duration :</label>
                  <input type="text" name="tripduration" id="tripduration" value="<?php echo $rasPackage['duration'];?>" style="width:150px;" valiclass="required" valimessage="Trip Duration is Mandatory." req="1" <?php if(isset($urlcode) && !empty($urlcode)){?> readonly="readonly"<?php } ?> />
                  <span class="ast">*</span> </div>
                <!--fld-->
              </div>
              <!--line-->
              <div class="line">
                <div class="fld">
                  <label for="tripcost" id="lbltripcost">Trip Cost : <span style="float:right;">&euro;</span></label>
                  <input type="text" name="tripcost" id="tripcost" value="<?php echo $rasPackage['cost'];?>" valiclass="required" valimessage="Trip Cost is Mandatory." req="1" <?php if(isset($urlcode) && !empty($urlcode)){?> readonly="readonly"<?php } ?> />
                  <span class="ast">*</span> </div>
                <!--fld-->
                <div class="fld">
                  <label for="groupsize" id="lblgroupsize">Group Size :</label>
                  <select name="groupsize" id="groupsize">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                    <option>10</option>
                    <option>11</option>
                    <option>12</option>
                    <option>13</option>
                    <option>14</option>
                    <option>15</option>
                    <option>16</option>
                    <option>17</option>
                    <option>18</option>
                    <option>19</option>
                    <option>20</option>
                    <option>> 20</option>
                  </select>
                </div>
                <!--fld-->
              </div>
              <!--line-->
            </div>
            <!--box-->
          </div>
          <!--seg-->
          <div class="seg"> <b>Personal Information</b>
            <div class="box">
              <div class="line">
                <div class="fld">
                  <label for="name" id="lblname">Name :</label>
                  <input type="text" name="name" id="name" valiclass="required" valimessage="Your name is Mandatory." req="1" />
                  <span class="ast">*</span> </div>
                <!--fld-->
                <div class="fld">
                  <label for="phone" id="lblphone">Phone :</label>
                  <input type="text" name="phone" id="phone" valiclass="required" valimessage="Your phonenumber is Mandatory." req="1"  />
                  <span class="ast">*</span> </div>
                <!--fld-->
                <div class="fld">
                  <label for="email" id="lblemail">Email :</label>
                  <input type="text" name="email" id="email" valiclass="email" valimessage="Invalid email address." />
                  <span class="ast">*</span> </div>
                <!--fld-->
              </div>
              <!--line-->
              <div class="line">
                <div class="fld">
                  <label for="address" id="lbladdress">Address :</label>
                  <input type="text" name="address" id="address" valiclass="required" valimessage="Your address is Mandatory." req="1"  />
                  <span class="ast">*</span> </div>
                <!--fld-->
                <div class="fld">
                  <label for="city" id="lblcity">City :</label>
                  <input type="text" name="city" id="city" valiclass="required" valimessage="Your city is Mandatory." req="1"  />
                  <span class="ast">*</span> </div>
                <!--fld-->
                <div class="fld">
                  <label for="country" id="lblcountry">Country :</label>
                  <input type="text" name="country" id="country" valiclass="required" valimessage="Your country is Mandatory." req="1"  />
                  <span class="ast">*</span> </div>
                <!--fld-->
              </div>
              <!--line-->
            </div>
            <!--box-->
          </div>
          <!--seg-->
          <div class="seg"> <b>Flight Information</b>
            <div class="box">
              <div class="line">
                <div class="fld">
                  <label for="arrival" id="lblarrival">Arrival Date :</label>
                  <input type="text" name="arrival" id="arrival" valiclass="required" valimessage="Arrival Date is Mandatory." req="1"  />
                  <img src="<?php echo SITEROOT;?>calendar/images/calendar.gif" width="19" height="19" alt="CAL" onclick="displayCalendar(document.forms[0].arrival,'yyyy/mm/dd',this)" style="cursor:pointer;" />
                  <span class="ast">*</span> </div>
                <!--fld-->
                <div class="fld">
                  <label for="depart" id="lbldepart">Departure Date :</label>
                  <input type="text" name="depart" id="depart" valiclass="required" valimessage="Departure Date is Mandatory." req="1"  /><img src="<?php echo SITEROOT;?>calendar/images/calendar.gif" width="19" height="19" alt="CAL" onclick="displayCalendar(document.forms[0].depart,'yyyy/mm/dd',this)" style="cursor:pointer;" />
                  <span class="ast">*</span> </div>
                <!--fld-->
                <div class="fld">
                  <label for="pickup" id="lblpickup">Airport Pickup :</label>
                  <input type="radio" id="pickup" name="pickup" value="Desired" />
                  <div class="rd">Desired</div>
                  <input type="radio" id="pickup" name="pickup" value="Required" />
                  <div class="rd">Required</div>
                </div>
                <!--fld-->
              </div>
              <!--line-->
              <div class="line">
                <div class="fld">
                  <label for="comments" id="lblcomments">Any Comments :</label>
                  <textarea id="comments" name="comments" rows="12" valiclass="required" valimessage="Your comment is Mandatory." req="1"></textarea>
                  <span class="ast">*</span> </div>
                <!--fld-->
              </div>
              <!--line-->
              <div class="line">
                <div class="fld">
                  <label></label>
                  <input type="reset" value="Reset" />
                </div>
                <!--fld-->
                <div class="fld">
                  <input type="submit" name="btnSubmit" value="Submit Your Inquiry" />
                </div>
                <!--fld-->
              </div>
              <!--line-->
            </div>
            <!--box-->
          </div>
          <!--seg-->
        </form>
      </div>
      <!--tripinfo-->
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
