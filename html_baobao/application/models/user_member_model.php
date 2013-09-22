<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user_member_model extends CI_Model
{
	private $_table='a_user';
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function edit($user_id, $data)
	{
		$this->db->where('user_id', (int)$user_id)->update($this->_table, $data);
		return 1;
	}

	function get($user_id)
	{
		$this->db->select('*')->from($this->_table);
		$this->db->where("user_id",(int)$user_id);
		//$this->db->limit($limit, $offset);
		return $this->db->get()->row_array();
	}
	
	//列表页
	function getList()
	{
		$this->db->select('user_id, user_name, user_realname, user_add_time')->from($this->_table);
		$this->db->order_by("user_id DESC");
		//$this->db->limit($limit, $offset);
		return $this->db->get()->result_array();
	}
}
