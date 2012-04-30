<?php 
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GIVE Center Help Page</title>
<style type="text/css">
<!--
body {
	font: 100%/1.4 Verdana, Arial, Helvetica, sans-serif;
	background: #cccccc;
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
.GeneralHelp
{
}
.AdminHelp
{
}
</style>
</head>


<script type="text/javascript" src="js/Navigation.js"></script>

<body>
<div class = "container">
<br />
<div class = "GeneralHelp" id="GeneralHelp" align="center">
<h1>General Help</h1>
<a href="helpVideo.php" onclick="return popitup('helpVideo.php?v=AdvancedSearch.mp4')">How To Use The Advanced Search Feature</a><br />
<a href="helpVideo.php" onclick="return popitup('helpVideo.php?v=QuickSearch.mp4')">How To Use The Quick Search Feature</a><br />
<a href="helpVideo.php" onclick="return popitup('helpVideo.php?v=BrowseAll.mp4')">How to Browse All</a><br />
<a href="helpVideo.php" onclick="return popitup('helpVideo.php?v=ToggleNavigation.mp4')">How to Toggle Between Program and Agency Lists</a>

</div>
<br />
<br />
<?php if($_SESSION['admin']) { ?>
<div class= "AdminHelp" id="AdminHelp" align="center">
<h1>Admin Help</h1>
<a href="helpVideo.php" onclick="return popitup('helpVideo.php?v=AdminIntro.mp4')">How To Access the Adminisitration Section</a><br />
<a href="helpVideo.php" onclick="return popitup('helpVideo.php?v=AdminChangeBanner.mp4')">How To Change The Banner</a><br />
<a href="helpVideo.php" onclick="return popitup('helpVideo.php?v=AdminEditingDatabaseEntries.mp4')">How To Edit Database Entries</a><br />
<a href="helpVideo.php" onclick="return popitup('helpVideo.php?v=AdminExit.mp4')">How To Exit The Administration Section</a>
</div>
<?php }?>

<div id="movieDiv" style="visibility:hidden;display:none;">
<OBJECT CLASSID="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" WIDTH="640" HEIGHT="480" 
	CODEBASE="http://www.apple.com/qtactivex/qtplugin.cab">
<PARAM name="SRC" VALUE="sample.mov">
<PARAM name="AUTOPLAY" VALUE="true">
<PARAM name="CONTROLLER" VALUE="true">
<EMBED SRC="sample.mov" WIDTH="640" HEIGHT="480" AUTOPLAY="true" CONTROLLER="true" 
	PLUGINSPAGE="http://www.apple.com/quicktime/download/">
</EMBED>
</OBJECT>
</div>
</div>
</body>
</html>
