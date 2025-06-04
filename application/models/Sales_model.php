<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_model extends CI_Model {

    public function get_all() {
        return $this->db->get('sales')->result_array();
    }

    public function get_by_id($idsales) {
        return $this->db->get_where('sales', ['idsales' => $idsales])->row_array();
    }

    public function insert($data) {
        return $this->db->insert('sales', $data);
    }

    public function update($idsales, $data) {
        $this->db->where('idsales', $idsales);
        return $this->db->update('sales', $data);
    }

    public function delete($idsales) {
        return $this->db->delete('sales', ['idsales' => $idsales]);
    }
}