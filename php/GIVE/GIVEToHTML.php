<?php 
include_once('GIVEAddr.php');
include_once('GIVEAgency.php')
include_once('GIVEContactHistory.php');
include_once('GIVEPath.php');
include_once('GIVEProContact.php');
include_once('GIVEProgram.php');
include_once('GIVEStudentContact.php');

function GIVEAgenciesToHTMLTable($agencies, $id, $hidden = true, $display = 'none')
{
	$visibility = ($hidden) ? 'hidden' : 'visible';
	echo '<table id='.$id.' style="visibility='.$visibility.';display='.$display.';"';
	
	foreach($agencies as $agency) {
		echo $agency->toHTMLTable('agency'.$agency->id);
	}
	echo '</table>';
}

?>