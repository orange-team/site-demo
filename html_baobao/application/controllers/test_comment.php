<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 评论控制器
* author: zg
* date: 2013-10-04
*/

class test_comment extends CI_Controller
{
    var $_info = array();
    var $_ref = '';
	function __construct()
	{
		parent::__construct();
        $this->_info['cls'] = strtolower(__CLASS__);
        $this->_info['name'] = '评论';
        $this->_info['view_path'] = 'admin/'.$this->_info['cls'];
        $this->output->set_header("Content-Type: text/html; charset=utf-8");
	}

    //用于测试评论页
    function index()
    {
        $this->_init();
        $this->data['ref'] = '/comment/';
        $this->load->view('header',$this->data);
        $this->load->view('comment',array('type'=>1,'target_id'=>1));
    }

    //保存评论
    function saveAdd()
	{
		$data = array(
				'target_id' => $this->input->get('target_id'),
				'user_id' => $this->_get_user_id(),
				'content' => $this->input->post('content'),
				'add_time' => date('Y-m-d H:i:s'),
                'c_status' => 0,
				);
		$affected_rows = $this->comment->insert($data);
		//$data['msg'] = ($affected_rows>0) ? '成功' : '失败';
        $ref = $this->input->get('ref');
        redirect($ref);
	}
    
    //保存回复
    function reply()
	{
        $comment_id = (int)$this->input->post('comment_id');
		$data = array(
				'comment_id' => $comment_id,
				'user_id' => $this->_get_user_id(),
				'content' => $this->input->post('content'),
				'add_time' => date('Y-m-d H:i:s'),
                'audit_status' => 0,
				);
        $this->load->model('reply_model','reply');
        $this->reply->_type = $this->input->get('type');
		$affected_rows = $this->reply->insert($data);
        if(0>=$affected_rows)
        {
            echo 0;
        } else {
            //回复数+1
            $this->comment->add_reply_num($comment_id);
            echo 1;
        }
	}

    //保存赞
    function praise()
	{
        $reply_id = (int)$this->input->post('reply_id');
        $this->load->model('reply_model','reply');
		$affected_rows = $this->reply->praise($reply_id);
		echo ($affected_rows>0) ? 1 : 0;
	}

    private function _get_user_id()
    {
        return 1;
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
