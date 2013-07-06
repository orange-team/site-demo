<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->lang->load('common');
		$this->lang->load('index');
		$this->load->model("index_model","ide");
	}
	public function index()
	{
		$this->load->view('index_htm');
	}

	public function index_two()
	{
		$this->load->view('index_two');
	}

	public function index_tmp()
	{
		//企业概况
		$com_info = $this->ide->get_company(10);
		$this->data['com_info'] = $com_info['content'];
		//$this->data['com_info'] = mb_substr($com_info['content'],0,2014,"utf-8")."......</b></span></p>";
		$this->data['com_info'] = strip_tags($this->data['com_info'],"<br>");
		$this->data['com_info'] = str_replace("<br />","<br />&nbsp;&nbsp;&nbsp;",$this->data['com_info']);
		$this->data['com_info'] = "&nbsp;&nbsp;&nbsp;".mb_substr($this->data['com_info'],0,780,"utf-8")."......<br /><br />";
		//董事长头像
		$bs = $this->ide->get_boss();
		$this->data['boss'] = $bs->row_array();
		//关于我们
		$href = array("/feed/showlist/30","/topic/detail/1","/question/lista/1");
		$left = $this->ide->get_leftmenu();
		$i = 0;
		foreach($left->result_array() as $val)
		{
			$val['menu_href'] = $href[$i];
			$this->data['left'][] = $val;
			$i++;
		}
		//资质证书
		$hon = $this->ide->get_honour();
		$honour = $hon->row_array();
		$this->data['honour'] = $honour;
		//友情链接
		$links = $this->ide->get_links();
		foreach($links->result_array() as $val)
		{
			$this->data['links'][] = $val;
		}
		//品牌优势
		$gn = $this->ide->get_goodness();
		foreach( $gn->row_array() AS $k=>$v )
		{
			$this->data['goodness'][$k] = explode('@', $v);
		}
		//产品
		$pro = $this->ide->get_product();
		foreach($pro->result_array() as $val)
		{
			$img = $this->ide->get_proimg($val['pro_id']);
			$image = $img->row_array();
			$val['img'] = $image['img_burl'];
			$this->data['product'][] = $val;
		}
		$this->load->view('header', $this->data);
		$this->load->view('index_new2');
		$this->load->view('footer');
	}
	public function index_search()
	{
		if(1==intval($_POST['cate']))header("location:/product/search_list/16/1/".$_POST['key']);
		if(2==intval($_POST['cate']))header("location:/article/searchlist/18/18/".$_POST['key']);
	}
	public function index_new()
	{
		$this->load->view('header', $this->data);
		$this->load->view('index');
		$this->load->view('footer');
	}

}
