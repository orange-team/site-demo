<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 时间轴模型
* author: zg
* date: 2013/10/20
*/
 
class timeline_model extends MY_Model
{
	var $_table = 'a_timeline';

	function __construct()
	{
		parent::__construct();
	}
}
