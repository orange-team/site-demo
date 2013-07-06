<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台登录页面
* author: arkulo yesgang
* date: 2011-10-29
*/

class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	//登录首页面
	function index()
	{
		$this->load->helper('url');
		$this->load->view('login_a.html');
	}
	//登录验证
	function doLogin()
	{
		$uname = $this->input->post('uname');
		$passwd = $this->input->post('passwd');
		$this->load->model('admin/user_model','user');
		$isRight = false;
		$user = $this->user->chk($uname, $passwd);
		//验证用户名，密码
		if ( $user['user_id']<=0 )
		{
			//显示错误信息
			$data['wrongPwd'] = 1;
			$this->load->helper('url');
			$this->load->view('login_a.html', $data);
		} else {
			//注册session
            $this->load->library('session'); 
			$arr = array('uname'=>$uname, 'userId'=>$user['user_id'], 'user_right'=>$user['user_right']);
            $this->session->set_userdata($arr); 
			//重定向到后台首页
			$this->load->helper('url');
			redirect('admin/main/index');
		}
	}
	//退出
	function doLogout()
	{
        $this->load->library('session'); 
        $this->session->sess_destroy();
		//重定向到后台首页
		$this->load->helper('url');
		redirect('/');
	}
	
}
