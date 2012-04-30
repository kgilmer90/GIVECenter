<?php 

$guestVideos = array( 	0 => 'AdvancedSearch.mp4',
						1 => 'QuickSearch.mp4',
						2 => 'BrowseAll.mp4',
						3 => 'ToggleNavigation.mp4');
						
$adminVideos = array (	0 => 'AdminIntro.mp4',
						1 => 'AdminChangeBanner.mp4',
						2 => 'AdminEditingDatabaseEntries.mp4',
						3 => 'AdminExit.mp4');

//default init $video to the first guest video
$video = $guestVideos[0];

//if the video name GET parameter is set
if(isset($_GET['v'])) {
	//if the GET parameter is a video in the array
	foreach($guestVideos as $v) {
		if($v == $_GET['v']) {
			//set $video to the video name
			$video = $v;
		}
	}
}

//if logged in as admin
if(isset($_SESSION['admin'])) {
	//if the video name GET parameter is set
	if(isset($_GET['v'])) {
		//if the GET parameter is a video in the admin videos array
		foreach($adminVideos as $v) {
			if($v == $_GET['v']) {
				//set $video to the video name
				$video = $v;
			}
		}
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Help Video: <?php echo $video; ?></title>
<style type="text/css">
<!--
body {
	font: 100%/1.4 Verdana, Arial, Helvetica, sans-serif;
	background: #FFF;
	margin: 0;
	padding: 0;
	color: #000;
	text-align: right;
}
/* ~~ Element/tag selectors ~~ */
ul, ol, dl { /* Due to variations between browsers, it's best practices to zero padding and margin on lists. For consistency, you can either specify the amounts you want here, or on the list items (LI, DT, DD) they contain. Remember that what you do here will cascade to the .nav list unless you write a more specific selector. */
padding: 0;
margin: 0;
}
h1, h2, h3, h4, h5, h6, p {
margin-top: 0; /* removing the top margin gets around an issue where margins can escape from their containing div. The remaining bottom margin will hold it away from any elements that follow. */
padding-right: 15px;
padding-left: 15px; /* adding the padding to the sides of the elements within the divs, instead of the divs themselves, gets rid of any box model math. A nested div with side padding can also be used as an alternate method. */
}
.container
{
	width:100%;	

}

</style>
<script type="text/javascript" src="js/Navigation.js"></script>
</head>
<body>
<div class = "container" align="center">
<a href="javascript:popitup('helpPage.php')"><img src="back.png" alt="backButton" name="backButton" width="5%" height="5%" style="padding: 2%;"/></a>
<br />
<h1><?php echo $video; ?></h1>
<OBJECT CLASSID="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" WIDTH="640" HEIGHT="440" CODEBASE="http://www.apple.com/qtactivex/qtplugin.cab">
<PARAM name="HelpVideos/<?php echo $video; ?>" VALUE="HelpVideos/<?php echo $video; ?>">
<PARAM name="AUTOPLAY" VALUE="true">
<PARAM name="CONTROLLER" VALUE="false">
<EMBED SRC="HelpVideos/<?php echo $video; ?>" WIDTH="640" HEIGHT="440" AUTOPLAY="false" CONTROLLER="true" PLUGINSPAGE="http://www.apple.com/quicktime/download/">
</EMBED>
</OBJECT>
<br/>
</div>
</body>
</html>
