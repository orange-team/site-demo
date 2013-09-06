<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台--关键词管理
* author: Liangxifeng
* date: 2013-06-22
*/

class Keyword extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('keyword_model','keyword');
		$this->load->model('section_model','section');
	}
    //列表页
	function showlist($section=0,$name='')
	{
        $this->load->helper('form'); 

        //搜索
        $where = array();
        //搜栏目segment(4)
        $this->data['section'] = 0;
        $this->data['one'] = $this->data['two'] = $this->data['three'] = 0; //栏目id
        $this->data['two_value'] = $this->data['three_value'] = '';         //栏目内容
        if($section)
        {
            $arr = explode('-',$section); //0:一级栏目id, 1:二级栏目id, 2:三级栏目id
            if($arr[0] != 0)
            {
                $childs = $this->get_child($arr[0]);
                //print_r($childs[1]);
                $childs_id = $childs[1] ? array_keys($childs[1]) : array();//子栏目id
                array_unshift($childs_id,$arr[0]);
                $where['section'] = $childs_id;
                $this->data['two_value'] = $childs[0] ? $childs[0] : '';//二级栏目内容
            }
            if($arr[1] != 0 && !empty($this->data['two_value']))
            {
                unset($childs,$childs_id,$where['section']);
                $childs = $this->get_child($arr[1],false);
                $childs_id = $childs[1] ? array_keys($childs[1]) : array();//子栏目id
                array_unshift($childs_id,$arr[1]);
                $where['section'] = $childs_id;
                $this->data['three_value'] = $childs[0] ? $childs[0] : '';//三级栏目内容
            }
            if($arr[2] != 0 && !empty($this->data['three_value']))
            {
                $where['section'] = array($arr[2]);
            }

            $this->data['section'] = $section; 
            $this->data['one'] = $arr[0]; 
            $this->data['two'] = $arr[1]; 
            $this->data['three'] = $arr[2]; 
        }

        //搜内容segment(5)
        $this->data['name'] = 0;
        if($name)  
        {
            $this->data['name'] = urldecode(trim(addslashes($name))); 
            $where['name'] = $this->data['name']; 
        }

		//分页
		$this->load->library('pagination');
		$config['base_url'] = site_url('admin/keyword/showlist/'.$this->data['section'].'/'.$this->data['name'].'/');
		//每页
		$config['per_page'] = $this->data['pagesize'] = 15 ; 
		//总数
		$config['total_rows'] = $this->keyword->getTotal($where);
		$this->data['section'] = (int)$section;
		$config['uri_segment'] = 6;
		$config['first_link'] = '首页';
		$config['last_link'] = '尾页';
		$config['next_link'] = '下一页';
		$config['prev_link'] = '上一页';
		$this->pagination->initialize($config); 
		$this->data['page'] = $this->pagination->create_links();
		$offset = $this->uri->segment(6);
		$arr = $this->keyword->getList($this->data['pagesize'], $offset, $where);
        //顶级栏目
        $this->data['one_section'] = $this->section->getBy_parent(0);
		$this->data['keywordArr'] = $arr;
        $this->data['number'] = $offset+1; 
		$this->load->view('admin/keywordList', $this->data);
	}
	//添加
	function add()
	{
        if($this->input->post('name'))
        {
            $data['name'] = trim(addslashes($this->input->post('name')));
            $data['section'] = (int)$this->input->post('section');
            $affected_rows = $this->keyword->insertNew($data);
            unset($data);
            $data['msg'] = ($affected_rows>0) ? '成功' : '失败';
            $data['url'] = '/admin/keyword/add/';
            $this->load->view('admin/info', $data);
        }else
        {
            $this->load->helper('form');
            $this->data['one_section'] = $this->section->getBy_parent(0);
            $this->load->view('admin/keywordAdd',$this->data);
        }
	}
	//编辑关键词
	function editKey($id)
	{
		$this->load->helper('form');
		$arr = $this->keyword->getBy_id($id);
        $section = $this->section->get_one(array('id'=>$arr['section']));
        $is_two = false;   //是否显示二级栏目
        $is_three = false; //是否显示三级栏目
        $arr['one'] = $arr['two'] = $arr['three'] = '';
        if(!empty($section))
        {
            if($section['parent'] != 0)
            {
                $section_up = $this->get_parent($section['parent']);
                $is_two = true;
                $arr['one'] = $section_up[0] ? $section_up[0] : '';
                $arr['two'] = $section_up[1] ? $section_up[1] : '';
                if('' != $arr['one'] && '' != $arr['two'])
                {
                    $is_three = true;
                }
                if($arr['one'] == '')
                {
                    $arr['one'] = $arr['two']; unset($arr['two']);
                    $arr['two'] = $section;
                } 
            }else
            {
                $arr['one'] = $section;
            }
        }

        //顶级栏目
        $arr['one_section'] = $this->section->getBy_parent(0);
        if( $is_two == true )
        {
            $fid = '' != $arr['one'] ? $arr['one']['id'] : $arr['two']['id'];
            $arr['two_section'] =  $this->section->getList(array('parent'=>$fid));
        }
        $arr['three_section'] = $is_three==true ? $this->section->getList(array('parent'=>$arr['two']['id'])) : '';
        
		
		$this->load->view('admin/keywordEdit', $arr);
	}
	//
	function saveEdit($id)
	{
		if($this->input->post('section')) $data['section'] = trim(addslashes($this->input->post('section')));
		if($this->input->post('name')) $data['name'] = trim(addslashes($this->input->post('name')));
		$affected_rows = $this->keyword->update($id, $data);
		$data['msg'] = ($affected_rows>0) ? '成功' : '失败';
		$data['url'] = '/admin/keyword/showList/';
		$this->load->view('admin/info', $data);
	}
	
	function del($id)
	{
		$affected_rows = $this->keyword->del($id);
		$data['msg'] = ($affected_rows>0) ? '成功' : '失败';
		$data['history'] = '1';
		$data['url'] = '/admin/keyword/showlist/';
		$this->load->view('admin/info', $data);
	}
   
    //递归获取子分类信息
    function get_child($id=0,$type=true)
    {
        $all_list = array();
        if($type == true) global $all_list;
        $childs = $this->section->getBy_parent($id);//只获取子栏目信息，非子孙栏目
        foreach($childs as $k=>$v)
        {
            if($id)
            {
               $this->get_child($v['id']);
               //echo $v['id'].'---'.$v['name'].'<br>---';
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
            if($parents['parent'] !=0 )
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
