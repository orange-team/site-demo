<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//共用函数

//检查变量,相当于isset,empty
function chk($var)
{
    return isset($var) && !empty($var);
}
