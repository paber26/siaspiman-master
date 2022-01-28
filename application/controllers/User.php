<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }


    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('nim', 'Nim', 'required|trim|min_length[7]');
        $this->form_validation->set_rules('kelas', 'Kelas', 'required|trim');
        $this->form_validation->set_rules('nohp', 'Nohp', 'required|trim|min_length[11]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $nim = $this->input->post('nim');
            $kelas = $this->input->post('kelas');
            $nohp = $this->input->post('nohp');
            $provider = $this->input->post('provider');
            if ($provider == "") {
                $provider = "none";
            } else {
                $provider =  $provider;
            }

            //cek jika ada gambar yg mau diupload
            $upload_image = $_FILES['image']['name']['nim']['kelas']['nohp'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '2048';
                $config['upload_path']   = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.png') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    $error = array('error' => $this->upload->display_errors());

                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger" role="alert">
                    <p class="mb-0">Failed to update your profile!</p>
                    <p class="mb-0">' . $error['error'] . '</p>
                    </div>'
                    );

                    redirect('user');
                }
            }

            $this->db->set('name', $name);
            $this->db->set('nim', $nim);
            $this->db->set('kelas', $kelas);
            $this->db->set('nohp', $nohp);
            $this->db->set('provider', $provider);

            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Your profile has been updated!</div>');
            redirect('user');
        }
    }

    // public function pengumuman()
    // {
    //     $data['title'] = 'Isi Aspirasi';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    //     $data['sambat'] = $this->db->get('sambat')->result_array();

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('user/pengumuman', $data);
    //     $this->load->view('templates/footer');
    // }

    public function aspirasi()
    {
        $data['title'] = 'Aspirasi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['dari'] = $this->db->get('sambat')->result_array();


        $this->form_validation->set_rules('dari', 'Dari', 'required|trim');
        $this->form_validation->set_rules('untuk', 'Untuk', 'required|trim');
        $this->form_validation->set_rules('isi', 'isi', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/aspirasi', $data);
            $this->load->view('templates/footer');
        } else {
            $dari = $this->input->post('dari', true);
            $untuk = $this->input->post('untuk', true);
            $isi = $this->input->post('isi', true);

            $data = [
                'nim' => $data['user']['nim'],
                'dari' => $dari,
                'untuk' => $untuk,
                'date_created' => time(),
                'isi' => $isi
            ];
            $this->db->insert('sambat', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sambatan kamu berhasil terkirim
            </div>');
            redirect('user/aspirasi');
        }
    }

    public function anggaran()
    {
        $data['title'] = 'Anggaran IMAPOLSTAT';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/anggaran', $data);
        $this->load->view('templates/footer');
    }

    public function anggaranpengajuan()
    {
        $data['title'] = 'Pengajuan Anggaran IMAPOLSTAT';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/anggaran/pengajuan', $data);
        $this->load->view('templates/footer');
    }

    public function anggaranpenganggaran()
    {
        $data['title'] = 'Penganggaran Anggaran IMAPOLSTAT';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/anggaran/penganggaran', $data);
        $this->load->view('templates/footer');
    }

    public function anggaranukmdivisi()
    {
        $data['title'] = 'UKMM/Divisi IMAPOLSTAT';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/anggaran/ukmdivisi', $data);
        $this->load->view('templates/footer');
    }

    public function anggaranmahasiswa()
    {
        $data['title'] = 'Anggaran Mahasiswa IMAPOLSTAT';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/anggaran/mahasiswa', $data);
        $this->load->view('templates/footer');
    }

    public function anggaranlaporan()
    {
        $data['title'] = 'Laporan IMAPOLSTAT';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/anggaran/laporan', $data);
        $this->load->view('templates/footer');
    }

    public function laporkuota()
    {
        $data['title'] = 'Pelaporan Kuota';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['kuota'] = $this->db->get_where('kuota', ['nim' => $data['user']['nim']])->result_array();

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('nim', 'NIM', 'required|trim');
        $this->form_validation->set_rules('kelas', 'Kelas', 'required|trim');
        $this->form_validation->set_rules('nohp', 'Nohp', 'required|trim|numeric');
        $this->form_validation->set_rules('provider', 'Provider', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/laporkuota', $data);
            $this->load->view('templates/footer');
        } else {
            $nama = $this->input->post('nama', true);
            $nim = $this->input->post('nim', true);
            $kelas = $this->input->post('kelas', true);
            $nohp = $this->input->post('nohp', true);
            $provider = $this->input->post('provider', true);


            $data = [
                'nama' => $nama,
                'nim' => $nim,
                'kelas' => $kelas,
                'nohp' => $nohp,
                'provider' => $provider,
                'date_created' => time()
            ];
            $this->db->insert('kuota', $data);
            $this->db->insert('kuota_backup', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Pelaporan kuota kamu berhasil terkirim
            </div>');
            redirect('user/laporkuota');
        }
    }


    public function changepassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[6]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', ' Confirm New Password', 'required|trim|min_length[6]|matches[new_password1]');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Wrong Password!</div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    New password cannot be the same as current password</div>');
                    redirect('user/changepassword');
                } else {
                    //password bener 
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Password changed!</div>');
                    redirect('user/changepassword');
                }
            }
        }
    }
}
