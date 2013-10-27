<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* description: 妈妈学栏目首页
* author: zg
* date: 2013-07-28
*/
 
class Mmxue extends LB_Controller 
{
    var $_table = 'a_specpage';
    //专栏封面图片路径
    var $spec_path = '/';
    var $data = array();
    //时间轴每页显示的周数
    var $limit_num = 3;

	public function __construct()
	{
		parent::__construct();
		$this->lang->load('common');
        $this->load->model('specpage_model','spec');
        $this->load->model('wiki_model','wiki');
        $this->output->set_header("Content-Type: text/html; charset=utf-8");
	}

	public function index()
	{
        /* 页面初始化 */
        $this->_init();
        //6张图区域
        $this->data['specArr'] = $this->get_cover();
        //育儿百科--字母检索
        //定义默认显示A相关wiki_key
        $this->data['showKey'] = 'F';
        $this->data['A_Z'] = range('A', 'Z');
        $this->data['keyArr'] = $this->wiki->get_wiki_key($this->data['A_Z'], 12);
        //得到时间轴文章
        $this->data['timelineArr'] = $this->get_timeline();
        //print_r($this->data['timelineArr'] );
        $this->data['panelArr'] = $this->get_panel();
        //print_r($this->data['panelArr']);
        $this->data['isRed'] = 1;
		$this->load->view('mmxue', $this->data);
	}

    private function _init()
    {
        $this->data['seo'] = array('title'=>'妈妈学首页',
                'description'=>'妈妈学首页的描述页面信息',
                'keywords'=>'妈妈学,母婴知识,宝宝健康'
                );
        //要载入的css, js文件
        $this->data['file'] = array('js'=>'mmxue','css'=>'mmxue');	
    }

    //得到时间轴文章
    private function get_timeline()
    {
        //初始化数组
        $articleArr = $timelineArr = array();
        $this->db->select('id')->from('a_timeline')->where('section >=',2)->where('section <=',4);
        $timelineArr = $this->db->get()->result_array();
        foreach( $timelineArr as $k=>$v )
        {
            //limit 6 是因为页面上只有6个可显示
            $this->db->select('id, title, keyword')->from('a_article')->where('timeline',$v['id'])->order_by('timeline')->limit($this->limit_num);
            $tmpArr = array();
            $tmpArr = $this->db->get()->result_array();
            //var_dump($tmpArr, count($tmpArr));
            if(is_array($tmpArr) && 0<count($tmpArr))
            {
                foreach( $tmpArr as $kv=>$tv )
                {
                    $tmpArr[$kv]['keywordName'] = array_pop($this->get_keyword((int)$tv['keyword']));
                }
                $articleArr[$v['id']] = $tmpArr;
            }
        }
        unset($timelineArr, $tmpArr);
        return $articleArr;
    }

    //得到各分类的文章
    private function get_panel()
    {
        //初始化数组
        $panel_article = array();
        //echo '<pre>';
        //得到妈妈学栏目
        $this->db->select('id, name')->where('name <>','')->limit(5);
        $section = $this->db->get('a_section')->result_array();
        foreach( $section as $key=>$val )
        {
            $this->db->select('id, title')->from('a_article')->where('section =',$val['id'])->limit(3);
            $panel_article[$val['id']] = $this->db->get()->result_array();
        }
        unset($key, $val, $section);
        //print_r($panel_article);
        return $panel_article;
    }

    //得到关键词
    private function get_keyword($id)
    {
        $this->db->select('name')->from('a_keyword')->where('id', $id);
        return $this->db->get()->row_array();
    }

    //得到前6张专栏图片
	private function get_cover()
    {
		$this->db->select('id, title, cover')->from($this->_table)->where('cover !=','')->limit(6);
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

    //处理前备份了数据库
    public function cut_wiki()
    {
        set_time_limit(0);
		//$this->db->select('id, wiki_content')->from('a_wiki')->where('wiki_content !=','')->where('id',607)->limit(2);
		$this->db->select('id, wiki_content')->from('a_wiki')->where('wiki_content !=','')->limit(3,0);
		//$this->db->select('id, wiki_content')->from('a_wiki')->where('wiki_content !=','')->limit(9999,2);
        $wikiArr = $this->db->get()->result_array();
        //print_r($spellArr);
        foreach($wikiArr as $k=>$v)
        {
            $data = array();
            //$pos = mb_strpos($v['wiki_content'], '<div class="askArea">',1);
            //var_dump($pos);exit;
            //$v['wiki_content'] = mb_substr($v['wiki_content'], 0, $pos);
            //$v['wiki_content'] = $v['wiki_content'].'</div>';
            //http://www.yaolan.com/zhishi/buruqi/
            //$v['wiki_content'] = str_replace('http://www.yaolan.com/zhishi/','/wiki/index/',$v['wiki_content']);
            $v['wiki_content'] = preg_replace('#<div class="key_rrs">.*?</div>#is','',$v['wiki_content']);
            //$v['wiki_content'] = preg_replace('#<h1 class="title yahei">.*?</h1>#is','',$v['wiki_content']);
            $data = array('wiki_content'=>$v['wiki_content']);
            $this->db->where('id', $v['id'])->update('a_wiki', $data);
            var_dump($v['id']);
            //var_dump($v['wiki_content']);
        }
    }


}
