<?php
/*************************************************************************
> File Name: ask_article_model.php
> Author: arkulo
> Mail: arkulo@163.com 
*************************************************************************/

class ask_article_model extends MY_Model
{
	const TBL_ASK = 'a_ask_article';
	const TBL_ASK_TAG = 'a_ask_tag';

    public function __construct()
    {
        $this->_table = self::TBL_ASK;
        parent::__construct();
    }

    //关联标签
    public function getTag($id)
    {
        $this->_table = self::TBL_ASK_TAG;
        $this->db->select('tag_id')
            ->where(array('target_id'=>$id,'status_tag'=>1));
        $res = $this->db->get($this->_table)->result();
        $resNew = array();
        $this->load->model('tag_model','tag');
        foreach($res as $key=>$val)
        {
            $resNew[$val->tag_id] = $this->tag->getOne($val->tag_id)->name;
        }
        return $resNew;
    }

    public function get($where=array(),$order='',$limit=20)
    {
        $this->db->where($where);
        $this->db->order_by($order);
        $this->db->limit($limit);
        $query = $this->db->get('a_ask_article');
        return $query->result_array();
    }

    
}

