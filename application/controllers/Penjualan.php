<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('level')==NULL){
            redirect('auth');
        }
    }
	public function index(){
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('y-m-d');
        $this->db->select('*');
        $this->db->from('penjualan a')->order_by('a.tanggal','DESC')->where('a.tanggal',$tanggal);
        $this->db->join('pelanggan b', 'a.id_pelanggan=b.id_pelanggan','left');
        $user = $this->db->get()->result_array();

        $this->db->from('pelanggan')->order_by('nama','ASC');
        $pelanggan = $this->db->get()->result_array();
        $data = array(
            'judul_halaman' => 'Kasir | Produk',
            'user'          => $user,
            'pelanggan'     => $pelanggan,
        );
		$this->template->load('template','penjualan_index', $data);
	}
    public function transaksi($id_pelanggan){
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m');
        $this->db->from('penjualan');
        $this->db->where("DATE_FORMAT(tanggal,'%Y-%m')",$tanggal); 
        $jumlah = $this->db->count_all_results();
        $nota = date('ymd').$jumlah+1;

        $this->db->from('produk')->where('stok >',0)->order_by('nama','ASC');
        $produk = $this->db->get()->result_array();

        $this->db->from('pelanggan')->where('id_pelanggan',$id_pelanggan);
        $namapelanggan = $this->db->get()->row()->nama;

        $this->db->from('detail_penjualan a');
        $this->db->join('produk b', 'a.id_produk=b.id_produk','left');
        $this->db->where('a.kode_penjualan',$nota);
        $detail = $this->db->get()->result_array();
        $data = array(
            'judul_halaman' => 'Transaksi Penjualan',
            'nota'          => $nota,
            'produk'        => $produk,
            'id_pelanggan'  => $id_pelanggan,
            'namapelanggan' => $namapelanggan,
            'detail'        => $detail,
        );
		$this->template->load('template','penjualan_transaksi', $data);
    } 
	public function tambahkeranjang(){
		$this->db->from('detail_penjualan');
		$this->db->where('id_produk',$this->input->post('id_produk'));
		$this->db->where('kode_penjualan',$this->input->post('kode_penjualan'));
		$cek = $this->db->get()->result_array();
		if($cek<>NULL){
			$this->session->set_flashdata('notifikasi',
			'<div class="alert alert-danger alert-dismissible" role="alert">
				Produk sudah dipilih
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>'
			);
			redirect($_SERVER["HTTP_REFERER"]);
		}

		$this->db->from('produk')->where('id_produk',$this->input->post('id_produk'));
		$harga = $this->db->get()->row()->harga;

		$this->db->from('produk')->where('id_produk',$this->input->post('id_produk'));
		$stok_lama = $this->db->get()->row()->stok;
		$stok_sekarang = $stok_lama-$this->input->post('jumlah');

		$sub_total = $this->input->post('jumlah')*$harga; 
		$data = array(
			'kode_penjualan'	=> $this->input->post('kode_penjualan'),
			'id_produk'			=> $this->input->post('id_produk'),
			'jumlah'			=> $this->input->post('jumlah'),
			'sub_total'			=> $sub_total,
		);
		if($stok_lama>=$this->input->post('jumlah')){
			$this->db->insert('detail_penjualan',$data);
			$data2 = array('stok'	=> $stok_sekarang );
			$where = array('id_produk'	=> $this->input->post('id_produk') );
			$this->db->update('produk',$data2,$where);
			$this->session->set_flashdata('notifikasi',
			'<div class="alert alert-danger alert-dismissible" role="alert">
				Produk Berhasil di tambah ke keranjang
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>'
			);
		} else {
			$this->session->set_flashdata('notifikasi',
			'<div class="alert alert-danger alert-dismissible" role="alert">
				Produk Yang dipilih tidak mencukupi!
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>'
			);
		}
		redirect($_SERVER["HTTP_REFERER"]);
	}
    public function bayar(){
        $data = array(
            'kode_penjualan'     => $this->input->post('kode_penjualan'),
            'id_pelanggan'       => $this->input->post('id_pelanggan'),
            'total_harga'        => $this->input->post('total_harga'),
            'tanggal'            => date('Y-m-d'),
        );
        $this->db->insert('penjualan',$data);
        $this->session->set_flashdata('notif',
        '<div class="alert alert-danger alert-dismissible" role="alert">
            Penjualan Berhasil
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
        redirect('penjualan/invoice/'.$this->input->post('kode_penjualan'));
    }
    public function invoice($kode_penjualan){
		$this->db->select('*');
		$this->db->from('penjualan a')->order_by('a.tanggal','DESC')->where('a.kode_penjualan',$kode_penjualan);
		$this->db->join('pelanggan b', 'a.id_pelanggan=b.id_pelanggan','left');
        $penjualan = $this->db->get()->row();

		$this->db->from('detail_penjualan a');
		$this->db->join('produk b', 'a.id_produk=b.id_produk','left');
		$this->db->where('a.kode_penjualan',$kode_penjualan);
		$detail = $this->db->get()->result_array();

		$data = array(
			'judul_halaman'		=> 'Aplikasi Kasir | Transaksi Penjualan',
			'nota'				=> $kode_penjualan,
			'penjualan'			=> $penjualan,
			'detail'			=> $detail,
		);
		$this->template->load('template','invoice', $data);
	}
    public function print($kode_penjualan){
        $this->db->select('*');
        $this->db->from('penjualan a')->order_by('a.tanggal','DESC')->where('a.kode_penjualan',$kode_penjualan);
        $this->db->join('pelanggan b', 'a.id_pelanggan=b.id_pelanggan','left');
        $penjualan = $this->db->get()->row();

        $this->db->from('detail_penjualan a');
        $this->db->join('produk b', 'a.id_produk=b.id_produk','left');
        $this->db->where('a.kode_penjualan',$kode_penjualan);

        $detail = $this->db->get()->result_array();
        $data = array(
            'judul_halaman' => 'Struk Pembayaran',
            'nota'          => $kode_penjualan,
            'penjualan'     => $penjualan,
            'detail'        => $detail,
        );
        $this->load->view('struk',$data);
    }
    public function hapus($id_detail,$id_produk){
        $this->db->from('detail_penjualan')->where('id_detail', $id_detail);
        $jumlah = $this->db->get()->row()->jumlah;

        $this->db->from('produk')->where('id_produk', $id_produk);
        $stok_lama = $this->db->get()->row()->stok;
        $stok_sekarang = $jumlah+$stok_lama;

        $data2 = array('stok' => $stok_sekarang );
        $where = array( 'id_produk' => $id_produk);
        $this->db->update('produk',$data2,$where);

        $where = array('id_detail' => $id_detail);
        $this->db->delete('detail_penjualan', $where);
        $this->session->set_flashdata('notif',
        '<div class="alert alert-danger alert-dismissible" role="alert">
            Produk berhasil dihapus dari Keranjang
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function laporan(){
        date_default_timezone_set('Asia/Jakarta');
        $tanggal1 = $this->input->get('tanggal1');
        $tanggal2 = $this->input->get('tanggal2');
        $this->db->select('*');
        $this->db->from('penjualan a')->order_by('a.tanggal','DESC');
        $this->db->join('pelanggan b', 'a.id_pelanggan=b.id_pelanggan','left');
        $this->db->where('a.tanggal <=', $tanggal2);
        $this->db->where('a.tanggal >=', $tanggal1);
        $penjualan = $this->db->get()->result_array();
        $data = array(
            'tanggal1'     => $tanggal1,
            'tanggal2'     => $tanggal2,
            'penjualan'     => $penjualan,
        );
		$this->load->view('laporan', $data);
	}
}
