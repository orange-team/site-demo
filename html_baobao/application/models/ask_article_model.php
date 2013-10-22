<?php
/*************************************************************************
> File Name: ask_article_model.php
> Author: arkulo
> Mail: arkulo@163.com 
*************************************************************************/

class ask_article_model extends MY_Model
{
	const TBL_ASK = 'a_ask_article';
	const TBL_ASK_TAG = 'a_ask_tag';

    public function __construct()
    {
        $this->_table = self::TBL_ASK;
        parent::__construct();
    }

    public function getOne($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('a_ask_article');
        return $query->row_array();
    }

    //关联标签
    public function getTag($id)
    {
        $this->_table = self::TBL_ASK_TAG;
        $this->db->select('tag_id')
            ->where(array('target_id'=>$id,'status_tag'=>1));
        $res = $this->db->get($this->_table)->result();
        $resNew = array();
        $this->load->model('tag_model','tag');
        foreach($res as $key=>$val)
        {
            $resNew[] = $this->tag->getOne($val->tag_id)->name;
        }
        return $resNew;
    }

    public function get($where=array(),$order='',$limit=20)
    {
        $this->db->where($where);
        $this->db->order_by($order);
        $this->db->limit($limit);
        $query = $this->db->get('a_ask_article');
        return $query->result_array();
    }

    //列表页
	function getList($limit=0, $offset=0, $where=array())
    {
        if(isset($where['title']) && !empty($where['title'])) 
        {
            $this->db->like('title',$where['title']);
            unset($where['title']);
        } 
		$this->db->select('*');
		($where) ? $this->db->where($where) : '';
		$this->db->order_by("id DESC");
        if($limit != 0 || $offset != 0)
            $this->db->limit($limit, $offset);
		return $this->db->get(self::TBL_ASK);
	}

    //总条数
    function getTotal($where=array())
	{
        $this->db->where($where);
		return $this->db->count_all_results(self::TBL_ASK);
	}
}

