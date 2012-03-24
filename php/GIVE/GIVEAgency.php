<?php

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
		
	}
}

?>