<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengumuman_model extends CI_Model
{

    public function __construct()
    {
        $this->load->library('pagination');
        $this->load->database();
    }

    public function get_pengumuman()
    {
        $this->db->select('*');
        $this->db->from('dpm');
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result();
    }

    public function get_pengumuman_beranda()
    {
        $this->db->select('*');
        $this->db->from('dpm');
        $this->db->order_by('createdAt', 'desc');
        $this->db->order_by('judul', 'desc'); 
        $query = $this->db->get()->result();
        foreach ($query as $item) {
        $time_format = strftime("%A, %d %B %Y", strtotime($item->waktu));
        $item->waktu = $time_format;
        }
        return $query;
    }


    public function pengumuman_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('dpm');
        $this->db->where('id', $id);
        return $this->db->get()->result();
    }

    public function pengumuman($number, $offset)
    {
        $this->db->select('*');
        $this->db->from('dpm');
        $this->db->order_by('id', 'desc');
        $this->db->order_by('createdAt', 'desc');
        $this->db->limit($number, $offset);
        return $this->db->get()->result();
    }

    public function cut_text($string, $length)
    {
        $string = strip_tags($string);
        if (strlen($string) > $length) {
            $stringCut = substr($string, 0, $length);
            $endPoint = strrpos($stringCut, ' ');
            $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
            $string .= '...';
        }
        return $string;
    }
}
