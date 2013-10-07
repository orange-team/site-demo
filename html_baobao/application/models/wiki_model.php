<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台--百科模型
* author: zg
* date: 2013-07-28
*/
 
class wiki_model extends CI_Model
{
	var $_table = 'a_wiki';
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
	function getList($where=array(),$order="",$limit=20)
    {
		if(!empty($where))$this->db->where($where);
		if(!empty($order))$this->db->order_by($order);
        $this->db->limit($limit, 0);
		$res = $this->db->get($this->_table)->result_array();
        return $res;
	}

	function insertNew($data)
	{
		$this->db->insert($this->_table, $data); 
		return $this->db->insert_id();
	}

    //为百科根新封面图片路径
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

    //育儿百科--字母检索标签
    function get_wiki_key($A_Z, $limit=null)
    {
        $keyArr = array();
        foreach( $A_Z as $k=>$v )
        {
            $this->db->select('id, wiki_key')->from($this->_table)->where('wiki_spell',$v);
            if(null!=$limit) $this->db->limit($limit);
            $keyArr[$v] = $this->db->get()->result_array();
        }
        return $keyArr;
    }

	
}
