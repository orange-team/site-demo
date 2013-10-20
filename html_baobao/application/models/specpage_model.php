<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台--专栏模型
* author: zg
* date: 2013-07-28
*/
 
class Specpage_model extends CI_Model
{
	var $_table = 'a_specpage';
	function __construct()
	{
		parent::__construct();
	}

	function getBy_id($id)
	{
		$this->db->select('*')->from($this->_table)->where('id', (int)$id);
		return $this->db->get()->row_array();
    }

	function getBy_ids($ids)
	{
		$this->db->select('id,name')->from($this->_table)->where_in('id', $ids);
		return $this->db->get()->result_array();
    }

	function getTotal($where=array())
	{
        if(isset($where['title']) && !empty($where['title'])) 
        {
            $this->db->like('title',$where['title']);
            unset($where['title']);
        } 
        $this->db->where($where);
		return $this->db->count_all_results($this->_table);
	}

    //列表页
	function getList($limit=0, $offset=0, $where=array())
    {
        if(isset($where['title']) && !empty($where['title'])) 
        {
            $this->db->like('title',$where['title']);
            unset($where['title']);
        } 
		$this->db->select('*')->from($this->_table);
		($where) ? $this->db->where($where) : '';
		$this->db->order_by("id DESC");
        if($limit != 0 || $offset != 0)
            $this->db->limit($limit, $offset);
		return $this->db->get()->result_array();
	}

	function insertNew($data)
	{
		$this->db->insert($this->_table, $data); 
		return $this->db->insert_id();
	}

    //为专栏根新封面图片路径
    function update_cover($id, $data)
    {
        $this->db->where('id', $id)->update($this->_table, $data);
        return $this->db->affected_rows();
    }

	function update($id, $data=array())
	{
		$this->db->where('id', $id)->update($this->_table, $data);
		return $this->db->affected_rows();
	}
	
	function del($id)
	{
		$this->db->where('id', $id)->limit("1")->delete($this->_table);
		return $this->db->affected_rows();
	}

	function getBy_name($name,$not_in_ids=array())
    {
        $this->db->select('id,name')->from($this->_table)->where_not_in('id',$not_in_ids)->like('name', $name)->limit(30);
        return $this->db->get()->result_array();
    }
	
}
