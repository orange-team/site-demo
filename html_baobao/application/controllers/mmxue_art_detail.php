<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * desc:前台妈妈学文章详情页面
 * author:Liangxifeng
 * date:2013-07-28
 */

class mmxue_art_detail extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/article_model','art');
		$this->load->model('admin/section_model','section');
		$this->load->model('admin/keyword_model','keyword');
		$this->load->model('tag_model','tag');
	}
	public function index($id)
	{
        //var $spec_path = '/uploads/specpage/8/';
        $id = intval($id);
        $row = $this->art->getBy_id($id);
        //关注度
        $attention = intval($row['attention']+1);  
        $this->art->update($id,array('attention'=>$attention));
        unset($attention);

        //获取对应栏目
        $section = $this->section->get_one(array('id'=>$row['section']));
        //$row['nav'] = "<a href='".base_url()."mmxue_art_list/index/".$section['id']."'>".$section['name']."</a>";
        $row['nav'] = "<a href='".base_url()."mmxue'>".$section['name']."</a>";

        //获得上级栏目
        if(3 == $section['pt_depth'])
        {
            $section_parent = $this->get_section($section['parent']);
            //$row['nav'] = "<a href='".base_url()."mmxue_art_list/index/".$section_parent[0]['id']."'>".$section_parent[0]['name']."</a> > ";
            $row['nav'] = "<a href='".base_url()."mmxuex'>".$section_parent[0]['name']."</a> > ";
            $row['nav'] .= "<a href='".base_url()."mmxue_art_list/index/".$section_parent[1]['id']."'>".$section_parent[1]['name']."</a> > ";
            $row['nav'] .= "<a href='".base_url()."mmxue_art_list/index/".$section['id']."'>".$section['name']."</a>";
        }else if(2 == $section['pt_depth'])
        {
            $section_parent = $this->section->get_one(array('id'=>$section['parent']));
            //$row['nav'] = "<a href='".base_url()."mmxue_art_list/index/".$section_parent['id']."'>".$section_parent['name']."</a> >";
            $row['nav'] = "<a href='".base_url()."mmxue'>".$section_parent['name']."</a> > ";
            $row['nav'] .= "<a href='".base_url()."mmxue_art_list/index/".$section['id']."'>".$section['name']."</a>";
        }
        $row['nav'] .= " > ".$row['title'];
        //组合面包屑导航

        //上一篇
        $pre = $this->art->getByorder_id('id < '.$id.' AND section = '.$row['section'],'id DESC');
        $row['pre'] = empty($pre) ? '' : $pre;

        //下一篇
        $next = $this->art->getByorder_id('id > '.$id.' AND section = '.$row['section'],'id ASC');
        $row['next'] = empty($next) ? '' : $next;
        unset($pre,$next);
        $row['seo'] = array('title'=>'妈妈学文章内容页',
                'description'=>'妈妈学文章内容页的描述页面信息',
                'keywords'=>'妈妈学,母婴知识,宝宝健康'
                );
        //要载入的css, js文件
        $row['file'] = array('js'=>'mmxue_art','css'=>'mmxue_art_detail');

        //取得推荐文章列表
        $artList = $this->get_recommend_art(10);
        $row['artList_1'] = array_slice($artList,0,5);
        $row['artList_2'] = array_slice($artList,5,5);


		$this->load->helper('url');
		$this->load->view('mmxue_art_detail',$row);
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

    //获取推荐文章列表
    function get_recommend_art($num)
    {
        $arr = array();
		$arr = $this->art->getList($num, 0, array('recommend'=>1));
        return $arr;
    }



}
