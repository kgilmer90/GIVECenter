<?php

include_once(dirname(__FILE__).'/GIVEToHTML.php');

class GIVEStudentContact
{
	public $id;
	public $l_name, $f_name, $m_name, $suf;		//STRING
	public $m_phone, $w_phone;					//STRING
	public $mail;								//STRING
	
	public function __construct($args = array())
	{
		$this->id = isset($args['id']) ? $args['id'] : '';
		$this->l_name = isset($args['l_name']) ? $args['l_name'] : '';
		$this->f_name = isset($args['f_name']) ? $args['f_name'] : '';
		$this->m_name = isset($args['m_name']) ? $args['m_name'] : '';
		$this->suf = isset($args['suf']) ? $args['suf'] : '';
		$this->w_phone = isset($args['w_phone']) ? $args['w_phone'] : '';
		$this->m_phone = isset($args['m_phone']) ? $args['m_phone'] : '';
		$this->mail = isset($args['mail']) ? $args['mail'] : '';
	}
	public function toHTMLTable($id)
	{
		$str = "<table id=\"$id\">".PHP_EOL;
		
		$str .= GIVEWrapDataWithTrTd($this->id, 'id');
		$str .= GIVEWrapDataWithTrTd($this->l_name, 'l_name');
		$str .= GIVEWrapDataWithTrTd($this->f_name, 'f_name');
		$str .= GIVEWrapDataWithTrTd($this->m_name, 'm_name');
		$str .= GIVEWrapDataWithTrTd($this->suf, 'suf');
		$str .= GIVEWrapDataWithTrTd($this->w_phone, 'w_phone');
		$str .= GIVEWrapDataWithTrTd($this->m_phone, 'm_phone');
		$str .= GIVEWrapDataWithTrTd($this->mail, 'mail');
		
		$str .= '</table>';
		return $str;
	}
}

?>