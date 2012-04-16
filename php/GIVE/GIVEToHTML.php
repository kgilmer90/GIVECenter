<?php 
include_once(dirname(__FILE__).'/GIVEAddr.php');
include_once(dirname(__FILE__).'/GIVEAgency.php');
include_once(dirname(__FILE__).'/GIVEContactHistory.php');
include_once(dirname(__FILE__).'/GIVEProContact.php');
include_once(dirname(__FILE__).'/GIVEProgram.php');
include_once(dirname(__FILE__).'/GIVEStudentContact.php');
include_once(dirname(__FILE__).'/../ini/GIVECenterIni.php');
include_once(dirname(__FILE__).'/../MySQLDatabase/MySQLDatabaseConn.php');
include_once(dirname(__FILE__).'/../../sql/object_creator/create_agencies.php');

/**
 * Fetches all necessary data from the database and echoes
 * it to the document in the form of a hidden HTML table.
 * Serves as a one-stop-shop function for getting data
 * from the server to the client.
 * @param string $urlRedirectOnError - url to redirect the
 * user to in the event of an error connecting to the database
 */
function GIVEFetchAndEcho($conn)
{
	//$_SESSSION['admin'] is true if logged in as admin, false otherwise
	//passing true to create_agencies() returns all available data
	//false returns data sanitized of sensitive personal information
	$all_agencies = create_agencies($conn, $_SESSION['admin']);
	
	//echo the agency data to the page as a hidden table
	GIVEAgenciesToHTMLTable($all_agencies);
}
/**
 * Prints an array of GIVEAgencies to a document in the form
 * of an HTML table -- the table is hidden and not displayed by default,
 * though this behavior can be overridden by passing arguments to
 * the $hidden and $display parameters.
 * @param GIVEAgency array $agencies - array of GIVEAgency objects to echo to the page
 * @param boolean $hidden - true if table should be hidden, false otherwise, defaults to true
 * @param string $display - HTML style display property
 */
function GIVEAgenciesToHTMLTable($agencies, $hidden = true, $display = 'none')
{
	$visibility = ($hidden) ? 'hidden' : 'visible';
	echo '<table id="agency_table" style="visibility:'.$visibility.';display:'.$display.';"';
	
	$i = 0;
	foreach($agencies as $agency) {
		
		echo GIVEWrapDataWithTrTd($agency->toHTMLTable('agency'.$i));
		$i++;
	}
	echo '</table>';
}

/**
 * 
 * Enter description here ...
 * @param unknown_type $data
 * @param unknown_type $title
 * @param unknown_type $newlines
 */
function GIVEWrapDataWithTrTd($data, $title = false, $newlines = true) {
	
	$str;
	if($newlines) {
		
		$str = '<tr>'.PHP_EOL;
		if($title) {
			$str .= "<td title=\"$title\">$data</td>".PHP_EOL;	
		}
		else {
			$str .= "<td>$data</td>".PHP_EOL;
		}
		$str .= '</tr>'.PHP_EOL;
	}
	else {
		
		$str = '<tr>';
		if($title) {
			$str .= "<td title=\"$title\">$data</td>";	
		}
		else {
			$str .= "<td>$data</td>";
		}
		$str .= '</tr>'.PHP_EOL;
	}
	return $str;
}

?>