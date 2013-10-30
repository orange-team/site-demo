<?php
/*************************************************************************
> File Name: Umodel.php
> Author: arkulo
> Mail: arkulo@163.com 
> Created Time: 2013年10月22日 星期二 20时41分29秒
*************************************************************************/
include('Ubase.php');
include('Ucreate.php');
class Umodel implements Ubase
{
    private $section = 0;
    private $userModel = "";
    private $userModelArr = array(1=>"Ucommon",2=>"Uprepare",3=>"Uprogprop",4=>"Uprogmedium",5=>"Uproglate",6=>"Uoneage",7=>"Uthreeage");  
    public function __construct($paras)
    {
        $this->CI = &get_instance();
        //查询当前用户状态
        $this->CI->load->model("user_model","user");
        $userType = $this->CI->user->get($paras[0]);
        $this->section = $userType['section'];
        $userModelFile = $this->userModelArr[$this->section];
        //调用相应的用户模型
        $this->CI->load->library("usermodel_tmp/".$userModelFile);
        $method = strtolower($userModelFile);
        $this->hd = & $this->CI->$method;        
        $this->hd->section = $this->section;
        //tags sended into common object
        if("Ucommon"==$userModelFile)
        {
            $this->hd->tags = $paras[1];
        }
    }

    public function getAskArticle()
    {
        $res = $this->hd->getAskArticle();
        return $res;
    }


}
