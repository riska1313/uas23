<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class produk extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Produk_model');
    }

    public function index() {
        $data['produk'] = $this->Produk_model->get_all_produk();
        $this->load->view('templates/header');
        $this->load->view('produk/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah() {
        $this->load->view('templates/header');
        $this->load->view('produk/form_produk');
        $this->load->view('templates/footer');
    }

    public function insert() {
        $data = [
            'kode_produk' => $this->input->post('kode_produk'),
            'nama_produk' => $this->input->post('nama_produk'),
            'harga'       => $this->input->post('harga'),
            'stok'        => $this->input->post('stok')
        ];

        $result = $this->Produk_model->insert_produk($data);

        if ($result) {
            $this->session->set_flashdata('success', 'Produk berhasil disimpan');
        } else {
            $this->session->set_flashdata('error', 'Produk gagal disimpan');
        }
        redirect('produk');
    }

    public function hapus($idproduk) {
        $this->Produk_model->delete_produk($idproduk);
        redirect('produk');
    }

    public function edit($idproduk) {
        $data['produk'] = $this->Produk_model->get_produk_by_id($idproduk);
        $this->load->view('templates/header');
        $this->load->view('produk/edit_produk', $data);
        $this->load->view('templates/footer');
    }

    public function update($id) {
        $this->form_validation->set_rules('kode_produk', 'Kode Produk', 'required');
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');

        if ($this->form_validation->run() === FALSE) {
            $this->edit($id);
        } else {
            $data = [
                'kode_produk' => $this->input->post('kode_produk'),
                'nama_produk' => $this->input->post('nama_produk'),
                'harga'       => $this->input->post('harga'),
                'stok'        => $this->input->post('stok')
            ];
            $this->Produk_model->update_produk($id, $data);
            redirect('produk');
        }
    }

    public function laporan() {
        $this->load->view('templates/header');
        $this->load->view('produk/laporan_form');
        $this->load->view('templates/footer');
    }

    public function cetak_laporan() {
        $tanggal_dari   = $this->input->post('tanggal_dari');
        $tanggal_sampai = $this->input->post('tanggal_sampai');

        $data['produk'] = $this->Produk_model->get_laporan_produk($tanggal_dari, $tanggal_sampai);
        $data['tanggal_dari'] = $tanggal_dari;
        $data['tanggal_sampai'] = $tanggal_sampai;

        $this->load->view('templates/header');
        $this->load->view('produk/laporan_hasil', $data);
        $this->load->view('templates/footer');
    }
}