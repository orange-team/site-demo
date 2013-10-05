<?php
/*************************************************************************
> File Name: Usermodelbase.php
> Author: arkulo
> Mail: arkulo@163.com 
> Created Time: 2013年10月05日 星期六 16时23分58秒
*************************************************************************/
class Usermodelbase
{
    protected $CI;

    public function __construct()
    {
        $this->CI = & get_instance();
        $this->CI->load->model("ask_article_model","askArt");
        $this->CI->load->model("tag_model","tag");
    }
}
