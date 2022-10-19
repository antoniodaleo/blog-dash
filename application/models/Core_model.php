<?php

    defined('BASEPATH') OR exit('Ação não permitida'); 

    class Core_model extends CI_Model{
        
        var $table = "blog";

        // Mi porti tutti i registri
        public function get_all($tabela = NULL, $condicao = NULL){
            if($tabela){
                if(is_array($condicao)){
                    $this->db->where($condicao); 
                }
                return $this->db->get($tabela)->result();
            }else {
                return FALSE;
            }
        }

        // Mi porti 1 registro
        public function get_by_id($tabela = NULL, $condicao = NULL){
            if($tabela && is_array($condicao)){
                $this->db->where($condicao); 
                $this->db->limit(1); 
                
                return $this->db->get($tabela)->row();
   
            }else{
                return false; 
            }

        }

        // Inseriamo il registro
        public function insert($tabela = NULL, $data = NULL, $get_last_id = NULL){
            
            if($tabela && is_array($data)){
                
                $this->db->insert($tabela, $data); 

                if($get_last_id){
                    $this->session->set_userdata('last_id', $this->db->insert_id()); 
                }

                if($this->db->affected_rows() > 0){
                    $this->session->set_flashdata('sucesso', 'Dados salvos com sucesso');
                }else{
                    $this->session->set_flashdata('error','Erro ao salvar dados');
                }

            }else{
                



            }
        }

        // Inseriamo il registro
        public function update($tabela = NULL, $data = NULL, $condicao = NULL){
            if($tabela && is_array($data) && is_array($condicao) ){

               if( $this->db->update($tabela, $data, $condicao)){
                    $this->session->set_flashdata('sucesso', 'Dados salvo');
               }else{
                    $this->session->set_flashdata('error', 'Erro ao atualizar');
               }

            }else{

                return false; 
            
            }

        }

        // Elimina il registro
        public function delete($tabela = NULL, $condicao = NULL ){
            $this->db->db_debug = FALSE;

            if($tabela && is_array($condicao)){
                
                $status = $this->db->delete($tabela, $condicao);  

                $error = $this->db->error(); 
                
                if(!$status){

                    foreach($error as $code){
                        if($code ==1451){
                            $this->session->set_flashdata('error','registro nao pode ser deletado');
                        }

                    }
                }else{
                    $this->session->set_flashdata('sussecco','Registro excluido'); 

                }
                $this->db->db_debug = true;
            }else{
                return false; 

            }


        }

        // Generare un codice

        public function get_email($tabela = null){
            if($tabela){
                $this->db->limit(10); 
                $this->db->order_by('email_id', 'desc');
                return $this->db->get($tabela)->result();
   
            }else{
                return false; 
            }
           
        }

        public function get_all_email($tabela = null){
            if($tabela){ 
                
                $this->db->order_by('email_id', 'desc');
                $query = $this->db->get($tabela); 
                return $query->result();

                
            }else{
                return false; 
            }
           
        }


        //Mi prendi 4 post che stanno nel blog 
        public function get_all_blog_home($tabela = null){
            if($tabela){

                $this->db->select([
                    'blog.blog_id',
                    'blog.blog_titulo',
                    'blog.blog_descricao',
                    
                    'blog.blog_data',
                    'blog.blog_meta_link', 
                    'produtos_fotos.foto_caminho',
                    'categorias.categoria_id',
                    'categorias.categoria_nome ',
    
                ]);
                
                $this->db->join('categorias', 'categorias.categoria_id = blog.blog_categoria_id','LEFT');

                $this->db->join('produtos_fotos', 'produtos_fotos.foto_produto_id = blog.blog_id', 'LEFT');
                $this->db->order_by("blog_id","desc");
                $this->db->limit(3); 
    
                $query =$this->db->get($tabela); 
                return $query->result(); 
                
            }else{

                return false; 
            }
            
           
        }

        //Mi prendi 3 post recenti come elenco 
        public function get_all_blog_titulos($tabela = null){
            if($tabela){

                $this->db->select([
                    'blog.blog_id',
                    'blog.blog_titulo',
                    'blog.blog_meta_link', 
                    'produtos_fotos.foto_caminho',
    
                ]);
    
                $this->db->join('produtos_fotos', 'produtos_fotos.foto_produto_id = blog.blog_id', 'LEFT');
                $this->db->order_by('blog_id','desc');
                $this->db->limit(3); 
    
                $query =$this->db->get($tabela); 
                return $query->result(); 
            }else{
                return false; 
            }
            
           
        }

        //Mi prendi tutti i post che stanno nel blog
        public function get_all_blog($tabela = null){
            if($tabela){

                $this->db->select([
                    'blog.blog_id',
                    'blog.blog_titulo',
                    'blog.blog_descricao',
                    
                    'blog.blog_data',
                    'blog.blog_meta_link', 
                    'produtos_fotos.foto_caminho',
                    'categorias.categoria_id',
                    'categorias.categoria_nome',
    
                ]);

                $this->db->join('categorias', 'categorias.categoria_id = blog.blog_categoria_id','LEFT');
                $this->db->join('produtos_fotos', 'produtos_fotos.foto_produto_id = blog.blog_id', 'LEFT');

                $this->db->order_by("blog_id","desc");
                //$this->db->limit(4); 
    
                $query =$this->db->get($tabela); 
                return $query->result(); 
            }else{
                return false; 
            }
            
           
        }

        //Mi prendi il singolo articolo  
        public function get_blog_by_id($blog_meta_link = null){
            $this->db->select([
                'blog.blog_id',
                'blog.blog_titulo',
                'blog.blog_descricao',
                'blog.blog_body',
                'blog.blog_data',
                'blog.blog_meta_link', 
                'produtos_fotos.foto_caminho',
                'categorias.categoria_id',
                'categorias.categoria_nome',
            ]);

            $this->db->where('blog.blog_meta_link', $blog_meta_link);
            $this->db->join('categorias', 'categorias.categoria_id = blog.blog_categoria_id','LEFT');
            $this->db->join('produtos_fotos', 'produtos_fotos.foto_produto_id = blog.blog_id', 'LEFT');
            
            return $this->db->get('blog')->row(); 
        }

        //Pesquisa artigo
        public function get_all_by_busca($busca = null){
    
            if($busca){
                $this->db->select([
                    'blog.blog_id',
                    'blog.blog_titulo',
                    'blog.blog_descricao',
                    
                    'blog.blog_data',
                    'blog.blog_meta_link', 
                    'produtos_fotos.foto_caminho',
                ]);

                $this->db->like('blog.blog_titulo', $busca, 'BOTH');

                $this->db->join('produtos_fotos', 'produtos_fotos.foto_produto_id = blog.blog_id', 'LEFT');
    
                $this->db->group_by('blog.blog_id'); 

                return $this->db->get('blog')->result();
                
            }else{

                return false;
            
            }


        }    


        //Pagination , questa funzione prende le categorie
        public function GetAll($sort = 'blog_id', $order = 'asc', $limit = null, $offset = null, $condicao= null) {
            $this->db->select([
                'blog.blog_id',
                'blog.blog_titulo',
                'blog.blog_descricao',
                'blog.blog_data',
                'blog.blog_meta_link', 
                'produtos_fotos.foto_caminho',
                'categorias.categoria_id',
                'categorias.categoria_nome',

            ]);

            //$this->db->where('categorias.categoria_nome', $condicao);
            if ($condicao && is_array($condicao)) {
                $this->db->where($condicao);
            }

            $this->db->join('categorias', 'categorias.categoria_id = blog.blog_categoria_id','LEFT');
            $this->db->join('produtos_fotos', 'produtos_fotos.foto_produto_id = blog.blog_id', 'LEFT');
            

            $this->db->order_by($sort, $order);
            $this->db->limit($limit,$offset); 

            $query =$this->db->get('blog'); 

            if ($query->num_rows() > 0) {
                return $query->result();
              } else {
                return null;
              }

        }
        

        //Pagination, questa funzione prende la categoria selezionata
        //Pagination , questa funzione prende le categorie
        public function GetAllcategoria($sort = 'blog_id', $order = 'asc', $limit = null, $offset = null, $condicao= null, $categoria = null) {
            $this->db->select([
                'blog.blog_id',
                'blog.blog_titulo',
                'blog.blog_descricao',
                'blog.blog_data',
                'blog.blog_meta_link', 
                'produtos_fotos.foto_caminho',
                'categorias.categoria_id',
                'categorias.categoria_nome',
                'categorias.categoria_meta_link',
            ]);

           

            $this->db->join('categorias', 'categorias.categoria_id = blog.blog_categoria_id','LEFT');
            $this->db->join('produtos_fotos', 'produtos_fotos.foto_produto_id = blog.blog_id', 'LEFT');
            
            

            $this->db->order_by($sort, $order);
            $this->db->limit($limit,$offset); 

            $query =$this->db->get('blog'); 

            if ($query->num_rows() > 0) {
                return $query->result();
              } else {
                return null;
              }

        }


        public function CountAll(){

            return $this->db->count_all($this->table);
        }




    }