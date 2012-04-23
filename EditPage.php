<?php
include_once('php/GIVE/GIVEToHTML.php');
include_once('sql/queries/queries.php');

session_start();

//if not properly logged in, redirect to login page
if(!isset($_SESSION['admin'])) {
	header('Location: Homepage.php');
}
if(!$_SESSION['admin']) {
	header('Location: Homepage.php');
}

$conn;
$banner_path = "img/giveBannerThin.jpg";
try
{
	$conn = new MySQLDatabaseConn($GIVE_MYSQL_SERVER, $GIVE_MYSQL_DATABASE, $GIVE_MYSQL_UNAME, $GIVE_MYSQL_PASS);
	$banner_path = get_banner_latest($conn);
}
catch(MySQLDatabaseConnException $e)
{
	header('Location: LoginPage.php?except=conn&code='.$e->code());
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
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
background-color: #FFF;
}
.sidebar2 {
visibility: hidden;
float: left;
width: 12.5%;
padding-top: 90px;
/* padding-left: 10px
padding-right: 10px; */
background-color: #FF9;
background-color: #cccccc;
}
.content {
position: absoulte;
width: 75%;
float: left;
background-image: url(img/gradientHORIZ.png);
height: 100%;
}
.results {
width: 100%;
float: left;
height: 100%;
}
.interests {
visibility: hidden;
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
width: 45%;
float: left;
border-right-width: thin;
border-right-style: solid;
border-right-color: #000;
padding: 2%;
}
.column2 {
width: 45%;
float: right;
padding: 2%;
}
.getData{
	width:100%;
	height: 50%;
	border-bottom-width: thin;
	border-bottom-style: none;
	border-bottom-color: #000;
}
.getInterests
{
	width: 100%;
	height: 50%;
}
input.hint
{
	color:grey;
}
.topRow
{
	width:100%;	
}

.textBox
{
overflow-y: hidden;
overflow-x:hidden;	
}

.layer
{
	width:50%;
}

