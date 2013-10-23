<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台--关键词模型
* author: Liangxifeng
* date: 2013-07-04
*/
 
class article_tag_model extends CI_Model
{
	var $_table = 'a_article_tag';
	function __construct()
	{
		parent::__construct();
	}

	function get_one($where=array())
	{
		$this->db->select('*')->from($this->_table)->where($where);
		return $this->db->get()->row_array();
	}
	function getList($where=array())
	{
		$this->db->select('*')->from($this->_table)->where($where);
		return $this->db->get()->result_array();
	}

	function insertNew($data)
	{
		$this->db->insert($this->_table, $data); 
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

	
	
}
