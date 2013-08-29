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
        $this->output->set_header("Content-Type: text/html; charset=utf-8");
	}

    //详细页
	public function index()
	{
        //详细页id
        $id = (int)trim(addslashes($this->uri->segment(3)));
        $this->data['prev'] = $this->get_prev($id);
        $this->data['next'] = $this->get_next($id);
        $this->data['seo'] = array('title'=>'专栏详细页',
                'description'=>'专栏的详细页面信息',
                'keywords'=>'专栏,母婴知识,宝宝健康'
                );
        //要载入的css, js文件
        $this->data['file'] = array('js'=>'mmxue_art','css'=>'mmxue_art_detail');
        $this->data['specpageArr'] = $this->specpage->getBy_id($id);
        $this->data['specpageArr']['source'] = '本站';
		$this->load->view('specpage_detail', $this->data);
	}

    //得到上一篇
	private function get_prev($id)
    {
		$this->db->select('id, title')->from($this->_table)->where('id <',$id)->order_by('id desc')->limit(1);
		return $this->db->get()->row_array();
	}
    
    //得到下一篇
	private function get_next($id)
    {
		$this->db->select('id, title')->from($this->_table)->where('id >',$id)->limit(1);
		return $this->db->get()->row_array();
	}

    //相关推荐文章
    private function get_recommend_art($id)
    {
		$this->db->select('id, title')->from($this->_table)->where('id >',$id)->limit(1);
		return $this->db->get()->row_array();
    }


}
