<?php
class GIVEProContact
{
	public $title;								//STRING
	public $l_name, $f_name, $m_name, $suf;		//STRING
	public $w_phone, $m_phone;					//STRING
	public $mail;								//STRING
	
	public function __construct($args)
	{
		$this->title = $args['title'];
		$this->l_name = $args['l_name'];
		$this->f_name = $args['f_name'];
		$this->m_name = $args['m_name'];
		$this->suf = $args['suf'];
		$this->w_phone = $args['w_phone'];
		$this->m_phone = $args['m_phone'];
		$this->mail = $args['mail'];
	}
	public function toHTMLTable($id)
	{	
		$str = "<table id=\"$id\">".PHP_EOL;
		
		$str .= GIVEWrapDataWithTrTd($this->title, 'title');
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