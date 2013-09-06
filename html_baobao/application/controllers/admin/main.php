<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台首页
* author: Liangxifeng
* date: 2013-06-22
*/

class Main extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
	}
    /**
    +----------------------------------------------------------
    * 加载后台首页
    +----------------------------------------------------------
    */
	function index()
	{
		$this->load->view('admin/index/index.html');
	}
	/**
    +----------------------------------------------------------
    * 后台头部框架
    +----------------------------------------------------------
    */
	function topframe()
	{
		$this->load->view('admin/index/topframe.html');
	}
	/**
    +----------------------------------------------------------
    * 后台左侧导航框架
    +----------------------------------------------------------
    */
	function leftframe()
	{
        $this->load->library('session'); 
        $user=$this->session->all_userdata(); 
		$this->load->view('admin/index/leftframe.html', $user);
	}
	/**
    +----------------------------------------------------------
    * 后台显示/隐藏左侧导航框架
    +----------------------------------------------------------
    */
	public function switchframe()
	{
		$this->load->view('admin/index/switchframe.html');
	}
	/**
    +----------------------------------------------------------
    * 后台管理导航区域框架
    +----------------------------------------------------------
    */
    function mainframe()
    {
		$this->load->view('admin/index/mainframe.html');
    }
	/**
    +----------------------------------------------------------
    * 后台默认内容页框架
    +----------------------------------------------------------
    */
	function manframe()
	{
		$this->load->view('admin/index/manframe.html');
	}
	/**
    +----------------------------------------------------------
    * 后台底部框架
    +----------------------------------------------------------
    */
	function bottomframe()
	{
		$this->load->view('admin/index/bottomframe.html');
	}
	
	
}
