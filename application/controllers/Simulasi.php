<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simulasi extends CI_Controller {
    public function index() {
        $this->load->database();
        $data['title'] = 'Simulasi Investasi';
        $data['user'] = array(
            'name' => $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'),
            'email' => $this->session->userdata('email'),
            'experience' => $this->session->userdata('investment_experience')
        );
        // Ambil produk investasi
        $data['products'] = $this->db->get('investment_products')->result();
        $data['result'] = null;
        if ($this->input->post('hitung')) {
            $awal = (float)$this->input->post('dana_awal');
            $bulanan = (float)$this->input->post('investasi_bulanan');
            $durasi = (int)$this->input->post('durasi');
            $produk_id = (int)$this->input->post('produk_id');
            $produk = $this->db->where('id', $produk_id)->get('investment_products')->row();
            $rate = $produk ? (float)$produk->expected_return : 0;
            // Simulasi: bunga majemuk bulanan
            $total = $awal;
            for($i=1;$i<=$durasi;$i++) {
                $total = ($total + $bulanan) * (1 + $rate/100/12);
            }
            $data['result'] = array(
                'produk' => $produk,
                'awal' => $awal,
                'bulanan' => $bulanan,
                'durasi' => $durasi,
                'rate' => $rate,
                'total' => round($total,2),
                'keuntungan' => round($total - ($awal + $bulanan*$durasi),2)
            );
        }
        $this->load->view('dashboard/header', $data);
        $this->load->view('simulasi/index', $data);
        $this->load->view('dashboard/footer');
    }
} 