<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台--关键词模型
* author: zg
* date: 2013-07-04
*/
 
class original_model extends CI_Model
{
	var $_table = 'a_article_crawl';
	function __construct()
	{
		parent::__construct();
	}

	function getBy_id($art_id)
	{
		$this->db->select('*')->from($this->_table)->where('id', (int)$art_id);
		return $this->db->get()->row_array();
	}

	function getByorder_id($where,$order='id ASC')
	{
		$this->db->select('id,title')->from($this->_table)->where($where);
		$this->db->order_by($order);
		return $this->db->get()->row_array();
	}


	function getTotal($where=array())
	{
        if(isset($where['title'])) 
        {
            $this->db->like('title',$where['title']);
            unset($where['title']);
        } 
        if(isset($where['section']) && $where['section'])
        {
            $in_where = $where['section'];
            unset($where['section']);
        }
        $this->db->where($where);
        if(isset($in_where))
            $this->db->where_in('section',$in_where);
		return $this->db->count_all_results($this->_table);
	}
	//列表页
	function getList($limit, $offset, $where=array())
    {
        $in_where = '';
        if(isset($where['title'])) 
        {
            $this->db->like('title',$where['title']);
            unset($where['title']);
        } 
		$this->db->select('id, title, content, section, add_time, keyword,attention ')->from($this->_table);
        if(isset($where['section']))
        {
            $in_where = $where['section'];
            unset($where['section']);
        }
		($where) ? $this->db->where($where) : '';
        ($in_where) ? $this->db->where_in('section',$in_where) : '';
		$this->db->order_by("id DESC");
		$this->db->limit($limit, $offset);
        //echo $this->db->last_query();
		return $this->db->get()->result_array();
	}
	function insertNew($data)
	{
		$this->db->insert($this->_table, $data); 
		return $this->db->affected_rows();
	}

	function update($original_id, $data=array())
	{
		$this->db->where('id', $original_id)->update($this->_table, $data);
		return $this->db->affected_rows();
	}
	
	function del($original_id)
	{
		$this->db->where('id', $original_id)->limit("1")->delete($this->_table);
		return $this->db->affected_rows();
	}

	
	
}
