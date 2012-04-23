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
	public $hours;									//array
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
		$this->hours = isset($args['hours']) ? $args['hours'] : array();
		$this->name = isset($args['name']) ? $args['name'] : '';
		$this->descript = isset($args['descript']) ? $args['descript'] : '';
		$this->duration = isset($args['duration']) ? $args['duration'] : '';
		$this->notes = isset($args['notes']) ? $args['notes'] : '';
		$this->issues = isset($args['issues']) ? $args['issues'] : array();
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
		$str .= GIVEWrapDataWithTrTd($this->name, 'name');
		$str .= GIVEWrapDataWithTrTd($this->descript, 'descript');
		$str .= GIVEWrapDataWithTrTd($this->duration, 'duration');
		$str .= GIVEWrapDataWithTrTd($this->notes, 'notes');
		$str .= GIVEWrapDataWithTrTd($this->hoursToHTMLTable($id, '_hours'));
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
		foreach($this->issues as $key => $val) {
			$str .= GIVEWrapDataWithTrTd($val, 'issue'.$i);
			$i++;
		}
		$str .= '</table>'.PHP_EOL;
		
		return $str;
	}
	private function hoursToHTMLTable($id)
	{	
		$str = "<table id=\"$id\">".PHP_EOL;
		
		$i = 0;
		foreach($this->hours as $key => $val) {
			$str .= GIVEWrapDataWithTrTd($val, 'hour'.$i);
			$i++;
		}
		$str .= '</table>'.PHP_EOL;
		
		return $str;
	}
}

?>