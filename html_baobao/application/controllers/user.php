<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 用户登录页面
* author: Liangxifeng yesgang
* date: 2013-09-19
*/

class user extends CI_Controller
{
    var $_info = array();
    var $_ref = '';
	function __construct()
	{
		parent::__construct();
        $this->_info['cls'] = strtolower(__CLASS__);
        $this->_info['name'] = '用户';
        $this->_info['view_path'] = 'admin/'.$this->_info['cls'];
        $this->load->model('user_model','user');
		$this->load->model('tag_model','tag');
		$this->load->model('relation_tag_model','relation');
	}

    //个人中心
    function center()
    {
        $user_id = 1;
        //获取用户信息
        $this->data['row'] = $this->user->get($user_id);
        //获取标签信息
        
        $whereData = array('target_id'=>$user_id,'target_type'=>3,'status'=>0);
        $tagArr = $this->relation->get($whereData);
        $arrTagIds = $tagNameArr = array();
        foreach($tagArr as $k=>$v)
        {
            $arrTagIds[] = $v['tag_id'];
        }
        if(0<count($arrTagIds)) $tagNameArr = $this->tag->getBy_ids($arrTagIds);
        $this->data['tagNameArr'] = $tagNameArr;
        unset($tagArr,$tagNameArr);
        
        $relation = $this->relation->get(array('target_type'=>3));
        //print_r($this->data['row']);
        $this->data['seo'] = array('title'=>'用户个人中心',
                'description'=>'用户个人中心页的描述页面信息',
                'keywords'=>'用户个人中心,母婴知识,宝宝健康'
                );
        //要载入的css, js文件
        $this->data['file'] = array('js'=>'user_center','css'=>'user_center');
        $this->data['isRed'] = 2;
		$this->load->helper(array('url','form'));
		$this->load->view('user_center', $this->data);
    }

    //修改个人信息
    function edit_info()
    {
        $user_id = 1;
        $info = $this->input->post('user_info') ? $this->input->post('user_info') : '';
        $res = $this->user->edit($user_id,array('user_info'=>$info));
        //echo $this->db->last_query();exit;
        if($res)
        {
            header('Location:/user/center/');
        }
    }

    //用户根据时间轴选择标签
    function select_tag()
    {
        $user_id = $this->data['user_id'] = 1;
        //获取用户信息
        $this->data['row'] = $this->user->get($user_id);
        //获取标签信息
        $this->data['tagNameArr'] = $this->tag->getOrder_weight(40,0,1);
        $relation = $this->relation->get(array('target_type'=>3));
        //print_r($this->data['row']);
        $this->data['seo'] = array('title'=>'蜡笔画注册用户选择标签',
                'description'=>'蜡笔画注册用户选择标签的描述页面信息',
                'keywords'=>'蜡笔画注册用户选择标签,母婴知识,宝宝健康'
                );
        //要载入的css, js文件
        $this->data['file'] = array('js'=>'user_select_tag','css'=>'user_select_tag');
        $this->data['isRed'] = 2;
		$this->load->view('user_select_tag', $this->data);
    }  

    //关联用户关注的标签
    function select_tag_action()
    {
        $user_id = $this->input->post('user_id') ? $this->input->post('user_id') : '';
        if('' != $user_id)
        {
            $tags = $this->input->post('tags') ? $this->input->post('tags') : '';
            if( '' != $tags )
            {
                $tagId_arr = explode(',',$tags);
                $tagId_num = count($tagId_arr);
                $sucess_num = 0;
                foreach($tagId_arr as $v)
                {
                    $res = $this->relation->insertNew(array('target_type'=>3,'target_id'=>$user_id,'tag_id'=>$v));
                    if($res)
                    {
                        $sucess_num++;
                    }
                }
                if($tagId_num == $sucess_num)
                {
                    header("Location:/user/user_center");
                }
            }
        }
    }

}
