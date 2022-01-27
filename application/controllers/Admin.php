<?php
defined('BASEPATH') or exit('No direct script access allowed');

require('./excel/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->helper('url', 'form');

    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['summarySambat'] = $this->db->get('summarySambat')->row_array();
        $data['summaryUser'] = $this->db->get('summaryUser')->row_array();
        $data['kuota'] = $this->db->get('kuota')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }


    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }


    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Access Changed!</div>');
    }
    
    public function isipengumuman()
    {
        $data['title'] = 'Pengumuman';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by("createdAt", "DESC");
        $data['pengumuman'] = $this->db->get('pengumuman')->result_array();

        $this->form_validation->set_rules('judul', 'Judul', 'required|trim');
        $this->form_validation->set_rules('isi', 'Isi', 'required|trim');

        $config['upload_path'] = './assets/img/pengumuman/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2048; //2MB
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('uploadimage')) {
            $img = $this->upload->data("file_name");
        }else{
            $img = "default-img.jpg";
        }
         
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/isipengumuman', $data);
            $this->load->view('templates/footer');
        } else {
            $judul = $this->input->post('judul', true);
            $isi = $this->input->post('isi', true);
            date_default_timezone_set("Asia/Jakarta");

            $data = [
                'judul' => $judul,
                'createdAt' => date("Y-m-d H:i:sa"),
                'createdBy' => $data['user']['name'],
                'isi' => $isi,
                'img' => $img
            ];
            $this->db->insert('pengumuman', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengumuman berhasil terkirim
            </div>');
            redirect('admin/isipengumuman');
        }
    }

    public function hapuspengumuman($id){
        $img = $this->db->get_where('pengumuman', ['id' => $id])->row_array();
        if ($img['img'] != "default-img.jpg") {
            $filename = $img['img'];
            // return array_map('unlink', glob(FCPATH."assets\img\pengumuman\$filename.*"));
            unlink('assets/img/pengumuman/'.$filename.'');
        }
        $this->load->model('Admin_model', 'isipengumuman');
        $this->Admin_model->hapusPengumuman($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Pengumuman berhasil dihapus</div>');
        redirect('admin/isipengumuman');

    }

    public function isigaleri(){
        $data['title'] = 'Galeri';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by("uploadAt", "DESC");
        $data['galeri'] = $this->db->get('galeri')->result_array();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('folder', 'folder', 'required|trim');
        // $this->form_validation->set_rules('file', 'File', 'required|trim');

         
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/isigaleri', $data);
            $this->load->view('templates/footer');

            // $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">File gagal terkirim </div>');
        } else {
            $folder = $this->input->post('folder', true);

            $config['upload_path'] = './assets/img/galeri/'.$folder.'/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 2048; //2MB
            $config['max_width'] = 1500;
            $config['max_height'] = 1500;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('uploadimg')) {
                $img = $this->upload->data("file_name");
            }else{
                $img = "default-img.jpg";
            }
            
            date_default_timezone_set("Asia/Jakarta");

            $data = [
                'uploadAt' => date("Y-m-d H:i:sa"),
                'uploadBy' => $data['user']['name'],
                'folder' => $folder,
                'file' => $img
            ];
            $this->db->insert('galeri', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Gambar berhasil terkirim
            </div>');
            redirect('admin/isigaleri');
        }

    }

    public function hapusgaleri($id){
        $img = $this->db->get_where('galeri', ['id' => $id])->row_array();
        if ($img['file'] != "default-img.jpg") {
            $filename = $img['file'];
            // return array_map('unlink', glob(FCPATH."assets\img\pengumuman\$filename.*"));
            unlink('assets/img/galeri/'.$filename.'');
        }
        $this->load->model('Admin_model', 'isigaleri');
        $this->Admin_model->hapusGaleri($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Galeri berhasil dihapus</div>');
        redirect('admin/isigaleri');

    }

    public function isiprofil(){
        $data['title'] = 'Struktur Profil';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by("idJabatan", "ASC");
        $data['struktur'] = $this->db->get('struktur')->result_array();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama', 'nama', 'required|trim');
        $this->form_validation->set_rules('nim', 'nim', 'required|trim');
        $this->form_validation->set_rules('kelas', 'kelas', 'required|trim');

         
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/isiprofil', $data);
            $this->load->view('templates/footer');

        } else {
            $nama = $this->input->post('nama', true);
            $nim = $this->input->post('nim', true);
            $kelas = $this->input->post('kelas', true);
            $idJbt = $this->input->post('jbt', true);
            // $idJbt = intval($idJabatan);

            if ($idJbt == 1) {
                $jbt = 'Ketua DPM';
            }
            elseif($idJbt == 2){
                $jbt = 'Wakil Ketua DPM';
            }
            elseif($idJbt == 3){
                $jbt = 'Sekretaris';
            }
            elseif( $idJbt == 4){
                $jbt = 'Bendahara';
            }
            elseif( $idJbt == 51){
                $jbt = 'Ketua Komisi I';
            }
            elseif( $idJbt == 52){
                $jbt = 'Ketua Komisi II';
            }
            elseif( $idJbt == 53){
                $jbt = 'Ketua Komisi III';
            }
            elseif( $idJbt == 54){
                $jbt = 'Ketua Komisi IV';
            }
            elseif( $idJbt == 60){
                $jbt = 'Ketua Pubdok';
            }

            $config['upload_path'] = './assets/img/struktur/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 2048; //2MB
            $config['max_width'] = 1500;
            $config['max_height'] = 1500;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('uploadimg')) {
                $img = $this->upload->data("file_name");
            }else{
                $img = "default-img.png";
            }

            
            date_default_timezone_set("Asia/Jakarta");

            $data = [
                'idJabatan' => $idJbt,
                'jabatan' => $jbt,
                'nama' => $nama,
                'nim' => $nim,
                'kelas' => $kelas,
                'img' => $img
            ];
            $this->db->insert('struktur', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Profil '.$jbt.' berhasil ditambahkan
            </div>');
            redirect('admin/isiprofil');
        }

    }

    public function hapusprofil($id){
        $img = $this->db->get_where('struktur', ['id' => $id])->row_array();
        if ($img['img'] != "default-img.png") {
            $filename = $img['img'];
            // return array_map('unlink', glob(FCPATH."assets\img\pengumuman\$filename.*"));
            unlink('assets/img/struktur/'.$filename.'');
        }
        $this->load->model('Admin_model', 'isiprofil');
        $this->Admin_model->hapusProfil($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Profil berhasil dihapus</div>');
        redirect('admin/isiprofil');

    }

    public function isiaspirasi()
    {
        $data['title'] = 'Isi Aspirasi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by("date_created", "DESC");
        $data['sambat'] = $this->db->get('sambat')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/isiaspirasi', $data);
        $this->load->view('templates/footer');
    }

    public function isilaporkuota()
    {
        $data['title'] = 'Isi Pelaporan Kuota';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['kuota'] = $this->db->get('kuota')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/isilaporkuota', $data);
        $this->load->view('templates/footer');
    }

    public function resetkuota(){
        $this->load->model('Admin_model', 'isilaporkuota');
        $this->Admin_model->resetKuota();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data pelaporan kuota bulan '.date('F').' telah dihapus</div>');
        redirect('admin/isilaporkuota');
    }

    public function hapusdokumen($id){
        $dkmn = $this->db->get_where('arsip', ['id' => $id])->row_array();
        unlink('assets/arsip/dokumen/'.$dkmn['file'].'');
        
        $this->db->where('id', $id);
        $this->db->delete('arsip');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Dokumen berhasil dihapus</div>');
        redirect('dpm/arsip');
    }

    public function databasemhs()
    {
        $data['title'] = 'Database Mahasiswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['database'] = $this->db->get('user')->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/databaseMhs', $data);
        $this->load->view('templates/footer');
    }

    public function daftar()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Registration';

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('nim', 'Nim', 'required|trim|min_length[7]');
        $this->form_validation->set_rules('kelas', 'Kelas', 'required|trim');
        $this->form_validation->set_rules('nohp', 'Nohp', 'required|trim|min_length[11]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'matches' => 'password dont match!',
            'min_length' => 'password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/daftar', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name', true);
            $nim = $this->input->post('nim', true);
            $kelas = $this->input->post('kelas', true);
            $nohp = $this->input->post('nohp', true);
            $email = $this->input->post('email', true);
            $password1 = $this->input->post('password1', true);

            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'nim' => htmlspecialchars($this->input->post('nim', true)),
                'kelas' => htmlspecialchars($this->input->post('kelas', true)),
                'nohp' => htmlspecialchars($this->input->post('nohp', true)),
                'image' => 'default.png',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                
            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Congratulation!, your account has been created.</div>');
            redirect('admin/daftar');
        }
    }

    public function hapusaspirasi($id)
    {
        $this->load->model('Admin_model', 'sambat');
        $this->Admin_model->hapusSambat($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Aspirasi aspician berhasil dihapus</div>');
        redirect('admin/isiaspirasi');
    }

    public function hapuslaporankuota($id)
    {
        $this->load->model('Admin_model', 'kuota');
        $this->Admin_model->hapusLaporkuota($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Pelaporan kuota aspician berhasil dihapus</div>');
        redirect('admin/isilaporkuota');
    }

    public function hapusdatabase($id)
    {
        $this->load->model('Admin_model', 'user');
        $this->Admin_model->hapusMhs($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Pelaporan kuota aspician berhasil dihapus</div>');
        redirect('admin/databaseMhs');
    }


    public function upload()
    {
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

        $config['upload_path'] = realpath('excel');
        $config['allowed_types'] = 'xlsx|xls|csv';
        $config['max_size'] = '10000';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {

            //upload gagal
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Upload Gagal</div>');
            //redirect halaman
            redirect('admin/jadwal');
        } else {

            $data_upload = $this->upload->data();

            $excelreader       = new PHPExcel_Reader_Excel2007();
            $loadexcel         = $excelreader->load('excel/' . $data_upload['file_name']); // Load file yang telah diupload ke folder excel
            $sheet             = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

            $data = array();

            $numrow = 1;
            foreach ($sheet as $row) {
                if ($numrow > 1) {
                    array_push($data, array(
                        'name' => $row['A'],
                        'email' => $row['B'],
                        'nim' => $row['C'],
                        'kelas' => $row['D'],
                        'nohp' => $row['E'],
                        'image' => $row['F'],
                        'password' => $row['G'],
                        'role_id' => $row['H'],
                        'is_active' => $row['I'],
                    ));
                }
                $numrow++;
            }
            $this->db->insert_batch('user', $data);
            //delete file from server
            unlink(realpath('excel/' . $data_upload['file_name']));

            //upload success
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Database Mahasiswa Berhasil Diupload</div>');
            //redirect halaman
            redirect('admin/databaseMhs');
        }
    }

    public function exportMhs()
    {
        $this->load->model('Admin_model');

        $data = $this->Admin_model->getMhs();

        $spreadsheet = new Spreadsheet;

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'NIM');
        $sheet->setCellValue('E1', 'Kelas');
        $sheet->setCellValue('F1', 'No Handphone');

        $kolom = 2;
        $nomor = 1;
        foreach ($data as $d) {
            $sheet->setCellValue('A' . $kolom, $nomor);
            $sheet->setCellValue('B' . $kolom, $d['name']);
            $sheet->setCellValue('C' . $kolom, $d['email']);
            $sheet->setCellValue('D' . $kolom, $d['nim']);
            $sheet->setCellValue('E' . $kolom, $d['kelas']);
            $sheet->setCellValue('F' . $kolom, $d['nohp']);
            $kolom++;
            $nomor++;
        }

        $writer = new Xlsx($spreadsheet);



        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="DatabaseMhs.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }



    public function exportLaporKuota()
    {
        $this->load->model('Admin_model');

        $data = $this->Admin_model->getKuota();

        $spreadsheet = new Spreadsheet;

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'NIM');
        $sheet->setCellValue('D1', 'Kelas');
        $sheet->setCellValue('E1', 'No Handphone');
        $sheet->setCellValue('F1', 'Provider');
        $sheet->setCellValue('G1', 'Tanggal Pelaporan');

        $kolom = 2;
        $nomor = 1;
        foreach ($data as $d) {
            $waktu = date('d F Y', $d['date_created']);
            $sheet->setCellValue('A' . $kolom, $nomor);
            $sheet->setCellValue('B' . $kolom, $d['nama']);
            $sheet->setCellValue('C' . $kolom, $d['nim']);
            $sheet->setCellValue('D' . $kolom, $d['kelas']);
            $sheet->setCellValue('E' . $kolom, $d['nohp']);
            $sheet->setCellValue('F' . $kolom, $d['provider']);
            $sheet->setCellValue('G' . $kolom, $waktu);
            $kolom++;
            $nomor++;
        }

        $writer = new Xlsx($spreadsheet);



        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Pelaporan kuota.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }


    public function exportAspirasi()
    {
        $this->load->model('Admin_model');

        $data = $this->Admin_model->getAspirasi();

        $spreadsheet = new Spreadsheet;

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Ditujukan Kepada');
        $sheet->setCellValue('D1', 'Tanggal Sambat');
        $sheet->setCellValue('E1', 'Isi Aspirasi');

        $kolom = 2;
        $nomor = 1;
        foreach ($data as $d) {
            $waktu = date('d F Y', $d['date_created']);
            $sheet->setCellValue('A' . $kolom, $nomor);
            $sheet->setCellValue('B' . $kolom, $d['dari']);
            $sheet->setCellValue('C' . $kolom, $d['untuk']);
            $sheet->setCellValue('D' . $kolom, $waktu);
            $sheet->setCellValue('E' . $kolom, $d['isi']);
            $kolom++;
            $nomor++;
        }

        $writer = new Xlsx($spreadsheet);



        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Aspirasi aspician.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }


}
