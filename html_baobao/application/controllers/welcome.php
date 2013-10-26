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
        $this->load->library("usermodel_tmp/ucommon");
	    $person = new Umodel(1);
        $this->ucommon->decorate($person);
        $this->ucommon->getAskArticle();
    }

}
