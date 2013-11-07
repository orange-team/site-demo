<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台--标签关系模型
* author: zg
* date: 2013-07-04
*/
 
class Relation_tag_model extends CI_Model
{
	var $_table = 'a_relation_tag';
	function __construct()
	{
		parent::__construct();
	}

	function get($data,$limit=0)
	{
		$this->db->select('tag_id')->from($this->_table)->where($data);
        if(0 != $limit)
        {
            $this->db->limit($limit);
        }
		return $this->db->get()->result_array();
    }

	function getBy_name($name)
    {
        $this->db->select('id,name')->from($this->_table)->like('name', $name)->limit(30);
        return $this->db->get()->result_array();
    }
	
}
