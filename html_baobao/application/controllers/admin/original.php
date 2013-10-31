<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台--原创管理
* author: zg
* date: 2013-09-06
*/

class Original extends MY_Controller
{
    //用百度搜索关键词
    var $baidu = array('search' => 'http://www.baidu.com/s?wd=',
        'index'=>'http://index.baidu.com/main/word.php?word=');
    var $img_lib_path = '/uploads/img_lib/';

	function __construct()
	{
		parent::__construct();
        $this->_info['cls'] = strtolower(__CLASS__);
        $this->_info['name'] = '深度原创';
        $this->_info['view_path'] = 'admin/'.$this->_info['cls'];
		$this->load->model('original_model','original');
		$this->load->model('section_model','section');
		$this->load->model('keyword_model','keyword');
	}

	//列表
	function showlist($section=0,$title='')
	{
        //搜索
        $where = array();
        //搜栏目segment(4)
        $this->data['section'] = 0;
        $this->data['cate_id'] = '';
        $this->data['one'] = $this->data['two'] = $this->data['three'] = 0; //栏目id
        $this->data['two_value'] = $this->data['three_value'] = '';         //栏目内容
        $this->data['keywords'] = array(); //关键词数组
        $this->data['keyword_id'] = 0;     //关键词id
        if($section)
        {
            //0:一级栏目id, 1:二级栏目id, 2:三级栏目id, 3:关键词id
            $arr = explode('-',$section); 
            if($arr[0] != 0)
            {
                $childs = $this->get_child($arr[0]);
                $childs_id = $childs[1] ? array_keys($childs[1]) : array();//子栏目id
                array_unshift($childs_id,$arr[0]);
                $where['section'] = $childs_id;
                $this->data['two_value'] = $childs[0] ? $childs[0] : '';   //二级栏目内容
            }
            if(isset($arr[1]) && $arr[1] != 0 && !empty($this->data['two_value']))
            {
                unset($childs,$childs_id,$where['section']);
                $childs = $this->get_child($arr[1],false);
                $childs_id = $childs[1] ? array_keys($childs[1]) : array();//子栏目id
                array_unshift($childs_id,$arr[1]);
                $where['section'] = $childs_id;
                $this->data['three_value'] = $childs[0] ? $childs[0] : ''; //三级栏目内容
            }
            if(isset($arr[2]) && $arr[2] != 0 && !empty($this->data['three_value']))
            {
                unset($where['section']);
                $where['section'] = array($arr[2]);
            }
            if(isset($arr[3]) && $arr[3] != 0)
            {
                $this->data['keyword_id'] = $where['keyword'] = (int)$arr[3];
            }

            //搜关键词
            if($where['section'])
            {
                $where_section['section'] = $where['section'];
                $this->data['keywords'] =  $this->keyword->getList($where_section, 0,0);
            }

            $this->data['section'] = $section; 
            $this->data['one'] = isset($arr[0]) ? $arr[0] : 0;
            $this->data['two'] = isset($arr[1]) ? $arr[1] : 0;
            $this->data['three'] = isset($arr[2]) ? $arr[2] : 0;
        }
        //搜标题segment(5)
        $this->data['title'] = 0;
        if($title)  
        {
            $this->data['title'] = urldecode(filter($title));
            $where['title'] = $this->data['title']; 
        }
		//分页
		$this->load->library('pagination');
		$config['base_url'] = site_url($this->_info['view_path'].'/showlist/'.$this->data['section'].'/'.$this->data['title'].'/');
		//每页
		$config['per_page'] = $this->data['pagesize'] = 15; 
		//总数
		$config['total_rows'] = $this->original->getTotalNum($where);
		$this->data['section'] = (int)$section;
		$config['uri_segment'] = 6;
		$config['first_link'] = '首页';
		$config['last_link'] = '尾页';
		$config['next_link'] = '下一页';
		$config['prev_link'] = '上一页';
		$this->pagination->initialize($config); 
		$this->data['page'] = $this->pagination->create_links();
		$offset = $this->uri->segment($config['uri_segment']);
		$arr = $this->original->getList($where, $this->data['pagesize'], $offset);
        //顶级栏目
        $this->data['one_section'] = $this->section->getBy_parent(0);
		$this->data['originalArr'] = $arr;
        $this->data['number'] = $offset+1; 
		$this->load->view($this->_info['view_path'].'List', $this->data);
	}

