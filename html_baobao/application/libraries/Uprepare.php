<?php
/*************************************************************************
> File Name: Uprepare.php
> Author: arkulo
> Mail: arkulo@163.com 
> Created Time: 2013年10月04日 星期五 21时21分37秒
*************************************************************************/
class Uprepare
{
    private $CI;
    private $tags = array();
    public function __construct($tags)
    {
        $this->tags = $tags;
        $this->CI = & get_instance();
        $this->CI->load->model('ask_article_model','askArt'); 
        $this->CI->load->model('user_model','user');
    }
    
    //问答文章数据
    public function getAskArt($order='',$limit=20,$recommand=0)
    {
        $where = array("time_line"=>1);
        if(empty($order))$order = 'pv desc';
        $res = $this->CI->askArt->get($where,$order,$limit);
        foreach($res as $key=>$item)
        {
            $user = $this->CI->user->get($item['author']); 
            $res[$key]['author'] = $user['user_nickname'];
        }
        return $res;
    }
}
