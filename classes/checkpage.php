<?php
//print_r($_GET);
$rasHome = $mydb->getArray('metatitle,metakeywords,metadescription','tbl_page','id=3');
$metatitle = stripslashes($rasHome['metatitle']);
$metakeywords = stripslashes($rasHome['metakeywords']);
$metadescription = stripslashes($rasHome['metadescription']);
$pagepath = 'includes/home.php';

if(isset($_GET['urlcode']))
{
	$urlcode = $_GET['urlcode'];
	//echo $urlcode;
	if($mydb->getCount('id','tbl_page','urlcode="'.$urlcode.'"')>0)
	{
		$pagepath = 'includes/template_page.php';
		$rasPage = $mydb->getArray('page,contents,metatitle,metakeywords,metadescription','tbl_page','urlcode="'.$urlcode.'"');
		
		$title = $rasPage['page'];
		$contents = stripslashes($rasPage['contents']);
		
		$metatitle = $rasPage['metatitle'];
		$metakeywords = $rasPage['metakeywords'];
		$metadescription = 	stripslashes($rasPage['metadescription']);
	}
	elseif($mydb->getCount('id','tbl_activity','urlcode="'.$urlcode.'"')>0)
	{
		$pagepath = 'includes/template_activity.php';
		$rasActivity = $mydb->getArray('id,title,description,pagetitle,metakeywords,metadescription','tbl_activity','urlcode="'.$urlcode.'"');	
		$id = $rasActivity['id'];		
		$metatitle = $rasActivity['pagetitle'];
		$metakeywords = $rasActivity['metakeywords'];
		$metadescription = 	$rasActivity['metadescription'];
	}
	elseif($mydb->getCount('id','tbl_package','urlcode="'.$urlcode.'"')>0)
	{
		$rasPackage = $mydb->getArray('*','tbl_package','urlcode="'.$urlcode.'"');
		$id 				= 	$rasPackage['id'];
		$acid 				= 	$rasPackage['aid'];	
		$packagecode 		= 	$rasPackage['urlcode'];
		$imagepath 			= 	SITEROOT.'img/package/'.$rasPackage['packageimage'];
		if(!empty($rasPackage['map']))
			$mapdocpath		= 	SITEROOTDOC.'img/package/'.$rasPackage['map'];
		else
			$mapdocpath		=	'';
		$mappath 			= 	SITEROOT.'img/package/'.$rasPackage['map'];
		//$pdffile			=	$rasPackage['pdffile'];
		$title				= 	stripslashes($rasPackage['title']);
		$duration 			= 	stripslashes($rasPackage['duration']);
		$cost 				= 	stripslashes($rasPackage['cost']);
		$cost_npr			= 	stripslashes($rasPackage['cost_npr']);
		$description 		= 	stripslashes($rasPackage['description']);
		$highlights 		= 	stripslashes($rasPackage['highlights']);
		$accomodations 		= 	stripslashes($rasPackage['accomodations']);
		$itinerary 			= 	stripslashes($rasPackage['itinerary']);
		$additionalremarks 	= 	stripslashes($rasPackage['additionalremarks']);
		
		$metatitle = $rasPackage['metatitle'];
		$metakeywords = $rasPackage['metakeywords'];
		$metadescription = 	$rasPackage['metadescription'];
		$pagepath = 'includes/template_package.php';
	}
	elseif($mydb->getCount('id','tbl_news','urlcode="'.$urlcode.'"')>0)
	{
		$rasNews = $mydb->getArray('*','tbl_news','urlcode="'.$urlcode.'"');
		
		$title = stripslashes($rasNews['title']);
		$contents = stripslashes($rasNews['contents']);
		$metatitle = stripslashes($rasNews['title']).' - Sports Tour and Travel';
		$metakeywords = $rasNews['title'];
		$metadescription = 	strip_tags($contents);
		$pagepath = 'includes/template_news.php';
	}
	elseif($urlcode=="testimonials")
	{		
		$metatitle = "Testimonials - Sports Tours and Travel";
		$metakeywords = "Testimonials, Sports Tours and Travel";
		$metadescription = "Testimonials for Sports Tours and Travel.";
		$pagepath = 'includes/template_testimonial.php';
	}
	elseif($urlcode=="booking-form")
	{
		$packagecode=$_POST['packagecode'];
		$rasPackage = $mydb->getArray('title,duration,cost,cost_npr','tbl_package','urlcode="'.$packagecode.'"');
		$title = stripslashes($rasPackage['title']);
		$duration = $rasPackage['duration'];
		$cost = stripslashes($rasPackage['cost']);
		$cost_npr = stripslashes($rasPackage['cost_npr']);
		$pagepath = 'includes/booking-form.php';
	}
	elseif($urlcode=="link-exchange")
	{
		//$rasPackage = $mydb->getArray('title,duration','tbl_package','urlcode="'.$packagecode.'"');
		$metatitle = "Link Exchange - Sports Tours and Travel";
		$metakeywords = "Link Exchange, Link Exchange with Sports Tours and Travel, Exchange you links with Sports Tours and Travel";
		$metadescription = "Exchange your links with Sports Tours and Travel - Nepal Tour - Nepal travel agency for Nepal tour packages, Nepal short hiking, travel packages, Nepal trekking, Nepal Holidays.";
		$pagepath = 'includes/link-exchange.php';
	}	
	elseif($_GET['acturlcode']=="link-exchange")
	{
		//$rasPackage = $mydb->getArray('title,duration','tbl_package','urlcode="'.$packagecode.'"');
		
		
		$rasLinkEx = $mydb->getArray('id,title,description','tbl_linkexchange','urlcode="'.$urlcode.'"');
		$lid = $rasLinkEx['id'];
		$linkexchangetitle = stripslashes($rasLinkEx['title']);
		
		$metatitle = $linkexchangetitle." - Link Exchange - Sports Tours and Travel";
		$metakeywords = $linkexchangetitle." - Link Exchange, Link Exchange with Sports Tours and Travel, Exchange you links with Sports Tours and Travel";
		$metadescription = $linkexchangetitle." - Exchange your links with Sports Tours and Travel - Nepal Tour - Nepal travel agency for Nepal tour packages, Nepal short hiking, travel packages, Nepal trekking, Nepal Holidays.";
		
		$description = stripslashes($rasLinkEx['description']);
		
		$pagepath = 'includes/link-exchange-single.php';
	}
	elseif($urlcode=="news-and-events")
	{
		//$rasPackage = $mydb->getArray('title,duration','tbl_package','urlcode="'.$packagecode.'"');
		
		$metatitle = "Recent News and Events - Sports Tours and Travel";
		$metakeywords = "Recent News and Events from Nepal, Recent News and Events - Sports Tours and Travel";
		$metadescription = "Read recent news and events from Nepal - Sports Tours and Travel.";
		
		$pagepath = 'includes/news-and-events.php';
	}
	elseif($urlcode=="thank-you")
	{
		//$rasPackage = $mydb->getArray('title,duration','tbl_package','urlcode="'.$packagecode.'"');
		
		$metatitle = "Thank you - Sports Tours and Travel";
		$metakeywords = "Thank you - Sports Tours and Travel";
		$metadescription = "Thank you - Sports Tours and Travel.";
		
		$pagepath = 'includes/template_thank_you.php';
	}
}
?>