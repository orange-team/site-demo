<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台--专栏管理
* author: zg
* date: 2013-07-28
*/

class specpage extends MY_Controller
{
    //封面图片路径
    var $specpage_path = '/uploads/img/specpage/';
	function __construct()
	{
		parent::__construct();
        //当前控制器名，用于view中复用
        $this->_info['cls'] = strtolower(__CLASS__);
        $this->_info['name'] = '专栏';
        $this->_info['view_path'] = 'admin/'.$this->_info['cls'];
		$this->load->model('specpage_model','specpage');
		$this->load->model('section_model','section');
		$this->load->model('keyword_model','keyword');
    }

	//专栏列表
	function showlist($section=0,$title='')
	{
        $this->load->helper('form'); 
        //搜索
        $where = array();
        //搜内容segment(4)
        $title = urldecode(trim($this->uri->segment(4)));
        $this->data['title'] = 0;
        if($title)  
        {
            $this->data['title'] = $title;
            $where['title'] = $this->data['title']; 
        }
		//分页
		$this->load->library('pagination');
		$config['base_url'] = site_url('admin/specpage/showlist/'.$this->data['title'].'/');
		//每页
		$config['per_page'] = $this->data['pagesize'] = 15 ; 
		//总数
		$config['total_rows'] = $this->specpage->getTotal($where);
		$config['uri_segment'] = 5;
		$config['first_link'] = '首页';
		$config['last_link'] = '尾页';
		$config['next_link'] = '下一页';
		$config['prev_link'] = '上一页';
		$this->pagination->initialize($config); 
		$this->data['page'] = $this->pagination->create_links();
		$offset = $this->uri->segment(5);
		$arr = $this->specpage->getList($this->data['pagesize'], $offset, $where);
		$this->data['specpageArr'] = $arr;
        unset($arr);
        $this->data['number'] = $offset+1; 
		$this->load->view('admin/specpageList', $this->data);
    }

	function add()
	{
		$this->load->helper('form');
        //等级栏目
        $this->data['one_section'] = $this->section->getBy_parent(0);
		//在线编辑器
		$eddt = array('name' =>'content', 'id' =>'content', 'value' =>'');
		$this->load->library('kindeditor',$eddt);
        $this->data ['kindeditor'] = $this->kindeditor->getEditor();
		$this->load->view('admin/specpageAdd', $this->data);
	}

    //保存新增结果
	function saveAdd()
	{
        $data = array(
                'section' => $this->input->post('section'),
                'keyword' => $this->input->post('keyword'),
				'title' => trim(addslashes($this->input->post('title'))),
				'content' => addslashes($this->input->post('content')),
				'add_time' => date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']),
				'author' => $this->input->post('author'),
                'edit_time' => date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']),
				);
		$specpage_id = $this->specpage->insertNew($data);
        $data['msg'] = ($specpage_id>0) ? '发布成功' : '发布失败';
        //上传图片,并做缩略
        $this->load->helper('upload');
		$uploadData = upload_img('upImg', $specpage_id,'specpage');
        if (-1 == $uploadData ) 
        {
			$data['msg'] = '图片上传失败';
			$data['url'] = '/admin/specpage/showlist/';
			return $this->load->view('admin/info', $data);
        }
        if ( 1 != $uploadData )
        {
            $addImg['cover'] = $uploadData['file_name'];
            //保存图片数据
            $affected_rows = $this->specpage->update_cover((int)$specpage_id, $addImg);
            $data['msg'] = ($affected_rows>0) ? '图片路径更新成功' : '图片路径更新失败';
        }
        unset($uploadData);
		$data['url'] = '/admin/specpage/showlist/';
		$this->load->view('admin/info', $data);
	}

