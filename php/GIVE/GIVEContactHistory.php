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
	
	public function __toString()
	{
		return "{$this->id}, {$this->contact}, {$this->program}";
	}
	public function toHTMLString()
	{
		return __CLASS__.", {$this->id}, {$this->contact->toHTMLString()}, {$this->program->toHTMLString()}";
	}
}

?>