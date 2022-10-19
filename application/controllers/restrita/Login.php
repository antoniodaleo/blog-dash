<?php

    defined('BASEPATH' ) OR exit('ação não permitida'); 

    class Login extends CI_Controller{


        public function index(){
            //echo '<pre>'; 
            //print_r($this->input->post()); 
            //exit(); 
            
            $data = array(
                'titulo' => 'Login', 
            );                 
            
            
            $this->load->view('restrita/layout/header',$data);
            $this->load->view('restrita/login/index'); 
            $this->load->view('restrita/layout/footer');
        
        }
        
        public function auth(){
            
            //echo '<pre>'; 
            //print_r($this->input->post()); 
            //exit(); 
            
            $identity = $this->security->xss_clean($this->input->post('email')); 
            $password = $this->security->xss_clean($this->input->post('password'));
            $remember = FALSE; // remember the user

            if($this->ion_auth->login($identity, $password, $remember)){
                redirect('restrita/home'); 
            }else{
                $this->session->set_flashdata('error', 'Verifique seu e-mail ou senha');
                redirect('restrita/login'); 
            }
            
           
        }

        public function logout(){
            $this->ion_auth->logout();
            redirect('restrita/login');
        }

        /*
            [email] => admin
            [password] => password
        */

    }