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

	function update($article_id, $data=array())
	{
		$this->db->where('id', $article_id)->update($this->_table, $data);
		return $this->db->affected_rows();
	}
	
	function del($article_id)
	{
		$this->db->where('id', $article_id)->limit("1")->delete($this->_table);
		return $this->db->affected_rows();
	}

	
	
}
