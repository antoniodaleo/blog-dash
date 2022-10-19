<?php

    defined('BASEPATH') OR exit('Ação não permitida'); 

    class Blog_model extends CI_Model{

        private $lastQuery=''; 


        // Recupera o post para detalhalo    
        public function get_by_id($blog_meta_link = null){
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
              
                //'sub_categorias.sub_categoria_meta_link', 

                ]);

                $this->db->where('blog.blog_meta_link', $blog_meta_link);

                $this->db->join('categorias', 'categorias.categoria_id = blog.blog_categoria_id','LEFT');
                $this->db->join('produtos_fotos', 'produtos_fotos.foto_produto_id = blog.blog_id','LEFT');
                
                // Mi prendi una linea visto che voglio solo 1 articolo
                return $this->db->get('blog')->row(); 
        }

        // Recupera tutti i post relazionati a 1 categoria selezionata
        public function get_all_by($condicoes){
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
    
            $this->db->where('categorias.categoria_ativa', 1);
    
            if ($condicoes && is_array($condicoes)) {
                $this->db->where($condicoes);
            }
    
            $this->db->join('categorias', 'categorias.categoria_id = blog.blog_categoria_id','LEFT');
            $this->db->join('produtos_fotos', 'produtos_fotos.foto_produto_id = blog.blog_id','LEFT');
    
            //Retorna apenas uma foto por registro
            $this->db->group_by('blog.blog_id');
    
            return $this->db->get('blog')->result();
        }

        // Recupera la somma dei post per categoria
        public function get_all_by_categoria($condicoes){
            $this->db->select([
                'blog.blog_id',
                'blog.blog_categoria_id',
                
            ]);
    
            //$this->db->where('categorias.categoria_ativa', 1);
            $this->db->where('categorias.categoria_meta_link', $condicoes);
           
            $this->db->join('categorias', 'categorias.categoria_id = blog.blog_categoria_id','LEFT');
    
            //Retorna apenas uma foto por registro
            $this->db->group_by('blog.blog_id');
            $num =  $this->db->get('blog')->result();

            return count($num);
        }

    }