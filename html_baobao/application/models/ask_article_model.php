<?php
/*************************************************************************
> File Name: ask_article_model.php
> Author: arkulo
> Mail: arkulo@163.com 
*************************************************************************/

class ask_article_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getOne($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('a_ask_article');
        return $query->row_array();
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

