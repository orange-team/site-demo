<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//自定义基类
class MY_Controller extends CI_Controller
{
	protected $data=array();

    public function __construct()
    {
        parent::__construct();
    }
	
}
