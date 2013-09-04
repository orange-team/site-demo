<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//自定义基类
class MY_Controller extends CI_Controller
{
	protected $data=array();
    //当前控制器名，用于view中复用
    protected $_class = '';

    public function __construct()
    {
        parent::__construct();
    }
	
}
