<?php
/*************************************************************************
> File Name: Ucreate.php
> Author: arkulo
> Mail: arkulo@163.com 
> Created Time: 2013年10月22日 星期二 20时45分41秒
*************************************************************************/
class Ucreate extends Umodel
{
    private $userHandle = NULL;

    public function decorate($userhandle)
    {
        $this->userHandle = $userhandle;
    }
    public function getAskArticle()
    {
        if(NULL!=$this->userHandle)
        {
            $this->userHandle->getAskArticle();
        }
    }
}
