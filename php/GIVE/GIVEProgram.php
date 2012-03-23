<?php

class GIVEProgram
{
	public $id;										//INT
	public $referal, $season, $times, $issues;		//BINARY
	public $name, $descript, $duration, $notes;		//STRING
	public $addr;									//GIVEAddr
	public $agency;									//GIVEAgency
	public $p_contact;								//GIVEProContact
	public $s_contact;								//GIVEStudentContact
	
	
	public function __construct()
	{
		
	}
}

?>