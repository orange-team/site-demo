<?php
/*************************************************************************
> File Name: Uommon.php
> Author: arkulo
> Mail: arkulo@163.com 
> Created Time: 2013年10月26日 星期六 21时06分51秒
*************************************************************************/
class Ucommon extends Ucreate
{
    public function getAskArticle()
    {
        $where = array("section"=>$this->section);
        $order = "id desc";
        $limit = "2";
        return parent::getAskArticle($where,$order,$limit);
    }
}
