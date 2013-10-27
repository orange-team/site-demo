<?php
/*************************************************************************
> File Name: Uprogmedium.php
> Author: arkulo
> Mail: arkulo@163.com 
> Created Time: 2013年10月28日 星期一 01时31分40秒
*************************************************************************/
class Uprogmedium extends Ucreate
{
    public function getAskArticle()
    {
        $where = array("section"=>$this->section);
        $order = "id desc";
        $limit = "2";
        return parent::getAskArticle($where,$order,$limit);
    }
}
