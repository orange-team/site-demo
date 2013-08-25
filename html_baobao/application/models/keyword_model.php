<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台--关键词模型
* author: Liangxifeng
* date: 2013-07-04
*/
 
class keyword_model extends CI_Model
{
	var $_table = 'a_keyword';
	function __construct()
	{
		parent::__construct();
	}

	function getBy_id($id)
	{
		$this->db->select('*')->from($this->_table)->where('id', (int)$id);
		return $this->db->get()->row_array();
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
	//列表页
	function getList($limit=0, $offset=0, $where=array(1=>1))
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
        if(isset($in_where)) $this->db->where_in('section',$in_where);
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
