<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台--百科管理
* author: zg
* date: 2013-09-01
*/

class wiki extends MY_Controller
{
    //封面图片路径
    var $wiki_img_path = '/uploads/img/wiki/';

	function __construct()
	{
		parent::__construct();
        $this->_info['cls'] = strtolower(__CLASS__);
        $this->_info['name'] = '百科';
        $this->_info['view_path'] = 'admin/'.$this->_info['cls'];
		$this->load->model('wiki_model','wiki');
    }

	//百科列表
	function showlist($section=0,$wiki_key='')
	{
        //搜索
        $where = array();
        //搜内容segment(4)
        $wiki_key = urldecode(trim($this->uri->segment(4)));
        $tag_name = urldecode(trim($this->uri->segment(5)));
        $this->data['wiki_key'] = 0;
        $this->data['tag_name'] = 0;
        if($wiki_key)  
        {
            $this->data['wiki_key'] = $wiki_key;
            $where['wiki_key'] = $this->data['wiki_key']; 
        }
		//分页
		$this->load->library('pagination');
		$config['base_url'] = site_url($this->_info['view_path'].'/showlist/'.$this->data['wiki_key'].'/'.$this->data['tag_name'].'/');
		//每页
		$config['per_page'] = $this->data['pagesize'] = 15 ; 
		//总数
		$config['total_rows'] = $this->wiki->getTotalNum($where);
		$config['uri_segment'] = 6;
		$config['first_link'] = '首页';
		$config['last_link'] = '尾页';
		$config['next_link'] = '下一页';
		$config['prev_link'] = '上一页';
		$this->pagination->initialize($config); 
		$this->data['page'] = $this->pagination->create_links();
		$offset = $this->uri->segment($config['uri_segment']);
		$arr = $this->wiki->getList($this->data['pagesize'], $offset, $where);
        $this->load->model('tag_model','tag');
        foreach($arr as $key=>$val)
        {
            //获得标签名称
            $arr[$key]['tag_name'] = $this->tag->getFieldById($val['tag_id'],'name');
        }
		$this->data['wikiArr'] = $arr;
        unset($arr);
        $this->data['number'] = $offset+1; 
		$this->load->view($this->_info['view_path'].'List', $this->data);
    }

    //添加
	function add()
	{
		//在线编辑器
		$eddt = array('name' =>'wiki_content', 'id' =>'wiki_content', 'value' =>'');
		$this->load->library('kindeditor',$eddt); 
        $this->data = array('id'=>'null','wiki_key'=>'');
		$this->data['id'] = $this->wiki->insert($this->data);
        $this->data['kindeditor'] = $this->kindeditor->getEditor($eddt);
		$this->load->view($this->_info['view_path'].'Edit', $this->data);
	}

	//编辑百科
	function edit($wiki_id)
	{
		$arr = $this->wiki->getOne($wiki_id);
        //在线编辑器
		$eddt = array('name' =>'wiki_content', 'id' =>'wiki_content', 'value' =>$arr['wiki_content']);
		$this->load->library('kindeditor',$eddt);
        $arr['kindeditor'] = $this->kindeditor->getEditor( $eddt );
		$this->load->view($this->_info['view_path'].'Edit', $arr);
	}

    //保存编辑结果
	function saveEdit($wiki_id)
	{
		if($this->input->post('wiki_key')) $data['wiki_key'] = trim(addslashes($this->input->post('wiki_key')));
		if($this->input->post('wiki_content')) $data['wiki_content'] = addslashes($this->input->post('wiki_content'));
		$affected_rows = $this->wiki->update($wiki_id, $data);
        unset($data);
        //上传图片,并做缩略
        $this->load->helper('upload');
		$uploadData = upload_img('upImg', $wiki_id,'wiki');
        if (-1 == $uploadData ) 
        {
			$data['msg'] = '图片上传失败';
			$data['url'] = '/admin/wiki/showlist/';
			return $this->load->view('admin/info', $data);
        }
        if ( 1 != $uploadData )
        {
            $addImg['wiki_img'] = $uploadData['file_name'];
            //保存图片数据
            $affected_rows = $this->wiki->update_cover((int)$wiki_id, $addImg);
        }
        unset($uploadData, $addImg);
		$data['msg'] = ($affected_rows) ? '成功' : '失败';
		$data['url'] = '/admin/wiki/showList/';
		$this->load->view('admin/info', $data);
	}

	function del($id)
	{
		$affected_rows = $this->wiki->del($id);
		$data['msg'] = ($affected_rows>0) ? '成功' : '失败';
		$data['history'] = '1';
		$data['url'] = '/admin/wiki/showlist/';
		$this->load->view('admin/info', $data);
	}

}
