<?php
/*	
 *      search_queries.php
 * 
 *      functions for returning names for searching:
 * 
 * 		$[]	quick_search($)
 * 		$[]	advanced_search1($[])
 * 		$[]	advanced_search2($[])
 * 
 *      TODO: CONVERT SEARCH TO JS
 */
 ?>


<?php
/**
 * Function Handles the Simple Search
 * @param	Parameter is the name of a program or agency to search for, and will also accept a regex
 * @return	Returns the names of the matches from the query
 */
function quick_search($find_me)
{
	$agency_query = "SELECT name FROM agency";
	$program_query = "SELECT name FROM program";

	$agencies = mysql_query($agency_query);
	$programs = mysql_query($program_query);

	$match_a;
	$match_b;

//	Search through agency names for matches
	foreach($agencies as $temp)
	{
		if(preg_match($find_me,$temp)){
		array_push($match_a,$temp);}
	}

//	Search through program names for matches
	foreach($programs as $temp)
	{
		if(preg_match($find_me,$temp))
		{
			array_push($match_p,$temp);
		}
	}

//	Concat the Two Arrays of matches into one, and return it
	//$matches = array('agency' => $match_a, 'program' => $match_p);
	$matches = array_merge($match_a, $match_p);
	return $matches;
}

/**
 * Function Handles the Advanced Search, though it requires the formatting of information before use
 * @param	Parameter is the post array, which contains parameters of advanced search interface
 * @return	Returns the names of the matches from the query
 */
function advanced_search1(&$post)
{
	$query =  "SELECT name
				FROM programs
				WHERE ";
	
//	iterate through variables, adding the ones that are set
	foreach($post as $key => $value)
	{
		$query .= $key."=".$value.",";
	}
//	remove last comma
	substr($string,0,-1);
	
//	query database and list results, then return	
	$program_matches = mysql_query($query);
	
	return $program_matches;
}

function advanced_search2(&$post)
{
	$query =  "SELECT name
				FROM programs
				WHERE ";
	
	if (isset($post['referal']))
	{
		$query .= "referal=$post[referal],";
	}
	
	if (isset($post['issue']))
	{
		$query .= "(issue1 or issue2 or issue3) = $post[issue],";
	}
	
	if (isset($post['duration']))
	{
		$query .= "duration BETWEEN 0 AND $post[duration],";
	}
	
	if (isset($post['times']))
	{
//		$query .= "= $,";
	}
	
	if (isset($post['season']))
	{
		$season_array = convert_season($post['season']);
		$season="(";
		
		foreach($season_array as $temp)
		{
			$season .= $temp." OR ";
		}
		//	remove last or
		substr($string,0,-4);
		$season.="),";
	}
	
//	remove last comma
	substr($string,0,-1);
	
//	query database and list results, then return	
	$program_matches = mysql_query($query);
	
	return $program_matches;
}

/*
	CREATE TABLE program(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	agency INT UNSIGNED NOT NULL,
	addr INT;
	name VARCHAR(20),
	p_contact
	s_contact
	descript VARCHAR(400),
	referal BOOL,
	season BINARY(4),
	times BINARY(24),
	issue1 INT UNSIGNED,
	issue2 INT UNSIGNED,
	issue3 INT UNSIGNED,
	duration INT UNSIGNED,
	notes VARCHAR(400)) ENGINE INNODB;
	*/
?>
