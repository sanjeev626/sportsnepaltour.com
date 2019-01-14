<?php
if(isset($_GET['id']))
{
	$btnValue='Update';
	$id = $_GET['id'];
}
else
{	
	$btnValue='Add';
	$id = 0;
}
?>
<script type="text/javascript">
	function callDeleteImage(id)
	{
		if(confirm('Are you sure to delete this image?'))
		{
			window.locaion='index.php?manager=package_manage&id=<?php echo $id;?>&delImid='+id;
		}
	}
</script>
<?php
	
/* generate refresh link*/	

if(isset($_GET['aid']))
{
	$aid = $_GET['aid'];
	$refreshlink='&aid='.$aid;
}

if(isset($_GET['delImid']))
{
	$imid = $_GET['delImid'];
	$imagename = $mydb->getValue('imagename','tbl_packageimage','id='.$imid);
	$unlink = '../img/package/'.$imagename;
	@unlink($unlink);
	$mydb->deleteQuery('tbl_packageimage','id='.$imid);
}

if(isset($_POST['btnSubmit']) && $_POST['btnSubmit']=='Update')
{
	//print_r($_FILES['packageeximage']);
	if(isset($_FILES['packageeximage']))
	{
	$excount = count($_FILES['packageeximage']['name']);
	for($i=0;$i<$excount;$i++)
	{
		if($_FILES['packageeximage']['size'][$i]>0)
		{
			$data='';
			$imagename = rand(111,999).$mydb->clean4urlcode($_FILES['packageeximage']['name'][$i]);
			$tmp_name=$_FILES['packageeximage']['tmp_name'][$i];
			$imagepath='../img/package/'.$imagename;
			copy($tmp_name,$imagepath);
			$data['pid'] = $id;
			$data['imagename'] = $imagename;
			$mydb->insertQuery('tbl_packageimage',$data);
		}
	}
	}
	
	$data='';
	
	if(isset($_FILES['iconimage']['name']) && $_FILES['iconimage']['size']>0)
	{
		$imagename = $mydb->clean4imagecode($_FILES['iconimage']['name']);
		$tmp_name=$_FILES['iconimage']['tmp_name'];
		$imagepath='../img/package/thumb/';	
		$unlinkpicname = $mydb->getValue('iconimage','tbl_package','id='.$id);	
		$iconimage = $mydb->UploadImage($imagename,$tmp_name,$imagepath,'',$unlinkpicname);
		$data['iconimage'] = $iconimage;
	}
	
	if(isset($_FILES['packageimage']['name']) && $_FILES['packageimage']['size']>0)
	{
		$imagename = $mydb->clean4imagecode($_FILES['packageimage']['name']);
		$tmp_name=$_FILES['packageimage']['tmp_name'];
		$imagepath='../img/package/';
		$unlinkpicname = $mydb->getValue('packageimage','tbl_package','id='.$id);	
		$packageimage = $mydb->UploadImage($imagename,$tmp_name,$imagepath,'',$unlinkpicname);
		$data['packageimage'] = $packageimage;
	}
	
	if(isset($_FILES['pdffile']['name']) && $_FILES['pdffile']['size']>0)
	{
		$pdfname = $mydb->clean4imagecode($_FILES['pdffile']['name']);
		$tmp_name=$_FILES['pdffile']['tmp_name'];
		$pdfpath='../img/package/';	
		$pdffile = $mydb->UploadImage($pdfname,$tmp_name,$pdfpath);
		$data['pdffile'] = $pdffile;
	}
	
	if(isset($_FILES['map']['name']) && $_FILES['map']['size']>0)
	{
		$imagename = $mydb->clean4imagecode($_FILES['map']['name']);
		$tmp_name=$_FILES['map']['tmp_name'];
		$imagepath='../img/package/';
		$unlinkpicname = $mydb->getValue('map','tbl_package','id='.$id);	
		$packageimage = $mydb->UploadImage($imagename,$tmp_name,$imagepath,'',$unlinkpicname);
		$data['map'] = $packageimage;
	}
	
	foreach($_POST as $key=>$value)
	{
		if($key!='btnSubmit')
			$data[$key]=$value;
	}
	$data['urlcode'] = $mydb->clean4urlcode($_POST['title']);
	
	$refreshlink.='&id='.$id;
	$mydb->updateQuery('tbl_package',$data,'id='.$id);
	$mydb->redirect(ADMINURLPATH."package_manage".$refreshlink."&msg=1");
}

