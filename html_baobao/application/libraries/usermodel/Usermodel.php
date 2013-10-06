<?php
/*************************************************************************
> File Name: Usermodel.php
> Author: arkulo
> Mail: arkulo@163.com 
> Created Time: 2013年10月05日 星期六 16时59分35秒
*************************************************************************/
include("Usermodelbase.php");
class Usermodel extends Usermodelbase
{
    private $hd;
    private $userModelArr = array("Ucommon","Uprepare","Uprogprop","Uprogmedium","Uproglate","Uoneage","Uthreeage");
    public function __construct($user_id)
    {
        parent::__construct();
        //判定用户当前处于哪个阶段
        $section = 0;
        if(""!=$user_id[0] && 0!=$user_id[0])
        {
            $userType = $this->CI->user->get($user_id[0]);
            $section = $userType['section'];
        }
        echo $section,"<br />";
        //获取对应的用户模型
        $userModel = $this->userModelArr[$section];
        $this->CI->load->library("usermodel/".$userModel);
        $method = strtolower($userModel);
        $this->hd = & $this->CI->$method;
    }
    public function getAskArticle($limit)
    {
        return $this->hd->getAskArticle($limit);
    }
    public function getTag($limit)
    {
        return $this->hd->getTag($limit);
    }
    public function getWiki($limit)
    {
        return $this->hd->getWiki($limit);
    }
}
