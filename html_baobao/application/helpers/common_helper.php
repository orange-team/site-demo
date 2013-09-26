<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//共用函数

//检查变量,相当于isset,empty
function chk($var)
{
    return isset($var) && !empty($var);
}

//过滤变量,相当于trim,addslashes
function filter($var)
{
    return trim(addslashes($var));
}

//转码
function utf2gbk($str)
{
    return mb_convert_encoding($str, 'GBK', 'UTF-8'); 
}

//生成密码
function create_pwd($str)
{
    return md5('labi'.$str.'hua');
}
