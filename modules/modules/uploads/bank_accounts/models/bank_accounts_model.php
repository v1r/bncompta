<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (!class_exists('CI_Model')) {

    class CI_Model extends Model {
        
    }

}

/**
 * 
 *  @author Karim Besbes
 *  @version v0.1 
 *  @name Accounting module Modele
 *  
 *  Created on 03/08/11
 *  Last Modification : 10/06/11 
 */
class Bank_accounts_model extends CI_Model {

    public function add_bank_account($data) {
            $data_array = array(
            'entreprise_id' => $this->current_entreprise,
            'name' => $data['name'],
            'label' => $data['label'],
            'address' => $data['address'],
            'iban' => $data['iban'],
            'rib' => $data['rib'],
            'bic' => $data['bic'],
            'contact' => $data['contact'],
            'description' => $data['description'],
        );
        return $this->db->insert('entreprises_bank_accounts', $data_array);        
    }

        public function update_bank_account($bank_account_id,$data) {
            $data_array = array(
            'name' => $data['name'],
            'label' => $data['label'],
            'address' => $data['address'],
            'iban' => $data['iban'],
            'rib' => $data['rib'],
            'bic' => $data['bic'],
            'contact' => $data['contact'],
            'description' => $data['description'],
        );
       return $this->db->where('entreprise_id',$this->current_entreprise)
               ->where('id',$bank_account_id)
               ->update('entreprises_bank_accounts', $data_array);        
    }
    public function get_bank_account_data($entreprise_id, $bank_account_id = false) {
        if (!$bank_account_id) {
            return $this->db->select('id,label, name, description')->where('entreprise_id', $entreprise_id)->get('entreprises_bank_accounts')->result();
        }
        else {
              return $this->db->select()
                              ->where('entreprise_id', $entreprise_id)
                              ->where('id', $bank_account_id)
                              ->get('entreprises_bank_accounts')->row();

        }
    }
    
    public function get_entreprise_bank_accounts($entreprise_id)
    {
        return $this->db->where('entreprise_id', $entreprise_id)->get('entreprises_bank_accounts')->result();
    }

}
