<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台--栏目model
* author: Liangxifeng
* date: 2013-06-25
*/
 
class section_model extends MY_Model
{
	var $_table = 'a_section';
	function __construct()
	{
		parent::__construct();
	}

	function getBy_parent($id)
	{
		$this->db->select('*')->from($this->_table)->where('parent', (int)$id);
		$arr = $this->db->get()->result_array();
		return $arr;
	}

    //获取单条记录
    function get_one($where=array())
    {
		$this->db->select('*')->from($this->_table)->where($where)->limit(1);
		$arr = $this->db->get()->row_array();
		return $arr;
    }

    //所有记录
    function getTotal()
    {
        $this->db->select('*')->where('name <>','');
        return $this->db->get($this->_table)->result_array();
    }

	
}