    //添加
	function add()
	{
		$this->load->helper('form');
        //等级栏目
        $this->data['one_section'] = $this->section->getBy_parent(0);
		//在线编辑器
		$edit = array('name' =>'content', 'id' =>'content', 'value' =>'');
		$this->load->library('kindeditor',$edit);
        $this->data ['kindeditor'] = $this->kindeditor->getEditor();
		$this->load->view($this->_info['view_path'].'Add', $this->data);
	}

	//编辑原创
	function edit($original_id)
	{
		$this->data = $this->original->getOne($original_id);
        $section = $this->section->get_one(array('id'=>$this->data['section']));
        $is_two = false;     //是否显示二级栏目
        $is_three = false;   //是否显示三级栏目
        $keyword_section = '';  //与关键词关联的栏目id
        $this->data['one'] = $this->data['two'] = '';//三个级栏目的selected标识

        //如果原创属于非顶级栏目
        if($section['parent'] != 0)
        {
            $section_up = $this->get_parent($section['parent']);
            //如果原创属于三级栏目下
            $is_two = true;
            $this->data['one'] = $section_up[0] ? $section_up[0] : '';
            $this->data['two'] = $section_up[1] ? $section_up[1] : '';
            if('' != $this->data['one'] && '' != $this->data['two'])
            {
                $is_three = true;
                $keyword_section = $section['id'];
            }

            //如果原创属于二级栏目下
            if($this->data['one'] == '')
            {
                $this->data['one'] = $this->data['two']; unset($this->data['two']);
                $this->data['two'] = $section;
                $keyword_section = $this->data['two']['id'];
            } 
        }else//属于顶级栏目
        {
            $this->data['one'] = $section;
            $keyword_section = $this->data['one']['id'];
        }

        //查询所选栏目对应的关键词
        $list = $this->get_child($keyword_section);
        $list[1] = $list[1] ? $list[1] : array();
        $childs_id = array_keys($list[1]);//当前栏目下所有子栏目id
        array_unshift($childs_id,$keyword_section);
        $where['section'] = $childs_id;
        $this->data['keywords'] = $this->keyword->getList($where,0,0);
        
        //顶级栏目
        $this->data['one_section'] = $this->section->getBy_parent(0);
        if( $is_two == true )
        {
            $fid = '' != $this->data['one'] ? $this->data['one']['id'] : $this->data['two']['id'];
            $this->data['two_section'] =  $this->section->getList(array('parent'=>$fid));
        }
        $this->data['three_section'] = $is_three==true ? $this->section->getList(array('parent'=>$this->data['two']['id'])) : '';

		//在线编辑器
		$edit = array('name' =>'content', 'id' =>'content', 'value' =>$this->data['content']);
		$this->load->library('kindeditor',$edit);
        $this->data['kindeditor'] = $this->kindeditor->getEditor( $edit );
        //相关标签
        $this->load->model('relation_tag_model','relation_tag');
        $this->load->model('img_lib_model','img_lib');
        $this->load->model('tag_model','tag');
        $whereData = array('target_id'=>$original_id,'target_type'=>1,'status'=>0);
        $tagArr = $this->relation_tag->get($whereData);
        $arrTagIds = $tagNameArr = array();
        foreach($tagArr as $k=>$v)
        {
            //读取图片库
            $img_libArr[] = $this->img_lib->getBy_tag($v['tag_id']);
            $arrTagIds[] = $v['tag_id'];
        }
        unset($tagArr);
        if(0<count($arrTagIds)) $tagNameArr = $this->tag->getBy_ids($arrTagIds);
        $this->data['tagNameArr'] = $tagNameArr;
        $this->data['img_libArr'] = $img_libArr;
		$this->load->view($this->_info['view_path'].'Edit', $this->data);
	}

