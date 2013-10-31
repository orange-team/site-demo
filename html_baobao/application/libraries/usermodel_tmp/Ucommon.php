<?php
/*************************************************************************
> File Name: Uommon.php
> Author: arkulo
> Mail: arkulo@163.com 
> Created Time: 2013年10月26日 星期六 21时06分51秒
*************************************************************************/
class Ucommon extends Ucreate
{
    private $tags = array();

    //用户个性化的东西，重写函数
    public function getAskArticle()
    {
        $where = array("section"=>$this->section);
        $order = "id asc";
        $limit = "2";
        return parent::getAskArticle($where,$order,$limit);
    }
}
