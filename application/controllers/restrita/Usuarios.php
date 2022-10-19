<?php

    defined('BASEPATH') OR exit('Ação não permitida'); 

    class Usuarios extends CI_Controller{
        public function __construct(){
            parent::__construct(); 
            
            if (!$this->ion_auth->logged_in())
            {
                $this->session->set_flashdata('info', 'Sua sessão expirou!'); 
                redirect('login');
            }
            
            if(!$this->ion_auth->is_admin()){
                $this->session->set_flashdata('info','O usuario não tem acesso a esse menu sistema'); 
                redirect('/'); 
            }
          
        }
        
        
        public function index(){
            
            if(!$this->ion_auth->is_admin()){
                $this->session->set_flashdata('info','Você não tem permissao para acessar este menu'); 
                redirect('restrita/home'); 
            }
            
            $data = array(
                'titulo' => 'Usuario cadastrado',

                'styles' => array(
                    'vendor/datatables/dataTables.bootstrap4.min.css',
                ),

                'scripts' =>array(
                     'vendor/datatables/jquery.dataTables.min.js',
                     'vendor/datatables/dataTables.bootstrap4.min.js',
                     'vendor/datatables/app.js'

                ),

                'usuarios' => $this->ion_auth->users()->result()
                
            );

            //echo '<pre>'; 
            //print_r($data['usuarios']); 
            //exit(); 
          

            $this->load->view('restrita/layout/header',$data);
            $this->load->view('restrita/usuarios/index');
            $this->load->view('restrita/layout/footer',); 

        }
            
        public function edit($usuario_id = NULL) {

            if(!$this->ion_auth->is_admin()){
                
                if ($this->session->userdata('user_id') != $usuario_id){
                    $this->session->set_flashdata('info', 'Voce nao pode editar um usuario diferente do seu'); 
                    redirect('restrita/home'); 
                }
            }
            //$user_session = $this->session->userdata('user_id'); 

            if(!$usuario_id ||  !$this->ion_auth->user($usuario_id)->row()){
                
                $this->session->set_flashdata('error', 'Usuario não encontrado');
                redirect('restrita/usuarios');  
                //exit('Usuario não cadastrado');
            
            }else{

                //Validazione del Formulario;
                $this->form_validation->set_rules('first_name','','trim|required');
                $this->form_validation->set_rules('last_name','','trim|required');
                //Stiamo chiamando la funzione emai_check (deve essere iniziato con il callback)
                $this->form_validation->set_rules('email','','trim|required|valid_email|callback_email_check');
                $this->form_validation->set_rules('username','','trim|required|callback_username_check');
                $this->form_validation->set_rules('password','senha','min_length[5]|max_length[255]');
                $this->form_validation->set_rules('confirm_password','confirme','matches[password]');

                if($this->form_validation->run()){

                    $data = elements(  
                        array(
                            'first_name',
                            'last_name',
                            'email',
                            'username', 
                            'active',
                            'password'
                                ), $this->input->post()
                    );
                    if(!$this->ion_auth->is_admin()){
                        unset($data['active']); 
                    }

                    $data = $this->security->xss_clean($data); 

                    //Verifica se foi passado o password
                    $password = $this->input->post('password'); 

                    if(!$password){ 
                        unset($data['password']); 
                    }

                    if($this->ion_auth->update($usuario_id, $data)){
                       
                        $perfil_usuario_db = $this->ion_auth->get_users_groups($usuario_id)->row(); 
                        $perfil_usuario_post = $this->input->post('perfil_usuario'); 
                        

                        if($this->ion_auth->is_admin()){
                            if($perfil_usuario_db->id !=  $perfil_usuario_post ){
                                // pass a single ID and user ID
                                $this->ion_auth->remove_from_group($perfil_usuario_db->id, $usuario_id);
                                $this->ion_auth->add_to_group($perfil_usuario_post, $usuario_id);
                            }
                        }
                        //Se for diferente, atualiza o grupo
                        $this->session->set_flashdata('sucesso', 'Dados salvos com successo'); 
                    }else{
                        $this->session->set_flashdata('error', 'Erro ao salvar os Dados'); 
                    }


                    if($this->ion_auth->is_admin()){
                        
                        redirect('restrita/usuarios'); 
                    }else{
                        redirect('restrita/home'); 
                    }
        
  
                }else{

                    $data = array(
                        'titulo' => 'Editar Usuario',
                        'usuario' => $this->ion_auth->user($usuario_id)->row(),
                        'perfil_usuario' => $this->ion_auth->get_users_groups($usuario_id)->row(),
                    ); 
                    
                    
                    $this->load->view('restrita/layout/header',$data);
                    $this->load->view('restrita/usuarios/edit');
                    $this->load->view('restrita/layout/footer');

                }
            }

          

        }

        public function email_check($email){

            $usuario_id = $this->input->post('usuario_id'); 
           
            if($this->core_model->get_by_id('users', array('email' =>$email, 'id !=' => $usuario_id ))){
                
                $this->form_validation->set_message('email_check','Esse email já existe');

                return false; 

            }else{

                return true;          
            }

        }

        public function username_check($username){
            $usuario_id = $this->input->post('usuario_id'); 

            if($this->core_model->get_by_id('users', array('username' =>$username, 'id !=' => $usuario_id ))){
                
                $this->form_validation->set_message('username_check','Esse usuario já existe');

                return false; 

            }else{

                return true;          
            }
        }
        
        public function add(){
            
            if(!$this->ion_auth->is_admin()){
                $this->session->set_flashdata('info','Você não tem permissao para acessar este menu'); 
                redirect('restrita/home'); 
            }
            

            //Validazione del Formulario;
            $this->form_validation->set_rules('first_name','','trim|required');
            $this->form_validation->set_rules('last_name','','trim|required');
            //Stiamo chiamando la funzione emai_check (deve essere iniziato con il callback)
            $this->form_validation->set_rules('email','','trim|required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('username','','trim|required|is_unique[users.username]');
            $this->form_validation->set_rules('password','senha','required|min_length[5]|max_length[255]');
            $this->form_validation->set_rules('confirm_password','confirme','matches[password]');

            if($this->form_validation->run()){
                //Dati totali che arrivano dal post
                $username = $this->security->xss_clean( $this->input->post('username'));
                $password = $this->security->xss_clean($this->input->post('password')) ;
                $email = $this->security->xss_clean($this->input->post('email')) ;
                
                $additional_data = array(
                            'first_name' => $this->input->post('first_name'),
                            'last_name' => $this->input->post('last_name'),
                            'username'=> $this->input->post('username'), 
                            'active' => $this->input->post('active'),
                            );

                $group = array( $this->input->post('perfil_usuario')); // Sets user to admin.
                 //Fine Dati totali che arrivano dal post

                $additional_data = $this->security->xss_clean($additional_data); 
                $group = $this->security->xss_clean($group); 

                //Alterar ion_auth_model 853
                //echo '<pre>'; 
                //print_r($additional_data); 
                //exit();            

                if($this->ion_auth->register($username, $password, $email, $additional_data, $group)){
                    $this->session->set_flashdata('sucesso','Dados salvos com sucesso');
                }else{
                    $this->session->set_flashdata('error','Erro ao salvar os dados');
                }

                redirect('restrita/usuarios'); 
                //exit('Validado');
            }else{

                //Erro di validação
                $data = array(
                    'titulo' => 'Cadastrar Usuario',
                ); 

                $this->load->view('restrita/layout/header',$data);
                $this->load->view('restrita/usuarios/add');
                $this->load->view('restrita/layout/footer');
    
            }


        }

        public function del($usuario_id = null){

            if(!$this->ion_auth->is_admin()){
                $this->session->set_flashdata('info','Você não tem permissao para acessar este menu'); 
                redirect('restrita/home'); 
            }

            if(!$usuario_id || !$this->ion_auth->user($usuario_id)->row()){
                $this->session->set_flashdata('error', 'Usuario não encontrado');
                redirect('restrita/usuarios'); 
            }

            if($this->ion_auth->is_admin($usuario_id)){
                $this->session->set_flashdata('error', 'Admin não pode ser excluido');
                redirect('restrita/usuarios'); 
            }

            if($this->ion_auth->delete_user($usuario_id)){
                $this->session->set_flashdata('sucesso', 'Usuario excluido com sucesso');
                redirect('restrita/usuarios'); 
            }else{
                $this->session->set_flashdata('error', 'Admin não pode ser excluido');
                redirect('restrita/usuarios'); 
            }
            
        }


        // ---------------------------------------------------- NOTAS
                //echo '<pre>';
                //print_r($this->input->post()); 
                //exit();

                /*
                    [first_name] => Admin
                    [last_name] => Franco
                    [email] => admin@admin.com
                    [username] => administrator
                    [active] => 1
                    [perfil_usuario] => 1
                    [password] => 
                    [confirm_password] => 
                    [usuario_id] => 1
                */
        // ----------------------------------------------------END NOTAS

    }


    



