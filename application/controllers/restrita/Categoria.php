<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {

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

            'titulo' => 'Categorias cadastradas',

            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),

            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'
            ),
            
            'categorias' => $this->core_model->get_all('categorias'),

        ); 

            $this->load->view('restrita/layout/header',  $data);
            $this->load->view('restrita/categoria/index');
            $this->load->view('restrita/layout/footer');
    }

    public function core($categoria_id=null){

        $categoria_id = (int) $categoria_id; 

        if(!$categoria_id){
            //Cadastrar
            $this->form_validation->set_rules('categoria_nome','Nome da categoria','trim|required|min_length[4]|max_length[40]|callback_valida_nome_categoria');
            
            if($this->form_validation->run()){ 
                
                $data = elements(
                    array(
                        'categoria_nome',
                        'categoria_ativa',
                        
                    ), $this->input->post()
                );

                //Definindo om metelink
                $data['categoria_meta_link'] = url_amigavel($data['categoria_nome']); 

                $data = html_escape($data); 
                $this->core_model->insert('categorias', $data);
                redirect('restrita/categoria'); 

            }else{

                $data = array(

                    'titulo' => 'Cadastrar Categorias',

                ); 

                //echo  '<pre>'; 
                //print_r($data['master']); 
                //exit(); 

                $this->load->view('restrita/layout/header',  $data);
                $this->load->view('restrita/categoria/core');
                $this->load->view('restrita/layout/footer');
            }

        }else{
            //Editiamo

            if(!$categoria = $this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id))){

                $this->session->set_flashdata('erro', 'A categoria não foi encontrada'); 
                redirect('restrita/categoria');

            }else{
                //editando
                $this->form_validation->set_rules('categoria_nome','Nome da categoria ','trim|required|min_length[4]|max_length[40]|callback_valida_nome_categoria');
            
                if($this->form_validation->run()){ 
                    
                    $data = elements(
                        array(
                            'categoria_nome',
                            'categoria_ativa',

                        ), $this->input->post()
                    );

                    //echo  '<pre>'; 
                    //print_r( $this->input->post()); 
                    //exit(); 
                    
                    //Definindo om metelink
                    $data['categoria_meta_link'] = url_amigavel($data['categoria_nome']); 

                    $data = html_escape($data); 
                    $this->core_model->update('categorias', $data, array('categoria_id' => $categoria_id));
                    redirect('restrita/categoria'); 

                }else{

                    $data = array(

                        'titulo' => 'Editar Categoria ',
                        'categoria' => $categoria,
                    ); 

                    //echo  '<pre>'; 
                    //print_r($data['master']); 
                    //exit(); 

                    $this->load->view('restrita/layout/header',  $data);
                    $this->load->view('restrita/categoria/core');
                    $this->load->view('restrita/layout/footer');
                }
            }
        }
    }


    public function valida_nome_categoria($categoria_nome){

        $categoria_id = $this->input->post('categoria_id');
        //echo  '<pre>'; 
        //print_r( $categoria_pai_nome); 
       // exit(); 

        if(!$categoria_id){
            //cadastrando
            if($this->core_model->get_by_id('categorias', array('categoria_nome' => $categoria_nome))){
                $this->form_validation->set_message('valida_nome_categoria', 'Essa categoria. pai já existe'); 
                return false; 
            }else{
                return true;
            }
        }else{
            //Editando
            if($this->core_model->get_by_id('categorias', array('categoria_nome' => $categoria_nome , 'categoria_id !=' => $categoria_id))){
                $this->form_validation->set_message('valida_nome_categoria', 'Essa categoia pai já existe'); 
                return false; 
            }else{
                return true;
            }


        }

    }

    public function delete($categoria_id = null){

        $categoria_id = (int) $categoria_id; 

        

        if(!$categoria_id || !$this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id))){
            $this->session->set_flashdata('error','A categoria não foi encontrada'); 
            redirect('restrita/categoria');
        }

        

        if($this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id, 'categoria_ativa'=> 1))){
            $this->session->set_flashdata('error','Não é possivel excluir uma categoria ativa'); 
            redirect('restrita/categoria');
        }

        

        $this->core_model->delete('categorias', array('categoria_id' => $categoria_id)); 
        redirect('restrita/categoria'); 

    }


}