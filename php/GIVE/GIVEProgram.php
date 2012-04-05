<?php

include_once('GIVEAddr.php');
include_once('GIVEAgency.php');
include_once('GIVEProContact.php');
include_once('GIVEStudentContact.php');
include_once('GIVEToHTML.php');

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
	public function toHTMLTable($id)
	{	
		$str = "<table id=\"$id\">".PHP_EOL;
		
		$str .= GIVEWrapDataWithTrTd($this->id, 'id');
		$str .= GIVEWrapDataWithTrTd($this->referal, 'referal');
		$str .= GIVEWrapDataWithTrTd($this->season, 'season');
		$str .= GIVEWrapDataWithTrTd($this->times, 'times');
		$str .= GIVEWrapDataWithTrTd($this->name, 'name');
		$str .= GIVEWrapDataWithTrTd($this->descript, 'descript');
		$str .= GIVEWrapDataWithTrTd($this->duration, 'duration');
		$str .= GIVEWrapDataWithTrTd($this->issuesToHTMLTable('issues'));
		$str .= GIVEWrapDataWithTrTd($this->addr->toHTMLTable('addr'));
		$str .= GIVEWrapDataWithTrTd($this->p_contact->toHTMLTable('p_contact'));
		$str .= GIVEWrapDataWithTrTd($this->s_contact->toHTMLTable('s_contact'));
		
		$str .= '</table>';
		return $str;
	}
	private function issuesToHTMLTable($id)
	{	
		$str = "<table id=\"$id\">".PHP_EOL;
		
		$i = 0;
		foreach($this->issues as $issue) {
			$str .= GIVEWrapDataWithTrTd($issue, 'issue'.$i);
			$i++;
		}
		$str .= '</table>'.PHP_EOL;
		
		return $str;
	}
}

?>