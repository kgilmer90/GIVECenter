<?php
include_once('php/GIVE/GIVEToHTML.php');
include_once('sql/queries/queries.php');

//TODO: Fix Admin Page Where Names Are Too Long

session_start();

//if not properly logged in, redirect to login page
if(!isset($_SESSION['username'])) {
	header('Location: LoginPage.php');
}
//if logged in but not as admin, redirect to homepage
else if(!$_SESSION['admin']) {
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
<title>GIVE Center Volunteer Administration</title>
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
ul, ol, dl { /* Zero padding due to browser variations */
	padding: 0;
	margin: 0;
}
h1, h2, h3, h4, h5, h6, p {
	margin-top: 0;	 /* Margins cannot escape from containing divs */
	padding-right: 15px;
	padding-left: 15px; 
}
a img { /* this selector removes the default blue border displayed in some browsers around an image when it is surrounded by a link */
	border: none;
}
/* Do not change order of link styling. */
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
/* ~~ this is the container surrounds all other divs  (content & sidebars) giving them their percentage-based width ~~ */
.container {
	width: 80%;
	max-width: 1260px;/* a max-width may be desirable to keep this layout from getting too wide on a large monitor. This keeps line length more readable. IE6 does not respect this declaration. */
	min-width: 780px;
	margin: 0 auto; /* the auto value on the sides, coupled with the width, centers the layout. It is not needed if you set the .container's width to 100%. */
	overflow: hidden; /* this declaration makes the .container clear all floated columns within it. */
	background-color: #cccccc;
}
/* ~~ These are the columns for the layout. ~~ */

/* This is the "Navigation" sidebar on the right --*/
.sidebar1 {
	float: right;
	width: 12.5%;
	background-color: #FFF;
}

/* This is the Nav of Program/Agency links sidebar on the left  set to hidden to keep shape of website but not display--*/
.sidebar2 {
	visibility:hidden; 
	float: left;
	width: 12.5%;
	padding-top: 90px;
	background-color: #FF9;
	background-color: #cccccc;
}

/* This is the center div with blue gradient background. Change background here. */
.content {
	width: 75%;
	float: left;
	background-image: url(img/gradientHORIZ.png);
	height: 100%;
}
/* div to contain "edit agency" option & list */
.editAgency {
	width: 19%;
	float: left;
	border: thin solid #000;
	height: 250px;
	padding: 3%;
	margin: 3%;
}

/* div to contain "edit program" option & list */
.editProgram {
	width: 19%;
	float: left;
	border: thin solid #000;
	height: 250px;
	padding: 3%;
	margin: 3%;
}

/* div to contain "add new agency or program" option & list */
.addNew {
	width: 19%;
	float: left;
	border: thin solid #000;
	height: 250px;
	padding: 3%;
	margin: 3%;
}

/* div to space out add/edit divs with "OR" */
.orBox {
	float: left;
	width: 3%;
	height: 250px;
	padding-top: 120px;
	padding-bottom: 120px;

}

/* Display hint (search...) in Quick search bar*/
input.hint {
    color: grey;
}
/* ~~ This grouped selector gives the lists in the .content area space ~~ */
.content ul, .content ol {
	padding: 0 15px 15px 40px; /* this padding mirrors the right padding in the headings and paragraph rule above. Padding was placed on the bottom for space between other elements on the lists and on the left to create the indention. These may be adjusted as you wish. */
}
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
.fltrt {  /* this class can be used to float an element right in your page. The floated element must precede the element it should be next to on the page. */
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


<!-- Link to javascript-->
<script type="text/javascript" src="js/Navigation.js"></script>
</head>

<!-- Call onload function to init page-->
<body onload="initAdmin()">

<!-- open container -->

<div class="container" id="content">
  <div align="center"></div>
  
  <!-- Create Nav on right-->

  <div class="sidebar1">
    <div align="center">
      <ul class="nav">
        <li><a href="#">Admin</a></li>
        <li><a href="BrowseAll.php">Browse All</a></li>
        <li><a href="Homepage.php">Homepage</a></li>
        <li><a href="php/Session/Logout.php">Logout</a></li>

		<!-- Quick Search-->

        <li>
          <input type="text" class="hint" value="Search..."
    onfocus="if (this.className=='hint') { this.className = ''; this.value = ''; }"
    onblur="if (this.value == '') { this.className = 'hint'; this.value = 'Search...'; }">
        </li>
      </ul>
      <!-- end .sidebar1 --></div>
  </div>
  
  <!--Create links on left for shape --- They will be hidden. Put nothing in them -->

  <div class="sidebar2">
    <div align="center">
      <ul class="nav">
       
      </ul>
      
      <!-- end .sidebar1 --></div>
  </div>
  
  <!-- Center "website-->
  <div class="content" id="content"> 
    <!-- Make space for & call to Banner-->
    <div align="center"><a href="#"><img src=<?php echo "$banner_path"; ?> alt="giveBanner" name="Insert_logo" width="100%" height="90" id="giveBanner" style="background: #8090AB; display:block;" /></a></div>
    <div align="center"><b>Change Banner:  </b>    <p><font size="2" color="red">*Banner height should be 90px</font></p>

<form method='post' action='sql/update/update_banner.php' enctype='multipart/form-data'>
        Select Image to Upload: <input type='file' name='banner' size='10' />
        <input type='submit' value='Upload' />
    </form>
    <a href="DisplayBanners.php">Choose Previous Banner</a>
    <h1 align="center">&nbsp;</h1>
    <h1 align="center">ADMINISTRATION</h1>
<div align="center">

  	<!-- edit agency box-->
	<div class="editAgency" id="editAgency">
    <div align="center">Select Agency to Edit
        <p align="center">&nbsp;</p>
        
  	<!-- drop down javascript will populate-->
    <select id="agencyDropdown">
    </select>
    	<p align="center">&nbsp;</p>
    	<p align="center">&nbsp;</p>

     <button onclick="editAgency()">Submit</button></div>

    </div>
    
    <div class="orBox" id="orBox">
    <div align="center">OR</div>
    </div>
    
    <!-- edit program box-->
    <div class="editProgram" id="editProgram">
    <div align="center">Select Program to Edit
    	<p align="center">&nbsp;</p>

    <select id="programDropdown">
    </select>
        	<p align="center">&nbsp;</p>
    	<p align="center">&nbsp;</p>

    <button onclick ="editProgram()">Submit</button></div>
    </div>
    
    <!--  Creats "OR" spacing -->
    <div class="orBox" id="orBox">
    <div align="center">OR</div>
    </div>
    
    
    <!-- Add new box with buttons for agency & programs-->
    <div class="addNew" id="addNew">
    <div align="center">Select
    	<p align="center">&nbsp;</p>
    	<p align="center">&nbsp;</p>

	<button onclick="addAgency()">Add New Agency</button>
    <p align="center">&nbsp;</p>

    <button onclick="addProgram()">Add New Program</button></div>
    </div>
  </div>
  <div align="center" class="container"><!-- end .container --></div>
</div>
</div>
<?php
	GIVEFetchAndEcho($conn);
	$conn->close();
?>
</body>
</html>
