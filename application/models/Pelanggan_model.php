<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_model extends CI_Model {

    public function get_all_pelanggan() {
        return $this->db->get('pelanggan')->result_array();
    }

    public function get_pelanggan_by_id($idpelanggan) {
        return $this->db->get_where('pelanggan', ['idpelanggan' => $idpelanggan])->row_array();
    }

    public function insert_pelanggan($data) {
        return $this->db->insert('pelanggan', $data);
    }

    public function update_pelanggan($idpelanggan, $data) {
        $this->db->where('idpelanggan', $idpelanggan);
        return $this->db->update('pelanggan', $data);
    }

    public function delete_pelanggan($idpelanggan) {
        $this->db->where('idpelanggan', $idpelanggan);
        return $this->db->delete('pelanggan');
    }
}