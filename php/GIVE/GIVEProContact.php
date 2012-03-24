<?php
class GIVEProContact
{
	public $id;									//INT
	public $title;								//STRING
	public $l_name, $f_name, $m_name, $suf;		//STRING
	public $w_phone, $m_phone;					//STRING
	public $mail;								//STRING
	
	public function __construct($args)
	{
		$this->id = $args['id'];
		$this->title = $args['title'];
		$this->l_name = $args['l_name'];
		$this->f_name = $args['f_name'];
		$this->m_name = $args['m_name'];
		$this->suf = $args['suf'];
		$this->w_phone = $args['w_phone'];
		$this->m_phone = $args['m_phone'];
		$this->mail = $args['mail'];
	}
	
	public function __toString()
	{
		return "{$this->id}, {$this->suf}, {$this->f_name}, {$this->m_name}, 
		{$this->l_name}, {$this->w_phone}, {$this->m_phone}, {$this->mail}";
	}
	
	public function toHTMLString()
	{
		return "{$this->id}, \"{$this->suf}\", \"{$this->f_name}\", \"{$this->m_name}\", 
		\"{$this->l_name}\", \"{$this->w_phone}\", \"{$this->m_phone}\",
		\"{$this->mail}\"";
	}
}
?>