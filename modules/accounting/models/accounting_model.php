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
 *  Created on 15/08/11
 *  Last Modification : 15/08/11 
 */
class Accounting_model extends CI_Model {

    /**
     *
     *  Accounting Year Model
     * @author Karim Besbes
     * 
     */
    public function add_new_accounting_year($data) {
        $insert_data = array(
            'entreprise_id' => $this->session->userdata('entreprise_id'),
            'label' => underscore($data['label']),
            'description' => $data['description'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'is_default' => (int) $data['is_default']
        );
        if ($data['is_default'] == 1)
            $this->deactivate_all_accounting_year();
        return $this->db->insert('entreprises_accounting_year', $insert_data);
    }

    public function get_all_accounting_year() {
        //order_by('is_default', 'desc')->
        return $this->db->get_where('entreprises_accounting_year', array('entreprise_id' => $this->session->userdata('entreprise_id')))->result();
    }

    public function deactivate_all_accounting_year() {
        $entreprise_id = $this->session->userdata('entreprise_id');
        return $this->db->update('entreprises_accounting_year', array('is_default' => 0));
    }

    public function activate_accounting_year($accounting_year_id) {
        $entreprise_id = $this->session->userdata('entreprise_id');
        $this->db->update('entreprises_accounting_year', array('is_default' => 0));
        return $this->db->where(array('entreprise_Id' => $entreprise_id, 'id' => $accounting_year_id))
                ->update('entreprises_accounting_year', array('is_default' => 1));
    }

    public function desactivate_accounting_year($accounting_year_id) {
        $entreprise_id = $this->session->userdata('entreprise_id');
        return $this->db->where(array('entreprise_Id' => $entreprise_id, 'id' => $accounting_year_id))
                ->update('entreprises_accounting_year', array('is_default' => 0));
    }

    public function get_accounting_year_data($accounting_year_id) {
        return $this->db->where('id', $accounting_year_id)->get('entreprises_accounting_year')->result();
    }

    public function update_accounting_year($data, $accounting_year_id) {
        $entreprise_id = $this->session->userdata('entreprise_id');
        $update_data = array(
            'label' => underscore($data['label']),
            'description' => $data['description'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'is_default' => (int) $data['is_default']
        );
        if ($data['is_default'] == 1)
            $this->desactivate_accounting_year();
        return $this->db->where(array('id' => $accounting_year_id, 'entreprise_id' => $entreprise_id))
                ->update('entreprises_accounting_year', $update_data);
    }

    public function accounting_year_entreprise_has_access($accounting_year, $entreprise_id) {
        return (bool) $this->db
                ->where('entreprise_id', $entreprise_id)
                ->where('id', $accounting_year)
                ->get('entreprises_accounting_year')->result();
    }

    public function get_entreprise_current_accounting_year_id($entreprise_id) {
        if ($query = $this->db->get_where('entreprises_accounting_year', array('is_default' => 1, 'entreprise_id' => $entreprise_id))->row())
            return $query->id;
        else
            return false;
    }

    public function close_accounting_year($accounting_year_id) {
        $entreprise_id = $this->session->userdata('entreprise_id');
        if ($this->accounting_year_entreprise_has_access($accounting_year_id, $entreprise_id)) {
            return $this->db->where('id', $accounting_year_id)->where('entreprise_id', $entreprise_id)
                    ->update('entreprises_accounting_year', array('closed' => 1));
        }
        else
            return false;
    }

    public function delete_accounting_year($accounting_year_id) {
        $entreprise_id = $this->session->userdata('entreprise_id');
        if ($this->accounting_year_entreprise_has_access($accounting_year_id, $entreprise_id)) {
            return $this->db->where('id', $accounting_year_id)->where('entreprise_id', $entreprise_id)
                    ->delete('entreprises_accounting_year');
        }
        else
            return false;
    }

    /**
     *
     *  Bank Statements Model
     * @author Karim Besbes
     * 
     */
    public function get_all_bank_statements($entreprise_id) {
        return $this->db->order_by('date', 'desc')
                ->where('entreprise_id', $entreprise_id)->get('entreprises_bank_statements')
                ->result();
    }

    public function add_new_bank_statement($data) {
        $insert_data = array(
            'entreprise_id' => $this->session->userdata('entreprise_id'),
            'bank_account_id' => $data['bank_account_id'],
            'label' => underscore($data['label']),
            'description' => $data['description'],
            'date' => $data['date'],
            'ammount' => $data['ammount']
        );


        return $this->db->insert('entreprises_bank_statements', $insert_data);
    }

    public function add_bulk_bank_statements($data) {
        foreach ($data['description'] as $key => $value) {
            $insert_data = array(
                'entreprise_id' => $this->session->userdata('entreprise_id'),
                'bank_account_id' => $data['bank_account_id'],
                'label' => $data['label'],
                'description' => $data['description'][$key],
                'ammount' => $data['ammount'][$key],
                'date' => strtotime(str_replace("/", "-", $data['date'][$key]))
            );
            $this->db->insert('entreprises_bank_statements', $insert_data);
        }
        return true;
    }

    public function update_bank_statement_row($data) {
        $update_data = array(
            'date' => $data['date'],
            'description' => $data['description'],
            'label' => $data['label'],
            'bank_account_id' => $data['bank_account_id'],
            'ammount' => $data['ammount']
        );

        return $this->db->where('id', $data['id'])->where('entreprise_id', $this->current_entreprise)
                ->update('entreprises_bank_statements', $update_data);
    }

    public function delete_bank_statement_row($id) {

        return $this->db->where('id', $id)->where('entreprise_id', $this->current_entreprise)
                ->delete('entreprises_bank_statements');
    }

    /*     * *******************************************************
     * Expenditures model 
     * @author Karim Besbes
     * ******************************************************** */

    public function add_new_expenditure($data) {
        $entreprise_id = $this->current_entreprise;
        $accounting_year_id = $this->current_accounting_year_id;
        $insert_data = array(
            'entreprise_id' => $entreprise_id,
            'expenditure_type_id' => $data['expenditure_type_id'],
            'accounting_year_id' => $accounting_year_id,
            'description' => $data['description'],
            'date' => strTotime($data['date']),
            'ht' => $data['ht'],
            'tva' => $data['tva'],
            'file_path' => $data['file_path'],
            'description' => $data['description']
        );
        return $this->db->insert('entreprises_expenditures', $insert_data);
    }

    /**
     * Get expenditure type
     */
    public function get_expenditure_type() {
        return $this->db->select()->where('type', 'expenditure')->get('entreprises_in_ex_type ')->result();
    }
    
    /**
     * Get all entreprise expenditure data
     */
    
    public function get_all_expenditures()           
    {
        return $this->db->get_where('entreprises_expenditures', array('entreprise_id' => $this->current_entreprise, 'accounting_year_id' => $this->current_accounting_year_id))->result();
    }

    /*     * ******************************************************
     * Incomes model 
     * @author Karim Besbes
     * ******************************************************** */

    public function add_new_income($data) {
        $entreprise_id = $this->current_entreprise;
        $accounting_year_id = $this->current_accounting_year_id;
        $insert_data = array(
            'entreprise_id' => $entreprise_id,
            'income_type_id' => $data['income_type_id'],
            'client_id' => $data['client_id'],
            'accounting_year_id' => $accounting_year_id,
            'description' => $data['description'],
            'date' => strTotime($data['date']),
            'ht' => $data['ht'],
            'tva' => $data['tva'],
            'file_path' => $data['file_path'],
            'description' => $data['description']
        );
        return $this->db->insert('entreprises_incomes', $insert_data);
    }

    /**
     * Get expenditure type
     */
    public function get_income_type() {
        return $this->db->select('id,label')->where('type', 'income')->get('entreprises_in_ex_type ')->result();
    }

    /*     * ******************************************************
     * Clients model 
     * @author Karim Besbes
     * ******************************************************** */
    
    public function get_clients_all()
    {
        return $this->db->get('entreprises_clients')->result();
    }
}
