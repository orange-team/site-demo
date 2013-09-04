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
		$this->load->model('admin/article_model','art');
		$this->load->model('admin/section_model','section');
		$this->load->model('admin/keyword_model','keyword');
	}
	//文章列表:新闻中心-->最新新闻
	function showlist($section=0,$title='')
	{error_reporting('E_ALL'); 
        $this->load->helper('form'); 

        //搜索
        $where = array();
        //搜栏目segment(4)
        $this->data['section'] = 0;
        $this->data['one'] = $this->data['two'] = $this->data['three'] = 0; //栏目id
        $this->data['two_value'] = $this->data['three_value'] = '';         //栏目内容
        $this->data['keywords'] = array(); //关键词数组
        $this->data['keyword_id'] = 0;     //关键词id

        if($section)
        {
            //0:一级栏目id, 1:二级栏目id, 2:三级栏目id, 3:关键词id
            $arr = explode('-',$section); 
            if($arr[0] != 0)
            {
                $childs = $this->get_child($arr[0]);
                $childs_id = $childs[1] ? array_keys($childs[1]) : array();//子栏目id
                array_unshift($childs_id,$arr[0]);
                $where['section'] = $childs_id;
                $this->data['two_value'] = $childs[0] ? $childs[0] : '';   //二级栏目内容
            }
            if($arr[1] != 0 && !empty($this->data['two_value']))
            {
                unset($childs,$childs_id,$where['section']);
                $childs = $this->get_child($arr[1],false);
                $childs_id = $childs[1] ? array_keys($childs[1]) : array();//子栏目id
                array_unshift($childs_id,$arr[1]);
                $where['section'] = $childs_id;
                $this->data['three_value'] = $childs[0] ? $childs[0] : ''; //三级栏目内容
            }
            if($arr[2] != 0 && !empty($this->data['three_value']))
            {
                unset($where['section']);
                $where['section'] = array($arr[2]);
            }
            if($arr[3] != 0)
            {
                $this->data['keyword_id'] = $where['keyword'] = (int)$arr[3];
            }

            //搜关键词
            if($where['section'])
            {
                $where_section['section'] = $where['section'];
                $this->data['keywords'] =  $this->keyword->getList(0,0,$where_section);
            }

            $this->data['section'] = $section; 
            $this->data['one'] = $arr[0]; 
            $this->data['two'] = $arr[1]; 
            $this->data['three'] = $arr[2]; 
        }


        //搜标题segment(5)
        $this->data['title'] = 0;
        if($title)  
        {
            $this->data['title'] = urldecode(trim(addslashes($title))); 
            $where['title'] = $this->data['title']; 
        }

		//分页
		$this->load->library('pagination');
		$config['base_url'] = site_url('admin/article/showlist/'.$this->data['section'].'/'.$this->data['title'].'/');
		//每页
		$config['per_page'] = $this->data['pagesize'] = 15; 
		//总数
		$config['total_rows'] = $this->art->getTotal($where);
		$this->data['section'] = (int)$section;
		$config['uri_segment'] = 6;
		$config['first_link'] = '首页';
		$config['last_link'] = '尾页';
		$config['next_link'] = '下一页';
		$config['prev_link'] = '上一页';
		$this->pagination->initialize($config); 
		$this->data['page'] = $this->pagination->create_links();
		$offset = $this->uri->segment(6);
		$arr = $this->art->getList($this->data['pagesize'], $offset, $where);
		//foreach( $arr as $k=>$v )
		//{
		//	$arr[$k]['title'] = $this->my_substr($v['title'],0,14);
		//}
        //顶级栏目
        $this->data['one_section'] = $this->section->getBy_parent(0);
		$this->data['articleArr'] = $arr;
        $this->data['number'] = $offset+1; 
		$this->load->view('admin/articleList', $this->data);
	}
	function add()
	{
		$this->load->helper('form');
        //等级栏目
        $this->data['one_section'] = $this->section->getBy_parent(0);
		//在线编辑器
		$edit = array('name' =>'content', 'id' =>'content', 'value' =>'');
		$this->load->library('kindeditor',$edit);
        $this->data ['kindeditor'] = $this->kindeditor->getEditor();
		$this->load->view('admin/articleAdd', $this->data);
	}

	//编辑
	function editArt($art_id)
	{
		$this->load->helper('form');
		$arr = $this->art->getBy_id($art_id);
        $section = $this->section->get_one(array('id'=>$arr['section']));
        $is_two = false;     //是否显示二级栏目
        $is_three = false;   //是否显示三级栏目
        $keyword_section = '';  //与关键词关联的栏目id
        $arr['one'] = $arr['two'] = '';//三个级栏目的selected标识
        //如果文章属于非顶级栏目
        if($section['parent'] != 0)
        {
            $section_up = $this->get_parent($section['parent']);
            //如果文章属于三级栏目下
            $is_two = true;
            $arr['one'] = $section_up[0] ? $section_up[0] : '';
            $arr['two'] = $section_up[1] ? $section_up[1] : '';
            if('' != $arr['one'] && '' != $arr['two'])
            {
                $is_three = true;
                $keyword_section = $section['id'];
            }

            //如果文章属于二级栏目下
            if($arr['one'] == '')
            {
                $arr['one'] = $arr['two']; unset($arr['two']);
                $arr['two'] = $section;
                $keyword_section = $arr['two']['id'];
            } 
        }else//属于顶级栏目
        {
            $arr['one'] = $section;
            $keyword_section = $arr['one']['id'];
        }

        //查询所选栏目对应的关键词
        $list = $this->get_child($keyword_section);
        $list[1] = $list[1] ? $list[1] : array();
        $childs_id = array_keys($list[1]);//当前栏目下所有子栏目id
        array_unshift($childs_id,$keyword_section);
        $where['section'] = $childs_id;
        $arr['keywords'] = $this->keyword->getList(0,0,$where);
        //顶级栏目
        $arr['one_section'] = $this->section->getBy_parent(0);
        if( $is_two == true )
        {
            $fid = '' != $arr['one'] ? $arr['one']['id'] : $arr['two']['id'];
            $arr['two_section'] =  $this->section->getList(array('parent'=>$fid));
        }
        $arr['three_section'] = $is_three==true ? $this->section->getList(array('parent'=>$arr['two']['id'])) : '';
		//在线编辑器
		$edit = array('name' =>'content', 'id' =>'content', 'value' =>$arr['content']);
		$this->load->library('kindeditor',$edit);
        $arr['kindeditor'] = $this->kindeditor->getEditor( $edit );
        //相关标签
		$this->load->model('admin/relation_tag_model','relation_tag');
		$this->load->model('admin/tag_model','tag');
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
		if($this->input->post('section')) $data['section'] = trim(addslashes($this->input->post('section')));
		if($this->input->post('keyword')) $data['keyword'] = trim(addslashes($this->input->post('keyword')));
		if($this->input->post('title')) $data['title'] = trim(addslashes($this->input->post('title')));
		if($this->input->post('subtitle')) $data['subtitle'] = trim(addslashes($this->input->post('subtitle')));
		if($this->input->post('source')) $data['source'] = trim(addslashes($this->input->post('source')));
		if($this->input->post('content')) $data['content'] = addslashes($this->input->post('content'));
		$affected_rows = $this->art->update($article_id, $data);
        //echo $this->db->last_query();exit;
		//var_dump($affected_rows);
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
				'keyword' => $this->input->post('keyword'),
				);
		$affected_rows = $this->art->insertNew($data);
		$data['msg'] = ($affected_rows>0) ? '成功' : '失败';
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
		$edit = array('name' =>'content', 'id' =>'content', 'value' =>$this->data['content']);
		$this->load->library('kindeditor',$edit);
        $this->data ['kindeditor'] = $this->kindeditor->getEditor( $edit );
		
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
        $showKey = $this->input->get('showKey') ? intval($this->input->get('showKey')) : ''; //showKey值为1时查询关键词，0:不查询
        if(!empty($section_id))
        {
            $childs = $this->section->getBy_parent($section_id);
            unset($childs['pt_depth'],$childs['parent']);
            if($showKey != '')
            {
                $list = $this->get_child($section_id);
                $list[1] = $list[1] ? $list[1] : array();
                $childs_id = array_keys($list[1]);//当前栏目下所有子栏目id
                array_unshift($childs_id,$section_id);
                $where['section'] = $childs_id;
                $childs['keywords'] = $this->keyword->getList(0,0,$where);
            }
            if($id == 0)
            {
                echo !empty($childs) ? json_encode($childs) : -1; 
            }else
            {
                return !empty($childs) ? $childs : -1;  
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
