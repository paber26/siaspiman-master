<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dpm_model extends CI_model
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dosen_model');
    }

    // public function cariArsip($keyword){
    //     $this->db->select('*');
    //     $this->db->from('arsip');
    //     $this->db->like('file',$keyword);
    //     $this->db->or_like('keterangan',$keyword);
    //     $this->db->or_like('uploadAt',$keyword);
    //     $this->db->order_by("uploadAt", "DESC");
    //     return $this->db->get()->result_array();
    // }

}
