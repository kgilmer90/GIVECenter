<?php

include_once('GIVEAddr.php');
include_once('GIVEProContact.php');
include_once('GIVEProgram.php');
include_once('GIVEToHTML.php');

class GIVEAgency
{
	public $id;						//INT
	public $name, $descript;		//STRING
	public $mail, $phone, $fax;		//STRING
	public $p_contact;				//GIVEProContact
	public $addr;					//GIVEAddr
	public $programs;				//GIVEProgram array
	
	public function __construct($args = array())
	{
		$this->id = isset($args['id']) ? $args['id'] : '';
		$this->name = isset($args['name']) ? $args['name'] : '';
		$this->descript = isset($args['descript']) ? $args['descript'] : '';
		$this->mail = isset($args['mail']) ? $args['mail'] : '';
		$this->phone = isset($args['phone']) ? $args['phone'] : '';
		$this->fax = isset($args['fax']) ? $args['fax'] : '';
		$this->p_contact = isset($args['p_contact']) ? $args['p_contact'] : new GIVEProContact();
		$this->addr = isset($args['addr']) ? $args['addr'] : new GIVEAddr();
		$this->programs = isset($args['programs']) ? $args['programs'] : array(0 => new GIVEProgram());
	}
	public function toHTMLTable($id)
	{	
		$str = "<table id=\"$id\">".PHP_EOL;
		
		$str .= GIVEWrapDataWithTrTd($this->id, 'id');
		$str .= GIVEWrapDataWithTrTd($this->name, 'name');
		$str .= GIVEWrapDataWithTrTd($this->descript, 'descript');
		$str .= GIVEWrapDataWithTrTd($this->mail, 'mail');
		$str .= GIVEWrapDataWithTrTd($this->phone, 'phone');
		$str .= GIVEWrapDataWithTrTd($this->fax, 'fax');
		$str .= GIVEWrapDataWithTrTd($this->p_contact->toHTMLTable($id.'_p_contact'), 'p_contact');
		$str .= GIVEWrapDataWithTrTd($this->addr->toHTMLTable($id.'_addr'), 'addr');
		
		$i = 0;
		foreach($this->programs as $program) {
			$str .= GIVEWrapDataWithTrTd($program->toHTMLTable("program$i"), "program$i");
			$i++;
		}
		
		$str .= '</table>';
		return $str;
	}
}

?>