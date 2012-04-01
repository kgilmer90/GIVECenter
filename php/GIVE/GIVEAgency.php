<?php

include_once('GIVEAddr.php');
include_once('GIVEProContact.php');

class GIVEAgency
{
	public $id;						//INT
	public $name, $descript;		//STRING
	public $mail, $phone, $fax;		//STRING
	public $p_contact;				//GIVEProContact
	public $addr;					//GIVEAddr
	
	public function __construct($args)
	{
		$this->id = $args['id'];
		$this->name = $args['name'];
		$this->descript = $args['descript'];
		$this->mail = $args['mail'];
		$this->phone = $args['phone'];
		$this->fax = $args['fax'];
		$this->p_contact = $args['p_contact'];
		$this->addr = $args['addr'];
	}
	
	public function __toString()
	{
		return "{$this->id}, {$this->name}, {$this->descript}, {$this->mail}, {$this->phone}, ".
		"{$this->fax}, {$this->p_contact}, {$this->addr}";
	}
	
	public function toHTMLString()
	{
		return /*__CLASS__.", */"{$this->id}, \"{$this->name}\", \"{$this->descript}\", \"{$this->mail}\", ".
		"\"{$this->phone}\", \"{$this->fax}\", {$this->p_contact->toHTMLString()}, ".
		"{$this->addr->toHTMLString()}";
	}
}

?>