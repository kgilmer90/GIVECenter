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
		$str .= '<td title="referal">'.PHP_EOL;
		$str .= $this->referal.PHP_EOL;
		$str .= '</td>'.PHP_EOL;
		$str .= '</tr>'.PHP_EOL;
		
		$str .= '<tr>'.PHP_EOL;
		$str .= '<td title="season">'.PHP_EOL;
		$str .= $this->season.PHP_EOL;
		$str .= '</td>'.PHP_EOL;
		$str .= '</tr>'.PHP_EOL;
	
		$str .= '<tr>'.PHP_EOL;
		$str .= '<td title="times>'.PHP_EOL;
		$str .= $this->times.PHP_EOL;
		$str .= '</td>'.PHP_EOL;
		$str .= '</tr>'.PHP_EOL;
		
		$str .= '<tr>'.PHP_EOL;
		$str .= '<td title="name>'.PHP_EOL;
		$str .= $this->name.PHP_EOL;
		$str .= '</td>'.PHP_EOL;
		$str .= '</tr>'.PHP_EOL;

		$str .= '<tr>'.PHP_EOL;
		$str .= '<td title="descript">'.PHP_EOL;
		$str .= $this->descript.PHP_EOL;
		$str .= '</td>'.PHP_EOL;
		$str .= '</tr>'.PHP_EOL;
		
		$str .= '<tr>'.PHP_EOL;
		$str .= '<td title="duration">'.PHP_EOL;
		$str .= $this->duration.PHP_EOL;
		$str .= '</td>'.PHP_EOL;
		$str .= '</tr>'.PHP_EOL;
		
		$str .= "<tr>".PHP_EOL;
		$str .= "<td>".PHP_EOL;
		$str .= $this->issuesToHTMLTable('issues')
		$str .= "</td>".PHP_EOL;
		$str .= "</tr>".PHP_EOL;
		
		$str .= "<tr>".PHP_EOL;
		$str .= "<td>".PHP_EOL;
		$str .= $this->addr->toHTMLTable('addr', $hidden, $display);
		$str .= "</td>".PHP_EOL;
		$str .= "</tr>".PHP_EOL;
		
		$str .= "<tr>".PHP_EOL;
		$str .= "<td>".PHP_EOL;
		$str .= $this->p_contact->toHTMLTable('p_contact', $hidden, $display);
		$str .= "</td>".PHP_EOL;
		$str .= "</tr>".PHP_EOL;
		
		$str .= "<tr>".PHP_EOL;
		$str .= "<td>".PHP_EOL;
		$str .= $this->s_contact->toHTMLTable('s_contact', $hidden, $display);
		$str .= "</td>".PHP_EOL;
		$str .= "</tr>".PHP_EOL;
		
		$str .= '</table>';
		return $str;
	}
	private function issuesToHTMLTable($id)
	{	
		$str = "<table id=\"$id\">".PHP_EOL;
		
		$i = 0;
		foreach($this->issues as $issue) {
			$str .= '<tr>'.PHP_EOL;
			$str .= '<td title="issue"'.$i.'>'.PHP_EOL;
			$str .= $issue.PHP_EOL;
			$str .= '</td>'.PHP_EOL;
			$str .= '</tr>'.PHP_EOL;
			
			$i++;
		}
		$str .= '</table>'.PHP_EOL;
		
		return $str;
	}
}

?>