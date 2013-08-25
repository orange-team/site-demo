<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台--关键词模型
* author: Liangxifeng
* date: 2013-07-04
*/
 
class article_model extends CI_Model
{
	var $_table = 'a_article';
	function __construct()
	{
		parent::__construct();
	}

	function getBy_id($art_id)
	{
		$this->db->select('*')->from($this->_table)->where('id', (int)$art_id);
		return $this->db->get()->row_array();
	}

	function getTotal($where=array())
	{
        if($where['title']) 
        {
            $this->db->like('title',$where['title']);
            unset($where['title']);
        } 
        if($where['section'])
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
        if($where['title']) 
        {
            $this->db->like('title',$where['title']);
            unset($where['title']);
        } 
		$this->db->select('id, title, section, add_time, keyword ')->from($this->_table);
        if($where['section'])
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
