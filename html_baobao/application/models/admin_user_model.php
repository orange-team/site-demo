<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_user_model extends CI_Model
{
	private $_table='admin_user';
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function chk($uname, $passwd)
	{
		$sql = 'SELECT user_id, user_right FROM admin_user WHERE user_name='.$this->db->escape($uname).' AND user_passwd='.$this->db->escape(md5($passwd));
		$res = $this->db->query($sql);
		$arr = $res->row_array();
		return empty($arr) ? 0 : $arr;
	}

    function add($data)
    {
        $this->db->insert($this->_table,$data);
        return 1;
    }
	
	function edit($user_id, $data)
	{
		$this->db->where('user_id', (int)$user_id)->update($this->_table, $data);
		return 1;
	}

    function del($user_id)
    {
        $this->db->where('user_id', (int)$user_id)->delete($this->_table); 
        return 1; 
    }
	
	function get($user_id)
	{
		$this->db->select('user_id, user_name, user_realname, user_right')->from($this->_table);
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
