<link rel="stylesheet" href="AnythingFader/fader.css" type="text/css" media="screen">
<!--<script type="text/javascript" src="AnythingFader/jquery.min.js"></script>-->
<script src="AnythingFader/jquery.anythingfader.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    
        function formatText(index, panel) {
		  return index + "";
	    }
    
        $(function () {
        
            $('.anythingFader').anythingFader({
                autoPlay: true,                 // This turns off the entire FUNCTIONALY, not just if it starts running or not.
                delay: 5000,                    // How long between slide transitions in AutoPlay mode
                startStopped: false,            // If autoPlay is on, this can force it to start stopped
                animationTime: 500,             // How long the slide transition takes
                hashTags: true,                 // Should links change the hashtag in the URL?
                buildNavigation: true,          // If true, builds and list of anchor links to link to each slide
                pauseOnHover: true,             // If true, and autoPlay is enabled, the show will pause on hover
                startText: "Go",                // Start text
                stopText: "Stop",               // Stop text
                navigationFormatter: formatText   // Details at the top of the file on this use (advanced use)
            });
            
            $("#slide-jump").click(function(){
                $('.anythingFader').anythingFader(6);
            });
            
        });
    </script>
<div class="anythingFader">
    <div class="wrapper" style="overflow: hidden; opacity: 1; ">
      <ul>
        <?php
		$resBanner = $mydb->getQuery('*','tbl_image','gid=3');
		while($rasBanner = $mydb->fetch_array($resBanner))
		{
		?>
        <li class="cloned"> <img src="<?php echo SITEROOT;?>im/gallery/<?php echo $rasBanner['imagename'];?>" title="<?php echo stripslashes($rasBanner['imagetitle']);?>" alt="" width="960px;"><span><?php echo stripslashes($rasBanner['imagetitle']);?></span> </li>
        <?php
		}
		?>
      </ul>
    </div>
    
  </div>
