<?php 
include_once('GIVEAddr.php');
include_once('GIVEAgency.php')
include_once('GIVEContactHistory.php');
include_once('GIVEPath.php');
include_once('GIVEProContact.php');
include_once('GIVEProgram.php');
include_once('GIVEStudentContact.php');

function GIVEAgenciesToHTMLTable($agencies, $hidden = true, $display = 'none')
{
	$visibility = ($hidden) ? 'hidden' : 'visible';
	echo '<table id="agency_table" style="visibility='.$visibility.';display='.$display.';"';
	
	var $i = 1;
	foreach($agencies as $agency) {
		echo $agency->toHTMLTable('agency'.$i);
		$i++;
	}
	echo '</table>';
}

?>