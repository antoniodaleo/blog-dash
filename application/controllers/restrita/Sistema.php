<?php

    defined('BASEPATH') OR exit('Ação não permitida'); 

    class Sistema extends CI_Controller{

        // 1° Verificazione, se la sessione esiste o no. 
        public function __construct(){
            parent::__construct(); 

            if (!$this->ion_auth->logged_in())
            {
                $this->session->set_flashdata('info', 'Sua sessão expirou!'); 
                redirect('restrita//login');
            }

            if(!$this->ion_auth->is_admin()){
                $this->session->set_flashdata('info','O usuario não tem acesso a esse menu sistema'); 
                redirect('/'); 
            }
        }

        public function index(){

            $data = array(
                'titulo' => 'Editar informações do sistema',

                'scripts' => array(
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js'
                ),

                'sistema' => $this->core_model->get_by_id('sistema', array('sistema_id'=>1)), 
            );


            
          
            


            $this->form_validation->set_rules('sistema_razao_social', 'Razão Social','required|min_length[10]|max_length[145]'); 
            $this->form_validation->set_rules('sistema_nome_fantasia', '','required|min_length[10]|max_length[145]'); 
            $this->form_validation->set_rules('sistema_cnpj', '','exact_length[18]');  
            $this->form_validation->set_rules('sistema_ie', '','max_length[25]'); 
            
            $this->form_validation->set_rules('sistema_telefone_fixo', '','max_length[25]'); 
            $this->form_validation->set_rules('sistema_telefone_movel', '','required|max_length[25]'); 
            $this->form_validation->set_rules('sistema_email', '','valid_email|max_length[100]'); 
            $this->form_validation->set_rules('sistema_site_url', 'URL do Site','required|valid_url|max_length[100]'); 
            
            $this->form_validation->set_rules('sistema_cep', 'Cep','required|exact_length[9]');
            $this->form_validation->set_rules('sistema_endereco', 'Endereço','required|max_length[145]');  
            $this->form_validation->set_rules('sistema_numero', 'Numero','required|max_length[25]');  
            $this->form_validation->set_rules('sistema_cidade', 'Cidade','required|max_length[45]');  
            
            $this->form_validation->set_rules('sistema_estado', 'Estado','required|exact_length[2]');
            $this->form_validation->set_rules('sistema_txt_ordem_servico', 'Ordem de serviço','max_length[500]');



            if($this->form_validation->run()){

                $data = elements(
                    array(
                        'sistema_razao_social',
                        'sistema_nome_fantasia',
                        'sistema_cnpj',
                        'sistema_ie',
                        'sistema_telefone_fixo',
                        'sistema_telefone_movel',
                        'sistema_email',
                        'sistema_site_url',
                        'sistema_cep',
                        'sistema_endereco',
                        'sistema_numero',
                        'sistema_cidade',
                        'sistema_estado',
                        'sistema_txt_ordem_servico',

                    ),$this->input->post()

                );

                $data = html_escape($data); 

                $this->core_model->update('sistema', $data, array('sistema_id' =>1)); 

                redirect('restrita/sistema');
                //echo '<pre>';
                //print_r($this->input->post()); 
                //exit();
            }else{
                //Erro de validação

                $this->load->view('restrita/layout/header',$data); 
                $this->load->view('restrita/sistema/index');
                $this->load->view('restrita/layout/footer'); 
            }

          

            

        }


        /*
        
            [sistema_id] => 1
            [sistema_razao_social] => System Ordem Inc
            [sistema_nome_fantasia] => Sistema Ordem 
            [sistema_cnpj] => 47.613.957/0001-77
            [sistema_ie] => 
            [sistema_telefone_fixo] => 
            [sistema_telefone_movel] => 
            [sistema_email] => ordemnow@contato.com.br
            [sistema_site_url] => http://localhost/sistema/
            [sistema_cep] => 80429-000
            [sistema_endereco] => rua da programação 
            [sistema_numero] => 38
            [sistema_cidade] => Curitiba
            [sistema_estado] => Pa
            [sistema_txt_ordem_servico] => 
            [sistema_data_alteracao] => 2020-10-16 15:34:47
        
        */




    }