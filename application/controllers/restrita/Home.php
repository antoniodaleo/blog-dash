<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct(); 

		if (!$this->ion_auth->logged_in())
		{
			$this->session->set_flashdata('info', 'Sua sessão expirou!'); 
		  	redirect('restrita/login');
		}
		
		if(!$this->ion_auth->is_admin()){
            $this->session->set_flashdata('info','O usuario não tem acesso a esse menu sistema'); 
            redirect('/'); 
        }
		

	}

	public function index(){

		$data = array(
			'titulo' => 'Home', 
			'email' => $this->core_model->get_email('email'),
			'email_view' => $this->core_model->get_novo_email_view(),
			'novo_email' => $this->core_model->get_novo_email(), 

			'post_tot' => $this->core_model->CountAll(), 
			'categorias_tot' => $this->core_model->CountAllCategorias(), 
	
			
		);

		/*echo '<pre>'; 
		print_r($data['email']); 
		exit(); 
		*/

		$this->load->view('restrita/layout/header', $data); 
		$this->load->view('restrita/home/index');
		$this->load->view('restrita/layout/footer'); 
	}
}