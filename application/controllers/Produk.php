<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('level')!='admin'){
            redirect('home');
        }
    }
	public function index(){
        $this->db->select('*')->from('produk');
        $this->db->order_by('nama','ASC');
        $user = $this->db->get()->result_array();
        $data = array(
            'judul_halaman' => 'Kasir | Produk',
            'user'          => $user,
        );
		$this->template->load('template','produk_index', $data);
	}
    public function simpan(){
        $this->db->from('produk')->where('kode_produk',$this->input->post('kode_produk'));
        $cek = $this->db->get()->result_array();
        if($cek==NULL){
            $data = array(
                'stok'            => $this->input->post('stok'),
                'nama'            => $this->input->post('nama'),
                'harga'           => $this->input->post('harga'),
                'kode_produk'     => $this->input->post('kode_produk'),
            );
            $this->db->insert('produk',$data);
            $this->session->set_flashdata('notif',
            '<div class="alert alert-danger alert-dismissible" role="alert">
            Berhasil menambah produk
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>');
        } else {
            $this->session->set_flashdata('notif',
            '<div class="alert alert-danger alert-dismissible" role="alert">
            Produk sudah digunakan!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>');
        }
        redirect('produk');
    }
    public function hapus($id_produk){
        $where = array('id_produk' => $id_produk);
        $this->db->delete('produk',$where);
        $this->session->set_flashdata('notif',
        '<div class="alert alert-danger alert-dismissible" role="alert">
            Produk berhasil dihapus
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
        redirect('produk');
    }
    public function update(){
        $where = array(
            'id_produk'       => $this->input->post('id_produk'),
        );
        $data = array(
            'stok'            => $this->input->post('stok'),
            'nama'            => $this->input->post('nama'),
            'harga'           => $this->input->post('harga'),
            'kode_produk'     => $this->input->post('kode_produk'),
        );
        $this->db->update('produk',$data,$where);
        $this->session->set_flashdata('notif',
        '<div class="alert alert-danger alert-dismissible" role="alert">
            produk berhasil di Edit 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
        redirect('produk');
    }
    public function print(){
        $this->db->select('*')->from('produk');
        $this->db->order_by('nama','ASC');
        $status = $this->input->get('status');
        if($status=='Ada'){
            $this->db->where('stok >', 0);
        } else if($status=='Habis'){
            $this->db->where('stok', 0);
        }
        $produk = $this->db->get()->result_array();
        
        $data = array(
            'status'          => $status,
            'produk'          => $produk,
        );
        $this->load->view('print_produk', $data);
    }
}
