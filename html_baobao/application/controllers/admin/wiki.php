<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台--百科管理
* author: zg
* date: 2013-09-01
*/

class wiki extends MY_Controller
{
    //封面图片路径
    var $wiki_path = '/';
	function __construct()
	{
		parent::__construct();
		$this->load->model('wiki_model','wiki');
    }

	//百科列表
	function showlist($section=0,$wiki_key='')
	{
        $this->load->helper('form'); 
        //搜索
        $where = array();
        //搜内容segment(4)
        $wiki_key = urldecode(trim($this->uri->segment(4)));
        $this->data['wiki_key'] = 0;
        if($wiki_key)  
        {
            $this->data['wiki_key'] = $wiki_key;
            $where['wiki_key'] = $this->data['wiki_key']; 
        }
		//分页
		$this->load->library('pagination');
		$config['base_url'] = site_url('admin/wiki/showlist/'.$this->data['wiki_key'].'/');
		//每页
		$config['per_page'] = $this->data['pagesize'] = 15 ; 
		//总数
		$config['total_rows'] = $this->wiki->getTotal($where);
		$config['uri_segment'] = 5;
		$config['first_link'] = '首页';
		$config['last_link'] = '尾页';
		$config['next_link'] = '下一页';
		$config['prev_link'] = '上一页';
		$this->pagination->initialize($config); 
		$this->data['page'] = $this->pagination->create_links();
		$offset = $this->uri->segment(5);
		$arr = $this->wiki->getList($this->data['pagesize'], $offset, $where);
		$this->data['wikiArr'] = $arr;
        unset($arr);
        $this->data['number'] = $offset+1; 
		$this->load->view('admin/wikiList', $this->data);
    }

	function add()
	{
		$this->load->helper('form');
		//在线编辑器
		$eddt = array('name' =>'wiki_content', 'id' =>'wiki_content', 'value' =>'');
		$this->load->library('kindeditor',$eddt);
        $this->data ['kindeditor'] = $this->kindeditor->getEditor();
		$this->load->view('admin/wikiAdd', $this->data);
	}

    //保存新增结果
	function saveAdd()
	{
        $data = array(
				'wiki_key' => $this->input->post('wiki_key'),
				'wiki_content' => $this->input->post('wiki_content'),
				'add_time' => date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']),
				'author' => $this->input->post('author'),
				);
		$wiki_id = $this->wiki->insertNew($data);
        //上传图片,并做缩略
		$uploadData = $this->doupload('upImg', $wiki_id);
        if (-1 == $uploadData ) 
        {
			$data['msg'] = '图片上传失败';
			$data['url'] = '/admin/wiki/showlist/';
			return $this->load->view('admin/info', $data);
        }
        if ( 1 != $uploadData )
        {
            $full_path = str_replace($_SERVER['DOCUMENT_ROOT'],'', $uploadData['full_path']);
            unset($uploadData);
            $addImg['cover'] = $full_path;
            //保存图片数据
            $affected_rows = $this->wiki->update_cover((int)$wiki_id, $addImg);
        }
		$data['msg'] = ($affected_rows>0) ? '成功' : '图片路径更新失败';
		$data['url'] = '/admin/wiki/showlist/';
		//$data['history'] = '1';
		$this->load->view('admin/info', $data);
	}

	//编辑百科
	function edit($wiki_id)
	{
		$this->load->helper('form');
		$arr = $this->wiki->getBy_id($wiki_id);
        //在线编辑器
		$eddt = array('name' =>'wiki_content', 'id' =>'wiki_content', 'value' =>$arr['wiki_content']);
		$this->load->library('kindeditor',$eddt);
        $arr['kindeditor'] = $this->kindeditor->getEditor( $eddt );
		$this->load->view('admin/wikiEdit', $arr);
	}

    //保存编辑结果
	function saveEdit($wiki_id)
	{
		if($this->input->post('wiki_key')) $data['wiki_key'] = trim(addslashes($this->input->post('wiki_key')));
		if($this->input->post('wiki_content')) $data['wiki_content'] = addslashes($this->input->post('wiki_content'));
		if($this->input->post('author')) $data['author'] = addslashes($this->input->post('author'));
		$affected_rows = $this->wiki->update($wiki_id, $data);
        unset($data);
        //上传图片,并做缩略
		$uploadData = $this->doupload('upImg', $wiki_id);
        if (-1 == $uploadData ) 
        {
			$data['msg'] = '图片上传失败';
			$data['url'] = '/admin/wiki/showlist/';
			return $this->load->view('admin/info', $data);
        }
        if ( 1 != $uploadData )
        {
            $full_path = str_replace($_SERVER['DOCUMENT_ROOT'],'', $uploadData['full_path']);
            unset($uploadData);
            $addImg['cover'] = $full_path;
            //保存图片数据
            $affected_rows = $this->wiki->update_cover((int)$wiki_id, $addImg);
        }
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

    //上传图片, $wiki_id用于生成散列目录
	private function doupload($upimg, $wiki_id)
	{
        //未上传图片
		if( empty($_FILES[$upimg]['name']) ) return 1;
		//重命名图片, 防止了.php.jpg
		$img_ext = substr($_FILES[$upimg]['name'],0, strpos($_FILES[$upimg]['name'],'.'));
		$myImg = date('YmdHis').'_'.rand(10000,99999);
		$config['file_name'] = $myImg.$img_ext;
		$config['upload_path'] = './uploads/wiki/'.(int)$wiki_id;
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
			$data['url'] = '/admin/wiki/showlist/';
			$this->load->view('admin/info', $data);
			return -2;
		}
		unset($config);
		$this->image_lib->clear();
		return $this->upload->data();
	}

}
