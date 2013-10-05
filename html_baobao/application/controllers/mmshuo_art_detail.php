<?php
/*************************************************************************
> File Name: mmshuo_art_detail.php
> Author: arkulo
> Mail: arkulo@163.com 
*************************************************************************/
if(!defined('BASEPATH')) exit('No direct script access allowd');

class mmshuo_art_detail extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ask_article_model','art');
        $this->load->model('user_model','user');
        //$this->load->model('ask_comment_model','comment');
        $this->load->model('section_model','sect');
        //$this->load->model('keyword_model','keyword');
        //$this->load->model('tag_model','tag');
    }

    public function detail($id)
    {
        $id = intval($id);
        $row = array();
        //文章
        $art_info = $this->art->getOne($id);
        $user = $this->user->get($art_info['author']);
        $art_info['author'] = $user['user_nickname'];
        $section = $this->sect->get_one(array('id'=>$art_info['section_type']));
        $art_info['section_type'] = $section['name'];
        $row['art'] = $art_info;
        //print_r($art_info);exit;
        $row['seo'] = array('title'=>$art_info['title'],
                            'description'=>$art_info['abstract'],
                            'keywords'=>'经历'
                );
        $row['file'] = array('js'=>'','css'=>'mmshuo_art_detail');

        $this->load->library("Uprepare",array());
        $rr = $this->uprepare->getAskArt();
        print_r($rr);exit;

        //右侧推荐
        $this->load->view('mmshuo_art_detail',$row);
    }
}
