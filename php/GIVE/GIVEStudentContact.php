<?php

class GIVEStudentContact
{
	public $id;									//INT
	public $l_name, $f_name, $m_name, $suf;		//STRING
	public $m_phone, $w_phone;					//STRING
	public $mail;								//STRING
	
	public function __construct($args)
	{
		$this->id = $args['id'];
		$this->l_name = $args['l_name'];
		$this->f_name = $args['f_name'];
		$this->m_name = $args['m_name'];
		$this->suf = $args['suf'];
		$this->w_phone = $args['w_phone'];
		$this->m_phone = $args['m_phone'];
		$this->mail = $args['mail'];
	}
}

?>