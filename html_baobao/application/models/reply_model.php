<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 回复模型
* author: zg
* date: 2013-10-05
*/
 
class reply_model extends CI_Model
{
	var $_table = 'a_comment_reply';

	function __construct()
	{
		parent::__construct();
	}

    //分表规则
    function _get_table($type)
    {
        $replyArr = array(1=>'ask',2=>'article');
        if( isset($replyArr[$type]) )
            $this->_table = $this->_table.'_'.$replyArr[$type];
    }

    //审核全部
    function auditAll()
    {
        $sql = 'update '.$this->_table.' set audit_status=1';
		$this->db->query($sql);
		return $this->db->affected_rows();
    }

    //赞+1
    function praise($reply_id)
	{
        $sql = 'update '.$this->_table.' set recommand=recommand+1 where id='.(int)$reply_id;
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
	
}
