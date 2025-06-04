<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Pelanggan_model');
        $this->load->library('form_validation');
    }

    // Menampilkan semua data pelanggan
    public function index(){
        $data['pelanggan'] = $this->Pelanggan_model->get_all_pelanggan();
        $this->load->view('templates/header');
        $this->load->view('pelanggan/index', $data);
        $this->load->view('templates/footer');
    }

    // Tampilkan form tambah pelanggan
    public function tambah(){
        $this->load->view('templates/header');
        $this->load->view('pelanggan/form_pelanggan');
        $this->load->view('templates/footer');
    }

    // Proses simpan pelanggan baru
    public function insert(){
        $this->form_validation->set_rules('nama', 'Nama Pelanggan', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_telp', 'no_telp', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'no_telp' => $this->input->post('no_telp')
            ];
            $insert = $this->Pelanggan_model->insert_pelanggan($data);
            if ($insert) {
                $this->session->set_flashdata('success', 'Pelanggan berhasil disimpan.');
            } else {
                $this->session->set_flashdata('error', 'Gagal menyimpan pelanggan.');
            }
            redirect('pelanggan');
        }
    }

    // Tampilkan form edit pelanggan
    public function edit($idpelanggan){
        $data['pelanggan'] = $this->Pelanggan_model->get_pelanggan_by_id($idpelanggan);
        if (!$data['pelanggan']) {
            show_404();
        }
        $this->load->view('templates/header');
        $this->load->view('pelanggan/edit_pelanggan', $data);
        $this->load->view('templates/footer');
    }

    // Proses update pelanggan
    public function update($idpelanggan){
        $this->form_validation->set_rules('nama', 'Nama Pelanggan', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_telp', 'no_telp', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->edit($idpelanggan);
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'no_telp' => $this->input->post('no_telp')
            ];
            $update = $this->Pelanggan_model->update_pelanggan($idpelanggan, $data);
            if ($update) {
                $this->session->set_flashdata('success', 'Pelanggan berhasil diupdate.');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengupdate pelanggan.');
            }
            redirect('pelanggan');
        }
    }

    // Hapus pelanggan
    public function hapus($idpelanggan){
        $delete = $this->Pelanggan_model->delete_pelanggan($idpelanggan);
        if ($delete) {
            $this->session->set_flashdata('success', 'Pelanggan berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus pelanggan.');
        }
        redirect('pelanggan');
    }
}