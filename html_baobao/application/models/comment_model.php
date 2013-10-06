<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 评论模型
* author: zg
* date: 2013-10-04
*/
 
class comment_model extends CI_Model
{
	var $_table = 'a_comment';
	function __construct()
	{
		parent::__construct();
	}

    //分表规则
    function _get_table($type)
    {
        $commentArr = array(1=>'ask',2=>'article');
        if( isset($commentArr[$type]) )
            $this->_table = $this->_table.'_'.$commentArr[$type];
    }

	function getBy_id($id)
	{
		$this->db->select('*')->from($this->_table)->where('id', $id);
		return $this->db->get()->row_array();
	}

	function getTotal($where=array())
	{
        $this->db->where($where);
		return $this->db->count_all_results($this->_table);
	}
	//列表页
	function getList($limit, $offset, $where=array())
    {
		$this->db->select('id, user_id, content, add_time, reply_num')->from($this->_table);
		($where) ? $this->db->where($where) : '';
		$this->db->limit($limit, $offset);
        //echo $this->db->last_query();
		return $this->db->get()->result_array();
	}

    function add_reply_num($id)
    {
        $sql = 'update '.$this->_table.' set reply_num=reply_num+1 where id='.(int)$id;
		$this->db->query($sql);
		return $this->db->affected_rows();
    }

	function insert($data)
	{
		$this->db->insert($this->_table, $data); 
		return $this->db->affected_rows();
	}

    //审核全部
    function auditAll()
    {
        $sql = 'update '.$this->_table.' set c_status=1';
		$this->db->query($sql);
		return $this->db->affected_rows();
    }

    //更新一条
	function update($comment_id, $data=array())
	{
		$this->db->where('id', $comment_id)->update($this->_table, $data);
		return $this->db->affected_rows();
	}
	
	function del($comment_id)
	{
		$this->db->where('id', $comment_id)->limit("1")->delete($this->_table);
		return $this->db->affected_rows();
	}
	
}
