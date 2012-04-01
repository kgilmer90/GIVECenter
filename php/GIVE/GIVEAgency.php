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
	public function toHTMLTable($id, $hidden = true, $display = 'none')
	{
		$visibility = ($hidden) ? 'hidden' : 'visible';
		$display = ($hidden) ? 'none' : 'block';
		
		$str = "<table id=\"$id\" style=\"visibility=$visibility;display=$display;\">".PHP_EOL;
		
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
		$str .= $this->p_contact->toHTMLTable($id.'_p_contact', $hidden, $display);
		$str .= '</td>'.PHP_EOL;
		$str .= '</tr>'.PHP_EOL;
		
		$str .= '<tr>'.PHP_EOL;
		$str .= '<td title="addr">'.PHP_EOL;
		$str .= $this->addr->toHTMLTable($id.'_addr', $hidden, $display);
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