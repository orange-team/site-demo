<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 妈妈学栏目首页
* author: zg
* date: 2013-07-28
*/
 
class Mmxue extends MY_Controller 
{
    var $_table = 'a_specpage';
    //专栏封面图片路径
    var $spec_path = '/';
    var $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->lang->load('common');
        $this->load->model('specpage_model','spec');
        $this->load->model('wiki_model','wiki');
	}

	public function index()
	{
        $this->data['seo'] = array('title'=>'妈妈学首页',
                'description'=>'妈妈学首页的描述页面信息',
                'keywords'=>'妈妈学,母婴知识,宝宝健康'
                );
        //要载入的css, js文件
        $this->data['file'] = array('js'=>'mmxue','css'=>'mmxue');
        //6张图区域
        $this->data['specArr'] = $this->get_cover();
        //育儿百科--字母检索
        //定义默认显示A相关wiki_key
        $this->data['showKey'] = 'F';
        $this->data['A_Z'] = range('A', 'Z');
        $this->data['keyArr'] = $this->wiki->get_wiki_key($this->data['A_Z'], 12);
		$this->load->view('mmxue', $this->data);
	}

    //得到前6张专栏图片
	private function get_cover()
    {
		$this->db->select('title, cover')->from($this->_table)->where('cover !=','')->limit(6);
		return $this->db->get()->result_array();
	}
    
    /*
    临时程序，用来处理a_wiki的字段wiki_key，产生对应的拼音字母
    添加字段:
    alter table a_wiki add column wiki_spell char(2) not null comment '百科关键字对应拼音' after wiki_key;
    update  a_wiki set wiki_spell='cc' where tag_id=1056 ;
    给该字段建立索引
    alter table a_wiki add index spell(wiki_spell);
    */
    public function create_spell()
    {
        exit('禁止访问');
        set_time_limit(0);
		$this->db->select('id, href')->from('a_wiki')->where('href !=','');
        $spellArr = $this->db->get()->result_array();
        //print_r($spellArr);
        foreach($spellArr as $k=>$v)
        {
            $data = array();
            $spell = str_replace('http://www.yaolan.com/zhishi/', '', $v['href']);
            if( !empty($spell) )
            {
                $data['wiki_spell'] = strtoupper(substr($spell,0,1));
                $this->db->where('id', $v['id'])->update('a_wiki', $data);
            }
        }
    }

}
