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
		
		$str .= '<tr>'.PHP_EOL;
		$str .= '<td> title="title"'.PHP_EOL;
		$str .= $this->title.PHP_EOL;
		$str .= '</td>'.PHP_EOL;
		$str .= '</tr>'.PHP_EOL;
		
		$str .= '<tr>'.PHP_EOL;
		$str .= '<td> title="l_name"'.PHP_EOL;
		$str .= $this->l_name.PHP_EOL;
		$str .= '</td>'.PHP_EOL;
		$str .= '</tr>'.PHP_EOL;
		
		$str .= '<tr>'.PHP_EOL;
		$str .= '<td> title="f_name"'.PHP_EOL;
		$str .= $this->f_name.PHP_EOL;
		$str .= '</td>'.PHP_EOL;
		$str .= '</tr>'.PHP_EOL;
	
		$str .= '<tr>'.PHP_EOL;
		$str .= '<td> title="m_name"'.PHP_EOL;
		$str .= $this->m_name.PHP_EOL;
		$str .= '</td>'.PHP_EOL;
		$str .= '</tr>'.PHP_EOL;
		
		$str .= '<tr>'.PHP_EOL;
		$str .= '<td> title="suf"'.PHP_EOL;
		$str .= $this->suf.PHP_EOL;
		$str .= '</td>'.PHP_EOL;
		$str .= '</tr>'.PHP_EOL;

		$str .= '<tr>'.PHP_EOL;
		$str .= '<td> title="w_phone"'.PHP_EOL;
		$str .= $this->w_phone.PHP_EOL;
		$str .= '</td>'.PHP_EOL;
		$str .= '</tr>'.PHP_EOL;
		
		$str .= '<tr>'.PHP_EOL;
		$str .= '<td> title="m_phone"'.PHP_EOL;
		$str .= $this->m_phone.PHP_EOL;
		$str .= '</td>'.PHP_EOL;
		$str .= '</tr>'.PHP_EOL;
		
		$str .= '<tr>'.PHP_EOL;
		$str .= '<td> title="mail"'.PHP_EOL;
		$str .= $this->mail.PHP_EOL;
		$str .= '</td>'.PHP_EOL;
		$str .= '</tr>'.PHP_EOL;
		
		$str .= '</table>';
		return $str;
	}
}
?>