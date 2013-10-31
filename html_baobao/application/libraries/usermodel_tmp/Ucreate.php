<?php
/*************************************************************************
> File Name: Ucreate.php
> Author: arkulo
> Mail: arkulo@163.com 
> Created Time: 2013年10月22日 星期二 20时45分41秒
*************************************************************************/
class Ucreate implements Ubase
{   
    public $section;
    function __construct()
    {
        $this->CI = & get_instance();
        $this->CI->load->model("ask_article_model","askArt");
        $this->CI->load->model("tag_model","tag");
        $this->CI->load->model("user_model","user");
        $this->CI->load->model("wiki_model","wiki");   
    }
    public function getAskArticle($where=array(),$order="id desc",$limit=20)
    {
        //用户模型如果不重写该函数，则默认$where的值
        if(empty($where))
        {
            $where = array("section"=>$this->section);
        }
        $res = $this->CI->askArt->get($where,$order,$limit);
        foreach($res as $key=>$item)
        {
            $user = $this->CI->user->get($item['author']);
            $res[$key]['author'] = $user['user_nickname'];
        }
        return $res;       
    }
}
