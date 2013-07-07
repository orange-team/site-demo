<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台-- 百科管理
* author: Liangxifeng
* date: 2013-06-22
*/

class Wiki extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/wiki_model','wiki');
	}
	//百科列表
	function showlist($wiki_keyword='',$tag_id=0)
	{
        $this->load->helper('form'); 

        //搜索
        $where = array();
        //搜栏目segment(4)
        $this->data['tag_id'] = 0;
        if($tag_id)
        {
            $where['tag_id'] = $this->data['tag_id'] = (int)$tag_id;
        }

        //搜内容segment(5)
        $this->data['wiki_keyword'] = 0;
        if($wiki_keyword)  
        {
            $this->data['wiki_keyword'] = urldecode(trim(addslashes($wiki_keyword))); 
            $where['wiki_keyword'] = $this->data['wiki_keyword']; 
        }

		//分页
		$this->load->library('pagination');
		$config['base_url'] = site_url('admin/wiki/showlist/'.$this->data['wiki_keyword'].'/'.$this->data['tag_id'].'/');
		//每页
		$config['per_page'] = $this->data['pagesize'] = 15; 
		//总数
		$config['total_rows'] = $this->wiki->getTotal($where);
        //echo $this->db->last_query();
		$this->data['tag_id'] = (int)$tag_id;
		$config['uri_segment'] = 6;
		$config['first_link'] = '首页';
		$config['last_link'] = '尾页';
		$config['next_link'] = '下一页';
		$config['prev_link'] = '上一页';
		$this->pagination->initialize($config); 
		$this->data['page'] = $this->pagination->create_links();
		$offset = $this->uri->segment(6);
		$arr = $this->wiki->getList($this->data['pagesize'], $offset, $where);

        $this->data['tags'][0] = array('id'=>1,'name'=>'测试标签01');
        $this->data['tags'][1] = array('id'=>2,'name'=>'测试标签02');
        $this->data['tags'][3] = array('id'=>3,'name'=>'测试标签03');

        //顶级栏目
		$this->data['wikiArr'] = $arr;
        $this->data['number'] = $offset+1; 
		$this->load->view('admin/wikiList', $this->data);
	}
	function add()
	{
		$this->load->helper('form');
        $this->data['tags'][0] = array('id'=>1,'name'=>'测试标签01');
        $this->data['tags'][1] = array('id'=>2,'name'=>'测试标签02');
        $this->data['tags'][3] = array('id'=>3,'name'=>'测试标签03');
        
		//在线编辑器
		$eddt = array('wiki_keyword' =>'wiki_content', 'id' =>'wiki_content', 'value' =>'');
		$this->load->library('kindeditor',$eddt);
        $this->data ['kindeditor'] = $this->kindeditor->getEditor();
		$this->load->view('admin/wikiAdd', $this->data);
	}
	//编辑百科
	function editArt($id)
	{
		$this->load->helper('form');
		$arr = $this->wiki->getBy_id($id);

		//在线编辑器
		$eddt = array('wiki_keyword' =>'wiki_content', 'id' =>'wiki_content', 'value' =>$arr['wiki_content']);
		$this->load->library('kindeditor',$eddt);
        $arr['kindeditor'] = $this->kindeditor->getEditor( $eddt );

        $arr['tags'][0] = array('id'=>1,'name'=>'测试标签01');
        $arr['tags'][1] = array('id'=>2,'name'=>'测试标签02');
        $arr['tags'][3] = array('id'=>3,'name'=>'测试标签03');
        
		
		$this->load->view('admin/wikiEdit', $arr);
	}

	function saveEdit($id)
	{
        if($_FILES['wiki_image']['name'] != 0)
        {
            //文件上传
            $upload_file_name = $this->doUpload('wiki_image');
            if($upload_file_name) $data['wiki_img'] = $upload_file_name;
        }

		if($this->input->post('tag_id')) $data['tag_id'] = (int)$this->input->post('tag_id');
		if($this->input->post('wiki_keyword')) $data['wiki_keyword'] = trim(addslashes($this->input->post('wiki_keyword')));
		if($this->input->post('wiki_content')) $data['wiki_content'] = trim(addslashes($this->input->post('wiki_content')));
		$affected_rows = $this->wiki->update($id, $data);
		$data['msg'] = ($affected_rows>0) ? '成功' : '失败';
		$data['url'] = '/admin/wiki/showList/';
		$this->load->view('admin/info', $data);
	}
	
	function saveAdd()
	{
        if($_FILES['wiki_image']['name'] != 0)
        {
            //文件上传
            $upload_file_name = $this->doUpload('wiki_image');
            if($upload_file_name) $data['wiki_img'] = $upload_file_name;
        }

		if($this->input->post('tag_id')) $data['tag_id'] = (int)$this->input->post('tag_id');
		if($this->input->post('wiki_keyword')) $data['wiki_keyword'] = trim(addslashes($this->input->post('wiki_keyword')));
		if($this->input->post('wiki_content')) $data['wiki_content'] = trim(addslashes($this->input->post('wiki_content')));
        
		$affected_rows = $this->wiki->insertNew($data);
		$data['msg'] = ($affected_rows>0) ? '成功' : '失败';
		$tag_id = $this->input->post('tag_id').'/';
		$data['url'] = '/admin/wiki/showlist/';
		$data['history'] = '1';
		$this->load->view('admin/info', $data);
	}
	//新增
	function addNew($tag_id)
	{
		$this->load->helper('form');
		$this->data['AddOrEdit'] = 'Add';//添加&更新
		$this->data['article_id'] = '';
		$this->data['content'] = '';
		//在线编辑器
		$eddt = array('wiki_keyword' =>'content', 'id' =>'content', 'value' =>$this->data['content']);
		$this->load->library('kindeditor',$eddt);
        $this->data ['kindeditor'] = $this->kindeditor->getEditor( $eddt );
		
		$this->load->view('admin/articleAddNew', $this->data);
	}	
	function del($id)
	{
		$affected_rows = $this->wiki->del($id);
		$data['msg'] = ($affected_rows>0) ? '成功' : '失败';
		$data['history'] = '1';
		$data['url'] = '/admin/wiki/showlist/';
		$this->load->view('admin/info', $data);
	}

	function doUpload($upImg)
	{
        $date = date('YmdHis');
        $file_name = $date.substr($_FILES[$upImg]['name'],0, strrpos($_FILES[$upImg]['name'],'.'));
		//重命名图片, 防止了.php.jpg

		$config['file_name'] = $file_name;
		$config['upload_path'] = './uploads/wiki/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '1600';
		$config['max_width']  = '1200';
		$config['max_height']  = '1200';
		//载入文件上传类，加入配置
		$this->load->library('upload', $config);
        
		if ( ! $this->upload->do_upload($upImg))//上传失败
		{
			$data = array('error' => $this->upload->display_errors());
			$this->load->view('admin/info', $data);
			var_dump($data);
			exit;
        }else
        {
            return $date.$_FILES[$upImg]['name'];
        } 
    }

}
