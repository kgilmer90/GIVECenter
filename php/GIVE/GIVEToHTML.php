<?php 
include_once('GIVEAddr.php');
include_once('GIVEAgency.php');
include_once('GIVEContactHistory.php');
include_once('GIVEPath.php');
include_once('GIVEProContact.php');
include_once('GIVEProgram.php');
include_once('GIVEStudentContact.php');

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
	echo '<table id="agency_table" style="visibility='.$visibility.';display='.$display.';"';
	
	$i = 1;
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