<?php
/*************************************************************************
> File Name: Usermodelbase.php
> Author: arkulo
> Mail: arkulo@163.com 
> Created Time: 2013年10月05日 星期六 16时23分58秒
*************************************************************************/
abstract class Usermodelbase
{
    protected $CI;

    public function __construct()
    {
        $this->CI = & get_instance();
        $this->CI->load->model("ask_article_model","askArt");
        $this->CI->load->model("tag_model","tag");
        $this->CI->load->model("user_model","user");
        $this->CI->load->model("wiki_model","wiki");
    }
    abstract function getAskArticle($limit);
    abstract function getTag($limit);
    abstract function getWiki($limit);
}
