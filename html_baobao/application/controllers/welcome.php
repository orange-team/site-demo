<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->lang->load('common');
		$this->lang->load('index');
	}
	public function getwiki($userid)
	{
        header("Content-type: text/html; charset=utf-8"); 
        $this->load->library("usermodel_tmp/umodel",array($userid));
        $res = $this->umodel->getWiki();
        print_r($res);
    }
    public function getarticle($userid)
    {
        header("Content-type: text/html; charset=utf-8"); 
        $this->load->library("usermodel_tmp/umodel",array($userid));
        $res = $this->umodel->getArticle();
        print_r($res);
    }
    public function getaskarticle($userid)
    {
        header("Content-type: text/html; charset=utf-8"); 
        $this->load->library("usermodel_tmp/umodel",array($userid));
        $res = $this->umodel->getAskArticle();
        print_r($res); 
    }
    public function gettag($userid)
    {
        header("Content-type: text/html; charset=utf-8"); 
        $this->load->library("usermodel_tmp/umodel",array($userid));
        $res = $this->umodel->getTag();
        print_r($res);
    }

}
