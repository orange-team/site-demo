<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * desc:前台妈妈学文章列表页面
 * author:Liangxifeng
 * date:2013-07-28
 */

class mmxue_art_list extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('article_model','art');
		$this->load->model('section_model','section');
		$this->load->model('tag_model','tag');
		$this->load->model('relation_tag_model','relation_tag');
		$this->load->model('specpage_model','specpage');
	}
	public function index()
	{
        $section = $this->uri->segment(3);

		$this->data['section'] = (int)$section;
        //文章列表
        $this->load->helper('form'); 

        //搜索
        $where = array();
        //搜栏目segment(4)
        $this->data['section'] = 0;
        $row['nav'] = '';

        if(intval($section))
        {
            $childs = $this->get_child($section);
            $childs_id = $childs[1] ? array_keys($childs[1]) : array();//子栏目id
            array_unshift($childs_id,$section);
            $where['section'] = $childs_id;
            $this->data['section'] = $section; 

            //获取对应栏目
            $section_row = $this->section->get_one(array('id'=>$section));
            $row['nav'] = "<a href='".base_url()."mmxue/index'> ".$section_row['name']."</a>";

            //获得上级栏目
            if(3 == $section_row['pt_depth'])
            {
                $section_parent = $this->get_section($section_row['parent']);
                $row['nav'] = "<a href='".base_url()."mmxue/index/'> ".$section_parent[0]['name']."</a> > ";
                $row['nav'] .= "<a href='".base_url()."mmxue_art_list/index/".$section_parent[1]['id']."' > ".$section_parent[1]['name']."</a> > ";
                $row['nav'] .= "<a href='".base_url()."mmxue_art_list/index/".$section_row['id']."'>".$section_row['name']."</a>";
            }else if(2 == $section_row['pt_depth'])
            {
                $section_parent = $this->section->get_one(array('id'=>$section_row['parent']));
                $row['nav'] = "<a href='".base_url()."mmxue/index/' > ".$section_parent['name']."</a> >";
                $row['nav'] .= "<a href='".base_url()."mmxue_art_list/index/".$section_row['id']."' > ".$section_row['name']."</a>";
            }
        }

        $search_name = '';
        //头部搜索
        if('search' == $section)
        {
            $search_name = $this->data['search_name'] = addslashes(trim($this->input->get('search_name')));
            $where = array('title'=>$search_name);
            $row['nav'] = "<a href='".base_url()."mmxue/index/'>妈妈学</a> > 首页搜索";
            
        }

        $this->data['nav'] = $row['nav'];
        unset($row['nav']);


		//分页
		$this->load->library('pagination');
        $config['base_url'] = site_url('mmxue_art_list/index/'.$this->data['section'].'/');
		//每页
		$config['per_page'] = $this->data['pagesize'] = 10; 
		//总数
        $config['total_rows'] = $this->data['total_rows'] = $this->art->getTotal($where);;
        $this->data['countPage'] = $countPage = ceil($config['total_rows']/$config['per_page']);
		//手动输入页码时的页数
		if($this->input->post('go_page') && $this->input->post('go_page')>0)
		{
            $this->data['go_page'] = intval($this->input->post('go_page'));
			if($this->data['go_page'] <= $countPage)
			{
				$offset = ($this->data['go_page']-1)*$config['per_page'];
				$config['cur_page'] = $this->data['go_page']-1;
			}
			else
			{
				$offset = $config['cur_page'] = $countPage-1;
				$this->data['go_page'] =  $countPage;
            }
		}else
		{
            $offset = $this->uri->segment(4);
			$this->data['go_page'] = '';
		}
		$config['uri_segment'] = 4;
		$config['first_link'] = '首页';
		$config['last_link'] = '尾页';
        $config['prev_tag_open'] = $config['next_tag_open'] = $config['first_tag_open'] = $config['last_tag_open'] = "<span class='next'>";
        $config['prev_tag_close'] = $config['next_tag_close'] = $config['first_tag_close'] = $config['last_tag_close'] = "</span>";
		$config['next_link'] = "下一页";
        $config['cur_tag_open'] = "&nbsp;<a class='on'>";
        $config['cur_tag_close'] = "</a>";
		$config['prev_link'] = "上一页";
		$this->pagination->initialize($config); 
		$this->data['page'] = $this->pagination->create_links();
		$arr = $this->art->getList($this->data['pagesize'], $offset, $where);
        foreach($arr as &$v)
        {
            $v['content'] = $this->remove_tag($v['content']);
            //获取标签
            $tag_ids = $this->relation_tag->get(array('target_type'=>1,'target_id'=>$v['id']));
            $tag_id = '';
            foreach($tag_ids as $val)
            {
                $tag_id[] = $val['tag_id'];
            }
            $v['tags'] = $this->tag->getBy_ids($tag_id);
            unset($tag_ids);
        }
		$this->data['articleArr'] = $arr;
        unset($arr);
        $this->data['number'] = $offset+1; 

        //3张专栏图片信息
        $this->data['specpage'] = $this->specpage->getList(3,0,array('cover != '=>''));

        $this->data['seo'] = array('title'=>'妈妈学文章列表页',
                'description'=>'妈妈学文章列表页的描述页面信息',
                'keywords'=>'妈妈学,母婴知识,宝宝健康'
                );
        //要载入的css, js文件
        $this->data['file'] = array('js'=>'mmxue_art','css'=>'mmxue_art_list');

        //取得标签列表
        $this->data['tagList'] = $this->get_tag(30);
        $this->data['isRed'] = 1;

		$this->load->helper('url');
		$this->load->view('mmxue_art_list',$this->data);
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
