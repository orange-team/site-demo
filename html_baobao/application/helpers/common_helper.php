<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//共用函数

//检查变量,相当于isset,empty
function chk($var)
{
    return isset($var) && !empty($var);
}

//统计子字符串在字符串中的出现次数
function statistics_str_count($substring)
{
    return mb_substr_count();
}
