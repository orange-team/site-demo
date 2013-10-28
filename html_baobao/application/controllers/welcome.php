<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->lang->load('common');
		$this->lang->load('index');
	}
	public function index($userid)
	{
        header("Content-type: text/html; charset=utf-8"); 
        $this->load->library("usermodel_tmp/umodel",array($userid));
        $res = $this->umodel->getWiki();
        print_r($res);
    }

}
