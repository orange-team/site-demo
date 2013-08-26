<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台--专栏模型
* author: zg
* date: 2013-07-28
*/
 
class Wiki_model extends CI_Model
{
	var $_table = 'a_wiki';
	function __construct()
	{
		parent::__construct();
	}

	function getBy_id($id)
	{
		$this->db->select('*')->from($this->_table)->where('id', (int)$id);
		return $this->db->get()->row_array();
    }

    //育儿百科--字母检索标签
	function get_wiki_key($A_Z, $limit=null)
    {
        $keyArr = array();
        foreach( $A_Z as $k=>$v )
        {
            $this->db->select('id, wiki_key')->from($this->_table)->where('wiki_spell',$v);
            if(null!=$limit) $this->db->limit($limit);
            $keyArr[$v] = $this->db->get()->result_array();
        }
        return $keyArr;
	}

}
