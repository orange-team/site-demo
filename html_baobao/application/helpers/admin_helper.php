<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//admin常用工具函数

//关联标签
function relation_tag($obj_id, $obj_type, $tagNameArr)
{
    echo '<script type="text/javascript" src="/adminStatic/easydialog/easydialog.min.js" ></script>
        <script type="text/javascript" src="/adminStatic/js/relation_tag.js" ></script>
        <link rel="stylesheet" href="/adminStatic/easydialog/easydialog.css" type="text/css" />
        <link rel="stylesheet" href="/adminStatic/css/relation_tag.css" type="text/css" />
        <script type="text/javascript">
        //初始化标签容器
        var tag_container = {
            //查询的关键词
            key : null,
            //已经选择的标签
            list : {},
            //临时标签容器，存放从“标签选择器”中新选择的标签
            tmp_list : {},
            //文章本身id
            target_id : "', $obj_id,'",
            target_type : "', $obj_type,'",
        }',"\n";

    //初始化“相关标签”
    if(!empty($tagNameArr))
    {
        foreach($tagNameArr as $k=>$v)
        {
            echo 'tag_container.tmp_list[',$v['id'],']="',$v['name'],'";';
        }
        echo 'tag_yesFn("init");';
    }
    echo '</script>',"\n";
}
