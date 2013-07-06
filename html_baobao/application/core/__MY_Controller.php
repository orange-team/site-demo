<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//自定义基类
class MY_Controller extends CI_Controller
{
	protected $data=array();

    public function __construct()
    {
        parent::__construct();
		$this->get_menu_arr();
		$this->lang->load('common');
		$this->lang->load('index');
		//每页个数
		$this->data['pagesize'] = 5;
    }
	
	private function get_menu_arr()
	{
		//后台菜单
		if( $this->uri->segment(1)=='admin' )
		{
			$this->load->model('admin/menu_model', 'menu');
			$this->db->select('menu_href')->from('menu_cn')->where('menu_fid',0)->limit(1);
			$numOld = $this->db->get()->row_array();
			$this->db->select('count(*) as num')->from('menu_cn');
			$numNow = array_pop($this->db->get()->row_array());
			//如果menu_href>'22'，重新遍历菜单树
			if( $numNow>(int)$numOld['menu_href'] ) 
			{
				$this->menu->rebuild_tree();
				$this->db->where('menu_id',1)->update('menu_cn', array('menu_href'=>$numNow));
			}
			$this->data['menuArr'] = $this->menu->getlist();
			return ;
		}
		//前台菜单
		$this->db->select("*")->from("menu_cn")->where("menu_fid",1)->where('menu_href !=','');
		$query = $this->db->get();
		foreach($query->result_array() as $val)
		{
			if($val['menu_fid']==0)continue;
			$this->data['info'][] = $val;
			$this->db->select("*")->from("menu_cn")->where("menu_fid",$val['menu_id'])->where('menu_href !=','');
			$res = $this->db->get();
			foreach($res->result_array() as $vala)
			{
				$this->data['infob'][$val['menu_id']][] = $vala;
			}
		}
	}
	
	//菜单相关
	protected function getData($menu_id)
	{
		// 当前位置 menu_href<>''
		$res1 = $this->db->query("SELECT menu_fid, menu_name FROM menu_cn WHERE menu_id='$menu_id'"); 
		$arr1 = $res1->row_array();
		$res2 = $this->db->query("SELECT menu_name FROM menu_cn WHERE menu_id='".$arr1['menu_fid']."'"); 
		$arr2 = $res2->row_array();
		$this->data['menuNav'][2] = array('id'=>$menu_id, 'name'=>$arr1['menu_name']);
		$this->data['menuNav'][1] = array('id'=>$arr1['menu_fid'], 'name'=>$arr2['menu_name']);
		// 左侧
		$resLeft = $this->db->query("SELECT menu_name, menu_href FROM menu_cn WHERE menu_fid='".$arr1['menu_fid']."'");
		$this->data['arrLeft'] = $resLeft->result_array();
	}
	
	//字符截取
	protected function my_substr($str,$start=0,$len=0)
	{
		mb_internal_encoding('UTF-8');
		$str = mb_substr(strip_tags($str),$start,$len);
		if( mb_strlen($str)>$len ) $str .= '...';
		return $str;
	}

	
}
