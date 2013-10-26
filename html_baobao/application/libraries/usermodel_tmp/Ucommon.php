<?php
/*************************************************************************
> File Name: Uommon.php
> Author: arkulo
> Mail: arkulo@163.com 
> Created Time: 2013年10月26日 星期六 21时06分51秒
*************************************************************************/
include("Umodel.php");
include("Ucreate.php");
class Ucommon extends Ucreate
{
    function __construct()
    {
        $this->section = 0;
    }
    public function getAskArticle()
    {
        echo "user: ",$this->section,"<br />";
        parent::getAskArticle();
    }
}
