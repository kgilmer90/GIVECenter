<?php

include_once('GIVEAddr.php');
include_once('GIVEProContact.php');
include_once('GIVEToHTML.php');

class GIVEAgency
{
	public $id;						//INT
	public $name, $descript;		//STRING
	public $mail, $phone, $fax;		//STRING
	public $p_contact;				//GIVEProContact
	public $addr;					//GIVEAddr
	public $programs;				//GIVEProgram array
	
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
		$this->programs = $args['programs'];
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