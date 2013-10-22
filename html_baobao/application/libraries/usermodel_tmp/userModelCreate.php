<?php
/*************************************************************************
> File Name: userModelCreate.php
> Author: arkulo
> Mail: arkulo@163.com 
> Created Time: 2013年10月22日 星期二 20时45分41秒
*************************************************************************/
class userModelCreate extends userModel
{
    private $userHandle = '';

    //装饰
    public function decorate($userhandle)
    {
        $this->userHandle = $userhandle;
    }
}
