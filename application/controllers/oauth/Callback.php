<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/Format.php';
date_default_timezone_set('Asia/Jakarta');
class Callback extends CI_Controller
{

	public function __construct()
	{
		setlocale(LC_ALL, 'id_ID.utf8');
		parent::__construct();
		// $this->load->model('Login_model');
		// $this->load->model('mahasiswa_model');
		// $this->load->model('dosen_model');
	}

	public function index()
	{
		$this->load->model('Login_model');
		$get_code = $this->input->get('code');
		// var_dump($get_code);
		// if (isset($_REQUEST['code']) && $_REQUEST['code']) { //REQUEST nya di ganti GET kalo ga bisa
		if (isset($get_code)) {
			$curl_status = curl_init();

			curl_setopt_array($curl_status, [
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_URL => 'https://ws.stis.ac.id/oauth/token',
				CURLOPT_POST => 1,

				CURLOPT_POSTFIELDS => [
					'grant_type' => 'authorization_code',
					'client_id' => '18', 
					'client_secret' => 'oaFNN62EFbg6bs42LTlghUHr6MSOPdvPlRGPKIJg',
					'redirect_uri' => 'https://dpm.stis.ac.id/oauth/callback',
					'code' => $get_code
					// 'code' => $_REQUEST['code']
				]
			]);
			curl_setopt($curl_status, CURLOPT_FRESH_CONNECT, TRUE);
			$result = curl_exec($curl_status);
			curl_close($curl_status);
			$hasil = json_decode($result);
			$token = $hasil->access_token;

			$authorization = "Authorization: Bearer " . $token;

			$curl_status = curl_init();

			curl_setopt_array($curl_status, [
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_URL => 'https://ws.stis.ac.id/api/user',
				CURLOPT_HTTPHEADER => array($authorization)
			]);

			curl_setopt($curl_status, CURLOPT_FRESH_CONNECT, TRUE);

			// Dapet hasil dari oauth sipadu
			$result = curl_exec($curl_status);
			curl_close($curl_status);

			// Bikin token sendiri
			$token_sipadu = $this->Login_model->generate_token(25);
			$arr = json_decode($result);
			
			// ngecek ni mahasiswa gak?
			if (isset($arr->profile->nim)) {
				$nim = $arr->profile->nim;
				$this->Login_model->save_token($nim, $token_sipadu); // nyimpan token di db
				echo "<script>window.opener.verification('$nim', '$token_sipadu');</script>"; // validasi siapatau ada yg inject nim doang lewat js
            }
            // else if (isset($arr->profile->username)) { // oh dosen ternyata
			// 	$username = $arr->profile->username;
			// 	$nama = $arr->profile->nama;
			// 	$result = $this->dosen_model->check_dosen($nama); // ngecek apa bener yg login adalah dosen pembimbing PeKaEl
			// 	if ($result) {
			// 		$this->dosen_model->set_username($username, $nama);
			// 		$this->dosen_model->save_token($username, $token_sipadu);
			// 		echo "<script>window.opener.verification_dosen('$username', '$token_sipadu');</script>"; // validasi siapatau ada yg inject username doang lewat js
			// 	} else {
			// 		echo "<script>window.opener.error_dosen();</script>"; // bukan dosen pembimbing PKL a.k.a ga terdaftar di DB sikokuy
			// 	}
			// }
		}
	}
}