    //百度指数是gbk的，所以单写页面实现跳转
    function go_baidu_index($str)
    {
        $this->load->helper('common');
        header('Content-Type: text/html; charset=gbk');
        echo '
        <script type="text/javascript">
        window.location.href="'.$this->baidu['index'].'"+decodeURIComponent("'.utf2gbk($str).'");
        </script>
        ';
    }

	function saveEdit($original_id)
	{
		if($this->input->post('section')) $data['section'] = filter($this->input->post('section'));
		if($this->input->post('keyword')) $data['keyword'] = filter($this->input->post('keyword'));
		if($this->input->post('title')) $data['title'] = filter($this->input->post('title'));
		if($this->input->post('subtitle')) $data['subtitle'] = filter($this->input->post('subtitle'));
		if($this->input->post('source')) $data['source'] = filter($this->input->post('source'));
		if($this->input->post('content')) $data['content'] = filter($this->input->post('content'));
		if($this->input->post('description')) $data['description'] = filter($this->input->post('description'));
		if($this->input->post('page_keywords')) $data['page_keywords'] = filter($this->input->post('page_keywords'));
		if($this->input->post('attention')) $data['attention'] = filter($this->input->post('attention'));
		if($this->input->post('recommend')) $data['recommend'] = filter($this->input->post('recommend'));
        //更新时间，防止没有改动的提交，导致affected_rows=0
        $data['add_time'] = date('Y-m-d H:i:s');
		$affected_rows = $this->original->update($original_id, $data);
        unset($data);
		$data['msg'] = ($affected_rows>0) ? '成功' : '失败';
		$data['url'] = site_url($this->_info['view_path'].'/showList/');
		$this->load->view('admin/info', $data);
	}
	
	function saveAdd()
	{
		$data = array(
				'title' => $this->input->post('title'),
				'subtitle' => $this->input->post('subtitle'),
				'content' => $this->input->post('content'),
				'add_time' => date('Y-m-d H:i:s'),
				'section' => $this->input->post('section'),
				'keyword' => $this->input->post('keyword'),
				'description' => $this->input->post('description'),
				'page_keywords' => $this->input->post('page_keywords'),
				'attention' => $this->input->post('attention'),
				'source' => $this->input->post('source'),
				'recommend' => $this->input->post('recommend'),
				);
		$affected_rows = $this->original->insert($data);
		$data['msg'] = ($affected_rows>0) ? '成功' : '失败';
		$section = $this->input->post('section').'/';
		$data['url'] = '/admin/original/showlist/'.$section;
		$data['history'] = '1';
		$this->load->view('admin/info', $data);
	}
		
	function del($id)
	{
		$affected_rows = $this->original->del($id);
		$data['msg'] = ($affected_rows>0) ? '成功' : '失败';
		$data['history'] = '1';
		$data['url'] = '/admin/original/showlist/';
		$this->load->view('admin/info', $data);
	}

    //ajax异步三级联动
    function ajax_change($id=0)//$id有值，則代表不是ajax异步获取
    {
        $section_id = $this->input->get('section_id') ? intval($this->input->get('section_id')) : $id;
        $showKey = $this->input->get('showKey') ? intval($this->input->get('showKey')) : ''; //showKey值为1时查询关键词，0:不查询
        if(!empty($section_id))
        {
            $childs = $this->section->getBy_parent($section_id);
            unset($childs['pt_depth'],$childs['parent']);
            if($showKey != '')
            {
                $list = $this->get_child($section_id);
                $list[1] = $list[1] ? $list[1] : array();
                $childs_id = array_keys($list[1]);//当前栏目下所有子栏目id
                array_unshift($childs_id,$section_id);
                $where['section'] = $childs_id;
                $childs['keywords'] = $this->keyword->getList($where,0,0);
            }
            if($id == 0)
            {
                echo !empty($childs) ? json_encode($childs) : -1; 
            }else
            {
                return !empty($childs) ? $childs : -1;  
            }
        }else
        {
            return -2;
        }
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

    //获取父及栏目内容
    function get_parent($id)
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
