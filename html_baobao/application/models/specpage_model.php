<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台--专栏模型
* author: zg
* date: 2013-07-28
*/
 
class Specpage_model extends MY_Model
{
	var $_table = 'a_specpage';

	function __construct()
	{
		parent::__construct();
	}

	function getBy_ids($ids)
	{
		$this->db->select('id,name')->from($this->_table)->where_in('id', $ids);
		return $this->db->get()->result_array();
    }

    //为专栏根新封面图片路径
    function update_cover($id, $data)
    {
        $this->db->where('id', $id)->update($this->_table, $data);
        return $this->db->affected_rows();
    }

	function getBy_name($name,$not_in_ids=array())
    {
        $this->db->select('id,name')->from($this->_table)->where_not_in('id',$not_in_ids)->like('name', $name)->limit(30);
        return $this->db->get()->result_array();
    }
	
}
