<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//后台权限拦截钩子
class AdminAuth
{
	function __construct()
	{
		$this->CI =& get_instance();
	}

	function auth()
	{
		$this->CI->load->helper('url');
		if( preg_match('/admin.*/i', uri_string()) )
		{
			//验证登录session
			session_start();
            $this->CI->load->library('session'); 
            $userId = $this->CI->session->userdata('userId'); 
			if( !$userId OR $userId <= 0 )
			{
				redirect('login');
				return;
			}
		}
	}
	
}
