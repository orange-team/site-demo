<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 用户登录页面
* author: Liangxifeng yesgang
* date: 2013-09-19
*/

class user_act extends CI_Controller
{
    var $_info = array();
    var $_ref = '';
	function __construct()
	{
		parent::__construct();
        $this->_info['cls'] = strtolower(__CLASS__);
        $this->_info['name'] = '用户';
        //$this->_info['view_path'] = ''.$this->_info['cls'];
        $this->load->model('user_model','user');
	}

	//
	function index() { }

    //保存注册
	function reg()
	{
        session_start();
        $this->load->helper('common');
		$authcode = filter($this->input->post('authcode'));
        $this->load->library('session');
        $my_authcode = $this->session->userdata('authcode');
        if( empty($my_authcode) || $authcode != $my_authcode )
        {
			//显示错误信息
			$this->data['wrongAuthcode'] = 1;
            $this->load->helper(array('url','form'));
			$this->load->view('user_reg', $this->data);
            var_dump($my_authcode,$authcode);
            exit;
        }
        $now = date('Y-m-d H:i:s');
        $data = array(
                'user_nickname' => filter($this->input->post('nickname')),
                'user_email' => filter($this->input->post('email')),
                'user_passwd' => filter($this->input->post('password')),
                'user_reg_time' => $now,
                'user_login_time' => $now,
        );
        $insert_id = $this->user->add($data);
        //数据写入失败
        if( 0>=$insert_id )
        {
            $info['msg'] = '注册失败';
            $info['url'] = '/user/reg/';
            $this->load->view('msg', $info);
            exit;
        }
        //注册session
        $arr = array('nickname'=>$data['nickname'], 'user_id'=>$insert_id);
        $this->session->set_userdata($arr); 
        unset($data,$arr);
        //重定向到首页
        redirect('/mmxue/index');
	}

	//登录验证
	function dologin()
	{
		$nickname = $this->input->post('nickname');
		$passwd = $this->input->post('passwd');
		$this->load->model('user_act_model','user_act');
		$isRight = false;
		$user_act = $this->user_act->chk($nickname, $passwd);
		//验证用户名，密码
		if ( $user_act['user_act_id']<=0 )
		{
			//显示错误信息
			$data['wrongPwd'] = 1;
			$this->load->helper('url');
			$this->load->view('user_act_a.html', $data);
		} else {
			//注册session
            $this->load->library('session'); 
			$arr = array('nickname'=>$nickname, 'user_actId'=>$user_act['user_act_id'], 'user_act_right'=>$user_act['user_act_right']);
            $this->session->set_user_actdata($arr); 
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
