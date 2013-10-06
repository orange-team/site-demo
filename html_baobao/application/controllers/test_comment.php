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
        $this->data['ref'] = '/test_comment/';
        $this->load->view('header',$this->data);
        $this->load->view('comment',array('type'=>1,'target_id'=>1));
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