if(isset($_POST['btnSubmit']) && $_POST['btnSubmit']=='Add')
{
	$aid = $_POST['aid'];
	$rid = $_POST['rid'];
	$data='';
	if(isset($_FILES['iconimage']['name']) && $_FILES['iconimage']['size']>0)
	{
		$imagename = $mydb->clean4imagecode($_FILES['iconimage']['name']);
		$tmp_name=$_FILES['iconimage']['tmp_name'];
		$imagepath='../img/package/thumb/';		
		$iconimage = $mydb->UploadImage($imagename,$tmp_name,$imagepath);
		$data['iconimage'] = $iconimage;
	}
	
	if(isset($_FILES['packageimage']['name']) && $_FILES['packageimage']['size']>0)
	{
		$imagename = $mydb->clean4imagecode($_FILES['packageimage']['name']);
		$tmp_name=$_FILES['packageimage']['tmp_name'];
		$imagepath='../img/package/';	
		$packageimage = $mydb->UploadImage($imagename,$tmp_name,$imagepath);
		$data['packageimage'] = $packageimage;
	}
	
	if(isset($_FILES['pdffile']['name']) && $_FILES['pdffile']['size']>0)
	{
		$pdfname = $mydb->clean4imagecode($_FILES['pdffile']['name']);
		$tmp_name=$_FILES['pdffile']['tmp_name'];
		$pdfpath='../img/package/';	
		$pdffile = $mydb->UploadImage($pdfname,$tmp_name,$pdfpath);
		$data['pdffile'] = $pdffile;
	}
	
	if(isset($_FILES['map']['name']) && $_FILES['map']['size']>0)
	{
		$imagename = $mydb->clean4imagecode($_FILES['map']['name']);
		$tmp_name=$_FILES['map']['tmp_name'];
		$imagepath='../img/package/';	
		$packageimage = $mydb->UploadImage($imagename,$tmp_name,$imagepath);
		$data['map'] = $packageimage;
	}
	
	
	
	foreach($_POST as $key=>$value)
	{
		if($key!='btnSubmit')
			$data[$key]=$value;
	}
	$data['ordering'] = $mydb->getValue('ordering','tbl_package','aid='.$aid.' ORDER BY ordering DESC LIMIT 1')+1;
	$data['urlcode'] = $mydb->clean4urlcode($_POST['title']);
	$mydb->insertQuery('tbl_package',$data,'id='.$id);
	$mydb->redirect(ADMINURLPATH."package".$refreshlink."&msg=2");
}
include("fckeditor/fckeditor.php") ;
$rasPackage = $mydb->getArray('*','tbl_package','id='.$id);
?>
<form action="" method="post" enctype="multipart/form-data" name="frmPage">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="FormTbl">
  <tr class="TitleBar">
    <td colspan="3" class="TtlBarHeading"><?php echo $btnValue;?> Package<div style="float:right">
      <input type="button" name="btnList" id="btnList" value="List" class="button" onClick="window.location='<?php echo ADMINURLPATH;?>package<?php echo $refreshlink;?>'" />
      <input type="submit" name="btnSubmit" id="btnSubmit" value="<?php echo $btnValue;?>" class="button" /></div></td>
  </tr>
  <?php if(isset($_GET['msg']) && $_GET['msg'] =='1'){ ?>
  <tr>
    <td colspan="3" class="adminsucmsg">Package info has been updated.</td>
    </tr>
  <?php } ?>
  <tr>
    <td class="TitleBarA" width="170"><strong>Activity</strong></td>
    <td width="100" colspan="2" class="TitleBarA">
    	<select name="aid" id="aid" class="inputbox">
        <option value="0">None</option>
		<?php
        $counter = 0;
        $resActivity = $mydb->getQuery('*','tbl_activity');
        while($rasActivity = $mydb->fetch_array($resActivity))
        {
		if(isset($_GET['aid']))
			$aid = $_GET['aid'];
		else
			$aid = $rasPackage['aid'];
        ?>
        <option value="<?php echo $rasActivity['id'];?>" <?php if($rasActivity['id']==$aid) echo 'selected';?>><?php echo $rasActivity['title'];?></option>
        <?php
		}
		?>
        </select>    </td>
  </tr>
  <tr>
    <td class="TitleBarA"><strong>Name</strong></td>
    <td colspan="2" class="TitleBarA"><input name="title" type="text" value="<?php echo $rasPackage['title'];?>" class="inputbox"></td>
  </tr>
  <tr>
    <td class="TitleBarA"><strong>Duration</strong></td>
    <td colspan="2" class="TitleBarA"><input name="duration" type="text" value="<?php echo $rasPackage['duration'];?>" class="inputbox"></td>
  </tr>
  <tr>
    <td class="TitleBarA"><strong>Cost(USD)</strong></td>
    <td colspan="2" class="TitleBarA"><input name="cost" type="text" value="<?php echo $rasPackage['cost'];?>" class="inputbox"></td>
  </tr>
  <tr>
    <td class="TitleBarA"></td>
    <td colspan="2" class="TitleBarA"><strong>OR</strong></td>
  </tr>
  <tr>
    <td class="TitleBarA"><strong>Cost(NRs)</strong></td>
    <td colspan="2" class="TitleBarA"><input name="cost_npr" type="text" value="<?php echo $rasPackage['cost_npr'];?>" class="inputbox"></td>
  </tr>
  <tr>
    <td class="TitleBarA"><strong> Show in homepage</strong></td>
    <td colspan="2" class="TitleBarA"><label>
      <select name="showinhomepage" id="showinhomepage">
      	<option value="0">No</option>
      	<option value="1" <?php if($rasPackage['showinhomepage']=='1') echo 'selected';?>>Yes</option>
      </select>
    </label></td>
  </tr>
  <tr>
    <td class="TitleBarA"><strong>Description</strong></td>
    <td colspan="2" class="TitleBarA"><?php
		$description = stripslashes($rasPackage['description']);
		
		$sBasePath = 'fckeditor/';
		
		$oFCKeditor = new FCKeditor('description') ;
		$oFCKeditor->BasePath = $sBasePath ;
		$oFCKeditor->Width = '100%' ;
		$oFCKeditor->Height = '350px' ;
		$oFCKeditor->Value = $description ;
		$oFCKeditor->Create() ;
		?>        </td>
  </tr>
  <tr>
    <td class="TitleBarA"><strong>Icon Image</strong></td>
    <td colspan="2" class="TitleBarA"><?php $iconpath='../img/package/thumb/'.$rasPackage['iconimage']; if(!empty($rasPackage['iconimage']) && file_exists($iconpath)){?><img src="<?php echo $iconpath;?>" alt="Package Image" width="220px"><br/><?php }?><input type="file" name="iconimage" id="iconimage"></td>
  </tr>
  <tr>
    <td class="TitleBarA"><strong>Image</strong></td>
    <td colspan="2" class="TitleBarA"><?php $imagepath='../img/package/'.$rasPackage['packageimage']; if(!empty($rasPackage['packageimage']) && file_exists($imagepath)){?><img src="<?php echo $imagepath;?>" alt="Package Image" width="220px"><br/><?php }?><input type="file" name="packageimage" id="packageimage"></td>
  </tr>
  <tr>
    <td class="TitleBarA"><strong>PDF file</strong></td>
    <td colspan="2" class="TitleBarA"><?php $pdfpath='../img/package/'.$rasPackage['pdffile']; if(!empty($rasPackage['pdffile']) && file_exists($pdfpath)){ echo $rasPackage['pdffile'];?><br/><?php }?><input type="file" name="pdffile" id="pdffile"></td>
  </tr>
  <tr>
    <td class="TitleBarA"><strong>Map</strong></td>
    <td colspan="2" class="TitleBarA"><?php $mappath='../img/package/'.$rasPackage['map']; if(!empty($rasPackage['map']) && file_exists($mappath)){?><img src="<?php echo $mappath;?>" alt="Map" width="220px"><br/><?php }?><input type="file" name="map" id="map"></td>
  </tr>
  <tr>
    <td class="TitleBarA"><strong>Highlights</strong></td>
    <td colspan="2" class="TitleBarA"><?php
		$highlights = stripslashes($rasPackage['highlights']);
		
		
		$sBasePath = 'fckeditor/';
		
		$oFCKeditor = new FCKeditor('highlights') ;
		$oFCKeditor->BasePath = $sBasePath ;
		$oFCKeditor->Width = '100%' ;
		$oFCKeditor->Height = '350px' ;
		$oFCKeditor->Value = $highlights ;
		$oFCKeditor->Create() ;
		?></td>
  </tr>
  <tr>
    <td class="TitleBarA"><strong>Accomodations</strong></td>
    <td colspan="2" class="TitleBarA"><?php
		$accomodations = stripslashes($rasPackage['accomodations']);
		
		
		$sBasePath = 'fckeditor/';
		
		$oFCKeditor = new FCKeditor('accomodations') ;
		$oFCKeditor->BasePath = $sBasePath ;
		$oFCKeditor->Width = '100%' ;
		$oFCKeditor->Height = '350px' ;
		$oFCKeditor->Value = $accomodations ;
		$oFCKeditor->Create() ;
		?></td>
  </tr>
  <tr>
    <td class="TitleBarA"><strong>Itinerary</strong></td>
    <td colspan="2" class="TitleBarA">&nbsp;</td>
  </tr>
  <tr>
    <td class="TitleBarA"><strong>Additional Remarks</strong></td>
    <td colspan="2" class="TitleBarA"><?php
		$additionalremarks = stripslashes($rasPackage['additionalremarks']);
		
		
		$sBasePath = 'fckeditor/';
		
		$oFCKeditor = new FCKeditor('additionalremarks') ;
		$oFCKeditor->BasePath = $sBasePath ;
		$oFCKeditor->Width = '100%' ;
		$oFCKeditor->Height = '350px' ;
		$oFCKeditor->Value = $additionalremarks ;
		$oFCKeditor->Create() ;
		?></td>
  </tr>
  <tr>
    <td class="TitleBarA"><strong>Page Title</strong></td>
    <td class="TitleBarA" colspan="2"><textarea name="metatitle" id="metatitle" cols="45" rows="5" style="width:100%"><?php echo stripslashes($rasPackage['metatitle']);?></textarea></td>
  </tr>
  <tr>
    <td class="TitleBarA"><strong>Meta Keywords</strong></td>
    <td class="TitleBarA" colspan="2"><textarea name="metakeywords" id="metakeywords" cols="45" rows="5" style="width:100%"><?php echo stripslashes($rasPackage['metakeywords']);?></textarea></td>
  </tr>
  <tr>
    <td class="TitleBarA"><strong>Meta Description</strong></td>
    <td class="TitleBarA" colspan="2"><textarea name="metadescription" id="metadescription" cols="45" rows="5" style="width:100%"><?php echo stripslashes($rasPackage['metadescription']);?></textarea></td>
  </tr>
  <tr>
    <td class="TitleBarA">&nbsp;</td>
    <td colspan="2" class="TitleBarA"><input type="submit" name="btnSubmit" id="btnSubmit" value="<?php echo $btnValue;?>" class="button" /></td>
  </tr>
</table>
</form>