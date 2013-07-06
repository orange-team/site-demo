<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台--用户的管理
* author: Liangxifeng
* date: 2013-06-20
*/

class User extends MY_Controller
{
	function __construct()
	{error_reporting(E_ALL);
		parent::__construct();
		$this->load->model('admin/user_model','user');
	}
	
	//新增
	function add()
	{
		$this->load->helper('form');
		$this->load->view('admin/userAdd', $this->data);
	}
	//编辑
	function edit($user_id)
	{
		$this->load->helper('form');
		$this->data['menu_id'] = (int)$user_id;
		$this->data['user'] = $this->user->get($user_id);
		$this->data['user_id'] = (int)$user_id;
		$this->load->view('admin/userEdit', $this->data);
	}
    function adminlist()
    {
		$this->load->model('admin/user_model', 'user');
		$this->data['userArr'] = $this->user->getList();
		$this->load->view('admin/mainRight', $this->data);

    }

	function saveEdit($user_id)
	{
		if($this->input->post('user_name')) $data['user_name'] = $this->input->post('user_name');
		if($this->input->post('user_realname')) $data['user_realname'] = $this->input->post('user_realname');
		if($this->input->post('pwd1')) $data['user_passwd'] = md5($this->input->post('pwd1'));
		$data['user_right'] = $this->input->post('user_right');
		$affected_rows = $this->user->edit($user_id, $data);
		$data['msg'] = ($affected_rows>0) ? '成功' : '失败';
		$data['url'] = '/admin/user/adminlist';
		$this->load->view('admin/info', $data);
	}

	function saveAdd()
	{
		if($this->input->post('user_name')) $data['user_name'] = $this->input->post('user_name');
		if($this->input->post('pwd1')) $data['user_passwd'] = md5($this->input->post('pwd1'));
		if($this->input->post('user_realname')) $data['user_realname'] = $this->input->post('user_realname');
		$data['user_right'] = $this->input->post('user_right');
        $data['user_add_time'] = date('Y-m-d H:i:s');
		$affected_rows = $this->user->add($data);
		$data['msg'] = ($affected_rows>0) ? '成功' : '失败';
		$data['history'] = '1';
		$data['url'] = '/admin/user/adminlist';
		$this->load->view('admin/info', $data);
	}

	function del($usericle_id)
	{
		$affected_rows = $this->user->del($usericle_id);
		$data['msg'] = ($affected_rows>0) ? '成功' : '失败';
		$data['history'] = '1';
		$data['url'] = '/admin/user/adminlist/';
		$this->load->view('admin/info', $data);
	}


}
