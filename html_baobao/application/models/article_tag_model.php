<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台--关键词模型
* author: Liangxifeng
* date: 2013-07-04
*/
 
class article_tag_model extends MY_Model
{
	var $_table = 'a_article_tag';
	function __construct()
	{
		parent::__construct();
	}

	function get_one($where=array())
	{
		$this->db->select('*')->from($this->_table)->where($where);
		return $this->db->get()->row_array();
	}

	
}
