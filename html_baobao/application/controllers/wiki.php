<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 百科知识控制器，包括：详细页、关键词字典页
* author: zg
* date: 2013-08-26
*/
 
class Wiki extends MY_Controller 
{
    var $_table = 'a_wiki';
    var $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->lang->load('common');
        $this->load->model('wiki_model','wiki');
	}

    //详细页
	public function index()
	{
        $this->data['seo'] = array('title'=>'百科知识详细页',
                'description'=>'百科知识的详细页面信息',
                'keywords'=>'百科知识,母婴知识,宝宝健康'
                );
        //要载入的css, js文件
        $this->data['file'] = array('js'=>'wiki_detail','css'=>'wiki_detail');
        //详细页id
        $id = (int)trim(addslashes($this->uri->segment(3)));
        $this->data['wikiArr'] = $this->wiki->getBy_id($id);
		$this->load->view('wiki_detail', $this->data);
	}

    //关键词字典页
    public function dict()
	{
        $this->data['seo'] = array('title'=>'百科知识关键词字典页',
                'description'=>'百科知识的描述页面信息',
                'keywords'=>'百科知识,母婴知识,宝宝健康'
                );
        //要载入的css, js文件
        $this->data['file'] = array('js'=>'wiki_dict','css'=>'wiki_dict');
        //育儿百科--字母检索
        $this->data['A_Z'] = range('A', 'Z');
        $this->data['keyArr'] = $this->wiki->get_wiki_dict($this->data['A_Z']);
		$this->load->view('wiki_dict', $this->data);
	}
    
}
