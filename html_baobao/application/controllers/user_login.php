<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 用户登录页面
* author: zg
* date: 2013-09-19
*/

class user_login extends CI_Controller
{
    var $_info = array();
    var $_ref = '';
	function __construct()
	{
		parent::__construct();
        $this->_info['cls'] = strtolower(__CLASS__);
        $this->_info['name'] = '用户';
        $this->_info['view_path'] = 'admin/'.$this->_info['cls'];
        $this->load->model('user_model','user');
	}

	//登录
	function index()
	{
        //如果用户已经登录了，跳至用户中心
        $this->_chk_if_logined();
        $this->_init();
        $this->data['email'] = '';
        $this->load->helper('common');
		if(filter($this->input->post('email')))
        {
            $this->_chk();
        }
		$this->load->helper(array('url','form'));
        $this->data['ref'] = $this->input->get('ref');
		$this->load->view('user_login', $this->data);
	}

    private function _chk_if_logined()
    {
        session_start();
        $this->load->library('session'); 
        if($this->session->set_userdata('user_id'))
        {
            redirect('/user_center/');
        }
    }

    //登录验证
	private function _chk()
	{
		$passwd = create_pwd(filter($this->input->post('password')));
		$email = filter($this->input->post('email'));
		$user = $this->user->chk($email, $passwd);
        $this->data['msg'] = '';
        //判断密码
        if( 0>=count($user) )
        {
            $this->data['msg'] = '密码不正确';
            $this->data['email'] = $email;
            return ;
        }
        //注册session
        session_start();
        $this->load->library('session'); 
        $arr = array('nickname'=>$user['user_nickname'], 'user_id'=>$user['user_id'],);
        $this->session->set_userdata($arr); 
        //重定向到来源页
        $this->load->helper('url');
        $ref = $this->input->get('ref');
        redirect($ref);
	}

    //ajax检查email是否注册
    function chk_email()
    {
        $email = '';
        $email = $this->input->post('email');
        $msg = 'false';
        if ($email && $this->user->chk_email($email))
        {
            $msg = 'true';
        }				
		echo $msg;
    }

    //初始化数据
    function _init()
    {
        $this->data['seo'] = array('title'=>'用户登录首页',
                'description'=>'用户登录首页的描述页面信息',
                'keywords'=>'用户登录,母婴知识,宝宝健康'
                );
        //要载入的css, js文件
        $this->data['file'] = array('js'=>'user','css'=>'user');
    }

	//退出
	function destroyed()
	{
        $this->load->library('session'); 
        $this->session->sess_destroy();
		//重定向到后台首页
		$this->load->helper('url');
		redirect('/');
	}


}
