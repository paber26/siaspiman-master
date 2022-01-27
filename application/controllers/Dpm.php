<?php
defined('BASEPATH') or exit('No direct script access allowed');

require('./excel/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Dpm extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->helper('url', 'form');
        $this->load->helper(array('url','download'));
        // $this->load->model('Dpm_model');
    }

    // public function index()
    // {
    //     $data['title'] = 'Dashboard';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('admin/index', $data);
    //     $this->load->view('templates/footer');
    // }
    

    public function index()
    {
        $data['title'] = 'Beranda';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['summarySambat'] = $this->db->get('summarySambat')->row_array();
        $data['summaryUser'] = $this->db->get('summaryUser')->row_array();
        $data['kuota'] = $this->db->get('kuota')->result_array();
        $this->db->order_by("createdAt", "DESC");
        $data['pengumuman'] = $this->db->get('pengumuman')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dpm/index', $data);
        $this->load->view('templates/footer');

    }

    public function arsip(){
        $data['title'] = 'Arsip Dokumen';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by("uploadAt", "DESC");
        $data['arsip'] = $this->db->get('arsip')->result_array();

        $this->load->library('form_validation');
        $this->form_validation->set_rules('keterangan',' Keterangan','required|trim');
        // $this->form_validation->set_rules('uploaddkmn', 'Upload','required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('dpm/arsip', $data);
            $this->load->view('templates/footer');

        } else {

            $config['upload_path'] = './assets/arsip/dokumen/';
            $config['allowed_types'] = 'doc|docx|xls|xlsx|csv|ppt|pptx|pdf';
            $config['max_size'] = 10480; //10MB
            // $config['max_width'] = 1500;
            // $config['max_height'] = 1500;

            $this->load->library('upload', $config);

            if ( !$this->upload->do_upload('uploaddkmn'))
            {
                $error = array('error' => $this->upload->display_errors());

                $this->session->set_flashdata('message', 
                '<div class="alert alert-danger" role="alert">
                <p class="mb-0">File tidak berhasil diupload</p>
                <p class="mb-0">'.$error['error'].'</p>
                </div>');
            
                redirect('dpm/arsip');
            }
            else
            {
                $filename =$this->upload->data("file_name");
                $filetype = $this->upload->data("file_ext");
                $filesize = $this->upload->data("file_size");
                if($filetype ==".doc" or $filetype == ".docx"){
                    $img = "fas fa-file-word";
                }
                elseif($filetype == ".xls" or $filetype == ".xlsx"){
                    $img = "fas fa-file-excel";
                }
                elseif($filetype == ".csv"){
                    $img = "fas fa-file-word";
                }
                elseif($filetype == ".ppt" or $filetype == ".pptx"){
                    $img = "fas fa-file-powerpoint";
                }
                elseif($filetype == ".pdf"){
                    $img = "fas fa-file-pdf";
                }
                else{
                    $img = "fas fa-file";
                }

            }
            
            $ket = $this->input->post('keterangan');
            date_default_timezone_set("Asia/Jakarta");
            $data = [
                'file' => $filename,
                'type' => $filetype,
                'img' => $img,
                'keterangan' => $ket,
                'size' => $filesize,
                'uploadBy' => $data['user']['name'],
                'uploadAt' => date("Y-m-d H:i:sa")
            ];
            
            $this->db->insert('arsip', $data);
            $this->session->set_flashdata('message', 
            '<div class="alert alert-success" role="alert">
            File berhasil diupload
            </div>');
            redirect('dpm/arsip');
        }

    }

    public function downloadarsip($file){
        force_download('./assets/arsip/dokumen/'.$file.'',NULL);
    }

    public function sarsip(){
        $data['title'] = 'Arsip Dokumen';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $keyword = $this->input->post('keyword');
        $this->load->model('Dpm_model');
        $data['arsip']=$this->Dpm_model->cariArsip($keyword);
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dpm/sarsip', $data);
        $this->load->view('templates/footer');
    }

    public function galeri(){
        $data['title'] = 'Galeri';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by("uploadAt", "DESC");
        $data['galeri'] = $this->db->get('galeri')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dpm/galeri', $data);
        $this->load->view('templates/footer');
    }

    public function sgaleri($folder){
        $data['title'] = 'Galeri';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by("uploadAt", "DESC");
        $data['galeri'] = $this->db->get_where('galeri', ['folder' => $folder])->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dpm/sgaleri', $data);
        $this->load->view('templates/footer');

    }


    public function profil(){
        $data['title'] = 'Profil DPM';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by("idJabatan", "ASC");
        $data['struktur'] = $this->db->get('struktur');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dpm/profil', $data);
        $this->load->view('templates/footer');
    }

    public function pengumuman()
    {
        $data['title'] = 'Buat Pengumuman';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    

        $this->form_validation->set_rules('judul', 'Judul', 'required|trim');
        $this->form_validation->set_rules('isi', 'Isi', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/pengumuman', $data);
            $this->load->view('templates/footer');
        } else {
            $judul = $this->input->post('judul', true);
            $isi = $this->input->post('isi', true);
            date_default_timezone_set("Asia/Jakarta");

            $data = [
                'judul' => $judul,
                'createdAt' => date("Y-m-d H:i:sa"),
                'createdBy' => $data['user']['name'],
                'isi' => $isi
            ];
            $this->db->insert('pengumuman', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengumuman berhasil terkirim
            </div>');
            redirect('admin/pengumuman');
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