<?php
/*************************************************************************
> File Name: mmshuo_art_detail.php
> Author: arkulo
> Mail: arkulo@163.com 
> Modified : zg
*************************************************************************/
if(!defined('BASEPATH')) exit('No direct script access allowd');

class mmshuo_art_detail extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ask_article_model','askArt');
        $this->load->model('user_model','user');
        //$this->load->model('ask_comment_model','comment');
        $this->load->model('section_model','section');
        //$this->load->model('keyword_model','keyword');
        $this->load->model('relation_tag1_model','tag');
    }

    public function detail($id,$user_id)
    {
        $id = intval($id);
        $user_id = intval($user_id);
        $row = array();
        //文章
        $art_info = $this->askArt->getOne($id);
        $user = $this->user->get($art_info['author']);
        $art_info['author'] = $user['user_nickname'];
        $section = $this->section->get_one(array('id'=>$art_info['section']));
        $art_info['section_name'] = $section['name'];
        $page_keyword = $this->tag->getTargetTag($art_info['id'],"a_ask_tag");
        $art_info['tag'] = $page_keyword;
        $row['art'] = $art_info;
        //seo数据
        $page_keyword = $this->tag->getPageTag($art_info['id'],"a_ask_tag");
        $row['seo'] = array('title'=>$art_info['title'],
                            'description'=>$art_info['abstract'],
                            'keywords'=>$page_keyword
                );
        //需要加载的文件
        $row['file'] = array('js'=>'','css'=>'mmshuo_art_detail');
        //相关经历
        $this->load->library("usermodel/Usermodel",array($user_id));
        $relationArticle = $this->usermodel->getAskArticle(8);
        $row['relation'] = $relationArticle;
        //百科推荐
        $this->load->library("usermodel/Usermodel",array($user_id));
        $relationWiki = $this->usermodel->getWiki(6);
        $row['wiki'] = $relationWiki;

        $this->load->view('mmshuo_art_detail',$row);
    }
}
