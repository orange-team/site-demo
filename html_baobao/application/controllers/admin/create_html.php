<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台--文章管理
* author: Liangxifeng
* date: 2013-06-22
*/

class Create_html extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('section_model','section');
		$this->load->model('keyword_model','keyword');
		$this->load->model('tag_model','tag');
	}

	//生成妈妈学右侧静态页面
	function create_right()
	{ 
        $this->load->helper('file');

        //获取栏目
        $row['rightList'] = $this->get_right_section();
        //取得标签列表
        $row['tagList'] = $this->get_right_tag(30);
        $this->load->view('mmxue_right',$row);
        $content = $this->output->get_output();

        $path = $_SERVER["DOCUMENT_ROOT"].'/application/views/';
        if ( !write_file($path.'mmxue_static_right.php', $content))
        {
             echo 'Unable to write the file';
        }
        else
        {
             echo 'File written!';
        }
    }

    //妈妈学右侧内容栏目
    function get_right_section()
    {
        $where = array('parent'=>1,'pt_depth'=>2);
        //二级栏目
        $two_section = $this->section->getList($where);
        foreach($two_section as $k=>&$v)
        {
            //二级栏目下的关键词
            $v['keyword'] = $this->keyword->getList(0,0,array('section'=>$v['id']));
            //三级栏目
            $v['three_section']= $this->section->getList(array('parent'=>$v['id'],'pt_depth'=>3));
            foreach($v['three_section'] as &$v3)
            {
                //三级栏目下的关键词
                $v3['keyword'] = $this->keyword->getList(0,0,array('section'=>$v3['id']),'id ASC');
            }
            //二级栏目下的关键词
            $v['keyword'] = $this->keyword->getList(0,0,array('section'=>$v['id']),'id ASC');
            $v['no_border'] = (($k+1) == count($two_section)) ? 1 : '';//判断是否显示div border-bottom 虚线
        }
        return $two_section;
    }

    //妈妈学右侧标签列表
    function get_right_tag($num)
    {
        $arr = array();
	    $arr = $this->tag->getOrder_weight($num,0);
        return $arr;
    }
}
   
