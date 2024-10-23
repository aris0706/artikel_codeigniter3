<?php
// result_array() digunakan menampilkan beberapa baris data 
//row_array() digunakan menampilkan satu baris data saja.

class Blog extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();//bisa ditaruh di file autoload.php , autoload libraries
        $this->load->library('form_validation');//bisa ditaruh di file autoload.php , autoload libraries
        $this->load->library('session');
        $this->load->helper('url');//url helper bkn fungsi php tp fungsi tmbahan ci
        $this->load->model('Blog_model');
        $this->load->helper('url');//bisa ditaruh di file autoload.php , autoload helper
        $this->load->helper('form'); 
        //Contoh kita akan menggunakan form helper untuk menambah dan mengedit data artikel,
        //maka kita harus memasangnya pada controller Blog.php , 
        //kita bisa memasangnya pada method __construct() agar form helper berlaku 
        //pada semua method di controller.

    }
    public function index($offset = 0)
    {
        // pagination
        $this->load->library('pagination');
        $config['base_url']     = site_url('blog/index');
        $config['total_rows']   = $this->Blog_model->getTotalBlog();
        $config['per_page']     = 3;
        $config['use_page_numbers'] = true;
$config['num_links']        = 5;
$config['full_tag_open']    = '<ul class="pagination">';
$config['full_tag_close']   = '</ul>';
$config['first_link']       = 'First';
$config['last_link']        = 'Last';
$config['first_tag_open']   = '<li class="page-item page-link">';
$config['first_tag_close']  = '</li>';
$config['prev_link']        = '&laquo';
$config['prev_tag_open']    = '<li class="page-item page-link">';
$config['prev_tag_close']   = '</li>';
$config['next_link']        = '&raquo';
$config['next_tag_open']    = '<li class="page-item page-link">';
$config['next_tag_close']   = '</li>';
$config['last_tag_open']    = '<li class="page-item page-link">';
$config['last_tag_close']   = '</li>';
$config['cur_tag_open']     = '<li class="active"><a href="" class="page-link">';
$config['cur_tag_close']    = '</a></li>';
$config['num_tag_open']     = '<li class="page-item page-link">';
$config['num_tag_close']    = '</li>';

        $this->pagination->initialize($config);

        $query = $this->Blog_model->getBlogs($config['per_page'],$offset);
        //$this->load->database();
        //$query = $this->db->query("select * from blog");
        $data['blogs'] = $query->result_array();//jika result saja mngeluarkan data objek
        
        $this->load->view('blog',$data);
    }
    public function detail($url)
    {
        $data['blogs']=$this->Blog_model->getSingleBlog('url',$url);
        $this->load->view('detail',$data);
    }
    public function add()
    {
        if ($this->input->post())
        {
        $this->form_validation->set_rules('title', 'Judul', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required|alpha_dash');
        $this->form_validation->set_rules('content', 'content', 'required');
        if($this->form_validation->run()===TRUE)
        {
           $data['title']= $this->input->post('title');
           $data['content']=$this->input->post('content');
           $data['url']=$this->input->post('url');

           //konfigurasi upload
            $config['upload_path']         = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1000;
            $config['max_width']            = 2000;
            $config['max_height']           = 1600;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('cover'))
            {
                echo $this->upload->display_errors();
            }
            else
            {
                $data['cover'] = $this->upload->data()['file_name'];
                //print_r($this->upload->data());
                //exit;
            }

           $id=$this->Blog_model->insertBlog($data);

            if ($id) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">
                Data berhasil disimpan</div>');
                redirect('/');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-warning">
                Data gagal disimpan</div>');
                redirect('/');
            }
          }
        }
        $this->load->view('form_add');  
    }
    public function edit($id)
    {
        $data['blog']=$this->Blog_model->getSingleBlog('id',$id);
        if($this->input->post())
        {
        $this->form_validation->set_rules('title', 'Judul', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required|alpha_dash');
        $this->form_validation->set_rules('content', 'content', 'required');
        if($this->form_validation->run()===TRUE)
        {
            $post['title']  =$this->input->post('title');
            $post['content']=$this->input->post('content');
            $post['url']    =$this->input->post('url'); 
            
            //konfigurasi upload
            $config['upload_path']         = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1000;
            $config['max_width']            = 2000;
            $config['max_height']           = 1600;
            $this->load->library('upload', $config);

            $this->upload->do_upload('cover');
            if(!empty($this->upload->data('file_name')))
            {
                $post['cover']= $this->upload->data('file_name');  
            }

                $id = $this->Blog_model->updateBlog($id,$post);
                if ($id) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success">
                    Data berhasil diedit</div>');
                    redirect('/');
                }else{
                    $this->session->set_flashdata('message', '<div class="alert alert-warning">
                    Data gagal diedit</div>');
                    redirect('/');
                }
            }
        }
        $this->load->view('form_edit',$data);
    }
    public function delete($id)
    {
        $this->Blog_model->deleteBlog($id); 
        if ($id) {
            $this->session->set_flashdata('message', '<div class="alert alert-success">
            Data berhasil dihapus</div>');
            redirect('/');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-warning">
            Data gagal dihapus</div>');
            redirect('/');
        }
    }
    public function login()
    {
        if($this->input->post())
        {
            $username   = $this->input->post('username');
            $password   = $this->input->post('password');
            if($username=='aris' && $password=='aris')
            {
                $_SESSION['username']='admin';
                redirect('/');
            }
            else
            {
                $this->session->set_flashdata('message','<div class="alert alert-warning">Username atau Password Anda tidak valid!</div>');
                redirect('blog/login');
            }
        }
        $this->load->view('login'); 
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/');
    }
}

