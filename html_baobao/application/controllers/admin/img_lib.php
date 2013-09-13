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
	function showlist($title='')
	{
        $this->load->helper('form'); 
        //搜索
        $where = array();
        $this->data['keywords'] = array(); //关键词数组
        $this->data['keyword_id'] = 0;     //关键词id
        //搜标题segment(5)
        $this->data['title'] = 0;
        if($title)  
        {
            $this->data['title'] = urldecode(trim($title));
            $where['title'] = $this->data['title']; 
        }
		//分页
        $this->load->helper('admin');
		$config['base_url'] = site_url($this->_info['view_path'].'/showlist/'.$this->data['title'].'/');
		//总数
		$config['total_rows'] = $this->img_lib->getTotal($where);
		$config['per_page'] = $this->data['pagesize'] = 15; 
		$config['uri_segment'] = 5;
		$this->data['page'] = my_page($config);
		$offset = $this->uri->segment(5);
		$arr = $this->img_lib->getList(15, $offset, $where);
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
        $this->load->helper('common');
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
        $this->load->view($this->_info['view_path'].'Edit', $this->data);
	}

	function saveEdit($img_lib_id)
	{
        $this->load->helper('common');
        $data = array();
		if($this->input->post('title')) $data['title'] = filter($this->input->post('title'));
		if($this->input->post('source')) $data['source'] = filter($this->input->post('source'));
		if($this->input->post('source_link')) $data['source_link'] = filter($this->input->post('source_link'));
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

}