	//编辑专栏
	function edit($specpage_id)
	{
        //封面图片路径
        $this->specpage_path .= $specpage_id.'/';
		$this->load->helper('form');
		$arr = $this->specpage->getBy_id($specpage_id);
        $section = $this->section->get_one(array('id'=>$arr['section']));
        $is_two = false;     //是否显示二级栏目
        $is_three = false;   //是否显示三级栏目
        $keyword_section = '';  //与关键词关联的栏目id
        $arr['one'] = $arr['two'] = '';//三个级栏目的selected标识
        //如果文章属于非顶级栏目
        if(isset($section['parent']) && $section['parent'] != 0)
        {
            $section_up = $this->get_parent($section['parent']);
            //如果文章属于三级栏目下
            $is_two = true;
            $arr['one'] = $section_up[0] ? $section_up[0] : '';
            $arr['two'] = $section_up[1] ? $section_up[1] : '';
            if('' != $arr['one'] && '' != $arr['two'])
            {
                $is_three = true;
                $keyword_section = $section['id'];
            }
            //如果文章属于二级栏目下
            if($arr['one'] == '')
            {
                $arr['one'] = $arr['two']; unset($arr['two']);
                $arr['two'] = $section;
                $keyword_section = $arr['two']['id'];
            } 
        }else//属于顶级栏目
        {
            $arr['one'] = $section;
            $keyword_section = isset($arr['one']['id']) ? $arr['one']['id'] : 0;
        }
        //查询所选栏目对应的关键词
        $list = $this->get_child($keyword_section);
        $list[1] = $list[1] ? $list[1] : array();
        $childs_id = array_keys($list[1]);//当前栏目下所有子栏目id
        array_unshift($childs_id,$keyword_section);
        $where['section'] = $childs_id;
        $arr['keywords'] = $this->keyword->getList(0,0,$where);
        //顶级栏目
        $arr['one_section'] = $this->section->getBy_parent(0);
        if( $is_two == true )
        {
            $fid = '' != $arr['one'] ? $arr['one']['id'] : $arr['two']['id'];
            $arr['two_section'] =  $this->section->getList(array('parent'=>$fid));
        }
        $arr['three_section'] = $is_three==true ? $this->section->getList(array('parent'=>$arr['two']['id'])) : '';
        //在线编辑器
		$eddt = array('name' =>'content', 'id' =>'content', 'value' =>$arr['content']);
		$this->load->library('kindeditor',$eddt);
        $arr['kindeditor'] = $this->kindeditor->getEditor( $eddt );
        //相关标签
		$this->load->model('relation_tag_model','relation_tag');
		$this->load->model('tag_model','tag');
        $whereData = array('target_id'=>$specpage_id,'target_type'=>2,'status'=>0);
        $tagArr = $this->relation_tag->get($whereData);
        $arrTagIds = $tagNameArr = array();
        foreach($tagArr as $k=>$v)
        {
            $arrTagIds[] = $v['tag_id'];
        }
        unset($tagArr);
        if(0<count($arrTagIds)) $tagNameArr = $this->tag->getBy_ids($arrTagIds);
		$arr['tagNameArr'] = $tagNameArr;
		$this->load->view('admin/specpageEdit', $arr);
	}

    //保存编辑结果
	function saveEdit($specpage_id)
	{
        if($this->input->post('section')) $data['section'] = trim(addslashes($this->input->post('section')));
		if($this->input->post('keyword')) $data['keyword'] = trim(addslashes($this->input->post('keyword')));
		if($this->input->post('title')) $data['title'] = trim(addslashes($this->input->post('title')));
		if($this->input->post('content')) $data['content'] = addslashes($this->input->post('content'));
		if($this->input->post('author')) $data['author'] = addslashes($this->input->post('author'));
		$data['edit_time'] = date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']);
		$affected_rows = $this->specpage->update($specpage_id, $data);
        unset($data);
        //上传图片,并做缩略
        $this->load->helper('upload');
		$uploadData = upload_img('upImg', $specpage_id,'specpage');
        if (-1 == $uploadData ) 
        {
			$data['msg'] = '图片上传失败';
			$data['url'] = '/admin/specpage/showlist/';
			return $this->load->view('admin/info', $data);
        }
        if ( 1 != $uploadData )
        {
            $addImg['cover'] = $uploadData['file_name'];
            //保存图片数据
            $affected_rows = $this->specpage->update_cover((int)$specpage_id, $addImg);
        }
        unset($uploadData);
		$data['msg'] = ($affected_rows) ? '成功' : '失败';
		$data['url'] = '/admin/specpage/showList/';
		$this->load->view('admin/info', $data);
	}

	function del($id)
	{
		$affected_rows = $this->specpage->del($id);
		$data['msg'] = ($affected_rows>0) ? '成功' : '失败';
		$data['history'] = '1';
		$data['url'] = '/admin/specpage/showlist/';
		$this->load->view('admin/info', $data);
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
