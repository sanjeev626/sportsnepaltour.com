<script type="text/javascript">
	function deleteImage(imid)
	{
		//alert(imid);
		var bool;
		bool = confirm('Are you sure to delete this image. The process is ir-reversible.');
		if(bool)
		{
			window.location='index.php?manager=place_manage&id=<?php echo $_GET["id"];?>&delImid='+imid;
		}
	}
</script>
<?php
if(isset($_GET['id']))
{
	$gid = $_GET['id'];
	$do = "Update";
}
else
{
	$gid = -1;
	$do = "Add";
}

if(isset($_GET['delImid']) && $_GET['delImid']>0)
{	
	$delImid = $_GET['delImid'];
	
	$imagename=$mydb->getValue('imagename','tbl_image','id='.$delImid);
	$imagepath='../img/place/'.$imagename;
	@unlink($imagepath);
	$mydb->deleteQuery('tbl_image','id='.$delImid);
}

if(isset($_POST['btnDo']) && $_POST['btnDo']=='Add')
{	
	foreach($_POST as $key=>$value)
	{
		if($key!="btnDo" && $key!="imagetitle") 
		$data[$key]=$value;
	}
	$data['urlcode'] = $mydb->clean4urlcode($_POST['title']);	
	$data['ordering'] = $mydb->getValue('ordering','tbl_place','1 ORDER BY ordering DESC LIMIT 1')+1;
	
	$gid = $mydb->insertQuery('tbl_place',$data);	

	if($gid>0)
	{		
		for($i=0;$i<5;$i++)
		{
			$imagesize = $_FILES['imagename']['size'][$i];
			//echo $imagesize."<br>";
			if($imagesize>0)
			{
				//ready to upload
				$imagename = rand(1111,9999).$mydb->clean4urlcode(($_FILES['imagename']['name'][$i]));
				$source = $_FILES['imagename']['tmp_name'][$i];
				$dest = '../img/place/'.$imagename;
				if(copy($source,$dest))
				{				
					$data2='';
					$data2['gid'] = $gid;
					$data2['imagename'] = $imagename;
					$data2['imagetitle'] = $_POST['imagetitle'][$i];
					$mydb->insertQuery('tbl_image',$data2);	
				}
			}
		}
		$message = "New place Has been added.";
	}
	else
	{
		$message = "ERROR!! Failed to add place.";
	}
	
	$url = ADMINURLPATH."place_manage&message=".$message;
	$mydb->redirect($url);
}

if(isset($_POST['btnDo']) && $_POST['btnDo']=='Update')
{	
	foreach($_POST as $key=>$value)
	{
		if($key!="btnDo" && $key!="imagetitle" && $key!="imagetitleOld" && $key!="imid") 
		$data[$key]=$value;
	}
	$data['urlcode'] = $mydb->clean4urlcode($_POST['title']);
	
	for($i=0;$i<count($_POST['imid']);$i++)
	{			
		$imid = $_POST['imid'][$i];
		$data3='';
		$data3['imagetitle'] = $_POST['imagetitleOld'][$i];
		$mydb->updateQuery('tbl_image',$data3,'id='.$imid);
	}
	
	$imgcount = count($_FILES['imagename']['name']);
	for($i=0;$i<5;$i++)
	{
		$imagesize = $_FILES['imagename']['size'][$i];
		//echo $imagesize."<br>";
		if($imagesize>0)
		{
			//ready to upload
			$imagename = rand(1111,9999).$mydb->clean4urlcode(($_FILES['imagename']['name'][$i]));
			$source = $_FILES['imagename']['tmp_name'][$i];
			$dest = '../img/place/'.$imagename;
			if(copy($source,$dest))
			{				
				$data2='';
				$data2['gid'] = $gid;
				$data2['imagename'] = $imagename;
				$data2['imagetitle'] = $_POST['imagetitle'][$i];
				$mydb->insertQuery('tbl_image',$data2);	
			}
		}
	}
	
	
	
	$message = $mydb->updateQuery('tbl_place',$data,'id='.$gid);
	
	$url = ADMINURLPATH."place_manage&id=".$gid."&message=".$message;
	$mydb->redirect($url);
}
$rasPlace = $mydb->getArray('*','tbl_place','id='.$gid);
?>
<form action="" method="post" enctype="multipart/form-data" name="placeInsert" onSubmit="return call_validate(this,0,this.length);">
  <table cellpadding="2" cellspacing="0" border="0" width="100%" class="FormTbl">
	<tr class="TitleBar">
      <td class="TtlBarHeading" colspan="2"><?php echo $do;?> place</td>
    </tr>		
	<?php if(isset($_GET['message'])){?>
	<tr>
	  <td colspan="2" class="message"><?php echo $_GET['message']; ?></td>
	</tr>
	<?php } ?>
	<tr>
	  <td width="17%" align="right" class="TitleBarA"><strong>Place name : </strong></td>
	  <td class="TitleBarA"><input name="title" id="title" type="text" value="<?php echo $rasPlace['title'];?>" class="inputBox"/></td>
	</tr>
	<tr>
	  <td width="17%" align="right" class="TitleBarA"><strong>Description : </strong></td>
	  <td class="TitleBarA"><textarea name="description" cols="" rows="10" style="width:100%"><?php echo stripslashes($rasPlace['description']);?></textarea></td>
	</tr>
	<tr>
	  <td align="right" class="TitleBarA"><strong>Images :</strong></td>
	  <td class="TitleBarA"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="FormTbl">
        <tr>
          <td class="TitleBarB"><strong>Image Title</strong></td>
          <td class="TitleBarB"><strong>Image</strong></td>
          <td class="TitleBarB">&nbsp;</td>
        </tr>
        <?php
		$resGalImage = $mydb->getQuery('*','tbl_image','gid='.$gid);
		while($rasGalImage = $mydb->fetch_array($resGalImage))
		{
		?>
        <tr>
          <td class="TitleBarA"><input type="text" name="imagetitleOld[]" id="imagetitleOld[]" class="inputBox" style="width:500px;" value="<?php echo $rasGalImage['imagetitle'];?>"><input name="imid[]" type="hidden" value="<?php echo $rasGalImage['id'];?>"></td>
          <td class="TitleBarA"><img src="../img/place/<?php echo $rasGalImage['imagename'];?>" width="200"></td>
          <td class="TitleBarA"><a href="javascript:deleteImage('<?php echo $rasGalImage['id'];?>');"><img src="images/action_delete.gif" alt="Delete" width="24" height="24" title="Delete"></a></td>
        </tr>
        <?php
		}
		for($i=0;$i<5;$i++)
		{
		?>
        <tr>
          <td class="TitleBarA"><input type="text" name="imagetitle[]" id="imagetitle[]" class="inputBox" style="width:500px;"></td>
          <td class="TitleBarA"><input type="file" name="imagename[]" id="imagename[]"></td>
          <td class="TitleBarA">&nbsp;</td>
        </tr>
        <?php
		}
		?>
      </table></td>
    </tr>
	<tr>
	  <td align="right" class="TitleBarA">&nbsp;</td>
	  <td class="TitleBarA" style="padding-bottom:15px;"><input name="btnDo" type="submit" value="<?php echo $do;?>" class="button" /></td>
	</tr>
  </table>
</form>