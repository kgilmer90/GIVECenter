<?php

class GIVEContactHistory
{
	public $id;				//INT
	public $contact;		//INT
	public $program;		//GIVEProgram
	
	public function __construct($args)
	{
		$this->id = $args['id'];
		$this->contact = $args['contact'];
		$this->program = $args['program'];
	}
}

?>