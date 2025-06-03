<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class produk extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('produk_model');
    }
    public function index(){

        $data['produk']=$this->produk_model->get_all_produk();
        $this->load->view('templates/header');
        $this->load->view('produk/index' ,$data);
        $this->load->view('templates/footer');
    }
    public function tambah(){
        $data['produk']=$this->produk_model->get_all_produk();
        $this->load->view('templates/header');
        $this->load->view('produk/form_produk',$data);
        $this->load->view('templates/footer');
    }
    public function insert(){
        $kode=$this->input->post('kode_produk');
        $nama=$this->input->post('nama_produk');
        $harga=$this->input->post('harga');
        $stok=$this->input->post('stok');


        $data=array(
            'kode_produk'=>$kode,
            'nama_produk'=>$nama,
            'harga'=>$harga,
            'stok'=>$stok,
        );

        $result=$this->produk_model->insert_produk($data);

        if($result){
            $this->session->set_flashdata('success','produk berhasil disimpan');
            redirect('produk');
        }else{
            $this->session->set_flashdata('error','produk gagal disimpan');
            redirect('produk');
        }
    }
    public function hapus($idproduk){
        $this->produk_model->delete_produk($idproduk);
        redirect('produk');
        }
    public function edit($idproduk){
        $data['produk']=$this->produk_model->get_produk_by_id($idproduk);
        $this->load->view('templates/header');
        $this->load->view('produk/edit_produk',$data);
        $this->load->view('templates/footer');
        }
    public function update($id){
        $this->form_validation->set_rules('kode_produk','kode_produk','required');
        $this->form_validation->set_rules('nama_produk','nama_produk','required');
        $this->form_validation->set_rules('harga','harga','required');
        $this->form_validation->set_rules('stok','stok','required');
        if ($this->form_validation->run() === FALSE){
            $this->index($id);
        }else{
            $data = [
                'kode_produk' => $this->input->post('kode_produk'),
                'nama_produk' => $this->input->post('nama_produk'),
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok')
            ];
            $this->produk_model->update_produk($id, $data);
            redirect('produk');
        }
    }
    }