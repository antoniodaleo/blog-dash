<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {


	public function index()
	{
        $data = array(

            'titulo' => 'Gerenciar Blog',  

            'styles' => array(
				'vendor/datatables/dataTables.bootstrap4.min.css',
			),

			'scripts' =>array(
				 'vendor/datatables/jquery.dataTables.min.js',
				 'vendor/datatables/dataTables.bootstrap4.min.js',
				 'vendor/datatables/app.js'

			),
            
            'blog' => $this->core_model->get_all_blog('blog'),
            'categorias' =>  $this->core_model->get_all('categorias', array('categoria_ativa' => 1)),
            'email' => $this->core_model->get_email('email'),
			'email_view' => $this->core_model->get_novo_email_view(),
			'novo_email' => $this->core_model->get_novo_email(), 
        );

		$this->load->view('restrita/layout/header', $data);
		$this->load->view('restrita/blog/index');
		$this->load->view('restrita/layout/footer');
	}


    public function core($blog_id =null){
        $blog_id = (int) $blog_id; 

        if(!$blog_id){
            //Catastrando------------------------------
            $this->form_validation->set_rules('blog_titulo','Titulo do post','trim|required|min_length[4]|max_length[250]');
            $this->form_validation->set_rules('blog_descricao','Descrição do post','trim|required|min_length[10]|max_length[5000]');
            $this->form_validation->set_rules('blog_categoria_id','Categoria do blog','trim|required');

            $this->form_validation->set_rules('blog_body','Conteudo do post','trim|required|min_length[100]');
            $this->form_validation->set_rules('blog_data','Data do post','trim|required');

        
            $fotos_produtos = $this->input->post('fotos_produtos'); 
           
           
            //echo '<pre>'; 
            //print_r($fotos_produtos); 
            //exit(); 


            if(!$fotos_produtos){
                $this->form_validation->set_rules('fotos_produtos','Imagens do post','trim|required');
            }

            if($this->form_validation->run()){

                $data = elements(
                    array(
                        'blog_titulo',
                        'blog_descricao', 
                        'blog_categoria_id',
                        'blog_body',  
                        'blog_data',
                        
                    ), $this->input->post()
                );

                $data['blog_meta_link'] = url_amigavel($data['blog_titulo']);
                $data = html_escape($data); 

                $this->core_model->insert('blog', $data, true); 

                //Recupera ultimo id inserido
                $blog_id = $this->session->userdata('last_id');
                
                
                

                if($fotos_produtos){
                
                    $total_fotos = count($fotos_produtos); 
    
                    for($i = 0; $i< $total_fotos; $i++){
                        $data = array(
                            'foto_produto_id' => $blog_id,  
                            'foto_caminho' => $fotos_produtos[$i],
                        );
    
                        //echo '<pre>'; 
                        //print_r($data['foto_caminho']); 
                        //exit(); 

                        $this->core_model->insert('produtos_fotos', $data);
                    }
           
                }
    
                redirect('restrita/blog');

            }else{

                $data = array(
                    'titulo' => 'Gerenciar Blog', 
                    
                    'styles' => array(
                        'jquery-upload-file/css/uploadfile.css',
                        'jquery-upload-file/css/uploadfile.custom.css',
                    ),
        
                    'scripts' =>array(
                        //È para baixar o arquivo SweetAlert
                        'sweetalert2/sweetalert2.all.min.js',      
                        'jquery-upload-file/js/jquery.uploadfile.min.js',
                        'jquery-upload-file/js/produtos.js',
                        'mask/jquery.mask.min.js',
                        'mask/custom.js',
                        
        
                    ),
                    'categorias' =>  $this->core_model->get_all('categorias', array('categoria_ativa' => 1)),
                    //'blog' => $this->core_model->get_all('blog'),
                    'email' => $this->core_model->get_email('email'),
                    'email_view' => $this->core_model->get_novo_email_view(),
                    'novo_email' => $this->core_model->get_novo_email(), 
        
                );
        
              

                $this->load->view('restrita/layout/header', $data);         
                $this->load->view('restrita/blog/core'); 
                $this->load->view('restrita/layout/footer');


            }



        }else{
            //Editando -------------------------------------------------------------
            if( !$blog = $this->core_model->get_by_id('blog', array('blog_id' =>$blog_id))){
                //Verifichiamo se il produto esiste
                $this->session->set_flash_data('erro', 'Esse post não foi encontrado');
                redirect('restrito/blog'); 
            }else{
                $this->form_validation->set_rules('blog_titulo','Titulo do post','trim|required|min_length[4]|max_length[250]');
                $this->form_validation->set_rules('blog_categoria_id','Categoria do blog','trim|required');

                $this->form_validation->set_rules('blog_descricao','Descrição do post','trim|required|min_length[10]|max_length[5000]');
                $this->form_validation->set_rules('blog_body','Conteudo do post','trim|required|min_length[100]');
                $this->form_validation->set_rules('blog_data','Data do post','trim|required');
    
                if($this->form_validation->run()){


                    //echo '<pre>'; 
                    //print_r($this->input->post()); 
                    //exit(); 


                    $data = elements(
                        array(
                            'blog_titulo',
                            'blog_categoria_id',
                            'blog_descricao', 
                            'blog_body',  
                            'blog_data',
                        ), $this->input->post()
                    );

                    //Criando o metalink do produto
                    $data['blog_meta_link'] = url_amigavel($data['blog_titulo']);

                    $data = html_escape($data); 

                    $this->core_model->update('blog', $data, array('blog_id' => $blog_id)); 

                    //Exclui as imagem antigas
                    $this->core_model->delete('produtos_fotos', array('foto_produto_id' => $blog_id));

                    $fotos_produtos = $this->input->post('fotos_produtos');

                    if($fotos_produtos){
                        
                        $total_fotos = count($fotos_produtos); 

                        for($i = 0; $i< $total_fotos; $i++){
                            $data = array(
                                'foto_produto_id' => $blog_id,  
                                'foto_caminho' => $fotos_produtos[$i],

                            );

                            $this->core_model->insert('produtos_fotos', $data);
                    }

                    }

                    redirect('restrita/blog');

                }else{

                    $data = array(

                        'titulo' => 'Editar post',
            
                        'styles' => array(
                            'jquery-upload-file/css/uploadfile.css',
                            'jquery-upload-file/css/uploadfile.custom.css',
                        ),
            
                        'scripts' => array(
                            //È para baixar o arquivo SweetAlert
                            'sweetalert2/sweetalert2.all.min.js',
                            'jquery-upload-file/js/jquery.uploadfile.min.js',
                            'jquery-upload-file/js/produtos.js',
                            'mask/jquery.mask.min.js',
                            'mask/custom.js',
                        ),
                        'categorias' =>  $this->core_model->get_all('categorias', array('categoria_ativa' => 1)),
                        'blog' => $blog,
                        'fotos_produto' => $this->core_model->get_all('produtos_fotos', array('foto_produto_id' => $blog_id)),
                        'email' => $this->core_model->get_email('email'),
                        'email_view' => $this->core_model->get_novo_email_view(),
                        'novo_email' => $this->core_model->get_novo_email(), 
                        //'marcas' =>  $this->core_model->get_all('marcas', array('marca_ativa' => 1)),
    
                    ); 
            
                        //echo '<pre>';
                        //print_r($data['post']); 
                        //exit();
            
            
                        $this->load->view('restrita/layout/header',  $data);
                        $this->load->view('restrita/blog/core');
                        $this->load->view('restrita/layout/footer');
            

                }
            }

        }


    }

    public function add(){

        // CADASTRANDO --------------------------------
        $this->form_validation->set_rules('blog_titulo','Titulo do post','trim|required|min_length[4]|max_length[250]');
        $this->form_validation->set_rules('blog_descricao','Descrição do post','trim|required|min_length[10]|max_length[5000]');
        $this->form_validation->set_rules('blog_body','Conteudo do post','trim|required|min_length[100]');
        $this->form_validation->set_rules('blog_data','Data do post','trim|required');

        $fotos_produtos = $this->input->post('foto_produto'); 

        if(!$fotos_produtos){
            $this->form_validation->set_rules('foto_produto','Imagens do post','trim|required');
        }

        if($this->form_validation->run()){
                
            $data = elements(
                array(
                    'blog_titulo',
                    'blog_descricao', 
                    'blog_body',  
                    'blog_data',
                       
                ), $this->input->post()
            );

            //Remove a virgula do valor
            //$data['produto_valor'] = str_replace(',','',$data['produto_valor']);

            //Criando o metalink do produto
            $data['blog_meta_link'] = url_amigavel($data['blog_titulo']);


            $data = html_escape($data); 

            //echo '<pre>'; 
            //print_r($data); 
            //exit(); 

            $this->core_model->insert('blog', $data, true); 


            //Recupera ultimo id inserido
            $blog_id = $this->session->userdata('last_id'); 
            //$fotos_produtos = $this->input->post('fotos_produtos'); 
            
            //echo '<pre>'; 
            //print_r($this->input->post()); 
            //exit(); 

            if($fotos_produtos){
                
                $total_fotos = count($fotos_produtos); 

                for($i = 0; $i< $total_fotos; $i++){
                    $data = array(
                        'foto_produto_id' => $blog_id,  
                        'foto_caminho' => $fotos_produtos[$i],
                    );

                    //echo '<pre>'; 
                    //print_r($data['foto_caminho']); 
                   // exit(); 
                    $this->core_model->insert('produtos_fotos', $data);
                }
       
            }

            redirect('restrita/blog');

        }else{
            $data = array(
                'titulo' => 'Gerenciar Blog', 
                
                'styles' => array(
                    'jquery-upload-file/css/uploadfile.css',
                    'jquery-upload-file/css/uploadfile.custom.css',
                ),
    
                'scripts' =>array(
                    //È para baixar o arquivo SweetAlert
                    'sweetalert2/sweetalert2.all.min.js',      
                    'jquery-upload-file/js/jquery.uploadfile.min.js',
                    'jquery-upload-file/js/produtos.js',
                    'mask/jquery.mask.min.js',
                    'mask/custom.js',
                    
    
                ),
                
                //'blog' => $this->core_model->get_all('blog'),
    
            );
    
            
            $this->load->view('restrita/layout/header', $data);         
            $this->load->view('restrita/blog/add'); 
            $this->load->view('restrita/layout/footer');

        }
        //--------------------------------------------------
         
    }


    public function upload(){

        $config['upload_path'] ='./uploads/produtos/'; 
        $config['allowed_types'] ='jpg|png|jpeg'; 
        $config['max_size'] = 4096;  // Max 4Mb
        $config['max_width'] = 1000; 
        $config['max_height'] = 1000; 
        $config['max_filename'] = 200; 
        $config['encrypt_name'] = true; 
        $config['file_ext_tolower'] = true; 


        $this->load->library('upload', $config); 


        if($this->upload->do_upload('foto_produto')){

            $data = array(
                'uploaded_data' => $this->upload->data(), 
                'mensagem' =>'imagem enviada com sucesso',
                'foto_caminho' => $this->upload->data('file_name'),
                'erro'=> 0,
            );

            //Resize image configuration
            $config['image_library'] = 'gd2';  // Max 2Mb
            $config['source_image'] ='./uploads/produtos/'.$this->upload->data('file_name'); 
            $config['new_image'] = './uploads/produtos/small/'.$this->upload->data('file_name'); 
            $config['width'] = 300; 
            $config['height'] = 300; 

            //Chama a biblioteca
            $this->load->library('image_lib', $config); 

            //Faz o resize
            //$this->image_lib->resize(); 

            if(!$this->image_lib->resize()){
                
                $data['erro'] = $this->image_lib->display_errors(); 
            
            }

        }else{
            $data = array(
                'mensagem' => $this->upload->display_errors(), 
                'erro' => 5, 
            );
        }

        echo json_encode($data); 

    }
 
    public function del($blog_id = null){

        $blog_id = (int) $blog_id; 

        

        if(!$blog_id || !$this->core_model->get_by_id('blog', array('blog_id' => $blog_id))){
            $this->session->set_flashdata('error','O post não foi encontrada'); 
            redirect('restrita/blog');
        }

        

        $this->core_model->delete('blog', array('blog_id' => $blog_id)); 
        $this->session->set_flashdata('sucesso','O post foi deletado com sucesso'); 
        redirect('restrita/blog'); 

    }



	

	
}
