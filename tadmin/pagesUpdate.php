<script type="text/javascript">

	function deleteImage(imid)

	{

		//alert(imid);

		var bool;

		bool = confirm('Are you sure to delete this image. The process is ir-reversible.');

		if(bool)

		{

			window.location='index.php?manager=pagesUpdate&pid=<?php echo $_GET["pid"];?>&delImid='+imid;

		}

	}

</script>



<?php

if(isset($_POST['btnSave']))

{

	$pid = $_GET['pid'];

	//print_r($_POST);

	//print_r($_FILES);

	$data='';

	foreach($_POST as $key=>$value)

	{

		if($key!='btnSave' && $key!="imagetitle" && $key!="imagename" && $key!="imagetitleOld" && $key!="imid")

			$data[$key]=$value;

	}

	$mydb->updateQuery('tbl_page',$data,'id='.$pid);

	
	//update Old images and title
	if(isset($_POST['imid']))
	{

		for($i=0;$i<count($_POST['imid']);$i++)

		{			

			$imid = $_POST['imid'][$i];

			$data3='';

			$data3['imagetitle'] = $_POST['imagetitleOld'][$i];

			$mydb->updateQuery('tbl_image',$data3,'id='.$imid);

		}

	}

	

	//print_r($_FILES);

	if(isset($_FILES['imagename']['name']))

	{

		$imgcount = count($_FILES['imagename']['name']);

		for($i=0;$i<5;$i++)

		{

			$imagesize = $_FILES['imagename']['size'][$i];

			//echo $imagesize."<br>";

			if($imagesize>0)

			{

				//ready to upload

				$imagename = rand(1111,9999).$mydb->clean4urlcode(($_FILES['imagename']['name'][$i]));

				//echo $imagename."<br>";

				$source = $_FILES['imagename']['tmp_name'][$i];

				$dest = '../im/gallery/'.$imagename;

				if(copy($source,$dest))

				{				

					$data2='';

					$data2['gid'] = $pid;

					$data2['imagename'] = $imagename;

					$data2['imagetitle'] = $_POST['imagetitle'][$i];

					$mydb->insertQuery('tbl_image',$data2);	

				}

			}

		}

	}

	

}







if(isset($_GET['delImid']) && $_GET['delImid']>0)

{	

	$delImid = $_GET['delImid'];

	

	$imagename=$mydb->getValue('imagename','tbl_image','id='.$delImid);

	$imagepath='../im/gallery/'.$imagename;

	@unlink($imagepath);

	$mydb->deleteQuery('tbl_image','id='.$delImid);

}





if(isset($_GET['pid']))

{

$pid = $_GET['pid'];

$rasPage = $mydb->getArray('*','tbl_page','id='.$pid);

	$contents = stripslashes($rasPage['contents']);

?>

<form action="" method="post" name="pageEdit" enctype="multipart/form-data">

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="FormTbl">

  <tr class="TitleBar">

    <td class="TtlBarHeading" colspan="4">Update Page</td>

  </tr>

  <tr>

    <td class="TitleBarA" style="width:130px;"><strong>Title</strong></td>

    <td class="TitleBarA"><?php echo $rasPage['page']; ?></td>

  </tr>

  <?php

  if($pid!=3)

  {

  ?>

  <tr>

    <td class="TitleBarA"><strong>Contents</strong></td>

    <td class="TitleBarA">

    	<?php

		include("fckeditor/fckeditor.php") ;

		

		$sBasePath = 'fckeditor/';

		

		$oFCKeditor = new FCKeditor('contents') ;

		$oFCKeditor->BasePath = $sBasePath ;

		$oFCKeditor->Width = '100%' ;

		$oFCKeditor->Height = '350px' ;

		$oFCKeditor->Value = $contents ;

		$oFCKeditor->Create() ;

		?></td>

  </tr>

  <?php

  }

  ?>

  <tr>

    <td class="TitleBarA"><strong>Page Title</strong></td>

    <td class="TitleBarA" colspan="2"><textarea name="metatitle" id="metatitle" cols="45" rows="5" style="width:100%"><?php echo stripslashes($rasPage['metatitle']);?></textarea></td>

  </tr>

  <tr>

    <td class="TitleBarA"><strong>Meta Keywords</strong></td>

    <td class="TitleBarA" colspan="2"><textarea name="metakeywords" id="metakeywords" cols="45" rows="5" style="width:100%"><?php echo stripslashes($rasPage['metakeywords']);?></textarea></td>

  </tr>

  <tr>

    <td class="TitleBarA"><strong>Meta Description</strong></td>

    <td class="TitleBarA" colspan="2"><textarea name="metadescription" id="metadescription" cols="45" rows="5" style="width:100%"><?php echo stripslashes($rasPage['metadescription']);?></textarea></td>

  </tr>

  <?php

  if($pid==3)

  {

  ?>

  <tr>

    <td class="TitleBarA"><strong>Images</strong></td>

    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="FormTbl">

        <tr>

          <td class="TitleBarB"><strong>Image Title</strong></td>

          <td class="TitleBarB"><strong>Image</strong></td>

          <td class="TitleBarB">&nbsp;</td>

        </tr>

        <?php

		$resGalImage = $mydb->getQuery('*','tbl_image','gid='.$pid);

		while($rasGalImage = $mydb->fetch_array($resGalImage))

		{

		?>

        <tr>

          <td class="TitleBarA"><input type="text" name="imagetitleOld[]" id="imagetitleOld[]" class="inputBox" style="width:500px;" value="<?php echo $rasGalImage['imagetitle'];?>"><input name="imid[]" type="hidden" value="<?php echo $rasGalImage['id'];?>"></td>

          <td class="TitleBarA"><img src="../im/gallery/<?php echo $rasGalImage['imagename'];?>" width="200"></td>

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

        <tr>

          <td colspan="3" class="TitleBarA"><strong>Note : Image resolution must be 960px X 333px for best view</strong></td>

        </tr>

      </table></td>

  </tr>

  <?php

  }

  ?>

  <tr>

    <td class="TitleBarA">&nbsp;</td>

    <td class="TitleBarA"><input type="submit" name="btnSave" id="btnSave" value="Save" class="button" /></td>

  </tr>

</table>

</form>

<?php

}

?>