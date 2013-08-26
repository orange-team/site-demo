<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台--标签管理
* author: zg
* date: 2013-07-07
*/

class Tag extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/tag_model','tag');
	}
    //列表页
	function showlist($section=0,$name='')
	{
        $this->load->helper('form'); 
        //搜索
        $where = array();
        $this->data['section'] = 0;
        //搜内容segment(5)
        $this->data['name'] = 0;
        if($name)  
        {
            $this->data['name'] = urldecode(trim(addslashes($name))); 
            $where['name'] = $this->data['name']; 
        }
		//分页
		$this->load->library('pagination');
		$config['base_url'] = site_url('admin/tag/showlist/'.$this->data['section'].'/'.$this->data['name'].'/');
		//每页
		$config['per_page'] = $this->data['pagesize'] = 15 ; 
		//总数
		$config['total_rows'] = $this->tag->getTotal($where);
		$this->data['section'] = (int)$section;
		$config['uri_segment'] = 6;
		$config['first_link'] = '首页';
		$config['last_link'] = '尾页';
		$config['next_link'] = '下一页';
		$config['prev_link'] = '上一页';
		$this->pagination->initialize($config); 
		$this->data['page'] = $this->pagination->create_links();
		$offset = $this->uri->segment(6);
		$arr = $this->tag->getList($this->data['pagesize'], $offset, $where);
		$this->data['tagArr'] = $arr;
        unset($arr);
        $this->data['number'] = $offset+1; 
		$this->load->view('admin/tagList', $this->data);
	}
	//添加
	function add()
	{
        if($this->input->post('name'))
        {
            $data['name'] = trim(addslashes($this->input->post('name')));
            $data['weight'] = trim(addslashes($this->input->post('weight')));
            $affected_rows = $this->tag->insertNew($data);
            unset($data);
            $data['msg'] = ($affected_rows>0) ? '成功' : '失败';
            $data['url'] = '/admin/tag/add/';
            $this->load->view('admin/info', $data);
        }else
        {
            $this->load->helper('form');
            $this->load->view('admin/tagAdd',$this->data);
        }
	}
	//编辑
	function editTag($id)
	{
		$this->load->helper('form');
		$arr = $this->tag->getBy_id($id);
		$this->load->view('admin/tagEdit', $arr);
	}
	//保存编辑
	function saveEdit($id)
	{
		if($this->input->post('name')) $data['name'] = trim(addslashes($this->input->post('name')));
		$affected_rows = $this->tag->update($id, $data);
		$data['msg'] = ($affected_rows>0) ? '成功' : '失败';
		$data['url'] = '/admin/tag/showList/';
		$this->load->view('admin/info', $data);
	}
    //删除	
	function del($id)
	{
		$affected_rows = $this->tag->del($id);
		$data['msg'] = ($affected_rows>0) ? '成功' : '失败';
		//$data['history'] = '1';
		$data['url'] = '/admin/tag/showlist/';
		$this->load->view('admin/info', $data);
	}
    //ajax获取标签
    function ajax_get($key)
    {
        header('Content-Type: text/html; charset=utf-8');
        //用于调试sql等
        $arr = $arrTag = array();
        if(!empty($key))
        {
            $key = urldecode($key);
            $not_in_ids = explode('-',$this->uri->segment(5));
            //模糊查询$key相关的标签
            $arr = $this->tag->getBy_name($key,$not_in_ids);
            foreach($arr as $v)
            {
                $arrTag[$v['id']] = $v['name'];
            }
            unset($arr);
        }
        $arrTag['len'] = count($arrTag);
        echo json_encode($arrTag);
    }
    

}
