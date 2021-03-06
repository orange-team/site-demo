<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @desc:数据层基类，提供基本的CRUD操作
 * @author:zg
 * @date:2013/11/06
 */

class MY_Model extends CI_Model
{
	//表名
	protected $_table;
	//主键
	protected $_primary_key = 'id';
	
	public function __construct()
	{
		parent::__construct();
	}

    //通过主键，得到某一字段数据
	function getFieldById($id, $field)
	{
		$this->db->select($field)->where($this->_primary_key, (int)$id);
		$arr = $this->db->get($this->_table)->row_array();
        return empty($arr[$field])?'':$arr[$field];
    }

	//通过主键，得到一条记录
	public function getOne($id)
	{
		$query = $this->db->where($this->_primary_key, $id)
					->get($this->_table);
		return ($query->num_rows() > 0) ? $query->row_array() : false;
    }
   	
    //得到符合条件的记录
	public function getTotal($where=array(), $limit=0, $offset=0, $order='',$where_in=array(),$where_like=array())
    {
		if(!empty($where))$this->db->where($where);
		if(!empty($order))$this->db->order_by($order);
        if(intval($limit)) $this->db->limit($limit);
        if(intval($offset)) $this->db->offset($offset);
        if(!empty($where_in)) $this->db->where_in($where_in['field'],$where_in['values']); 
		if(!empty($where_like))$this->db->like($where_like);
		return $this->db->get($this->_table)->result_array();
	}

    //总条数
	public function getTotalNum($where=array(),$where_in=array(),$where_like=array())
	{
		if(!empty($where))$this->db->where($where);
        if(!empty($where_in)) $this->db->where_in($where_in['field'],$where_in['values']); 
		if(!empty($where_like))$this->db->like($where_like);
		return $this->db->count_all_results($this->_table);
	}

    //新增
    public function insert($data)
	{
		return ($this->db->insert($this->_table, $data)) ? $this->db->insert_id() : false;
	}
	
    //修改
    public function update($id, $data)
	{
		return ($this->db->update($this->_table, $data, array($this->_primary_key => $id))) ? true : false;
	}
	
	//删除
	public function del($id)
	{
		return ($this->db->delete($this->_table, array($this->_primary_key => $id))) ? true : false;
	}
	
}
