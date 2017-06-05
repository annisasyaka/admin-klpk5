<?php

class admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('madmin');
        $this->load->helper('url');
        $this->load->library('lib_new');
    }

    function index(){
        $this->load->view('head_user');
        $data['kab'] = $this->lib_new->get_data('kabupaten');
        $this->load->view('admin/beranda', $data);
        $this->load->view('foot_user');
    }

    function user(){
        $this->load->view('head_user');
        $data['user']= $this->madmin->tampil_data()->result();
        $this->load->view('admin/user', $data);
        $this->load->view('foot_user');
    }

    function hapus($id){
        $this->load->view('head_user');
        $where = array('id'=>$id);
        $this->madmin->hapus_data($where, 'user');
        redirect('admin/user');
        $this->load->view('foot_user');
    }

    function edit($id){
        $this->load->view('head_user');
        $where = array('id' => $id);
        $data['user']= $this->madmin->edit_data($where, 'user')->result();
        $this->load->view('admin/user', $data);
        $this->load->view('foot_user');
    }

    function tambah_proses(){
        $this->load->view('head_user');
        $id = $this->input->post('id');
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $nama = $this->input->post('nama');
        $level = $this->input->post('level');
        $foto = $this->input->post('foto');

        $data = array(
            'id' => $id,
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'nama' => $nama,
            'level' => $level,
            'foto' => $foto
            );
        $this->madmin->tambah_data($data,'user');
        redirect('admin/user');
        $this->load->view('foot_user');
    }


    function update(){
        $this->load->view('head_user');
        $id = $this->input->post('id');
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $nama = $this->input->post('nama');
        $level = $this->input->post('level');
        $foto = $this->input->post('foto');

        $data = array(
            'id' => $id,
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'nama' => $nama,
            'level' => $level,
            'foto' => $foto
            );
        $where = array('id'=> $id);
        $this->madmin->update_data($where,$data,'user');
        redirect('admin/user');
        $this->load->view('foot_user');
    }

    function statistik(){
        $this->load->view('head_user');
        $this->load->view('admin/statistik');
        $this->load->view('foot_user');
    }

    function guru(){
        $this->load->view('head_user');
        $this->load->view('admin/dguru');
        $this->load->view('foot_user');
    }

    function sekolah(){
        $this->load->view('head_user');
        $data['kab'] = $this->lib_new->get_data('kabupaten');
        $this->load->view('admin/dsekolah', $data);
        $this->load->view('foot_user');
    }

    function siswa(){
        $this->load->view('head_user');
        $this->load->view('admin/dsiswa');
        $this->load->view('foot_user');
    }

    function tenpendik(){
        $this->load->view('head_user');
        $this->load->view('admin/dten');
        $this->load->view('foot_user');
    }

    function logout() {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('level');
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('');
    }
}
?>