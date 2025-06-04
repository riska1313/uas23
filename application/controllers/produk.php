<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Produk_model');
        $this->load->library('form_validation');
    }

    public function index(){
        $data['produk'] = $this->Produk_model->get_all_produk();
        $this->load->view('templates/header');
        $this->load->view('produk/index', $data);
        $this->load->view('templates/footer');
    }

    // Tampilkan form tambah produk
    public function tambah(){
        $this->load->view('templates/header');
        $this->load->view('produk/form_produk');
        $this->load->view('templates/footer');
    }

    // Proses simpan produk baru
    public function insert(){
        $this->form_validation->set_rules('kode_produk', 'Kode Produk', 'required');
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|integer');

        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            $data = [
                'kode_produk' => $this->input->post('kode_produk'),
                'nama_produk' => $this->input->post('nama_produk'),
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok')
            ];
            $insert = $this->Produk_model->insert_produk($data);
            if ($insert) {
                $this->session->set_flashdata('success', 'Produk berhasil disimpan.');
            } else {
                $this->session->set_flashdata('error', 'Gagal menyimpan produk.');
            }
            redirect('produk');
        }
    }

    // Tampilkan form edit produk
    public function edit($idproduk){
        $data['produk'] = $this->Produk_model->get_produk_by_id($idproduk);
        if (!$data['produk']) {
            show_404();
        }
        $this->load->view('templates/header');
        $this->load->view('produk/edit_produk', $data);
        $this->load->view('templates/footer');
    }

    // Proses update produk
    public function update($idproduk){
        $this->form_validation->set_rules('kode_produk', 'Kode Produk', 'required');
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|integer');

        if ($this->form_validation->run() == FALSE) {
            $this->edit($idproduk);
        } else {
            $data = [
                'kode_produk' => $this->input->post('kode_produk'),
                'nama_produk' => $this->input->post('nama_produk'),
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok')
            ];
            $update = $this->Produk_model->update_produk($idproduk, $data);
            if ($update) {
                $this->session->set_flashdata('success', 'Produk berhasil diupdate.');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengupdate produk.');
            }
            redirect('produk');
        }
    }

    // Hapus produk
    public function hapus($idproduk){
        $delete = $this->Produk_model->delete_produk($idproduk);
        if ($delete) {
            $this->session->set_flashdata('success', 'Produk berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus produk.');
        }
        redirect('produk');
    }
}