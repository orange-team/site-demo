<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 时间轴模型
* author: zg
* date: 2013/10/20
*/
 
class timeline_model extends CI_Model
{
	var $_table = 'a_timeline';

	function __construct()
	{
		parent::__construct();
	}

	function getBy_id($id)
	{
		$this->db->select('*')->from($this->_table)->where('id', $id);
		return $this->db->get()->row_array();
	}

	function getTotal($where=array())
	{
        $this->db->where($where);
		return $this->db->count_all_results($this->_table);
	}

	//列表页
	function getList($limit=0, $offset=0, $where=array())
    {
		$this->db->select('*');
		($where) ? $this->db->where($where) : '';
		$this->db->limit($limit, $offset);
		return $this->db->get($this->_table);
	}

	function insert($data)
	{
		$this->db->insert($this->_table, $data); 
		return $this->db->affected_rows();
	}
	
	function del($timeline_id)
	{
		$this->db->where('id', $timeline_id)->limit("1")->delete($this->_table);
		return $this->db->affected_rows();
	}
	
}
