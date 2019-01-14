<?php
$rasPage = $mydb->getArray('*','tbl_page','id='.$pageId);
?>
<div class="lcont2">
  <div class="cmenu"><?php include (SITEROOTDOC."includes/countrymenu.php");?></div>
  <!--cmenu-->
  <div class="lmain2">
    <div class="lchead">
      <div class="tripinfo1">
        <h1><?php echo stripslashes($rasPage['title']);?></h1>
        <?php echo stripslashes($rasPage['contents']);?>
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
    <!--quicknav-->
  </div>
  <!--qnav-->
</div>
<!--rcont-->
<?php include (SITEROOTDOC."includes/footer.php");?>
<!--botm-->
