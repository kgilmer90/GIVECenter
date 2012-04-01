<?php

include_once('GIVEAddr.php');
include_once('GIVEAgency.php');
include_once('GIVEProContact.php');
include_once('GIVEStudentContact.php');

class GIVEProgram
{
	public $id;										//INT
	public $referal;								//BOOL
	public $season;									//BINARY(4)
	public $times;									//BINARY(24)
	public $name, $descript, $duration, $notes;		//STRING
	public $issues;									//STRING array
	public $addr;									//GIVEAddr
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
		$this->p_contact = $args['p_contact'];
		$this->s_contact = $args['s_contact'];
	}
	
	public function __toString()
	{
		$str = "{$this->id}, {$this->referal}, {$this->season}, {$this->times}, ".
		"{$this->name}, {$this->descript}, {$this->duration}, {$this->notes}, ";
		
		foreach($issues as $val) {
			$str .= "$val, ";
		}
		
		$str .= "{$this->addr}, {$this->p_contact}, {$this->s_contact}";
	}
	public function toHTMLString()
	{
		$str = /*__CLASS__.", */"{$this->id}, {$this->referal}, \"{$this->season}\", \"{$this->times}\", ".
		"\"{$this->name}\", \"{$this->descript}\", \"{$this->duration}\", \"{$this->notes}\", ";
		
		foreach($issues as $val) {
			$str .= "\"$val\", ";
		}
		
		$str .= "{$this->addr->toHTMLString()}, ";
		$str .= "{$this->p_contact->toHTMLString()}, {$this->s_contact->toHTMLString()}";
	}
}

?>