<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('level')!='admin'){
            redirect('home');
        }
    }
	public function index(){
        $this->db->select('*')->from('user');
        $this->db->order_by('nama','ASC');
        $user = $this->db->get()->result_array();
        $data = array(
            'judul_halaman' => 'Kasir | Pengguna',
            'user'          => $user,
        );
		$this->template->load('template','pengguna_index', $data);
	}
    public function simpan(){
        $this->db->from('user')->where('username',$this->input->post('username'));
        $cek = $this->db->get()->result_array();
        if($cek==NULL){
            $data = array(
                'username'      => $this->input->post('username'),
                'nama'          => $this->input->post('nama'),
                'password'      => md5($this->input->post('password')),
                'level'         => $this->input->post('level'),
            );
            $this->db->insert('user',$data);
            $this->session->set_flashdata('notif',
            '<div class="alert alert-danger alert-dismissible" role="alert">
            Berhasil menambah pengguna
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>');
        } else {
            $this->session->set_flashdata('notif',
            '<div class="alert alert-danger alert-dismissible" role="alert">
            Username sudah digunakan!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>');
        }
        redirect('pengguna');
    }
    public function hapus($id_user){
        $where = array('id_user' => $id_user);
        $this->db->delete('user',$where);
        $this->session->set_flashdata('notif',
        '<div class="alert alert-danger alert-dismissible" role="alert">
            Pengguna berhasil dihapus
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
        redirect('pengguna');
    }
    public function update(){
        $where = array(
            'id_user'       => $this->input->post('id_user'),
        );
        $data = array(
        'nama'          => $this->input->post('nama'),
        'password'      => md5($this->input->post('password')),
        'level'         => $this->input->post('level'),
        );
        $this->db->update('user',$data,$where);
        $this->session->set_flashdata('notif',
        '<div class="alert alert-danger alert-dismissible" role="alert">
            Pengguna berhasil di Edit 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
        redirect('pengguna');
    }
}
