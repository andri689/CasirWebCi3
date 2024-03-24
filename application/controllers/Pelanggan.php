<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('level')==NULL){
            redirect('auth');
        }
    }
	public function index(){
        $this->db->select('*')->from('pelanggan');
        $this->db->order_by('nama','ASC');
        $user = $this->db->get()->result_array();
        $data = array(
            'judul_halaman' => 'Kasir | Pelanggan',
            'user'          => $user,
        );
		$this->template->load('template','pelanggan_index', $data);
	}
    public function simpan(){
        $data = array(
            'nama'          => $this->input->post('nama'),
            'alamat'        => $this->input->post('alamat'),
            'telp'          => $this->input->post('telp'),
        );
        $this->db->insert('pelanggan',$data);
        $this->session->set_flashdata('notif',
        '<div class="alert alert-danger alert-dismissible" role="alert">
        Berhasil menambah Pelanggan
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
        redirect('pelanggan');
    }
    public function hapus($id_pelanggan){
        $where = array('id_pelanggan' => $id_pelanggan);
        $this->db->delete('Pelanggan',$where);
        $this->session->set_flashdata('notif',
        '<div class="alert alert-danger alert-dismissible" role="alert">
            Pelanggan berhasil dihapus
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
        redirect('pelanggan');
    }
    public function update($id_pelanggan){
        $where = array(
            'id_pelanggan'       => $this->input->post('id_pelanggan'),
        );
        $data = array(
            'nama'          => $this->input->post('nama'),
            'alamat'        => $this->input->post('alamat'),
            'telp'          => $this->input->post('telp'),
        );
        $this->db->update('pelanggan',$data,$where);
        $this->session->set_flashdata('notif',
        '<div class="alert alert-danger alert-dismissible" role="alert">
            Pelanggan berhasil di Edit 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
        redirect('pelanggan');
    }
}
