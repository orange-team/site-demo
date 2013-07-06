<?php
class LangClass extends CI_Controller
{
    function set_lang() 
	{
		$my_lang = $this->uri->segment(1);
		if ($my_lang=='cn' || $my_lang=='en')
		{
				$this->config->set_item('language', $my_lang);
				$this->config->set_item('post_lang', '_'.$my_lang);
		}
		$this->load->helper('language');
    }
}
?>