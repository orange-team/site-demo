<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * desc:前台--妈妈说文章列表页面
 * author:zg
 * date:2013/10/19
 */

class mmshuo_art_list extends LB_Controller 
{
    var $page_name;
    var $nav;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('article_model','art');
		$this->load->model('section_model','section');
		$this->load->model('tag_model','tag');
		$this->load->model('relation_tag_model','relation_tag');
	}
	public function index()
	{
        $this->_init();
        $this->load->helper('url');
		$this->load->view('mmshuo_art_list',$this->data);
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

    //递归获取子分类信息
    function get_child($id=0,$type=true)
    {
        if($type == true)//获取该栏目下所有子栏目,定义全局变量
            global $all_list;
        $childs = $this->section->getBy_parent($id);//只获取子栏目信息，非子孙栏目
        foreach($childs as $k=>$v)
        {
            if($id)
            {
               $this->get_child($v['id']);
               $all_list[$v['id']] = $v['name'];//组合本栏目下所有子孙栏目id与name为一唯数组
               
            }
        }
        return array($childs,$all_list);
    }

	/**
    +----------------------------------------------------------
    * 去除多余html、js标签和空白的公用方法
    +----------------------------------------------------------
    */
    public function remove_tag($str)
    {
    	$search = array ("'<script[^>]*?>.*?</script>'si",  // 去掉 javascript
                 		 "'<[\/\!]*?[^<>]*?>'si",           // 去掉 HTML 标记
                 		 "'([\r\n])[\s]+'",                 // 去掉空白字符
                 		 "'&(quot|#34);'i",                 // 替换 HTML 实体
                 	 	 "'&(amp|#38);'i",
                 		 "'&(lt|#60);'i",
                 		 "'&(gt|#62);'i",
                  		 "'&(nbsp|#160);'i",
                 		 "'&(iexcl|#161);'i",
                 		 "'&(cent|#162);'i",
                 		 "'&(pound|#163);'i",
                 		 "'&(copy|#169);'i",
                		 "'&#(\d+);'e");                    // 作为 PHP 代码运行
    	$replace = array ("","","\\1","\"","&","<",">"," ",chr(161),chr(162),chr(163),chr(169),"chr(\\1)","");
		$str= preg_replace($search,$replace,$str);
		return $str;
	}

    // 计算中文字符串长度                                                                                                                                 
    function utf8_strlen($string = NULL){
        // 将字符串分解为单元
        preg_match_all("/./us",$string,$match);
        // 返回单元个数
        return count($match[0]);
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
