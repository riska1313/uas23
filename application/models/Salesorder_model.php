<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salesorder_model extends CI_Model {

    public function get_all_salesorder() {
        $this->db->select('so.*, p.nama as nama_pelanggan, s.nama_sales');
        $this->db->from('salesorder so');
        $this->db->join('pelanggan p', 'so.idpelanggan = p.idpelanggan');
        $this->db->join('sales s', 'so.idsales = s.idsales');
        $this->db->order_by('so.tanggal', 'DESC');
        return $this->db->get()->result_array();
    }

 
    public function insert_salesorder($data, $details) {
        $this->db->trans_start();

        $this->db->insert('salesorder', $data);
        $idso = $this->db->insert_id();

        foreach ($details as $item) {
            $item['idso'] = $idso;
            $this->db->insert('detail_so', $item);

            // Kurangi stok produk
            $this->db->set('stok', 'stok - ' . intval($item['jumlah']), FALSE);
            $this->db->where('idproduk', $item['idproduk']);
            $this->db->update('produk');
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    // Ambil data sales order berdasarkan ID
    public function get_salesorder_by_id($idso) {
        $this->db->select('so.*, p.nama as nama_pelanggan, s.nama_sales');
        $this->db->from('salesorder so');
        $this->db->join('pelanggan p', 'so.idpelanggan = p.idpelanggan');
        $this->db->join('sales s', 'so.idsales = s.idsales');
        $this->db->where('so.idso', $idso);
        $order = $this->db->get()->row_array();

        if ($order) {
            $order['details'] = $this->get_detail_by_salesorder($idso);
        }

        return $order;
    }

    // Ambil detail produk dari satu sales order
    public function get_detail_by_salesorder($idso) {
        $this->db->select('dso.*, pr.nama_produk, pr.harga');
        $this->db->from('detail_so dso');
        $this->db->join('produk pr', 'dso.idproduk = pr.idproduk');
        $this->db->where('dso.idso', $idso);
        return $this->db->get()->result_array();
    }

    // Update data sales order
    public function update_salesorder($idso, $data, $details) {
        $this->db->trans_start();

        $this->db->where('idso', $idso);
        $this->db->update('salesorder', $data);

        // Kembalikan stok dari detail lama
        $old_details = $this->get_detail_by_salesorder($idso);
        foreach ($old_details as $item) {
            $this->db->set('stok', 'stok + ' . intval($item['jumlah']), FALSE);
            $this->db->where('idproduk', $item['idproduk']);
            $this->db->update('produk');
        }

        // Hapus detail lama
        $this->db->delete('detail_so', ['idso' => $idso]);

        // Insert detail baru dan kurangi stok
        foreach ($details as $item) {
            $item['idso'] = $idso;
            $this->db->insert('detail_so', $item);

            $this->db->set('stok', 'stok - ' . intval($item['jumlah']), FALSE);
            $this->db->where('idproduk', $item['idproduk']);
            $this->db->update('produk');
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    // Hapus sales order dan kembalikan stok
    public function delete_salesorder($idso) {
        $this->db->trans_start();

        $details = $this->get_detail_by_salesorder($idso);
        foreach ($details as $item) {
            $this->db->set('stok', 'stok + ' . intval($item['jumlah']), FALSE);
            $this->db->where('idproduk', $item['idproduk']);
            $this->db->update('produk');
        }

        $this->db->delete('detail_so', ['idso' => $idso]);
        $this->db->delete('salesorder', ['idso' => $idso]);

        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}