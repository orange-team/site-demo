<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台--图库管理
* author: zg
* date: 2013-09-10
*/

class Img_lib extends MY_Controller
{
    //用百度搜索关键词
    var $baidu = array('search' => 'http://www.baidu.com/s?wd=',
        'index'=>'http://index.baidu.com/main/word.php?word=');
    var $img_lib_path = '/uploads/img_lib/';

	function __construct()
	{
		parent::__construct();
        $this->_info['cls'] = strtolower(__CLASS__);
        $this->_info['name'] = '图库';
        $this->_info['view_path'] = 'admin/'.$this->_info['cls'];
		$this->load->model('img_lib_model','img_lib');
		$this->load->model('section_model','section');
		$this->load->model('keyword_model','keyword');
	}

	//列表
	function showlist($section=0,$title='')
	{
        $this->load->helper('form'); 
        //搜索
        $where = array();
        $this->data['keywords'] = array(); //关键词数组
        $this->data['section'] = 0;
        $this->data['keyword_id'] = 0;     //关键词id
        //搜标题segment(5)
        $this->data['title'] = 0;
        if($title)  
        {
            $this->data['title'] = urldecode(trim($title));
            $where['title'] = $this->data['title']; 
        }
		//分页
		$this->load->library('pagination');
		$config['base_url'] = site_url($this->_info['view_path'].'/showlist/'.$this->data['title'].'/');
		//每页
		$config['per_page'] = $this->data['pagesize'] = 15; 
		//总数
		$config['total_rows'] = $this->img_lib->getTotal($where);
		$this->data['section'] = (int)$section;
		$config['uri_segment'] = 5;
		$config['first_link'] = '首页';
		$config['last_link'] = '尾页';
		$config['next_link'] = '下一页';
		$config['prev_link'] = '上一页';
		$this->pagination->initialize($config); 
		$this->data['page'] = $this->pagination->create_links();
		$offset = $this->uri->segment($config['uri_segment']);
		$arr = $this->img_lib->getList($this->data['pagesize'], $offset, $where);
		$this->load->model('tag_model','tag');
        foreach($arr as $key=>$val)
        {
            $arr[$key]['path'] = $this->img_lib_path.substr($val['path'],0,2).'/'.$val['path'];
            //获得标签名称
            $arr[$key]['tag_name'] = $this->tag->getFieldBy_id($val['tag_id'],'name');
        }
        //顶级栏目
		$this->data['img_libArr'] = $arr;
        unset($arr);
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

    function saveAdd()
	{
        $this->load->helper('common');
		$data = array(
				'title' => filter($this->input->post('title')),
				'source' => $this->input->post('本站'),
				'add_time' => date('Y-m-d H:i:s'),
				);
		$img_lib_id = $this->img_lib->addone($data);
        //上传图片,并做缩略
        $this->load->helper('upload');
		$uploadData = upload_img('upImg','img_lib');
        if (-1 == $uploadData ) 
        {
			$data['msg'] = '图片上传失败';
			$data['url'] = '/admin/'.$this->_info['cls'].'/showlist/';
			return $this->load->view('admin/info', $data);
        }
        if ( 1 != $uploadData )
        {
            $addImg['path'] = $uploadData['file_name'];
            //保存图片数据
            $affected_rows = $this->img_lib->update((int)$img_lib_id, $addImg);
        }
        unset($uploadData, $addImg);
		$data['msg'] = ($affected_rows>0) ? '成功' : '失败';
		$data['url'] = '/admin/'.$this->_info['cls'].'/showlist/';
		$this->load->view('admin/info', $data);
	}

	//编辑原创
	function edit($img_lib_id)
	{
        //读取图片库
		$this->load->helper('form');
		$this->load->helper('common');
		$this->data = $this->img_lib->getBy_id($img_lib_id);
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
        $this->data['keywords'] = $this->keyword->getList(0,0,$where);
        
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
        $this->load->model('tag_model','tag');
        $whereData = array('target_id'=>$img_lib_id,'target_type'=>1,'status'=>0);
        $tagArr = $this->relation_tag->get($whereData);
        $arrTagIds = $tagNameArr = array();
        foreach($tagArr as $k=>$v)
        {
            $arrTagIds[] = $v['tag_id'];
        }
        unset($tagArr);
        if(0<count($arrTagIds)) $tagNameArr = $this->tag->getBy_ids($arrTagIds);
        $this->data['tagNameArr'] = $tagNameArr;
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

	function saveEdit($img_lib_id)
	{
        $this->load->helper('common');
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
		$affected_rows = $this->img_lib->update($img_lib_id, $data);
        unset($data);
		$data['msg'] = ($affected_rows>0) ? '成功' : '失败';
		$data['url'] = site_url($this->_info['view_path'].'/showList/');
		$this->load->view('admin/info', $data);
	}
	
	function del($id)
	{
		$affected_rows = $this->img_lib->del($id);
		$data['msg'] = ($affected_rows>0) ? '成功' : '失败';
		$data['history'] = '1';
		$data['url'] = '/admin/img_lib/showlist/';
		$this->load->view('admin/info', $data);
	}

}
