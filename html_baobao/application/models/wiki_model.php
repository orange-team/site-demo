<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台--百科模型
* author: zg
* date: 2013-07-28
*/
 
class wiki_model extends MY_Model
{
	var $_table = 'a_wiki';

	function __construct()
	{
		parent::__construct();
	}

	function getBy_ids($ids)
	{
		$this->db->select('id,name')->from($this->_table)->where_in('id', $ids);
		return $this->db->get()->result_array();
    }

    function getBy_name($name,$not_in_ids=array())
    {
        $this->db->select('id,name')->from($this->_table)->where_not_in('id',$not_in_ids)->like('name', $name)->limit(30);
        return $this->db->get()->result_array();
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

    //为百科根新封面图片路径
    function update_cover($id, $data)
    {
        $this->db->where('id', $id)->update($this->_table, $data);
        return $this->db->affected_rows();
    }
    
		
}
