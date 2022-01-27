<?php
defined('BASEPATH') or exit('No direct script access allowed');

require('./excel/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Dosen extends CI_Controller
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
        $this->load->view('dosen/index', $data);
        $this->load->view('templates/footer');
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
        $this->load->view('dosen/isiaspirasi', $data);
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
        $this->load->view('dosen/isilaporkuota', $data);
        $this->load->view('templates/footer');
    }

    public function hapusaspirasi($id)
    {
        $this->load->model('Admin_model', 'sambat');
        $this->Admin_model->hapusSambat($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Aspirasi aspician berhasil dihapus</div>');
        redirect('dosen/isiaspirasi');
    }

    public function hapuslaporankuota($id)
    {
        $this->load->model('Admin_model', 'kuota');
        $this->Admin_model->hapusLaporkuota($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Pelaporan kuota aspician berhasil dihapus</div>');
        redirect('dosen/isilaporkuota');
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
