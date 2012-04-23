<?php
include_once('php/GIVE/GIVEToHTML.php');
include_once('sql/queries/queries.php');

session_start();

//if not properly logged in, redirect to login page
if(!isset($_SESSION['username'])) {
	header('Location: LoginPage.php');
}

$conn;
try
{
	$conn = new MySQLDatabaseConn($GIVE_MYSQL_SERVER, $GIVE_MYSQL_DATABASE, $GIVE_MYSQL_UNAME, $GIVE_MYSQL_PASS);
}
catch(MySQLDatabaseConnException $e)
{
	header('Location: LoginPage.php?except=conn&code='.$e->code());
}

$banner_path = get_banner_latest($conn);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Homepage</title>
<style type="text/css">
<!--
body {
font: 100%/1.4 Verdana, Arial, Helvetica, sans-serif;
background: #cccccc;
margin: 0;
padding: 0;
color: #000;

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
a img { /* this selector removes the default blue border displayed in some browsers around an image when it is surrounded by a link */
border: none;
}
/* ~~ Styling for your site's links must remain in this order - including the group of selectors that create the hover effect. ~~ */
a:link {
color:#414958;
text-decoration: underline; /* unless you style your links to look extremely unique, it's best to provide underlines for quick visual identification */
}
a:visited {
color: #4E5869;
text-decoration: underline;
}
a:hover, a:active, a:focus { /* this group of selectors will give a keyboard navigator the same hover experience as the person using a mouse. */
text-decoration: none;
}
.header {
background: #6F7D94;
}
/* ~~ this container surrounds all other divs giving them their percentage-based width ~~ */
.container {
width: 80%;
max-width: 1260px;/* a max-width may be desirable to keep this layout from getting too wide on a large monitor. This keeps line length more readable. IE6 does not respect this declaration. */
min-width: 780px;
margin: 0 auto; /* the auto value on the sides, coupled with the width, centers the layout. It is not needed if you set the .container's width to 100%. */
overflow: hidden; /* this declaration makes the .container clear all floated columns within it. */
background-color: #cccccc;
}
/* ~~ These are the columns for the layout. ~~

1) Padding is only placed on the top and/or bottom of the divs. The elements within these divs have padding on their sides. This saves you from any "box model math". Keep in mind, if you add any side padding or border to the div itself, it will be added to the width you define to create the *total* width. You may also choose to remove the padding on the element in the div and place a second div within it with no width and the padding necessary for your design.

2) No margin has been given to the columns since they are all floated. If you must add margin, avoid placing it on the side you're floating toward (for example: a right margin on a div set to float right). Many times, padding can be used instead. For divs where this rule must be broken, you should add a "display:inline" declaration to the div's rule to tame a bug where some versions of Internet Explorer double the margin.

3) Since classes can be used multiple times in a document (and an element can also have multiple classes applied), the columns have been assigned class names instead of IDs. For example, two sidebar divs could be stacked if necessary. These can very easily be changed to IDs if that's your preference, as long as you'll only be using them once per document.

4) If you prefer your nav on the right instead of the left, simply float these columns the opposite direction (all right instead of all left) and they'll render in reverse order. There's no need to move the divs around in the HTML source.

*/
.sidebar1 {
float: right;
width: 12.5%;
}
.sidebar2 {
	float: left;
	width: 12.5%;
	padding-top: 90px;
	background-color: #FF9;
	background-color: #cccccc;
	overflow-y: scroll;
	overflow-x: hidden;
	height: 400px;
}
.content {
position: absoulte;
width: 75%;
float: left;
background-image: url(img/gradientHORIZ.png);
}
.results {
visibility: hidden;
display: none;
width: 100%;
float: left;
}
.interests {
width: 100%;
float: left;
height: 100%;
}
.form1 {
background-color: #FFF;
border: thin solid #000;
}
.form3 {
background-color: #FFF;
border: thin solid #000;
}
.column1 {
width: 40%;
float: left;
border: thin solid #D6D6D6;
	background-color: #FFF;
	padding: 1%;
		height: 40%;
	margin-right: 1%;
	margin-bottom: 1%;
	margin-left: 5%;
	overflow-x: hidden;
	overflow-y: scroll;

}
.address {
width: 40%;
float: left;
border: thin solid #D6D6D6;
	background-color: #FFF;
	padding: 1%;
		height: 20%;
	margin-right: 1%;
	margin-bottom: 5%;
	margin-left: 5%;


}
.column2 {
	width: 40%;
	float: right;
	background-color: #FFF;
	padding: 1%;
	border: thin solid #D6D6D6;
	height: 30%;
	margin-right: 5%;
	margin-bottom: 1%;
	margin-left: 1%;
	overflow-x: scroll;
	overflow-y:hidden;
}

.studContact {
	width: 40%;
	float: right;
	background-color: #FFF;
	padding: 1%;
	border: thin solid #D6D6D6;
	height: 30%;
	margin-right: 5%;
	margin-bottom: 5%;
	margin-left: 1%;
	overflow-x: scroll;
	overflow-y:hidden;
}

input.hint {
    color: grey;
}

/* ~~ This grouped selector gives the lists in the .content area space ~~ */
.content ul, .content ol {
padding: 0 15px 15px 40px; /* this padding mirrors the right padding in the headings and paragraph rule above. Padding was placed on the bottom for space between other elements on the lists and on the left to create the indention. These may be adjusted as you wish. */
}
/* ~~ The navigation list styles (can be removed if you choose to use a premade flyout menu like Spry) ~~ */
ul.nav {
list-style: none; /* this removes the list marker */
border-top: 1px solid #666; /* this creates the top border for the links - all others are placed using a bottom border on the LI *//* this creates the space between the navigation on the content below */
}
ul.nav li {
border-bottom: 1px solid #666; /* this creates the button separation */
}
ul.nav a, ul.nav a:visited { /* grouping these selectors makes sure that your links retain their button look even after being visited */
padding: 5px 5px 5px 15px;
display: block; /* this gives the link block properties causing it to fill the whole LI containing it. This causes the entire area to react to a mouse click. */
text-decoration: none;
background: #8090AB;
color: #000;
}
ul.nav a:hover, ul.nav a:active, ul.nav a:focus { /* this changes the background and text color for both mouse and keyboard navigators */
background: #6666aa;
color: #FFF;
}

/********************AGENCY /PROGRAM TOGGLE NAV*************/

ul.nav1 {
	list-style: none; /* this creates the top border for the links - all others are placed using a bottom border on the LI *//* this creates the space between the navigation on the content below */
	background-color: #666;
	border-top-width: 3px;
	border-right-width: 1px;
	border-bottom-width: 3px;
	border-left-width: 1px;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	border-top-color: #000;
	border-right-color: #000;
	border-bottom-color: #000;
	border-left-color: #000;
}
ul.nav1 li {
border-bottom: 1px solid #666; /* this creates the button separation */
}
ul.nav1 a, ul.nav1 a:visited { /* grouping these selectors makes sure that your links retain their button look even after being visited */
padding: 5px 5px 5px 15px;
display: block; /* this gives the link block properties causing it to fill the whole LI containing it. This causes the entire area to react to a mouse click. */
text-decoration: none;
background: #CCCCFF;
color: #FFFFF;
}
ul.nav1 a:hover, ul.nav1 a:active, ul.nav1 a:focus { /* this changes the background and text color for both mouse and keyboard navigators */
background: #6666aa;
color: #FFF;
}


/********************END AGENCY /PROGRAM TOGGLE NAV*************/

/* ~~miscellaneous float/clear classes~~ */
.fltrt { /* this class can be used to float an element right in your page. The floated element must precede the element it should be next to on the page. */
float: right;
margin-left: 8px;
}
.fltlft { /* this class can be used to float an element left in your page. The floated element must precede the element it should be next to on the page. */
float: left;
margin-right: 8px;
}
.clearfloat { /* this class can be placed on a <br /> or empty div as the final element following the last floated div (within the #container) if the overflow:hidden on the .container is removed */
clear:both;
height:0;
font-size: 1px;
line-height: 0px;
}
-->
</style>
<!--[if lte IE 7]>
<style>
.content { margin-right: -1px; } /* this 1px negative margin can be placed on any of the columns in this layout with the same corrective effect. */
ul.nav a { zoom: 1; } /* the zoom property gives IE the hasLayout trigger it needs to correct extra whiltespace between the links */
</style>
<![endif]-->
</head>

<script type="text/javascript" src="js/Navigation.js"></script>


<body onload="init()">
<div class="container" id="content">
<div align="center"></div>
<!-- <div class="header">
<div align="center"><a href="#"><img src="img/giveBannerThin.jpg" alt="giveBanner" name="Insert_logo" width="75%" height="90" id="giveBanner" style="background: #8090AB; display:block;" /></a></div>
</div> -->
<div class="sidebar1">
<div align="center">
<ul class="nav">
<?php if($_SESSION['admin']) { ?>
	<li><a href="Admin.php">Admin</a></li> 
<?php }?>
<li><a href="BrowseAll.php">Browse All</a></li>
<li><a href="php/Session/Logout.php">Logout</a></li>
<form action="javascript:void(0)" onsubmit="javascript:quickSearch()">
<input type="text" class="hint" value="Search..." name="searchBar" id="searchBar"
    onfocus="if (this.className=='hint') { this.className = ''; this.value = ''; }"
    onblur="if (this.value == '') { this.className = 'hint'; this.value = 'Search...'; }">
</form>

</ul>
<!-- end .sidebar1 --></div>
</div>
<div class="sidebar2">
<div align="center">
<ul class="nav1" id="toggleNav">
<li><a href="javascript:toggleLeftSideBarDisplay()" id="toggle" >View Programs</a></li>
</ul>
<ul class="nav" id="leftSideBar">

</ul>
<!-- end .sidebar1 --></div>
</div>
<div class="content" id="content">
<div align="center"><a href="#"><img src=<?php echo "$banner_path"; ?> alt="giveBanner" name="Insert_logo" width="100%" height="90" id="giveBanner" style="background: #8090AB; display:block;" /></a></div>
<div align="right"><a href="helpPage.html" onclick="return popitup('helpPage.html')"><img src="help.png" alt="helpButton" name="helpButton" width="4%" height="4%" style="padding: 1%;"/></a></div>
<div class ="results" id="results">
<div align="left"><a href="javascript:backtosearch()"><img src="back.png" alt="backButton" name="backButton" width="5%" height="5%" style="padding: 2%;"/></a></div>
<p align="center">&nbsp;</p>
<div align="center"></div>
<h1 align="center" id="display_name">Program Name</h1>
<div class="column1"><b>
<p align="center">&nbsp;</p>
<p align="center" id="descript">Description</p></b>
<div align="left">
<p id="display_descript">
</p>

</div>
</div>

<div class="column2"> <b>
<p align="center">&nbsp;</p>
<p align="center">Contact Information</p>
<label>
</label>
</b>
<table width="400" border="0">
  <tr>
    <td>Name: </td>
    <td id="display_p_contact_name"></td>
  </tr>
  <tr>
    <td>Mobile Phone:</td>
    <td id="display_p_contact_m_phone"></td>
  </tr>
  <tr>
    <td>Work Phone: </td>
    <td id="display_p_contact_w_phone"></td>
  </tr>
  <tr>
    <td>Email:</td>
    <td id="display_p_contact_mail"></td>
  </tr>
  <tr>
    <td>Fax Number:</td>
    <td id="display_p_contact_fax"></td>
  </tr>
    <tr>
    <td></td>
    <td></td>
  </tr>
    <tr>
    <td></td>
    <td></td>
  </tr>
</table>
</div>

<div class="studContact"> <b>
<p align="center">&nbsp;</p>
<p align="center">Student Contact Information</p>
<label>
</label>
</b>
<table width="400" border="0">
  <tr>
    <td>Name: </td>
    <td id="display_s_contact_name"></td>
  </tr>
  <tr>
    <td>Mobile Phone:</td>
    <td id="display_s_contact_m_phone"></td>
  </tr>
  <tr>
    <td>Work Phone: </td>
    <td id="display_s_contact_w_phone"></td>
  </tr>
  <tr>
    <td>Email:</td>
    <td id="display_s_contact_mail"></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
  </tr>
    <tr>
    <td></td>
    <td></td>
  </tr>
</table>
</div>

<div class="address"> <b>
<p align="center">&nbsp;</p>
<p align="center" id="display_address">Address</p></b>
<div align="left">
<p id="display_address_street">
<p id="display_address_city">

</p></div>
</div>
</p>
</p>


<div align="center"><h4>Link to Agency / Program(s): </h4><br />
<ul id="link_to_prog_agency">
<li><a href="#" style="color:#00C">Programs Here...</a></li>
</ul>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>

</div>

</div>
<!--********************* BETWEEN CONTENT PAGES ***************************** -->
<div class = "interests" id="interests">
<div align="center">
<h1 align="center">&nbsp;</h1>
<h1 align="center">Select Your Interests</h1>
<form id="form1" name="form1" method="post" action="">
<div align="center">
<table class="form1">
<tr>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests" value="checkbox" id="Alumni" />
    Alumni
  </label>
  </div></td>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests" value="checkbox" id="Elderly" />
    Elderly
    </label>
  </div></td>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests" value="checkbox" id="Male Issues" />
    Male Issues
    </label>
  </div></td>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests" value="checkbox" id="Recreation" />
    Recreation
    </label>
  </div></td>
</tr>
<tr>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests" value="checkbox" id="Animals" />
    Animals
    </label>
  </div></td>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests" value="checkbox" id="Environment" />
    Environment
    </label>
  </div></td>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests" value="checkbox" id="Minority Issues" />
    Minority Issues
    </label>
  </div></td>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests" value="checkbox" id="Religious" />
    Religious
    </label>
  </div></td>
</tr>
<tr>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests" value="checkbox" id="Children" /> 
    Children</div></td>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests" value="checkbox" id="Female Issues" />
    Female Issues
  </label>
  </div></td>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests" value="checkbox" id="Office" />
    Office
    </label>
  </div></td>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests" value="checkbox" id="Service Leaders" />
    Service Leaders
    </label>
  </div></td>
</tr>
<tr>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests" value="checkbox" id="Disabilities" /> 
    Disabilities
  </div></td>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests" value="checkbox" id="Fine Arts" />
    Fine Arts
    </label>
  </div></td>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests" value="checkbox" id="Patriotic" />
    Patriotic
    </label>
  </div></td>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests" value="checkbox" id="Technology" />
    Technology
    </label>
  </div></td>
</tr>
<tr>  
  <td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests" value="checkbox" id="Disasters" />
    Disasters
    </label>
  </div></td>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests" value="checkbox" id="General Service" />
    General Service
    </label>
  </div></td>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests" value="checkbox" id="Poverty" />
    Poverty
    </label>
  </div></td>
<td width="200"></td>
</tr>
<tr>  
  <td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests" value="checkbox" id="Education" />
    Education
    </label>
  </div></td>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests" value="checkbox" id="Health" />
    </label>Health</div></td>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests" value="checkbox" id="PR" />
    PR
    </label>
  </div></td>
<td width="200"></td>
</tr>
</table>
</div>
</form>
<p align="center">&nbsp; </p>
<p align="center">&nbsp;</p>
<div align="center">
<label><b>Select All Hours Available:</b></label>
<form id="form3" name="form3" method="post" action="">
<table width="150" class="form3">
<tr>
<div align="left">

<td><label>
<input type="checkbox" name="Hours" value="checkbox" id="Hours_0" />
Morning</label></td>
</tr>
<tr>
<td><label>
<input type="checkbox" name="Hours" value="checkbox" id="Hours_1" />
Afternoon</label></td>
</tr>
<tr>
<td><label>
<input type="checkbox" name="Hours" value="checkbox" id="Hours_2" />
Evening</label></td>
</tr>
<tr>
<td><label>
<input type="checkbox" name="Hours" value="checkbox" id="Hours_3" />
Night</label></td>
</table>
<p>
</form>
</div>
<button onclick="advancedSearch()">Submit</button>
<button onclick="clearChoices()"> Clear Choices </button>

</div>
</div>



</div>
</div>
<div align="center" class="container"><!-- end .container --></div>
<?php
	GIVEFetchAndEcho($conn);
	$conn->close();
?>
</body>
</html>