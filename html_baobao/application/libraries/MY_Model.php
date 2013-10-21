<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @desc:数据层基类，提供基本的CRUD操作
 * @author:zg
 * @date:2013/10/21
 */

class MY_Model extends CI_Model
{
	//表名
	protected $_table;
	//主键
	protected $primary_key = 'id';
	
	public function __construct()
	{
		parent::__construct();
	}
	
	//一条记录
	public function getOne($primary_value)
	{
		$sql = $this->db->where($this->primary_key, $primary_value)
					->get($this->_table);
				
		return ($sql->num_rows() > 0) ? $sql->row() : false;
	}
	
    //所有记录
	public function getTotal()
	{
		return $this->db->get($this->_table)->result();
	}
	
    //新增
    public function insert($data)
	{
		return ($this->db->insert($this->_table, $data)) ? $this->db->insert_id() : false;
	}
	
    //修改
    public function update($primary_value, $data)
	{
		return ($this->db->update($this->_table, $data, array($this->primary_key => $primary_value)));
	}
	
	//删除
	public function del($primary_value)
	{
		return ($this->db->delete($this->_table, array($this->primary_key => $primary_value))) ? true : false;
	}
	
    //总条数
	function getTotalNum($where=array())
	{
		return $this->db->count_all($this->_table);
	}

}
