<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagar extends CI_Controller {

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

        $this->load->model('financeiro_model'); 

	
    }
    

    public function index(){
        $data = array(

            'titulo' => 'Contas a pagar ',

            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),

            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'
            ),
            
            'contas_pagar' => $this->financeiro_model->get_all_pagar('contas_pagar'),

            'email' => $this->core_model->get_email('email'),
			'email_view' => $this->core_model->get_novo_email_view(),
			'novo_email' => $this->core_model->get_novo_email(), 
        ); 
            /*
            echo '<pre>'; 
            print_r($data['contas_pagar']); 
            exit(); 
            */
            $this->load->view('restrita/layout/header',  $data);
            $this->load->view('restrita/pagar/index');
            $this->load->view('restrita/layout/footer');
    }

    public function edit($conta_pagar_id = NULL){
        if(!$conta_pagar_id || !$this->core_model->get_by_id('contas_pagar', array('conta_pagar_id'))){
            $this->session->set_flashdata('error', 'Conta não encontrada'); 
            redirect('pagar'); 

        }else{

            $data = array(

                'titulo' => 'Contas a pagar ',
    
                'styles' => array(
                    'vendor/datatables/dataTables.bootstrap4.min.css',
                ),
    
                'scripts' => array(
                    'vendor/datatables/jquery.dataTables.min.js',
                    'vendor/datatables/dataTables.bootstrap4.min.js',
                    'vendor/datatables/app.js'
                ),
                
                'contas_pagar' => $this->financeiro_model->get_all_pagar('contas_pagar'),
    
                'email' => $this->core_model->get_email('email'),
                'email_view' => $this->core_model->get_novo_email_view(),
                'novo_email' => $this->core_model->get_novo_email(), 
            ); 
                /*
                echo '<pre>'; 
                print_r($data['contas_pagar']); 
                exit(); 
                */
                $this->load->view('restrita/layout/header',  $data);
                $this->load->view('restrita/pagar/edit');
                $this->load->view('restrita/layout/footer');

        }
    }

}