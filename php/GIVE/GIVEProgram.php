<?php

class GIVEProgram
{
	public $id;										//INT
	public $referal;								//BOOL
	public $season;									//BINARY(4)
	public $times;									//BINARY(24)
	public $name, $descript, $duration, $notes;		//STRING
	public $issues;									//STRING array
	public $addr;									//GIVEAddr
	public $agency;									//GIVEAgency
	public $p_contact;								//GIVEProContact
	public $s_contact;								//GIVEStudentContact
	
	public function __construct($args)
	{
		$this->id = $args['id'];
		$this->referal = $args['referal'];
		$this->season = $args['season'];
		$this->times = $args['times'];
		$this->descript = $args['name'];
		$this->duration = $args['duration'];
		$this->notes = $args['notes'];
		$this->issues = $args['issues'];
		$this->addr = $args['addr'];
		$this->agency = $args['agency'];
		$this->s_contact = $args['p_contact'];
	}
}

?>