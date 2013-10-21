<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @desc:���ݲ���࣬�ṩ������CRUD����
 * @author:zg
 * @date:2013/10/21
 */

class MY_Model extends CI_Model
{
	//����
	protected $_table;
	//����
	protected $primary_key = 'id';
	
	public function __construct()
	{
		parent::__construct();
	}
	
	//һ����¼
	public function getOne($primary_value)
	{
		$sql = $this->db->where($this->primary_key, $primary_value)
					->get($this->_table);
				
		return ($sql->num_rows() > 0) ? $sql->row() : false;
	}
	
    //���м�¼
	public function getTotal()
	{
		return $this->db->get($this->_table)->result();
	}
	
    //����
    public function insert($data)
	{
		return ($this->db->insert($this->_table, $data)) ? $this->db->insert_id() : false;
	}
	
    //�޸�
    public function update($primary_value, $data)
	{
		return ($this->db->update($this->_table, $data, array($this->primary_key => $primary_value)));
	}
	
	//ɾ��
	public function del($primary_value)
	{
		return ($this->db->delete($this->_table, array($this->primary_key => $primary_value))) ? true : false;
	}
	
    //������
	function getTotalNum($where=array())
	{
		return $this->db->count_all($this->_table);
	}

}
