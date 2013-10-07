<?php
/*************************************************************************
> File Name: relation_tag1_model.php
> Author: arkulo
> Mail: arkulo@163.com 
> Created Time: 2013年10月06日 星期日 17时41分35秒
*************************************************************************/
class relation_tag1_model extends CI_Model
{
    private $_table = "";
    
    //取得标签关系表对应的标签array格式
    public function getTargetTag($target_id,$target_name)
    {
        $sql = "select ".$target_name.".id,name from ".$target_name." left join a_tag on a_ask_tag.tag_id=a_tag.id where target_id=".$target_id;
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    //取得标签关系表对应的标签string格式
    public function getPageTag($target_id,$target_name)
    {
        $res = $this->getTargetTag($target_id,$target_name);
        $pageKeywords = "";
        foreach($res as $item)
        {
            $pageKeywords .= $item['name'].",";
        }
        return mb_substr($pageKeywords,0,-1,"utf-8");
    }

}
