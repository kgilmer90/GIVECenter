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
		
		$str .= '<tr>'.PHP_EOL;
		$str .= '<td title="id">'.PHP_EOL;
		$str .= $this->id.PHP_EOL;
		$str .= '</td>'.PHP_EOL;
		$str .= '</tr>'.PHP_EOL;
		
		$str .= '<tr>'.PHP_EOL;
		$str .= '<td title="name">'.PHP_EOL;
		$str .= $this->name.PHP_EOL;
		$str .= '</td>'.PHP_EOL;
		$str .= '</tr>'.PHP_EOL;
		
		$str .= '<tr>'.PHP_EOL;
		$str .= '<td title="descript">'.PHP_EOL;
		$str .= $this->descript.PHP_EOL;
		$str .= '</td>'.PHP_EOL;
		$str .= '</tr>'.PHP_EOL;
	
		$str .= '<tr>'.PHP_EOL;
		$str .= '<td title="mail">'.PHP_EOL;
		$str .= $this->mail.PHP_EOL;
		$str .= '</td>'.PHP_EOL;
		$str .= '</tr>'.PHP_EOL;
		
		$str .= '<tr>'.PHP_EOL;
		$str .= '<td title="phone">'.PHP_EOL;
		$str .= $this->phone.PHP_EOL;
		$str .= '</td>'.PHP_EOL;
		$str .= '</tr>'.PHP_EOL;

		$str .= '<tr>'.PHP_EOL;
		$str .= '<td title="fax">'.PHP_EOL;
		$str .= $this->fax.PHP_EOL;
		$str .= '</td>'.PHP_EOL;
		$str .= '</tr>'.PHP_EOL;
		
		$str .= '<tr>'.PHP_EOL;
		$str .= '<td title="p_contact>'.PHP_EOL;
		$str .= $this->p_contact->toHTMLTable($id.'_p_contact');
		$str .= '</td>'.PHP_EOL;
		$str .= '</tr>'.PHP_EOL;
		
		$str .= '<tr>'.PHP_EOL;
		$str .= '<td title="addr">'.PHP_EOL;
		$str .= $this->addr->toHTMLTable($id.'_addr');
		$str .= '</td>'.PHP_EOL;
		$str .= '</tr>'.PHP_EOL;
		
		$i = 0;
		foreach($this->programs as $program) {
			$str .= '<tr>'.PHP_EOL;
			$str .= "<td title=\"program$i\">".PHP_EOL;
			$str .= $program->toHTMLTable("program$i").PHP_EOL;
			$str .= '</td>'.PHP_EOL;
			$str .= '</tr>'.PHP_EOL;
			$i++;
		}
		
		$str .= '</table>';
		return $str;
	}
}

?>