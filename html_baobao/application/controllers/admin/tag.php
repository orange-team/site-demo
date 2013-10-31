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
        $this->_info['cls'] = strtolower(__CLASS__);
        $this->_info['name'] = '标签';
        $this->_info['view_path'] = 'admin/'.$this->_info['cls'];
		$this->load->model('tag_model','tag');
	}

    //列表页
	function showlist($name='')
	{
        //搜索
        $where = array();
        //搜内容segment(5)
        $name = urldecode(trim($this->uri->segment(4)));
        $this->data['name'] = 0;
        if($name)  
        {
            $this->data['name'] = urldecode(trim(addslashes($name))); 
            $where['name'] = $this->data['name']; 
        }
		//分页
		$config['base_url'] = site_url('admin/tag/showlist/'.$this->data['name'].'/');
		//每页
		$config['per_page'] = $this->data['pagesize'] = 15 ; 
		//总数
		$config['total_rows'] = $this->tag->getTotal($where);
		$config['uri_segment'] = 5;
		$config['first_link'] = '首页';
		$config['last_link'] = '尾页';
		$config['next_link'] = '下一页';
		$config['prev_link'] = '上一页';
		$this->pagination->initialize($config); 
		$this->data['page'] = $this->pagination->create_links();
		$offset = $this->uri->segment($config['uri_segment']);
		$arr = $this->tag->getList($where, '', $this->data['pagesize'], $offset);
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
            $this->load->helper('common');
            $data['name'] = fileter($this->input->post('name'));
            $data['weight'] = fileter($this->input->post('weight'));
            $affected_rows = $this->tag->insert($data);
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

    //保存新增结果
	function saveAdd()
	{
        $data = array(
				'name' => $this->input->post('name'),
				'weight' => $this->input->post('weight'),
				);
		$id = $this->tag->insert($data);
		$data['msg'] = ($id>0) ? '成功' : '图片路径更新失败';
		$data['url'] = '/admin/tag/showlist/';
		$this->load->view('admin/info', $data);
	}

	//编辑
	function edit($id)
	{
		$arr = $this->tag->getOne($id);
		$this->load->view('admin/tagEdit', $arr);
	}

	//保存编辑
	function saveEdit($id)
	{
		if($this->input->post('name')) $data['name'] = trim(addslashes($this->input->post('name')));
		if($this->input->post('weight')) $data['weight'] = trim(addslashes($this->input->post('weight')));
		if($this->input->post('section')) $data['section'] = trim(addslashes($this->input->post('section')));
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
