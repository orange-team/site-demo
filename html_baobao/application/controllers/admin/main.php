<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 后台首页
* author: Liangxifeng
* date: 2013-06-22
*/

class Main extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
	}
    /**
    +----------------------------------------------------------
    * 加载后台首页
    +----------------------------------------------------------
    */
	function index()
	{
		//$this->rebuild_tree();
		//$this->load->view('admin/mainFrame', $this->data);
		$this->load->view('admin/index/index.html');
	}
	/**
    +----------------------------------------------------------
    * 后台头部框架
    +----------------------------------------------------------
    */
	function topframe()
	{
		//$this->load->view('admin/mainTop', $this->data);
		$this->load->view('admin/index/topframe.html');
	}
	/**
    +----------------------------------------------------------
    * 后台左侧导航框架
    +----------------------------------------------------------
    */
	function leftframe()
	{
		//$this->load->view('admin/mainLeft', $this->data);
        $this->load->library('session'); 
        $user=$this->session->all_userdata(); 
		$this->load->view('admin/index/leftframe.html', $user);
	}
	/**
    +----------------------------------------------------------
    * 后台显示/隐藏左侧导航框架
    +----------------------------------------------------------
    */
	public function switchframe()
	{
		$this->load->view('admin/index/switchframe.html');
	}
	/**
    +----------------------------------------------------------
    * 后台管理导航区域框架
    +----------------------------------------------------------
    */
    function mainframe()
    {
		$this->load->view('admin/index/mainframe.html');
    }
	/**
    +----------------------------------------------------------
    * 后台默认内容页框架
    +----------------------------------------------------------
    */
	function manframe()
	{
		$this->load->view('admin/index/manframe.html');
	}
	/**
    +----------------------------------------------------------
    * 后台底部框架
    +----------------------------------------------------------
    */
	function bottomframe()
	{
		$this->load->view('admin/index/bottomframe.html');
	}
	
	//先根遍历菜单树
	private function rebuild_tree($menu_fid=1, $left=1)
	{ 
        $right = $left+1; 
        $res = $this->db->query("SELECT menu_id FROM menu_cn WHERE menu_fid='$menu_fid'"); 
		$arr = $res->result_array();
        foreach ( $arr as $row ) 
		{ 
            $right = $this->rebuild_tree($row['menu_id'], $right); 
        }
        $this->db->query("UPDATE menu_cn SET lft='$left', rgt='$right' WHERE menu_id='$menu_fid'"); 
        return $right+1; 
	} 
	
	/**
	 * @param $root_id 需要显示的树/子树根节点 id。
	 */
	function show_tree($root_id = 1)
	{
		while ($row = mysql_fetch_array($result)) {
			if (count($stack)>0) { //仅当堆栈非空的时候检测
				// 如果当前节点右边的值比堆栈最上边的值大，则移除堆栈最上边的值，因为这个值对应的节点不是当前节点的父节点
				while ($row['rgt'] > $stack[count($stack)-1]) {
					array_pop($stack);
				} //while 循环结束之后，堆栈里边只剩下当前节点的父节点了
			}
			// 现在可以显示缩进了
			echo '<div style="margin-left:'.(count($stack)*12).'px">'.$row['menu_name'].'</div>';
			// 将当前的节点压入堆栈里边，为循环后边的节点缩进显示做好准备
			array_push($stack, $row['rgt']);
		}
	}
	
	
}
