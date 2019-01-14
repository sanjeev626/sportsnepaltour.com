<?php
if(isset($_GET['del_aid']))
{
	$did = $_GET['del_aid'];
	$mydb->deleteQuery('tbl_activity','id='.$did);
}


	$resActivity = $mydb->getQuery('*','tbl_activity');
	$count = mysql_num_rows($resActivity);
	?>
	<form action="" method="post" name="Activity">
	  <table cellpadding="0" cellspacing="0" border="0" width="100%" class="FormTbl" style="font-size:12px;">	
		<tr class="TitleBar">
		  <td colspan="4" class="TtlBarHeading">Manage Activity <div style="float:right"><input name="btnAdd" type="button" value="Add" class="button" onClick="window.location='<?php echo ADMINURLPATH;?>activity_manage'" /></div></td>
		</tr>
		<?php 
		if(isset($_GET['msg']) && $_GET['msg'] =='1'){ ?>
        <tr>
          <td colspan="4" class="adminsucmsg">Activity info has been updated.</td>
          </tr>
        <?php 
		}
		if(isset($_GET['msg']) && $_GET['msg'] =='2'){ ?>
        <tr>
          <td colspan="4" class="adminsucmsg">New Activity has been added.</td>
          </tr>
        <?php 
		}
		if(isset($_GET['del_aid'])){ ?>
        <tr>
          <td colspan="4" class="adminsucmsg">Selected Activity has been deleted.</td>
          </tr>
        <?php 
		}
		if($count != 0)
		{
		?>
		<tr>
		  <td width="2%" valign="top" class="titleBarB" align="center"><strong>S.N</strong></td>
		  <td width="17%" class="titleBarB"><strong>Name</strong></td>
		  <td class="titleBarB"><strong>Description</strong></td>
		  <td width="11%" class="titleBarB">&nbsp;</td>
		</tr>
		<?php
		$counter = 0;
		while($rasActivity = $mydb->fetch_array($resActivity))
		{
		if($counter%2==0)
			$tdclass='titleBarA';
		else
			$tdclass='titleBarB';
		?>
		<tr>
		  <td class="<?php echo $tdclass;?>" align="center" valign="top"><?php echo ++$counter;?></td>
		  <td class="<?php echo $tdclass;?>" valign="top"><?php echo stripslashes($rasActivity['title']);?></td>
		  <td class="<?php echo $tdclass;?>" valign="top"><?php echo stripslashes($rasActivity['description']);?></td>
		  <td class="<?php echo $tdclass;?>" valign="top" align="center"><a href="<?php echo ADMINURLPATH;?>package&amp;aid=<?php echo $rasActivity['id'];?>"><img src="images/package.jpg" alt="View Packages" width="24" height="24" title="View Packages" /></a> <a href="<?php echo ADMINURLPATH;?>activity_manage&id=<?php echo $rasActivity['id'];?>"><img src="images/action_edit.gif" alt="Edit" width="24" height="24" title="Edit"></a> <a href="javascript:void(0);" onClick="callDelete('<?php echo ADMINURLPATH;?>activity&del_aid=<?php echo $rasActivity['id'];?>')"><img src="images/action_delete.gif" alt="Delete" width="24" height="24" title="Delete"></a></td>
		</tr>		
		<?php
        }
		}
		?>
  	  </table>
	</form>
	