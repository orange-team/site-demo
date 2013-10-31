<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台--图片库模型
* author: zg
* date: 2013-09-06
*/
 
class Img_lib_model extends CI_Model
{
	var $_table = 'a_img_lib';
	function __construct()
	{
		parent::__construct();
	}

    function getBy_tag($tag_id)
	{
		$this->db->select('*')->from($this->_table)->where('tag_id', (int)$tag_id);
		return $this->db->get()->row_array();
    }

    function getBy_tag_ids($tag_ids)
	{
		$this->db->select('*')->from($this->_table)->where_in($tag_ids);
		return $this->db->get()->result_array();
    }

    function getOrder_weight($limit,$offset)
    {
        $this->db->select('id,name')->from($this->_table)->order_by("weight DESC");
        $this->db->limit($limit, $offset);
        return $this->db->get()->result_array();
    }

	function getBy_ids($ids)
	{
		$this->db->select('id,name')->from($this->_table)->where_in('id', $ids);
		return $this->db->get()->result_array();
    }

	function getBy_name($name,$not_in_ids=array())
    {
        $this->db->select('id,name')->from($this->_table)->where_not_in('id',$not_in_ids)->like('name', $name)->limit(30);
        return $this->db->get()->result_array();
    }
	
}
