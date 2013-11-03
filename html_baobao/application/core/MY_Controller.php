<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * desc: 前台、后台的控制器基类，
 * 所有控制器都继承它们，用于整体控制，
 * 如：前台读取用户信息
 * author: zg
 * date : 2013/10/07
 */

//前台基类
class LB_Controller extends CI_Controller
{
	protected $data=array();
    //用户信息
    public $_user = array();

    public function __construct()
    {
        parent::__construct();
        //初始化用户信息
        $this->_get_user_info();
    }

    //初始化用户信息
    function _get_user_info()
    {
        session_start();
        $this->load->library('session'); 
        $this->_user['id'] = $this->session->userdata('user_id');
    }
	
}

//后台基类
class MY_Controller extends CI_Controller
{
	protected $data=array();
    //控制器信息
    public $_info = array();

    public function __construct()
    {
        parent::__construct();
    }

}
