<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台--关键词模型
* author: Liangxifeng
* date: 2013-07-04
*/
 
class article_model extends MY_Model
{
	var $_table = 'a_article';
	function __construct()
	{
		parent::__construct();
	}

	function getByorder_id($where,$order='id ASC')
	{
		$this->db->select('id,title')->from($this->_table)->where($where);
		$this->db->order_by($order);
		return $this->db->get()->row_array();
	}

}
