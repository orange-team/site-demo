<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->lang->load('common');
		$this->lang->load('index');
	}
	public function index($id)
	{
        header("Content-type: text/html; charset=utf-8"); 
        $this->load->library("usermodel_tmp/umodel",array($id));
        $res = $this->umodel->getTag();
        print_r($res);
    }

}
