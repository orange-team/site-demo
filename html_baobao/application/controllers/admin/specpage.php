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
        $this->data['_class'] = Strtolower(__CLASS__);
		$this->load->model('specpage_model','specpage');
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
				'title' => $this->input->post('title'),
				'content' => $this->input->post('content'),
				'add_time' => date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']),
				'author' => $this->input->post('author'),
				);
		$specpage_id = $this->specpage->insertNew($data);
        $data['msg'] = ($specpage_id>0) ? '文章发布成功' : '文章发布失败';
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
		$this->load->helper('form');
		$arr = $this->specpage->getBy_id($specpage_id);
        $this->specpage_path .= $specpage_id.'/';
        //在线编辑器
		$eddt = array('name' =>'content', 'id' =>'content', 'value' =>$arr['content']);
		$this->load->library('kindeditor',$eddt);
        $arr['kindeditor'] = $this->kindeditor->getEditor( $eddt );
        //相关标签
		$this->load->model('admin/relation_tag_model','relation_tag');
		$this->load->model('admin/tag_model','tag');
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
		if($this->input->post('title')) $data['title'] = trim(addslashes($this->input->post('title')));
		if($this->input->post('content')) $data['content'] = addslashes($this->input->post('content'));
		if($this->input->post('author')) $data['author'] = addslashes($this->input->post('author'));
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

}
