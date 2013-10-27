<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->lang->load('common');
		$this->lang->load('index');
	}
	public function index()
	{
        $this->load->library("usermodel_tmp/umodel",array(1));
        $res = $this->umodel->getAskArticle();
        print_r($res);
    }

}
