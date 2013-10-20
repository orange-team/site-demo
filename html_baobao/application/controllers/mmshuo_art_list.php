<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * desc:前台--妈妈说文章列表页面
 * author:zg
 * date:2013/10/19
 */

class mmshuo_art_list extends LB_Controller 
{
    var $page_name='妈妈说';
    var $nav;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ask_article_model','ask');
		$this->load->model('section_model','section');
		$this->load->model('tag_model','tag');
		$this->load->model('relation_tag_model','relation_tag');
	}

	public function index()
	{
        $this->_init();
        $timelineArr = $this->_getTimeline();
        $sectionArr = $this->_getSection();
        $askArr = $this->ask->getList();
        //print_r($askArr); exit;
        $this->data['timeline'] = $timeline;
        $this->data['section'] = $section;
        $this->data['ask'] = $ask;
        $this->load->helper('url');
		$this->load->view('mmshuo_art_list',$this->data);
	}

    //时间轴数据
    private function _getTimeline()
    {
    }

    //时期数据
    private function _getSection()
    {
    }

    //初始化SEO，js，css信息
    private function _init()
    {
        $this->data['seo'] = array('title'=>'妈妈说首页',
                'description'=>'描述页面信息',
                'keywords'=>'母婴知识,宝宝健康'
                );
        //要载入的css, js文件
        $this->data['file'] = array('js'=>'mmshuo_art_list','css'=>'mmshuo_art_list');
        //面包屑导航
        $this->nav = '<a href="'.base_url().'mmshuo_art_list/"> '.$this->page_name.'</a>';
    }

    //获取父及栏目内容
    function get_section($id)
    {
        if($id != 0)
        {
            $parents = $this->section->get_one(array('id'=>$id));
            $parent_top = array();
            if($parents['parent'] != 0 )
            {
                $parent_top =  $this->section->get_one(array('id'=>$parents['parent']));
            }
            $return = array($parent_top,$parents);
        }else
        {
            $return = 'top';
        }
        return $return;
    }

    //获取标签列表
    function get_tag($num)
    {
        $arr = array();
	    $arr = $this->tag->getOrder_weight($num,0);
        return $arr;
    }

}
