<?php
// #4

function simple_search($find_me)
{
	$agency_query = "SELECT name FROM agency";
	$program_query = "SELECT name FROM program";

	$agencies = mysql_query($agency_query);
	$programs = mysql_query($program_query);

	$match_a;
	$match_b;

	foreach($agencies as $temp)
	{
		if(preg_match($find_me,$temp){
			array_push($match_a,$temp);}
	}

	foreach($programs as $temp)
	{
		if(preg_match($find_me,$temp){
			array_push($match_p,$temp);}
	}
	
	$matches = array('agency' => $match_a, 'program' => $match_p);
	return $matches;
}
?>

<?php
// #5

function advanced_search(&$post)
{
}
