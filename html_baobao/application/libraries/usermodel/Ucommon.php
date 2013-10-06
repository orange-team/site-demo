<?php
/*************************************************************************
> File Name: Ucommon.php
> Author: arkulo
> Mail: arkulo@163.com 
> Created Time: 2013年10月05日 星期六 16时33分15秒
*************************************************************************/
class Ucommon extends Usermodelbase
{
    public function getAskArticle($limit)
    {
        $where = array();
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
        $where = array();
        $order = "weight desc";
        $res = $this->CI->tag->getList($where,$order,$limit);
        return $res;
    }
    public function getWiki($limit)
    {
        $res = $this->CI->wiki->getList($limit);
        return $res;
    }
}