.column3 {
width: 45%;
float: left;
padding: 2%;
}
.column4 {
width: 45%;
float: right;
padding: 2%;
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

<body>
<div class="container" id="content">
<div align="center"></div>
<div class="sidebar1">
<div align="center">
<ul class="nav">
<li><a href="Admin.php">Admin</a></li>
<li><a href="BrowseAll.php">Browse All</a></li>
<li><a href="php/Session/Logout.php">Logout</a></li>
<input type="text" class="hint" value="Search..."
    onfocus="if (this.className=='hint') { this.className = ''; this.value = ''; }"
    onblur="if (this.value == '') { this.className = 'hint'; this.value = 'Search...'; }">
</ul>
<!-- end .sidebar1 --></div>
</div>
<div class="sidebar2">
<div align="center">
<ul class="nav">
<li><a href="#">Program1 </a></li>
<li><a href="#">Program2 </a></li>
<li><a href="#">Program3 </a></li>
<li><a href="#">Program4 </a></li>
<li><a href="#">Program5 </a></li>
<li><a href="#">Program6 </a></li>
<li><a href="#">Program7 </a></li>
<li><a href="#">Program8 </a></li>
<li><a href="#">...</a></li>
</ul>
<!-- end .sidebar1 --></div>
</div>
<div class="content" id="content">
<div align="center"><a href="#"><img src=<?php echo "$banner_path"; ?> alt="giveBanner" name="Insert_logo" width="100%" height="90" id="giveBanner" style="background: #8090AB; display:block;" /></a></div>
<div class ="results" id="results">
<div align="left"><a href="Admin.php"><img src="back.png" alt="backButton" name="backButton" width="5%" height="5%" style="padding: 2%;"/></a></div>
<div align="center"></div>
<h1 id="editHeader" align="center">jjj</h1>
<div class="topRow">
<div class="column1">
<label>
<p align="center">&nbsp;</p>
<table width="400" border="0">
  <caption>
  </caption>
  <tr>
    <td>Name</td>
    <td><input name="name" id="name" type="text" size="30" maxlength="30" /></td>
  </tr>
    <tr>
    <td id="agencyDescrip">Select Agency:</td>
    <td id="agencyOpt">    
    <select>
    	<option>Agency1</option>
    	<option>Agency2</option>
        <option>Agency3</option>
    	<option>Agency4</option>
        <option>Agency5</option>
    	<option>Agency6</option>
    </select>
    </td>
  </tr>
  <tr>
    <td>Description: </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><div class="textBox"><textarea name="descript" cols="25" rows="16" id="descript"></textarea></div></td>
  </tr>
    <tr>
    <td>Notes: </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><div class="textBox"><textarea name="notes" cols="25" rows="16" id="notes"></textarea></div></td>
  </tr>
</table></label>

<p align="center">&nbsp;</p>
<div align="center"><strong>Referral Type:</strong>
<form id="form2" name="form2" method="post" action="">
  <table width="100">
    <tr>
      <td><label>
        <input type="radio" name="ref_type" value="full" id="ref_type_full" />
        Full</label></td>
    </tr>
    <tr>
      <td><label>
        <input type="radio" name="ref_type" value="lim" id="ref_type_lim" />
        Limited</label></td>
    </tr>
  </table>
</form></div>
<p align="center">&nbsp;</p>



</div>
<div class="column2"> <b>
<label>
<p align="center">&nbsp;</p>
<p align="center">Professional Contact Information</p>
</label>
</b>
<table width="400" border="0">
  <tr>
    <td>Title: </td>
    <td><input name="title" id="title" type="text" size="30" /></td>
  </tr>
  <tr>
    <td>First Name: </td>
    <td><input name="f_name" id="f_name" type="text" size="30" /></td>
  </tr>
  <tr>
    <td>Last Name:</td>
    <td><input name="l_name" id= "l_name" type="text" size="30" /></td>
  </tr>
  <tr>
    <td>Middle Name:</td>
    <td><input name="m_name" id="m_name" type="text" size="30" /></td>
  </tr>
  <tr>
    <td>Suffix: </td>
    <td><input name="suf" id="suf" type="text" size="3" /></td>
  </tr>
  <tr>
    <td>Mobile Phone:</td>
    <td><input name="m_phone" id="m_phone" type="text" size="10" /></td>
  </tr>
  <tr>
    <td>Work Phone: </td>
    <td><input name="w_phone" id="w_phone" type="text" size="10" /></td>
  </tr>
  <tr>
    <td>Email:</td>
    <td><input name="mail" type="text" id="mail" size="30" maxlength="40" /></td>
  </tr>
  <tr>
    <td>Fax Number:</td>
    <td><input name="fax" id="fax" type="text" size="10" /></td>
  </tr>
</table>


<label>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<b>
<p align="center">Student Contact Information</p>
</label>
</b>
<table width="400" border="0">
  <tr>
    <td>First Name: </td>
    <td><input name="s_f_name" id="s_f_name" type="text" size="30" /></td>
  </tr>
  <tr>
    <td>Last Name:</td>
    <td><input name="s_l_name" id= "s_l_name" type="text" size="30" /></td>
  </tr>
  <tr>
    <td>Middle Name:</td>
    <td><input name="s_m_name" id="s_m_name" type="text" size="30" /></td>
  </tr>
  <tr>
    <td>Suffix: </td>
    <td><input name="s_suf" id="s_suf" type="text" size="3" /></td>
  </tr>
  <tr>
    <td>Mobile Phone:</td>
    <td><input name="s_m_phone" id="s_m_phone" type="text" size="10" /></td>
  </tr>
  <tr>
    <td>Work Phone: </td>
    <td><input name="s_w_phone" id="s_w_phone" type="text" size="10" /></td>
  </tr>
  <tr>
    <td>Email:</td>
    <td><input name="s_mail" type="text" id="s_mail" size="30" maxlength="40" /></td>
  </tr>
</table>

<label>
<table width="400" border="0">
<p align="center">&nbsp;</p>
<p align="center"><b>Address</b></p>

    <tr>
    <td>Street: </td>
    <td><input name="street" type="text" id="street" size="30" maxlength="50" /></td>
  </tr>
  <tr>
    <td>City:</td>
    <td><input name="city" id= "city" type="text" size="30" /></td>
  </tr>
  <tr>
    <td>State:</td>
    <td><input name="state_us" id="state_us" type="text" size="30" /></td>
  </tr>
  <tr>
    <td>Zip:</td>
    <td><input name="zip" id="zip" type="text" size="5" /></td>
  </tr>
</table>
</label>

<p align="center">&nbsp; </p>
<p align="center">&nbsp;</p></div></div></div>
<div class="getInterests">
	<h1 align="center">&nbsp;</h1>
    <div align="center">
<label><b>Select Up to 3 Interests Associated:</b></label>
<form id="form1" name="form1" method="post" action="">
<table class="form1">
<tr>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests[]" value="Alumni" id="Alumni" />
    Alumni
  </label>
  </div></td>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests[]" value="Elderly" id="Elderly" />
    Elderly
    </label>
  </div></td>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests[]" value="Male Issues" id="Male Issues" />
    Male Issues
    </label>
  </div></td>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests[]" value="Recreation" id="Recreation" />
    Recreation
    </label>
  </div></td>
</tr>
<tr>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests[]" value="Animals" id="Animals" />
    Animals
    </label>
  </div></td>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests[]" value="Environment" id="Environment" />
    Environment
    </label>
  </div></td>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests[]" value="Minority Issues" id="Minority Issues" />
    Minority Issues
    </label>
  </div></td>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests[]" value="Religious" id="Religious" />
    Religious
    </label>
  </div></td>
</tr>
<tr>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests[]" value="Children" id="Children" /> 
    Children</div></td>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests[]" value="Female Issues" id="Female Issues" />
    Female Issues
  </label>
  </div></td>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests[]" value="Office" id="Office" />
    Office
    </label>
  </div></td>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests[]" value="Service Leaders" id="Service Leaders" />
    Service Leaders
    </label>
  </div></td>
</tr>
<tr>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests[]" value="Disabilities" id="Disabilities" /> 
    Disabilities
  </div></td>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests[]" value="Fine Arts" id="Fine Arts" />
    Fine Arts
    </label>
  </div></td>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests[]" value="Patriotic" id="Patriotic" />
    Patriotic
    </label>
  </div></td>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests[]" value="Technology" id="Technology" />
    Technology
    </label>
  </div></td>
</tr>
<tr>  
  <td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests[]" value="Disasters" id="Disasters" />
    Disasters
    </label>
  </div></td>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests[]" value="General Service" id="General Service" />
    General Service
    </label>
  </div></td>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests[]" value="Poverty" id="Poverty" />
    Poverty
    </label>
  </div></td>
<td width="200"></td>
</tr>
<tr>  
  <td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests[]" value="Education" id="Education" />
    Education
    </label>
  </div></td>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests[]" value="Health" id="Health" />
    </label>Health</div></td>
<td width="200"><label>
  <div align="left">
    <input type="checkbox" name="selectInterests[]" value="PR" id="PR" />
    PR
    </label>
  </div></td>
<td width="200"></td>
</tr>
</table>
</form>
<div class ="layers">
<p align="center">&nbsp; </p>
<p align="center">&nbsp;</p>
<div class = "column3">
<div align="center">
<label><b>Select All Hours Available:</b></label>
<form id="form3" name="form3" method="post" action="">
<table width="150" class="form3">
<tr>
<td><label>
<input type="checkbox" name="Hours" value="checkbox" id="morning" />
Morning</label></td>
</tr>
<tr>
<td><label>
<input type="checkbox" name="Hours" value="checkbox" id="afternoon" />
Afternoon</label></td>
</tr>
<tr>
<td><label>
<input type="checkbox" name="Hours" value="checkbox" id="evening" />
Evening</label></td>
</tr>
<tr>
<td><label>
<input type="checkbox" name="Hours" value="checkbox" id="night" />
Night</label></td>
</tr>
</table>
</form></div></div></div>
  <div class = "column4">
<label><b>Select All Hours Available:</b></label>
<form id="form5" name="form3" method="post" action="">
<table width="150" class="form3">
      <tr>
        <td><div align="left">
          <div align="left">
            <input type="checkbox" name="winter" value="checkbox" id="winter" />
            Winter</div></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="spring" value="checkbox" id="spring" />
          Spring</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="summer" value="checkbox" id="summer" />
          Summer</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="fall" value="checkbox" id="fall" />
          Fall</label></td>
      </tr>
    </table>

</form></div>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<div align="center">
  <input type="submit" value="Save Changes" />
  <br />
<input type="button" value="Delete Program / Agency" style="background-color:#FF0000; color:#FFFFFF;" onclick="alert('Are you sure you want to permanently DELETE this program/agency?')"></div>

</div>
</p>
</p>
</div>
</div>
</div>
<div align="center" class="container"><!-- end .container --></div>
</body>
</html>