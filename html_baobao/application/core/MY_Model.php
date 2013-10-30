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

    //通过主键，得到某一字段数据
	function getFieldById($id, $field)
	{
		$this->db->select($field)->where($this->primary_key, (int)$id);
		$arr = $this->db->get($this->_table)->row_array();
        return empty($arr[$field])?'':$arr[$field];
    }

	//一条记录
	public function getOne($id)
	{
		$query = $this->db->where($this->primary_key, $id)
					->get($this->_table);
		return ($query->num_rows() > 0) ? $query->row() : false;
	}
	
    //列表
	function getList($where=array(), $limit=0, $offset=0, $order='')
    {
		if(!empty($where))$this->db->where($where);
		if(!empty($order))$this->db->order_by($order);
        $this->db->limit($limit, 0);
		return $this->db->get($this->_table)->result_array();
	}

    //所有记录
	public function getTotal()
	{
		return $this->db->get($this->_table)->result();
	}
	
    //总条数
	public function getTotalNum($where=array())
	{
		return $this->db->count_all($this->_table);
	}

    //新增
    public function insert($data)
	{
		return ($this->db->insert($this->_table, $data)) ? $this->db->insert_id() : false;
	}
	
    //修改
    public function update($id, $data)
	{
		return ($this->db->update($this->_table, $data, array($this->primary_key => $id))) ? true : false;
	}
	
	//删除
	public function del($id)
	{
		return ($this->db->delete($this->_table, array($this->primary_key => $id))) ? true : false;
	}
	
}
