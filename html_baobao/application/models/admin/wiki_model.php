<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台--关键词模型
* author: Liangxifeng
* date: 2013-07-04
*/
 
class wiki_model extends CI_Model
{
	var $_table = 'a_wiki';
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
        if(isset($where['wiki_keyword'])) 
        {
            $this->db->like('wiki_keyword',$where['wiki_keyword']);
            unset($where['wiki_keyword']);
        } 
        $this->db->where($where);
		return $this->db->count_all_results($this->_table);
	}
	//列表页
	function getList($limit, $offset, $where=array())
    {
        if(isset($where['wiki_keyword'])) 
        {
            $this->db->like('wiki_keyword',$where['wiki_keyword']);
            unset($where['wiki_keyword']);
        } 
		$this->db->select('id, tag_id,wiki_keyword')->from($this->_table);
		($where) ? $this->db->where($where) : '';
		$this->db->order_by("id DESC");
		$this->db->limit($limit, $offset);
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
