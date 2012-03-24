<?php
/*	
 *      nav_queries.php
 * 
 *      functions for aquiring data for navigation
 * 
 * 		$[]	step_1()
 * 		$[]	step_2a($)
 * 		$[]	step_2b($)
 * 		$[]	step_3($)
 */
 ?>
 
 <?php
 /**
  * @return returns list of all agency names
  */ 
function step_1()
{
	$query = "SELECT id,name
				From agency
				ORDER BY name";
				
	$results = mysql_query($query);
	
	return $results;
}
 
 /**
  * @return returns list of all program names that match a specific agency
  * @param $agency_id used to specify which agency to display the programs for
  */ 
function step_2a($agency_id)
{
	$query = "SELECT id,name
				FROM programs
				WHERE program.agency_id = $agency_id
				ORDER BY name";

	$results = mysql_query($query);
	
	return $results;
}

 /**
  * @return returns information for a specific agency, considered the other half of step2
  * @param $agency_id used to specify which agency to display info about
  */
function step_2b($agency_id)
{
	$query = "SELECT *
				FROM agency
				WHERE id = $agency_id
				JOIN addr
				ON
				JOIN p_contact
				ON";
				
	$results = mysql_query($query);			
	
	return $results;
}

 /**
  * @return returns information for a specific program, including address, and contacts
  * @param $program_id used to specify which program to display info about
  */
function step_3($program_id)
{
	$query = "SELECT *
				FROM program
				WHERE id = $program_id
				JOIN addr
				ON
				JOIN s_contact
				ON
				JOIN p_contact
				ON";
				
	$results = mysql_query($query);
	
	return $results;
}
