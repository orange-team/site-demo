<?php
/*************************************************************************
> File Name: Uprepare.php
> Author: arkulo
> Mail: arkulo@163.com 
> Created Time: 2013年10月28日 星期一 01时26分08秒
*************************************************************************/
class Uprepare extends Ucreate
{
    public function getAskArticle()
    {
        $where = array("section"=>$this->section);
        $order = "id desc";
        $limit = "20";
        return parent::getAskArticle($where,$order,$limit);
    }
}
