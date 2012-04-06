<?php

include_once('GIVEProgram.php');

class GIVEContactHistory
{
	public $id;				//INT
	public $contact;		//GIVEStudentContact
	public $program;		//GIVEProgram
	
	public function __construct($args)
	{
		$this->id = $args['id'];
		$this->contact = $args['contact'];
		$this->program = $args['program'];
	}
}

?>