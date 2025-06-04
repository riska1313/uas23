<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_model extends CI_Model {

    protected $table = 'sales';

    public function get_all_sales() {
        return $this->db->get($this->table)->result_array();
    }

    public function get_sales_by_id($idsales) {
        return $this->db->get_where($this->table, ['idsales' => $idsales])->row_array();
    }

    public function insert_sales($data) {
        return $this->db->insert($this->table, $data);
    }

    public function update_sales($idsales, $data) {
        $this->db->where('idsales', $idsales);
        return $this->db->update($this->table, $data);
    }

    public function delete_sales($idsales) {
        $this->db->where('idsales', $idsales);
        return $this->db->delete($this->table);
    }
}