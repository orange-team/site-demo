<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台--栏目管理
* author: Liangxifeng
* date: 2013-06-25
*/

class Section extends MY_Controller
{
    function __construct()
    {
        parent::__construct(); 
        $this->load->model('admin/section_model', 'section'); 
    }

    //栏目列表
    function showlist()
    {
        $where['parent'] = 0; 
        $rows = $this->section->getList($where); 
        foreach($rows as $key=>$val)
        {
            //判断是否叶子节点
            $row = $this->section->getBy_parent($val['id']); 
			$rows[$key]['leaf'] = ($row) ? '+' : '-'; 

        }
        $data['rows'] = $rows; 
        $this->load->view('admin/sectionList', $data); 
    }
    //异步添加
	function ajax_add()
	{
		$name = $this->input->post('name') ?  trim($this->input->post('name')) : '';
		$level_1 = $this->input->post('level_1') ? intval($this->input->post('level_1')) : '';
		$level_2 = $this->input->post('level_2') ? intval($this->input->post('level_2')) : '';
        if(empty($name))
        {
            echo -2; exit;
        }
        $data['name'] = $name;

        //添加一级栏目
        if(empty($level_1)  &&  empty($level_2))
        {
            $data['pt_depth'] = 1;
            $data['parent'] = 0;
        //添加二级栏目
        }elseif(!empty($level_1) && empty($level_2))
        {
            $data['pt_depth'] = 2;
            $data['parent'] = $level_1;
        //添加三级栏目
        }else
        {
            $data['pt_depth'] = 3;
            $data['parent'] = $level_2;
        }

        //执行添加操作
        $res = $this->section->insert($data);
        if($res)
        {
            $new_insert = array('name'=>$name,'id'=>$res,'pt_depth'=>$data['pt_depth']);
            echo json_encode($new_insert);
        }
	}
    //异步修改
    function ajax_edit()
    {
        $id = $this->input->post('id') ? intval($this->input->post('id')) : 0;
        $name = $this->input->post('name') ? trim(addslashes($this->input->post('name'))):'';
        $rowA = $this->section->get_one(array('id'=>$id));
        $where = array('parent'=>$rowA['parent'],'name'=>$name);
        if($where)
        {
            $rowB = $this->section->get_one($where); 
        }

        if(isset($rowB) && !empty($rowB))       //同栏目下已有同名
        {
            echo -1;
        }else if(empty($name))//不能为空
        {
            echo -2; 
        }else
        {
            $res = $this->session->update($id, array('name'=>$name)); 
            echo $res ? 1 : -3; 
        }
    }
    //异步删除
    function ajax_del()
    {
        $id = $this->input->post('id') ? intval($this->input->post('id')) : 0;
        echo $this->section->del($id) ? 1 : -1; 
    }

    //ajax异步展开树
	function ajax_extend()
	{
		$id = empty($_POST['id']) ? 0 : $_POST['id']; 
		//根据ID查找所有子分类
		$where = array('id'=>$id);
		$rows = $this->section->getBy_parent($id);
        foreach($rows as $key=>$val)
        {
            //判断是否叶子节点
            $row = $this->section->getBy_parent($val['id']); 
			$rows[$key]['leaf'] = ($row) ? '+' : '-'; 
        }
		echo json_encode($rows);
    }

}
