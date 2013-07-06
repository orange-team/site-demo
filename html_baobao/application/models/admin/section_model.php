<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台--栏目model
* author: Liangxifeng
* date: 2013-06-25
*/
 
class section_model extends CI_Model
{
	var $_table = 'a_section';
	function __construct()
	{
		parent::__construct();
	}

	function getBy_parent($id)
	{
		$this->db->select('*')->from($this->_table)->where('parent', (int)$id);
		$arr = $this->db->get()->result_array();
		return $arr;
	}

    //获取单条记录
    function get_one($where=array())
    {
		$this->db->select('*')->from($this->_table)->where($where)->limit(1);
		$arr = $this->db->get()->row_array();
		return $arr;
    }

	//列表页
	function getList($where=array())
    {
		$this->db->select('*')->from($this->_table);
		($where) ? $this->db->where($where) : '';
		$this->db->order_by("id ASC");
		return $this->db->get()->result_array();
	}

	function insert($data)
	{
		$this->db->insert($this->_table, $data); 
		return $this->db->insert_id();
	}

	function update($id, $data=array())
	{
		$this->db->where('article_id', $id)->update($this->_table, $data);
		return $this->db->affected_rows();
	}
	
	function del($id)
	{
		$this->db->where('id', $id)->limit("1")->delete($this->_table);
        echo $this->db->last_query(); 
		return $this->db->affected_rows();
	}

	
	
}
