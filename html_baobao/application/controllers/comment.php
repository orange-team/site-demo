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
        $this->load->model('comment_model','comment');
	}

    //用于测试评论页
    function index()
    {
        $this->load->view('commnet');
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

    //初始化数据
    function _init()
    {
        $this->data['seo'] = array('title'=>'用户登录首页',
                'description'=>'用户登录首页的描述页面信息',
                'keywords'=>'用户登录,母婴知识,宝宝健康'
                );
        //要载入的css, js文件
        $this->data['file'] = array('js'=>'comment','css'=>'comment');
    }

}
