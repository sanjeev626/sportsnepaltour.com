<?php	
	function getmimetype ($filename) {
		static $mimes = array(
			'\.jpg$|\.jpeg$'  => 'image/jpeg',
			'\.gif$'          => 'image/gif',
			'\.png$'          => 'image/png',
			'\.html$|\.htm$' => 'text/html',
			'\.txt$|\.asc$'   => 'text/plain',
			'\.xml$|\.xsl$'   => 'application/xml',
			'\.doc$'   		  => 'application/doc',
			'\.zip$'   		  => 'application/zip',
			'\.rar$'   		  => 'application/rar',
			'\.xls$'   		  => 'application/xls',
			'\.pdf$'          => 'application/pdf'
			
		);
	
		foreach ($mimes as $regex => $mime) {
			if (eregi($regex, $filename)) return $mime;
		}
		//return 'text/plain';
	}
	$file = "img/package/".$_GET["downfile"];
	
	dl_file_resume($file);
	
	function dl_file_resume($file){

    //First, see if the file exists
    if (!is_file($file)) { die("<b>404 File not found!</b>"); }
   
    //Gather relevent info about file
    $len = filesize($file);
    $filename = basename($file);
    $file_extension = strtolower(substr(strrchr($filename,"."),1));
   
    //This will set the Content-Type to the appropriate setting for the file
    switch( $file_extension ) {
        case "exe": $ctype="application/octet-stream"; break;
        case "zip": $ctype="application/zip"; break;
        case "mp3": $ctype="audio/mpeg"; break;
        case "mpg": $ctype="video/mpeg"; break;
        case "avi": $ctype="video/x-msvideo"; break;
		case "gif": $ctype="image/gif"; break;
		case "jpg": $ctype="image/jpeg"; break;
		case "png": $ctype="image/png"; break;
		case "pdf": $ctype="application/pdf"; break;
		case "doc": $ctype="application/word"; break;
		case "txt": $ctype="text/plain"; break;
		case "html": $ctype="text/html"; break;
		case "htm": $ctype="text/html"; break;
        default: $ctype="application/force-download";
    }
	
    //Begin writing headers
    header("Cache-Control:");
    header("Cache-Control: public");
   
    //Use the switch-generated Content-Type
    header("Content-Type: $ctype");
    if (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE")) {
        # workaround for IE filename bug with multiple periods / multiple dots in filename
        # that adds square brackets to filename - eg. setup.abc.exe becomes setup[1].abc.exe
        $iefilename = preg_replace('/\./', '%2e', $filename, substr_count($filename, '.') - 1);
        header("Content-Disposition: attachment; filename=\"$iefilename\"");
    } else {
        header("Content-Disposition: attachment; filename=\"$filename\"");
    }
    header("Accept-Ranges: bytes");
   
    $size=filesize($file);
    //check if http_range is sent by browser (or download manager)
    if(isset($_SERVER['HTTP_RANGE'])) {
        list($a, $range)=explode("=",$_SERVER['HTTP_RANGE']);
        //if yes, download missing part
        str_replace($range, "-", $range);
        $size2=$size-1;
        $new_length=$size2-$range;
        header("HTTP/1.1 206 Partial Content");
        header("Content-Length: $new_length");
        header("Content-Range: bytes $range$size2/$size");
    } else {
        $size2=$size-1;
        header("Content-Range: bytes 0-$size2/$size");
        header("Content-Length: ".$size);
    }
    //open the file
    $fp=fopen("$file","rb");
    //seek to start of missing part
    fseek($fp,$range);
    //start buffered download
    while(!feof($fp)){
        //reset time limit for big files
        set_time_limit(0);
        print(fread($fp,1024*8));
        flush();
        ob_flush();
    }
    fclose($fp);
    exit;

/*
	header('Pragma: public');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Content-Type: ' . getmimetype($file));
	header('Content-Disposition: attachment; filename=' . $file . ';');
	header('Content-Length: ' . filesize($file));

	readfile($file);
	*/
	}
?>