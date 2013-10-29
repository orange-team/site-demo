<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 时间轴模型
* author: zg
* date: 2013/10/20
*/
 
class timeline_model extends CI_Model
{
	var $_table = 'a_timeline';
	function __construct()
	{
		parent::__construct();
	}

    /* replaced by MY_Model->getOne($id)
	function getBy_id($id)
	{
		$this->db->select('*')->from($this->_table)->where('id', $id);
		return $this->db->get()->row_array();
	}
     */

    /* replaced by MY_Model->getTotalNum($where)
	function getTotal($where=array())
	{
        $this->db->where($where);
		return $this->db->count_all_results($this->_table);
	}
     */

    /* replaced by MY_Model->getList(...)
	//列表页
	function getList($limit=0, $offset=0, $where=array())
    {
		$this->db->select('*');
		($where) ? $this->db->where($where) : '';
		$this->db->limit($limit, $offset);
		return $this->db->get($this->_table);
	}
     */

}
