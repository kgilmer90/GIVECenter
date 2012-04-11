<?php

include_once(dirname(__FILE__).'/GIVEAddr.php');
include_once(dirname(__FILE__).'/GIVEAgency.php');
include_once(dirname(__FILE__).'/GIVEProContact.php');
include_once(dirname(__FILE__).'/GIVEStudentContact.php');
include_once(dirname(__FILE__).'/GIVEToHTML.php');

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
	
	public function __construct($args = array())
	{
		$this->id = isset($args['id']) ? $args['id'] : '';
		$this->referal = isset($args['referal']) ? $args['referal'] : '';
		$this->season = isset($args['season']) ? $args['season'] : '';
		$this->times = isset($args['times']) ?$args['times'] : '';
		$this->descript = isset($args['name']) ? $args['name'] : '';
		$this->duration = isset($args['duration']) ? $args['duration'] : '';
		$this->notes = isset($args['notes']) ? $args['notes'] : '';
		$this->issues = isset($args['issues']) ? $args['issues'] : array(0 => '', 1 => '', 2 => '');
		$this->addr = isset($args['addr']) ? $args['addr'] : new GIVEAddr();
		$this->p_contact = isset($args['p_contact']) ? $args['p_contact'] : new GIVEProContact();
		$this->s_contact = isset($args['s_contact']) ? $args['s_contact'] : new GIVEStudentContact();
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
		$str .= GIVEWrapDataWithTrTd($this->issuesToHTMLTable($id.'_issues'));
		$str .= GIVEWrapDataWithTrTd($this->addr->toHTMLTable($id.'_addr'));
		$str .= GIVEWrapDataWithTrTd($this->p_contact->toHTMLTable($id.'_p_contact'));
		$str .= GIVEWrapDataWithTrTd($this->s_contact->toHTMLTable($id.'_s_contact'));
		
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