<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台--评论管理
* author: zg
* date: 2013-10-06
*/

class comment extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
        $this->load->model('comment_model','comment');
        $this->load->model('reply_model','reply');
        $this->comment->_get_table($this->input->get('type'));
        $this->reply->_get_table($this->input->get('type'));
        $this->output->set_header("Content-Type: text/html; charset=utf-8");
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
                $this->data['keywords'] =  $this->keyword->getList($where_section, 0, 0);
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
		$config['total_rows'] = $this->comment->getTotalNum($where);
		$this->data['section'] = (int)$section;
		$config['uri_segment'] = 6;
		$config['first_link'] = '首页';
		$config['last_link'] = '尾页';
		$config['next_link'] = '下一页';
		$config['prev_link'] = '上一页';
		$this->pagination->initialize($config); 
		$this->data['page'] = $this->pagination->create_links();
		$offset = $this->uri->segment($config['uri_segment']);
		$arr = $this->comment->getList($where, $this->data['pagesize'], $offset);
        //顶级栏目
        $this->data['one_section'] = $this->section->getBy_parent(0);
		$this->data['commentArr'] = $arr;
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
	function edit($comment_id)
	{
		$this->data = $this->comment->getOne($comment_id);
        //在线编辑器
		$edit = array('name' =>'content', 'id' =>'content', 'value' =>$this->data['content']);
		$this->load->library('kindeditor',$edit);
        $this->data['kindeditor'] = $this->kindeditor->getEditor( $edit );
        //相关标签
        $this->load->model('relation_tag_model','relation_tag');
        $this->load->model('img_lib_model','img_lib');
        $this->load->model('tag_model','tag');
        $whereData = array('target_id'=>$comment_id,'target_type'=>1,'status'=>0);
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

    //审核
    function audit()
    {
        //判断是否审核全部
        $all = (int)$this->input->get('all');
        if(1==$all)
        {
            $this->comment->auditAll();
            $this->reply->auditAll();
            $data['msg'] = ($affected_rows>0) ? '成功' : '失败';
            $data['url'] = site_url($this->_info['view_path'].'/showList/');
            echo $data['msg'];
        }
    }

	function saveEdit($comment_id)
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
		$affected_rows = $this->comment->update($comment_id, $data);
        unset($data);
		$data['msg'] = ($affected_rows>0) ? '成功' : '失败';
		$data['url'] = site_url($this->_info['view_path'].'/showList/');
		$this->load->view('admin/info', $data);
	}
	
	function del($id)
	{
		$affected_rows = $this->comment->del($id);
		$data['msg'] = ($affected_rows>0) ? '成功' : '失败';
		$data['history'] = '1';
		$data['url'] = '/admin/comment/showlist/';
		$this->load->view('admin/info', $data);
	}

}
