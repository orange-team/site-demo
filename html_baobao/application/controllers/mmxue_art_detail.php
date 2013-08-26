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
	}
	public function index($id)
	{
        $id = intval($id);
        $row = $this->art->getBy_id($id);
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
            $row['nav'] = "<a href='".base_url()."mmxue'>".$section_parent['name']."</a> >";
            $row['nav'] .= "<a href='".base_url()."mmxue_art_list/index/".$section['id']."'>".$section['name']."</a>";
        }
        $row['nav'] .= " > ".$row['title'];
        //组合面包屑导航

        //上一篇
        $row['pre'] = $id-1==0 ? 1 : $id-1;
        //下一篇
        $row['next'] = $id+1;
        $head['seo'] = array('title'=>'妈妈学文章内容页',
                'description'=>'妈妈学文章内容页的描述页面信息',
                'keywords'=>'妈妈学,母婴知识,宝宝健康'
                );
        //要载入的css, js文件
        $head['file'] = array('js'=>'mmxue_art','css'=>'mmxue_art_detail');

        $head['title'] = '文章详情页面';
		$this->load->helper('url');
		$this->load->view('header',$head);
		$this->load->view('mmxue_art_detail',$row);
		$this->load->view('mmxue_right',$row);
		$this->load->view('footer');
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

}
