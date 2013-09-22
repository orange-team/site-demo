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
        //详细页id
        $id = (int)trim(addslashes($this->uri->segment(3)));
        $this->data['prev'] = $this->get_prev($id);
        $this->data['next'] = $this->get_next($id);

        $this->data['seo'] = array('title'=>'百科知识详细页',
                'description'=>'百科知识的详细页面信息',
                'keywords'=>'百科知识,母婴知识,宝宝健康'
                );
        //要载入的css, js文件
        $this->data['file'] = array('js'=>'mmxue_art','css'=>'wiki_detail');
        $wikiArr = $this->wiki->getBy_id($id);
        $this->data['wikiArr'] = $wikiArr;
        //得到推荐文章
        $this->data['recommend'] = $this->get_recommend((int)$wikiArr['tag_id']);
        $this->data['isRed'] = 1;
        unset($wikiArr);
		$this->load->view('wiki_detail', $this->data);
	}

    //得到上一篇
	private function get_prev($id)
    {
		$this->db->select('id, wiki_key')->from($this->_table)->where('id <',$id)->order_by('id desc')->limit(1);
		return $this->db->get()->row_array();
	}
    
    //得到下一篇
	private function get_next($id)
    {
		$this->db->select('id, wiki_key')->from($this->_table)->where('id >',$id)->limit(1);
		return $this->db->get()->row_array();
	}
 
    //得到推荐文章,涉及两张表，故没放到model中
	private function get_recommend($tag_id)
    {
        $arr = array();
		$this->db->select('target_id')->from('a_relation_tag')->where('tag_id',$tag_id)->where('status',1)->where('target_type',1)->limit(6);
		$resIds = $this->db->get()->result_array();
        if( is_array($resIds) && 0 < count($resIds) )
        {
            $this->db->select('id, title')->from('a_article')->where_in('id >',$resIds)->limit(10);
        } else {
            $this->db->select('id, title')->from('a_article')->order_by('attention desc')->limit(10);
        }
        $arr = $this->db->get()->result_array();
        return $arr;
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
        $this->data['keyArr'] = $this->wiki->get_wiki_key($this->data['A_Z']);
		$this->load->view('wiki_dict', $this->data);
	}
    
}
