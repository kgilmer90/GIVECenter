<?php
/*	
 *      translate.php
 * 
 *      functions to translate the database into something both human readable and meaningful
 * 
 * 		$[]translate_season($)
 * 		$[]translate_hours($)
 * 		
 * 		$[] convert_season($)
 * 		$[]convert_time($)
 */

 
  /**
  * @return 
  * @param 
  */
function translate_hours($my_hours)
{
	
	
	//return $output;
}

  /**	Function converts the database version of seasons flags to human readable
  * @return array of seasons selected
  * @param bitflag variable of seasons as referenced in database, spring summer fall winter
  */
function translate_season($my_season)
{
	$seasons['spring'] = 1000;
	$seasons['summer'] = 100;
	$seasons['fall'] = 10;
	$seasons['winter'] = 1;
	
	$output;
	
	if(($my_season - $seasons['spring']) > 0) array_push($output,'spring');
	if(($my_season - $seasons['summer']) > 0) array_push($output,'summer');
	if(($my_season - $seasons['fall']) > 0) array_push($output,'fall');
	if(($my_season - $seasons['winter']) > 0) array_push($output,'winter');
	
	return $output;
}

  /**	Function takes in season flags and returns permutation
  * @return possible purmutations to be checked against
  * @param combined season bitflag value
  */
function convert_season($my_season)
{
	$seasons['spring'] = 1000;
	$seasons['summer'] = 100;
	$seasons['fall'] = 10;
	$seasons['winter'] = 1;
	
	$output;
	
	if(($my_season - $seasons['spring']) > 0)
	{
		array_push($output,'1000');
		array_push($output,'1100');
		array_push($output,'1110');
		array_push($output,'1111');
	}
	
	if(($my_season - $seasons['summer']) > 0)
	{
		array_push($output,'0100');
		array_push($output,'1100');
		array_push($output,'1110');
		array_push($output,'1111');
	}
		
	if(($my_season - $seasons['fall']) > 0)
	{
		array_push($output,'0010');
		array_push($output,'0110');
		array_push($output,'1110');
		array_push($output,'1111');
	}
		
	if(($my_season - $seasons['winter']) > 0)
	{
		array_push($output,'0001');
		array_push($output,'0011');
		array_push($output,'0111');
		array_push($output,'1111');
	}
	
	return $output;
}

  /**
  * @return 
  * @param 
  */
function convert_time()
{}
?>
