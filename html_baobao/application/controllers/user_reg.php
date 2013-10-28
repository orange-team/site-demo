<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 用户注册页面
* author: zg
* date: 2013-09-19
*/

class user_reg extends CI_Controller
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

    function index()
	{
        $this->_init();
        $this->load->helper('common');
        if(filter($this->input->post('email')))
        {
            $this->_chk();
        }
		$this->data['err_msg'] = $this->uri->segment(3, 0);
        $this->load->helper(array('url','form'));
        $this->data['ref'] = $this->input->get('ref');
		$this->load->view('user_reg', $this->data);
	}

    //注册
	function _chk()
	{
        session_start();
		$authcode = filter($this->input->post('authcode'));
        $this->data['ref'] = $this->input->get('ref');
        $my_authcode = $this->session->userdata('authcode');
        if( empty($my_authcode) || $authcode != $my_authcode )
        {
			//显示错误信息
			$msg = '验证码错误';
			redirect('user/reg/'.$msg);
        }
        $now = date('Y-m-d H:i:s');
        $data = array(
                'user_nickname' => filter($this->input->post('nickname')),
                'user_email' => filter($this->input->post('email')),
                'user_passwd' => create_pwd(filter($this->input->post('password'))),
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
        //跳至“用户中心”
        $ref = $this->input->get('ref');
        redirect('/user/center/?ref='.$ref);
	}

    //ajax检查email是否存在
    function chk_email()
    {
        $email = '';
        $email = $this->input->post('email');
        $msg = 'true';
        if ($email && $this->user->chk_email($email))
        {
            $msg = 'false';
        }				
		echo $msg;
    }

    //ajax检查验证码
    function chk_authcode()
    {
        $authcode = $my_authcode = '';
        $authcode = $this->input->post('authcode');
        $msg = 'true';
        session_start();
        $this->load->library('session'); 
        $my_authcode = $this->session->userdata('authcode'); 
        if ($authcode && $authcode!=$my_authcode)
        {
            $msg = 'false';
        }				
		echo $msg;
    }

    private function _init()
    {
        $this->data['seo'] = array('title'=>'用户注册页',
                'description'=>'用户注册页的描述页面信息',
                'keywords'=>'用户注册,母婴知识,宝宝健康'
                );
        //要载入的css, js文件
        $this->data['file'] = array('js'=>'user','css'=>'user');
    }

}
