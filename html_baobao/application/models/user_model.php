<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 评论模型
* author: zg
* date: 2013-10-04
*/
 
class user_model extends MY_Model
{
	var $_table='a_user';
    var $primary_key='user_id';
	function __construct()
	{
		parent::__construct();
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
