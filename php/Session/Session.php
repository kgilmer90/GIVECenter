<?php
session_start();

include_once('../GIVE/GIVEToHTML.php');


//by default, restrict queries
$restrict_queries = true;

if(isset($_SESSION['username'])) {
	
	//queries are unrestricted only if $_SESSION['username'] == 'admin'
	if($_SESSION['username'] == 'admin') {
		$restrict_queries = false;
	}
}

$all_agencies;
if($restrict_queries) {
	//$all_agencies = some_function_to_obtain_restricted_data();
}
else {
	//$all_agencies = some_function_to_obtain_unrestricted_data();
}

//echo the agency data to the page as a hidden table
GIVEAgenciesToHTMLTable($all_agencies);

?>