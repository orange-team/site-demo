<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台登录页面
* author: arkulo yesgang
* date: 2011-10-29
*/

class user extends CI_Controller
{
    var $_info = array();
    var $_ref = '';
	function __construct()
	{
		parent::__construct();
        $this->_info['cls'] = strtolower(__CLASS__);
        $this->_info['name'] = '用户';
        $this->_info['view_path'] = 'admin/'.$this->_info['cls'];
	}

	//
	function index()
	{
    }

	//登录
	function login()
	{
        $this->data['seo'] = array('title'=>'用户登录首页',
                'description'=>'用户登录首页的描述页面信息',
                'keywords'=>'用户登录,母婴知识,宝宝健康'
                );
        //要载入的css, js文件
        $this->data['file'] = array('js'=>'user','css'=>'user');
		$this->load->helper(array('url','form'));
		$this->load->view('user_login', $this->data);
	}

	//登录验证
	function dologin()
	{
		$uname = $this->input->post('uname');
		$passwd = $this->input->post('passwd');
		$this->load->model('user_model','user');
		$isRight = false;
		$user = $this->user->chk($uname, $passwd);
		//验证用户名，密码
		if ( $user['user_id']<=0 )
		{
			//显示错误信息
			$data['wrongPwd'] = 1;
			$this->load->helper('url');
			$this->load->view('user_a.html', $data);
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

    //注册
	function reg()
	{
        $this->data['seo'] = array('title'=>'用户注册页',
                'description'=>'用户注册页的描述页面信息',
                'keywords'=>'用户注册,母婴知识,宝宝健康'
                );
        //要载入的css, js文件
        $this->data['file'] = array('js'=>'user','css'=>'user');
		$this->load->helper(array('url','form'));
		$this->load->view('user_reg', $this->data);
	}


}
