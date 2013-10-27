<?php
/*************************************************************************
> File Name: Uprogprop.php
> Author: arkulo
> Mail: arkulo@163.com 
> Created Time: 2013年10月28日 星期一 01时28分33秒
*************************************************************************/
class Uprogprop extends Ucreate
{
    function getAskArticle()
    {
        $where = array("section"=>$this->section);
        $order = "id desc";
        $limit = "2";
        return parent::getAskArticle($where,$order,$limit);
    }
}
