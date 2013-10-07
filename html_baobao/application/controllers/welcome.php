<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->lang->load('common');
		$this->lang->load('index');
	}
	public function index()
	{
        $daytime = "2013-8-04 12:12:30";
        $hourM = date("H:i",strtotime($daytime));
        $day = explode(" ",$daytime);
        $result = "";
        $dateArr = array("今天","昨天","前天");
        $dateNum = (strtotime(date("Y-m-d",time()))-strtotime($day[0]))/86400; 
        if(array_key_exists($dateNum,$dateArr))
        {
            $result = $dateArr[$dateNum]." ".$hourM;
        }else if($dateNum<=30)
        {
            $result = $dateNum."天前 ".$hourM;
        }else
        {
            $result = $daytime;
        }
        echo $result;

	}

}
