<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台--文章管理
* author: Liangxifeng
* date: 2013-06-22
*/

class Article extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('article_model','art');
		$this->load->model('article_tag_model','art_tag');
		$this->load->model('section_model','section');
		$this->load->model('tag_model','tag');
	}
	//文章列表:新闻中心-->最新新闻
	function showlist($section=0,$tag=0,$title='')
	{//error_reporting('E_ALL'); 
        $this->load->helper('form'); 


        //搜索
        $where = array();
        $where_in = array();

        //搜栏目segment(4)
        $this->data['section_id'] = 0;

        if($section!=0)
        {
            $where['section'] = $this->data['section_id'] = $section;
        }

        //标签segment(5)
        $this->data['tags'] = array();
        $this->data['tag_id'] = 0;     
        if(!empty($tag))
        {
            $this->data['tag_id'] = $tag;
            $row = $this->art_tag->getList(array('tag_id'=>$tag));
            $art_id_arr = array();
            if(!empty($row))
            {
                foreach($row as $k=>$v)
                {
                    $art_id_arr[] = $v['target_id'];
                }
            }
            $where_in['field'] = 'id';
            $where_in['values'] = empty($art_id_arr)?'':$art_id_arr;
            unset($art_id,$art_id_arr,$row);
        }


        //搜标题segment(6)
        $this->data['title'] = 0;
        $where_like = array();
        if(!empty($title))
        {
            $this->data['title'] = $title;
            $where_like = array('title'=>$title); 
        }

		//分页
		$this->load->library('pagination');
		$config['base_url'] = site_url('admin/article/showlist/'.$this->data['section_id'].'/'.$this->data['tag_id'].'/'.$this->data['title'].'/');
		//每页
		$config['per_page'] = $this->data['pagesize'] = 2; 
		//总数
		$config['total_rows'] = $this->art->getTotalNum($where,$where_in,$where_like);
		$config['uri_segment'] = 7;
		$config['first_link'] = '首页';
		$config['last_link'] = '尾页';
		$config['next_link'] = '下一页';
		$config['prev_link'] = '上一页';
		$this->pagination->initialize($config); 
		$this->data['page'] = $this->pagination->create_links();
		$offset = $this->uri->segment(7);
		$arr = $this->art->getList($where,$this->data['pagesize'], $offset, 'id DESC', $where_in, $where_like);
        if(!empty($tag) && empty($where['id']))
        {
            $arr = array();
        }

        //获取栏目
        $this->data['section'] = $this->section->getList();
        $this->data['tags'] = 0!=$section ?  $this->ajax_change($section) : array();
		$this->data['articleArr'] = $arr;
        $this->data['number'] = $offset+1; 
		$this->load->view('admin/articleList', $this->data);
	}

    //添加
	function add()
	{
		$this->load->helper('form');
        //等级栏目
        $this->data['section'] = $this->section->getList();
		//在线编辑器
		$eddt = array('name' =>'content', 'id' =>'content', 'value' =>'');
		$this->load->library('kindeditor',$eddt);
        $this->data ['kindeditor'] = $this->kindeditor->getEditor();
		$this->load->view('admin/articleAdd', $this->data);
	}

	//编辑文章
	function editArt($art_id)
	{
		$this->load->helper('form');
		$arr = $this->art->getOne($art_id);
        //等级栏目
        $arr['sections'] = $this->section->getList();
        //标签
        $arr['tags'] = 0!=$arr['section'] ?  $this->ajax_change($arr['section']) : array();
        //查询文章和tag关系
        $arr['art_tag'] = $this->art_tag->get_one(array('target_id'=>$arr['id']));

		//在线编辑器
		$eddt = array('name' =>'content', 'id' =>'content', 'value' =>$arr['content']);
		$this->load->library('kindeditor',$eddt);
        $arr['kindeditor'] = $this->kindeditor->getEditor( $eddt );
		

        $edit = array('name' =>'content', 'id' =>'content', 'value' =>$arr['content']);
        $this->load->library('kindeditor',$edit);
        $arr['kindeditor'] = $this->kindeditor->getEditor( $edit );
        //相关标签
               $this->load->model('relation_tag_model','relation_tag');
               $this->load->model('tag_model','tag');
        $whereData = array('target_id'=>$art_id,'target_type'=>1,'status'=>0);
        $tagArr = $this->relation_tag->get($whereData);
        $arrTagIds = $tagNameArr = array();
        foreach($tagArr as $k=>$v)
        {
            $arrTagIds[] = $v['tag_id'];
        }
        unset($tagArr);
        if(0<count($arrTagIds)) $tagNameArr = $this->tag->getBy_ids($arrTagIds);
        $arr['tagNameArr'] = $tagNameArr;
		$this->load->view('admin/articleEdit', $arr);
	}

	function saveEdit($article_id)
	{
		if($this->input->post('section')) $data['section'] = intval($this->input->post('section'));
		if($this->input->post('keyword')) $data['keyword'] = trim(addslashes($this->input->post('keyword')));
		if($this->input->post('title')) $data['title'] = trim(addslashes($this->input->post('title')));
		if($this->input->post('subtitle')) $data['subtitle'] = trim(addslashes($this->input->post('subtitle')));
		if($this->input->post('source')) $data['source'] = trim(addslashes($this->input->post('source')));
		if($this->input->post('content')) $data['content'] = $this->input->post('content');
		if($this->input->post('description')) $data['description'] = $this->input->post('description');
		if($this->input->post('page_keywords')) $data['page_keywords'] = $this->input->post('page_keywords');
		if($this->input->post('attention')) $data['attention'] = $this->input->post('attention');
		$data['recommend'] = $this->input->post('recommend');
        
		$affected_rows = $this->art->update($article_id, $data);
        //echo $this->db->last_query();exit;
		//var_dump($affected_rows);
        /*讨论一篇文章可以添加多个标签吗?
        if(!empty($article_id) && $affected_rows>0)
        {
            $tag_id = $this->input->post('tag') ? $this->input->post('tag') : 0;
            $tags['target_id'] = $article_id;
            $tags['tag_id'] = $tag_id;
            $tags['status_tag'] = 1;
            $resTag = $this->art_tag->update($);
        }
		$data['msg'] = ($resTag>0) ? '成功' : '失败';
         */
		$data['msg'] = ($affected_rows>0) ? '成功' : '失败';
		$data['url'] = '/admin/article/showList/';
		$this->load->view('admin/info', $data);
	}
	
	function saveAdd()
	{
		$data = array(
				'title' => $this->input->post('title'),
				'subtitle' => $this->input->post('subtitle'),
				'content' => $this->input->post('content'),
				'add_time' => date('Y-m-d H:i:s'),
				'section' => $this->input->post('section'),
				'description' => $this->input->post('description'),
				'page_keywords' => $this->input->post('page_keywords'),
				'attention' => $this->input->post('attention'),
				'source' => $this->input->post('source'),
				'recommend' => $this->input->post('recommend'),
				);
		$last_id = $this->art->insert($data);
        $tag_id = $this->input->post('tag') ? $this->input->post('tag'):0;
        $resTag = 0;
        if(!empty($tag_id) && !empty($last_id))
        {
            $tags['target_id'] = $last_id;
            $tags['tag_id'] = $tag_id;
            $tags['status_tag'] = 1;
            unset($last_id,$tag_id);
            $resTag = $this->art_tag->insert($tags);
        }
		$data['msg'] = ($resTag>0) ? '成功' : '失败';
		$section = $this->input->post('section').'/';
		$data['url'] = '/admin/article/showlist/'.$section;
		$data['history'] = '1';
		$this->load->view('admin/info', $data);
	}
	//新增
	function addNew($section)
	{
		$this->load->helper('form');
		$this->data['AddOrEdit'] = 'Add';//添加&更新
		$this->data['article_id'] = '';
		$this->data['content'] = '';
		//在线编辑器
		$eddt = array('name' =>'content', 'id' =>'content', 'value' =>$this->data['content']);
		$this->load->library('kindeditor',$eddt);
        $this->data ['kindeditor'] = $this->kindeditor->getEditor( $eddt );
		
		$this->load->view('admin/articleAddNew', $this->data);
	}	
	function del($id)
	{
		$affected_rows = $this->art->del($id);
		$data['msg'] = ($affected_rows>0) ? '成功' : '失败';
		$data['history'] = '1';
		$data['url'] = '/admin/article/showlist/';
		$this->load->view('admin/info', $data);
	}

	function doUpload($upImg)
	{
		//重命名图片, 防止了.php.jpg
		$config['file_name'] = date('YmdHis').substr($_FILES[$upImg]['name'],0, strpos($_FILES[$upImg]['name'],'.'));
		$config['upload_path'] = './uploads/';
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
		} 
    }
    //ajax异步三级联动
    function ajax_change($id=0)//$id有值，則代表不是ajax异步获取
    {
        $section_id = $this->input->get('section_id') ? intval($this->input->get('section_id')) : $id;
        if(!empty($section_id))
        {
            $list = $this->tag->getList(array('section'=>$section_id));
            if( 0!=$id )
            {
                return $list;
            }else
            {
                echo !empty($list) ? json_encode($list) : -1; 
            }
        }else
        {
            return -2;
        }
    }
   
    //递归获取子分类信息
    function get_child($id=0,$type=true)
    {
        if($type == true)//获取该栏目下所有子栏目,定义全局变量
            global $all_list;
        $childs = $this->section->getBy_parent($id);//只获取子栏目信息，非子孙栏目
        foreach($childs as $k=>$v)
        {
            if($id)
            {
               $this->get_child($v['id']);
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
            if($parents['parent'] != 0 )
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
