<style type="text/css" media="all">
@import "<?php echo SITEROOT;?>css/global.css";
</style>
<?php /*?><script src="<?php echo SITEROOT;?>js/jquery.js" type="text/javascript"></script><?php */?>
<script language="javascript">
    function openAttraction(pid) {
        //var AttractionURL = "http://www.newshan.com/tour/AttractionBox.aspx?Code=" + AttractionCode;
		//alert(pid);
		 var AttractionURL = "<?php echo SITEROOT;?>popup.php?pid="+pid;
        if (window.XMLHttpRequest) {
            AttractionLoading();
            document.getElementById("AttractionPanel").style.display = "";
            document.getElementById("AttractionPanel_iframe").src = AttractionURL;
        } else {
            window.open(AttractionURL, '', 'scrollbars=no,menubar=no,height=405,width=640,resizable=no,toolbar=no,location=no,status=no');
        }
    }
    function closeAttraction(PanelName) {
        document.getElementById(PanelName).style.display = "none";
    }
    function AttractionLoading() {
        document.getElementById("AttractionPanel_Loading").style.display = "";
        document.getElementById("AttractionPanel_iframe").style.display = "none";
    }
    function AttractionLoaded() {
        //alert("hello");
        document.getElementById("AttractionPanel_iframe").style.display = "";
        document.getElementById("AttractionPanel_Loading").style.display = "none";
    }
    function openLegendsPanel() {
        document.getElementById("LegendsPanel").style.display = "";
    }
</script>
<script src="<?php echo SITEROOT;?>js/jtip.js" type="text/javascript"></script>


