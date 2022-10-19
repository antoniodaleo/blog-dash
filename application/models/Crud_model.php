<?php
class Crud_model extends CI_Model 
{
	function saverecords($name, $email, $mensagem)
	{
		$query="INSERT INTO `email`( `email_nome`, `email_descricao`,`email_mensagem`) 
		VALUES ('$name','$email','$mensagem')";
		$this->db->query($query);

	}

	function savenewsletter_email( $newsletter_email){
		$query="INSERT INTO `newsletter`(  `newsletter_email`) 
		VALUES ('$newsletter_email')";
		$this->db->query($query);
	}

	
}