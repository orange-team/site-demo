<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 评论控制器
* author: zg
* date: 2013-10-04
*/

class comment extends CI_Controller
{
    var $_info = array();
    var $_ref = '';
	function __construct()
	{
		parent::__construct();
        $this->_info['cls'] = strtolower(__CLASS__);
        $this->_info['name'] = '评论';
        $this->_info['view_path'] = 'admin/'.$this->_info['cls'];
        $this->load->model('user_model','user');
	}

    //保存评论
    function saveAdd()
	{
		$data = array(
				'target_id' => $this->input->post('target_id'),
				'user_id' => $this->_get_user_id(),
				'content' => $this->input->post('content'),
				'add_time' => date('Y-m-d H:i:s'),
                'status' => 0,
				);
		$affected_rows = $this->comment->insert($data);
		$data['msg'] = ($affected_rows>0) ? '成功' : '失败';
		$section = $this->input->post('section').'/';
		$data['url'] = '/admin/comment/showlist/'.$section;
		$this->load->view('admin/msg', $data);
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

}
