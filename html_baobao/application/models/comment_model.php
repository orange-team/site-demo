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

    function add_reply_num($id)
    {
        $sql = 'update '.$this->_table.' set reply_num=reply_num+1 where id='.(int)$id;
		$this->db->query($sql);
		return $this->db->affected_rows();
    }

    //审核全部
    function auditAll()
    {
        $sql = 'update '.$this->_table.' set c_status=1';
		$this->db->query($sql);
		return $this->db->affected_rows();
    }

	
}
