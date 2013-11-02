<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user_model extends CI_Model
{
	private $_table='a_user';
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    //验证email
    function chk($email,$passwd)
    {
		$this->db->select('user_id, user_nickname')->from($this->_table)->where(array('user_email'=>$email,'user_passwd'=>$passwd));
		return $this->db->get()->row_array();
    }
    
    function chk_email($email)
    {
		$this->db->select('user_id, user_nickname, user_passwd')->from($this->_table)->where('user_email',$email);
		return $this->db->get()->row_array();
    }

    function chk_name($name)
	{
		$query = $this->db->get_where($this->_table,array('user_nickname' => $name));
        if ($row = $query->row_array()){
            return true;
        }
        return false;
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
	

}
