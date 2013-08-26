<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 专栏控制器，包括：详细页、关键词字典页
* author: zg
* date: 2013-08-26
*/
 
class specpage extends MY_Controller 
{
    var $_table = 'a_specpage';
    var $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->lang->load('common');
        $this->load->model('specpage_model','specpage');
	}

    //详细页
	public function index()
	{
        $this->data['seo'] = array('title'=>'专栏详细页',
                'description'=>'专栏的详细页面信息',
                'keywords'=>'专栏,母婴知识,宝宝健康'
                );
        //要载入的css, js文件
        $this->data['file'] = array('js'=>'specpage_detail','css'=>'specpage_detail');
        //详细页id
        $id = (int)trim(addslashes($this->uri->segment(3)));
        $this->data['specpageArr'] = $this->specpage->getBy_id($id);
		$this->load->view('specpage_detail', $this->data);
	}

    
}
