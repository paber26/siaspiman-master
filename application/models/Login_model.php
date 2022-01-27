<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_model
{
    public function generate_token($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    public function save_token($nim, $token) {
        $this->db->where('nim', $nim);
        $this->db->update('user', array('token' => $token));
    }

    public function verifikasi_token($nim, $token_sipadu){

        $this->db->where('nim',$nim);
        $que = $this->db->get('user');
        $res = $que->row_array();
        var_dump($res);


        if ($res != null && $token_sipadu == $res['token']) {
            return 1;
        } else {
            return 0;
        }
    }
    
    // public function getMhs($nim){
    //     $this->db->select('*');
    //     $this->db->from('user');
    //     $this->db->where('nim', $nim);
    //     $query = $this->db->get();
    //     return $query->result();

    // }
}