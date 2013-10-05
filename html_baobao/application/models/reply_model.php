<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 回复模型
* author: zg
* date: 2013-10-05
*/
 
class reply_model extends CI_Model
{
	var $_table = 'a_comment_reply';
    //分表
    var $_type = '1';
	function __construct()
	{
		parent::__construct();
	}

    //分表规则
    function _get_table()
    {
        $replyArr = array(1=>'ask',2=>'article');
        if( isset($replyArr[$this->_type]) )
            $this->_table = $this->_table.'_'.$replyArr[$this->_type];
    }

	function getBy_id($id)
	{
        $this->_get_table();
		$this->db->select('*')->from($this->_table)->where('id', $id);
		return $this->db->get()->row_array();
	}

	function getTotal($where=array())
	{
        $this->_get_table();
        if(isset($where['title'])) 
        {
            $this->db->like('title',$where['title']);
            unset($where['title']);
        } 
        if(isset($where['section']) && $where['section'])
        {
            $in_where = $where['section'];
            unset($where['section']);
        }
        $this->db->where($where);
        if(isset($in_where))
            $this->db->where_in('section',$in_where);
		return $this->db->count_all_results($this->_table);
	}

	//列表页
	function getList($limit, $offset, $where=array())
    {
        $this->_get_table();
		$this->db->select('id, content, add_time, user_id')->from($this->_table);
		($where) ? $this->db->where($where) : '';
        if( isset($limit) && !empty($limit) )
		$this->db->limit($limit, $offset);
        //echo $this->db->last_query();
		return $this->db->get()->result_array();
	}

	function insert($data)
	{
        $this->_get_table();
		$this->db->insert($this->_table, $data); 
		return $this->db->affected_rows();
	}

	function update($reply_id, $data=array())
	{
        $this->_get_table();
		$this->db->where('id', $reply_id)->update($this->_table, $data);
		return $this->db->affected_rows();
	}
	
    //赞+1
    function praise($reply_id)
	{
        $sql = 'update '.$this->_table.' set recommand=recommand+1 where id='.(int)$reply_id;
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
	
	function del($reply_id)
	{
        $this->_get_table();
		$this->db->where('id', $reply_id)->limit("1")->delete($this->_table);
		return $this->db->affected_rows();
	}
	
}
