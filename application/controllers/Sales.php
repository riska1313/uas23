<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Sales_model');
        $this->load->library('form_validation');
    }

    public function index(){
        $data['sales'] = $this->Sales_model->get_all_sales();
        $this->load->view('templates/header');
        $this->load->view('sales/index', $data);
        $this->load->view('templates/footer');
    }

    // Tampilkan form tambah sales
    public function tambah(){
        $this->load->view('templates/header');
        $this->load->view('sales/form_sales');
        $this->load->view('templates/footer');
    }

    // Proses simpan sales baru
    public function insert(){
        $this->form_validation->set_rules('idsales', 'ID Sales', 'required');
        $this->form_validation->set_rules('nama_sales', 'Nama Sales', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            $data = [
                'idsales' => $this->input->post('idsales'),
                'nama_sales' => $this->input->post('nama_sales')
            ];

            $insert = $this->Sales_model->insert_sales($data);
            if ($insert) {
                $this->session->set_flashdata('success', 'Sales berhasil disimpan.');
            } else {
                $this->session->set_flashdata('error', 'Gagal menyimpan sales.');
            }
            redirect('sales');
        }
    }

    // Tampilkan form edit sales
    public function edit($idsales){
        $data['sales'] = $this->Sales_model->get_sales_by_id($idsales);
        if (!$data['sales']) {
            show_404();
        }
        $this->load->view('templates/header');
        $this->load->view('sales/form_edit_sales', $data);
        $this->load->view('templates/footer');
    }

    // Proses update sales
    public function update($idsales){
        $this->form_validation->set_rules('idsales', 'ID Sales', 'required');
        $this->form_validation->set_rules('nama_sales', 'Nama Sales', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->edit($idsales);
        } else {
            $data = [
                'idsales' => $this->input->post('idsales'),
                'nama_sales' => $this->input->post('nama_sales')
            ];

            $update = $this->Sales_model->update_sales($idsales, $data);
            if ($update) {
                $this->session->set_flashdata('success', 'Sales berhasil diupdate.');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengupdate sales.');
            }
            redirect('sales');
        }
    }

    // Hapus sales
    public function hapus($idsales){
        $delete = $this->Sales_model->delete_sales($idsales);
        if ($delete) {
            $this->session->set_flashdata('success', 'Sales berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus sales.');
        }
        redirect('sales');
    }
}