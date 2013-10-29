<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_user_model extends MY_Model
{
	private $_table='admin_user';

	function __construct()
	{
		parent::__construct();
	}
	
	function chk($uname, $passwd)
	{
		$sql = 'SELECT user_id, user_right FROM admin_user WHERE user_name='.$this->db->escape($uname).' AND user_passwd='.$this->db->escape(md5($passwd));
		$res = $this->db->query($sql);
		$arr = $res->row_array();
		return empty($arr) ? 0 : $arr;
	}

	
}
