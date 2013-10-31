<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台--关键词模型
* author: Liangxifeng
* date: 2013-07-04
*/
 
class Tag_model extends MY_Model
{
	var $_table = 'a_tag';

	function __construct()
	{
		parent::__construct();
	}

    function getBy_name($name,$not_in_ids=array())
    {
        $this->db->select('id,name')->from($this->_table)->where_not_in('id',$not_in_ids)->like('name', $name)->limit(30);
        return $this->db->get()->result_array();
    }

    //随机排序 或者 通过weight排序
    function getOrder_weight($limit,$offset,$rand=0)
    {
        $this->db->select('id,name')->from($this->_table);
        if(0 != $rand)
        {
            $this->db->order_by("rand()");
        }else
        {
            $this->db->order_by("weight DESC");
        }
        $this->db->limit($limit, $offset);
        return $this->db->get()->result_array();

    }

	function getBy_ids($ids)
	{
		$this->db->select('id,name')->from($this->_table)->where_in('id', $ids);
		return $this->db->get()->result_array();
    }

	function getTotal($where=array())
	{
        if(isset($where['name']) && !empty($where['name'])) 
        {
            $this->db->like('name',$where['name']);
            unset($where['name']);
        } 
        if(isset($where['section']) && !empty($where['section']))
        {
            $in_where = $where['section'];
            unset($where['section']);
        }
        $this->db->where($where);
        if(isset($in_where)) $this->db->where_in('section',$in_where);
		return $this->db->count_all_results($this->_table);
	}
}
