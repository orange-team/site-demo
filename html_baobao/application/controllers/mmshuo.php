<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * desc:前台--妈妈说文章列表页面
 * author:zg
 * date:2013/10/19
 */

class Mmshuo extends LB_Controller 
{
    public $page_name='妈妈说';
    //面包屑导航
    public $nav;
	private $_ask = array();
    //当前uri
	public $_uri = '';
    //分页的基础url
    private $_base_url = '';
    //页码的segment
    private $_uri_segment = 4;
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

	public function __construct()
	{
		parent::__construct();
		$this->_uri = $this->uri->segment(1) . '/index/';
		$this->load->model('ask_article_model','ask');
	}

	public function index()
	{
        //时间轴
        $timeline = $this->_getTimeline();
        $this->data['timeline'] = $timeline;
        //时期-->标签
        $section = $this->_getSection();

        //搜索
        $where = array();
        //tag
        $tag = trim($this->uri->segment(3));
        $this->data['tag'] = 0;
        if($tag)  
        {
            $this->data['tag'] = addslashes($tag); 
            $where['tag_id'] = $this->data['tag']; 
        }
        //var_dump($current_page, $tag);
		$this->_offset = $this->uri->segment($this->_uri_segment);
		$this->_ask = $this->ask->getList($where, $this->_limit, $this->_offset)->result();
        //得到条目总数
		$this->_total_count  = $this->ask->getList($where)->num_rows();
        //var_dump($where, $this->_limit, $this->_offset, $this->_ask);
        $this->data['ask'] = $this->_ask;
        //var_dump($this->_total_count);
		if(!empty($this->_ask))
		{
			$this->_prepare_ask();
			$this->_apply_pagination();
		}
		/* 页面初始化 */
        $this->_init();
        $this->data['section'] = $section;
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
        //$this->nav = '<a href="'.base_url().'mmshuo/"> '.$this->page_name.'</a>';
        $this->nav = $this->page_name;
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
		foreach($this->data['ask'] as &$ask)
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
            $config['base_url'] = site_url($this->_uri.$this->data['tag'].'/');
            $config['per_page'] = $this->_limit; 
            $config['total_rows']  = $this->_total_count;
            $config['uri_segment'] = $this->_uri_segment;
            $config['next_link'] = $config['prev_link'] = '';
            $config['prev_tag_open'] = '<div class="prev">';
            $config['prev_tag_close'] = '</div>';
            $config['next_tag_open'] = '<div class="next">';
            $config['next_tag_close'] = '</div>';
            //不显示页码(1 2 3 ...)
            $config['display_pages'] = false;
            //不显示“尾页”,"首页"
            $config['last_link'] = $config['first_link'] = false;
            $this->pagination->initialize($config); 
            $this->_pagination = $this->pagination->create_links();
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
