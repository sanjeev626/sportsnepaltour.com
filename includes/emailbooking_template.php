<table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif;">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="4"><b>Trip Details</b></td>
        </tr>
        <tr>
          <td width="100px;">Trip Name :</td>
          <td width="250px;"><?php echo $_POST['tripname'];?></td>
          <td width="100px;">Trip Duration :</td>
          <td><?php echo $_POST['tripduration'];?></td>
        </tr>
        <tr>
          <td>Trip Cost :</td>
          <td>&euro;<?php echo $_POST['tripcost'];?></td>
          <td>Group Size :</td>
          <td><?php echo $_POST['groupsize'];?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="4"><b>Personal Information</b></td>
        </tr>
        <tr>
          <td width="100px;">Name :</td>
          <td width="200px;"><?php echo $_POST['name'];?></td>
          <td width="100px;">Phone :</td>
          <td width="200px;"><?php echo $_POST['phone'];?></td>
          <td width="100px;">Email :</td>
          <td><?php echo $_POST['email'];?></td>
        </tr>
        <tr>
          <td>Address  :</td>
          <td><?php echo $_POST['address'];?></td>
          <td>City  :</td>
          <td><?php echo $_POST['city'];?></td>
          <td>Country  :</td>
          <td><?php echo $_POST['country'];?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="4"><b>Flight Information</b></td>
        </tr>
        <tr>
          <td width="100px;">Arrival Date :</td>
          <td width="200px;"><?php echo $_POST['arrival'];?></td>
          <td width="100px;">Departure Date :</td>
          <td width="200px;"><?php echo $_POST['depart'];?></td>
          <td width="100px;">Airport Pickup :</td>
          <td><?php echo $_POST['pickup'];?></td>
        </tr>
        <tr>
          <td>Comments :</td>
          <td colspan="5"><?php echo $_POST['comments'];?></td>
        </tr>
      </table></td>
  </tr>
</table>
