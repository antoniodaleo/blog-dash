<?php

    defined('BASEPATH') OR exit('Ação não permitida'); 

    class Financeiro_model extends CI_Model{

        public function get_all_pagar(){

            $this->db->select([
                'contas_pagar.*', 
                'fornecedor_id', 
                'fornecedor_razao as fornecedor'
            ]);


            $this->db->join('fornecedores', 'fornecedor_id = conta_pagar_fornecedor_id', 'LEFT'); 
            return $this->db->get('contas_pagar')->result(); 

        }





    }