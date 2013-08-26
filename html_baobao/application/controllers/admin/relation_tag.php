<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台--标签关系管理
* author: zg
* date: 2013-07-07
*/

class Relation_tag extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/relation_tag_model','relation_tag');
	}
	//添加
	function add()
	{
        $tag_id = trim(addslashes($this->input->get('tag_id')));
        $target_id = trim(addslashes($this->input->get('target_id')));
        if ( empty($tag_id) || empty($target_id) )
        {
            exit -1;
        }
        $data = array('tag_id'=>$tag_id, 'target_id'=>$target_id, 'target_type'=>1);
        $affected_rows = $this->relation_tag->insertNew($data);
        unset($data);
        echo ($affected_rows>0) ? '1' : '-2';
    }
    //删除	
	function del()
	{
		$tag_id = trim(addslashes($this->input->get('tag_id')));
        $target_id = trim(addslashes($this->input->get('target_id')));
        if ( empty($tag_id) || empty($target_id) )
        {
            exit -1;
        }
        $data = array('tag_id'=>$tag_id, 'target_id'=>$target_id, 'target_type'=>1);
        $affected_rows = $this->relation_tag->del($data);
		echo ($affected_rows>0) ? '1' : '-2';
	}
    //ajax获取标签关系
    function ajax_get($key)
    {
        header('Content-Type: text/html; charset=utf-8');
        $arr = $arrRelation_tag = array();
        if(!empty($key))
        {
            $key = urldecode($key);
            //模糊查询$key相关的标签关系
            $arr = $this->tag->getBy_name($key);
            foreach($arr as $v)
            {
                $arrRelation_tag[$v['id']] = $v['name'];
            }
            unset($arr);
        }
        $arrRelation_tag['len'] = count($arrRelation_tag);
        echo json_encode($arrRelation_tag);
    }
    

}
