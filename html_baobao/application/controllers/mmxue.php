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
        //$sectionArticleArr = array();
        //$sectionArticleArr = $this->get_section_article(4);
        //得到时间轴文章
        $this->data['timelineArr'] = $this->get_timeline();
		$this->load->view('mmxue', $this->data);
	}

    //得到时间轴文章
    private function get_timeline()
    {
        //初始化数组
        $articleArr = $timelineArr = array();
        $this->db->select('id')->from('a_timeline')->where('time_bucket >=',1)->where('time_bucket <=',6);
        $timelineArr = $this->db->get()->result_array();
        foreach( $timelineArr as $k=>$v )
        {
            //limit 6 是因为页面上只有6个可显示
            $this->db->select('id, title, keyword')->from('a_article')->where('timeline_id',$v['id'])->order_by('timeline_id')->limit($this->limit_num);
            $tmpArr = array();
            $tmpArr = $this->db->get()->result_array();
            //var_dump($tmpArr, count($tmpArr));
            foreach( $tmpArr as $kv=>$tv )
            {
                $tmpArr[$kv]['keywordName'] = array_pop($this->get_keyword((int)$tv['keyword']));
            }
            $articleArr[$v['id']] = $tmpArr;
        }
        unset($timelineArr, $tmpArr);
        return $articleArr;
    }

    //得到各分类的文章
    public function get_panel()
    {
        //初始化数组
        $articleArr = $timelineArr = array();
        $tab = array('备孕期', '怀孕期', '分娩期', '0-1岁', '1-3岁', '3-6岁');
        echo '<pre>';
        foreach( $tab as $key=>$val )
        {
            /*
            $query = $this->db->get_where('a_section', array('name' => $val), 1);
            $arr = $query->result();
            print_r($arr);continue;
            */
            $this->db->select('id')->from('a_section')->where('name',$val)->limit(1);
            $section = $this->db->get()->row_array();
            print_r($section);
            if( 0 < count($section) )
            {
                //得到所有子id
                $this->db->select('id')->from('a_section')->where('parent',$section['id']);
                $tmpArr = array();
                $sub_ids = $this->db->get()->result_array();
                foreach( $sub_ids as $sv )
                {
                    $sub_ids_new[] = $sv['id'];
                }
                //echo 'sub_ids';
                //print_r($sub_ids_new);
                if( is_array($sub_ids_new) && 0 < count($sub_ids_new) )
                {
                    $this->db->select('id, title')->from('a_article')->where_in('section',$sub_ids_new)->limit(3);
                    $article = $this->db->get()->result_array();
                    print_r($article);
                }
            }
            continue;
            $this->db->select('id, title, keyword')->from('a_article')->where('timeline_id',$v['id'])->order_by('timeline_id')->limit($this->limit_num);
            $tmpArr = array();
            $tmpArr = $this->db->get()->result_array();
            //var_dump($tmpArr, count($tmpArr));
            foreach( $tmpArr as $kv=>$tv )
            {
                $tmpArr[$kv]['keywordName'] = array_pop($this->get_keyword((int)$tv['keyword']));
            }
            $articleArr[$v['id']] = $tmpArr;
        }
        unset($timelineArr, $tmpArr);
        return $articleArr;
    }

    //得到关键词
    private function get_keyword($id)
    {
        $this->db->select('name')->from('a_keyword')->where('id', $id);
        return $this->db->get()->row_array();
    }

    private function get_sub_section($parent_id)
    {
        //limit 6 是因为页面上只有6个可显示
		$this->db->select('id, name')->from($this->_table)->where('parent',1)->limit(6);
		return $this->db->get()->result_array();
    }

    //得到前6张专栏图片
	private function get_cover()
    {
		$this->db->select('id, title, cover')->from($this->_table)->where('cover !=','')->limit(6);
		return $this->db->get()->result_array();
	}

    //响应ajax请求
    public function get_ajax_article($section_id)
    {
        $articleArr = $this->get_section_article($section_id);
        print_r($articleArr);
        echo json_encode($articleArr);
    }

    //得到分娩等栏目的文章
	private function get_section_article($section_id)
    {
        $sectionArr = array('分娩'=>4);
		$this->db->select('id, title')->from('a_keyword')->where('section',4)->limit(6);
		return $this->db->get()->result_array();
		$this->db->select('id, name')->from('a_keyword')->where('section',4)->limit(6);
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
		$this->db->select('id, wiki_content')->from('a_wiki')->where('wiki_content !=','')->limit(9999,2);
        $wikiArr = $this->db->get()->result_array();
        //print_r($spellArr);
        foreach($wikiArr as $k=>$v)
        {
            $data = array();
            //$pos = mb_strpos($v['wiki_content'], '<div class="askArea">',1);
            //var_dump($pos);exit;
            //$v['wiki_content'] = mb_substr($v['wiki_content'], 0, $pos);
            $v['wiki_content'] = $v['wiki_content'].'</div>';
            $data = array('wiki_content'=>$v['wiki_content']);
            //$this->db->where('id', $v['id'])->update('a_wiki', $data);
            var_dump($v['id']);
            //var_dump($v['wiki_content']);
        }
    }


}
