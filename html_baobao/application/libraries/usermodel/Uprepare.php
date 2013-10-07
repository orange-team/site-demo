<?php
/*************************************************************************
> File Name: Uprepare.php
> Author: arkulo
> Mail: arkulo@163.com 
> Created Time: 2013年10月05日 星期六 19时55分26秒
*************************************************************************/
class Uprepare extends Usermodelbase
{
    public function getAskArticle($limit)
    {
        $where = array("section"=>1);
        $order = "pv desc";
        $res = $this->CI->askArt->get($where,$order,$limit);
        foreach($res as $key=>$item)
        {
            $user = $this->CI->user->get($item['author']);
            $res[$key]['author'] = $user['user_nickname'];
        }
        return $res;
    }
    public function getTag($limit)
    {
        $where = array("section"=>1);
        $order = "weight desc";
        $res = $this->CI->tag->getList($where,$order,$limit);
        return $res;
    }
    public function getWiki($limit)
    {
        $where = array("section"=>1);
        $order = "id desc";
        $res = $this->CI->wiki->getList($where,$order,$limit);
        return $res;
    }
}
