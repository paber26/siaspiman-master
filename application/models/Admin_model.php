<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_model
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
    }


    public function hapusSambat($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('sambat');
    }

    public function hapusLaporkuota($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('kuota');
    }

    public function resetKuota()
    {
        $this->db->empty_table('kuota');
    }

    public function hapusMenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_menu');
    }

    public function hapusSubMenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_sub_menu');
    }

    public function hapusMhs($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');
    }

    public function getMhs()
    {
        $query = "SELECT *
        FROM `user`";
        return $this->db->query($query)->result_array();
    }

    public function getMhsbynim($nim){
        $this->db->where('nim',$nim); //add this line
        $query = $this->db->get('user');
        return $query->result();
    }

    public function getKuota()
    {
        $query = "SELECT *
        FROM `kuota`";
        return $this->db->query($query)->result_array();
    }

    public function getAspirasi()
    {
        $query = "SELECT *
        FROM `sambat`";
        return $this->db->query($query)->result_array();
    }

    
    public function hapusPengumuman($id){
        $this->db->where('id', $id);
        $this->db->delete('pengumuman');
    }

    public function hapusGaleri($id){
        $this->db->where('id', $id);
        $this->db->delete('galeri');
    }

    public function hapusProfil($id){
        $this->db->where('id', $id);
        $this->db->delete('struktur');
    }
}
