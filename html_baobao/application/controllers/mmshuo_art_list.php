<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * desc:前台--妈妈说文章列表页面
 * author:zg
 * date:2013/10/19
 */

class mmshuo_art_list extends LB_Controller 
{
    public $page_name='妈妈说';
    public $nav;
	private $_ask = array();
    //当前页码
	private $_current_page = 1;
    //每页条目数
	private $_limit = 5;
    //偏移
	private $_offset = 0;
    //条目总数
    private $_total_count = 0;
    //分页字符串 wrapper
	private $_pagination = '';
    public $pageNext = '';
    public $pagePrev = '';

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
        $timeline = $this->_getTimeline();
        //print_r($timeline);exit;
        $section = $this->_getSection();
		$this->_ask = $this->ask->getList()->result();
        //得到条目总数
		$this->_total_count = $this->ask->getTotal();

		if(!empty($this->_ask))
		{
			$this->_prepare_ask();
			$this->_apply_pagination(site_url('page').'/%');
		}

		/* 页面初始化 */
        $this->data['timeline'] = $timeline;
        $this->data['section'] = $section;
        $this->data['ask'] = $this->_ask;
		$this->data['pagination'] = $this->_pagination;
		$this->load->view('mmshuo_art_list', $this->data);
	}

    //时间轴数据
    private function _getTimeline()
    {
		$this->load->model('timeline_model','timeline');
        return $this->timeline->getList();
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

    /**
     * 加工和处理ask数据
     * 
     * @access private
     * @param  array  $ask 内容stdClass对象数组
     * @return void
     */
	private function _prepare_ask()
	{
		foreach($this->_ask as &$ask)
		{
            //格式化日期
            //$ask->add_time = Common::fmt_date($ask->add_time);
			/* 标签 */
			$ask->tags = $this->ask->getTag($ask->id);
			//unset($ask->content);
		}
	}

     // 应用分页规则
	private function _apply_pagination()
	{
		if($this->_total_count > $this->_limit)
		{
			$this->pageNext = '';
			$this->pagePrev = '';
		}
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
