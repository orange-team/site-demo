<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台--专栏管理
* author: zg
* date: 2013-07-28
*/

class specpage extends MY_Controller
{
    //封面图片路径
    var $spec_path = '/';
	function __construct()
	{
		parent::__construct();
		$this->load->model('specpage_model','spec');
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
		$config['total_rows'] = $this->spec->getTotal($where);
		$config['uri_segment'] = 5;
		$config['first_link'] = '首页';
		$config['last_link'] = '尾页';
		$config['next_link'] = '下一页';
		$config['prev_link'] = '上一页';
		$this->pagination->initialize($config); 
		$this->data['page'] = $this->pagination->create_links();
		$offset = $this->uri->segment(5);
		$arr = $this->spec->getList($this->data['pagesize'], $offset, $where);
		$this->data['specArr'] = $arr;
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
		$spec_id = $this->spec->insertNew($data);
        //上传图片,并做缩略
		$uploadData = $this->doupload('upImg', $spec_id);
        if (-1 == $uploadData ) 
        {
			$data['msg'] = '图片上传失败';
			$data['url'] = '/admin/specpage/showlist/';
			return $this->load->view('admin/info', $data);
        }
        if ( 1 != $uploadData )
        {
            $full_path = str_replace($_SERVER['DOCUMENT_ROOT'],'', $uploadData['full_path']);
            unset($uploadData);
            $addImg['cover'] = $full_path;
            //保存图片数据
            $affected_rows = $this->spec->update_cover((int)$spec_id, $addImg);
        }
		$data['msg'] = ($affected_rows>0) ? '成功' : '图片路径更新失败';
		$data['url'] = '/admin/specpage/showlist/';
		//$data['history'] = '1';
		$this->load->view('admin/info', $data);
	}

	//编辑专栏
	function edit($spec_id)
	{
		$this->load->helper('form');
		$arr = $this->spec->getBy_id($spec_id);
        //在线编辑器
		$eddt = array('name' =>'content', 'id' =>'content', 'value' =>$arr['content']);
		$this->load->library('kindeditor',$eddt);
        $arr['kindeditor'] = $this->kindeditor->getEditor( $eddt );
		$this->load->view('admin/specpageEdit', $arr);
	}

    //保存编辑结果
	function saveEdit($spec_id)
	{
		if($this->input->post('title')) $data['title'] = trim(addslashes($this->input->post('title')));
		if($this->input->post('content')) $data['content'] = addslashes($this->input->post('content'));
		if($this->input->post('author')) $data['author'] = addslashes($this->input->post('author'));
		$affected_rows = $this->spec->update($spec_id, $data);
        unset($data);
        //上传图片,并做缩略
		$uploadData = $this->doupload('upImg', $spec_id);
        if (-1 == $uploadData ) 
        {
			$data['msg'] = '图片上传失败';
			$data['url'] = '/admin/specpage/showlist/';
			return $this->load->view('admin/info', $data);
        }
        if ( 1 != $uploadData )
        {
            $full_path = str_replace($_SERVER['DOCUMENT_ROOT'],'', $uploadData['full_path']);
            unset($uploadData);
            $addImg['cover'] = $full_path;
            //保存图片数据
            $affected_rows = $this->spec->update_cover((int)$spec_id, $addImg);
        }
		$data['msg'] = ($affected_rows) ? '成功' : '失败';
		$data['url'] = '/admin/specpage/showList/';
		$this->load->view('admin/info', $data);
	}

	function del($id)
	{
		$affected_rows = $this->spec->del($id);
		$data['msg'] = ($affected_rows>0) ? '成功' : '失败';
		$data['history'] = '1';
		$data['url'] = '/admin/specpage/showlist/';
		$this->load->view('admin/info', $data);
	}

    //上传图片, $spec_id用于生成散列目录
	private function doupload($upimg, $spec_id)
	{
        //未上传图片
		if( empty($_FILES[$upimg]['name']) ) return 1;
		//重命名图片, 防止了.php.jpg
		$img_ext = substr($_FILES[$upimg]['name'],0, strpos($_FILES[$upimg]['name'],'.'));
		$myImg = date('YmdHis').'_'.rand(10000,99999);
		$config['file_name'] = $myImg.$img_ext;
		$config['upload_path'] = './uploads/specpage/'.(int)$spec_id;
		//生成散列目录
		if( !is_dir($config['upload_path']) ) mkdir($config['upload_path']);
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = '93600';
		$config['max_width']  = '3000';
		$config['max_height']  = '3000';
		//载入文件上传类，加入配置
		$this->load->library('upload', $config);
        $up_success = $this->upload->do_upload($upimg);
		if ( true!=$up_success )//上传失败
		{
            return -1;
		}
		unset($config);
		$uploadData = $this->upload->data();
		//生成缩略图
		$this->load->library('image_lib');
		$config['source_image'] = $uploadData['full_path'];
		$config['width'] = 120;
		$config['height'] = 120;
		$config['quality'] = 90;
		$new_image = $myImg.$img_ext.'_s'.$uploadData['file_ext'];
		$config['new_image'] = $new_image;
		$this->image_lib->initialize($config);
		if (!$this->image_lib->resize()) 
		{     
			$data['msg'] = '缩略图生成失败';
			$data['url'] = '/admin/specpage/showlist/';
			$this->load->view('admin/info', $data);
			return -2;
		}
		unset($config);
		$this->image_lib->clear();
		return $this->upload->data();
	}

}
