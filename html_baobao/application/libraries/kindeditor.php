<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kindeditor {
        var $id = '';
        var $name = '';
        var $value = '';
        var $className = '';
        var $height = '300px';
        var $minWidth = '474px';
        function __construct($params = array()) {
                $this->initialize ( $params );
        }
        
        public function initialize($params = array()) {
                if (count ( $params ) > 0) {
                        foreach ( $params as $key => $val ) {
                                if (isset ( $this->$key )) {
                                        $this->$key = $val;
                                }
                        }
                }
        }
        
        public function getEditor() {
                $sd = '<textarea id="'.$this->id.'" name="'.$this->id.'" style="width:700px;height:350px; visibility:hidden;display:none;">'.$this->value.'</textarea>';
                $sd .= '<link rel="stylesheet" href="'.base_url().'adminStatic/editor/themes/default/default.css" />';
                $sd .= '<script charset="utf-8" src="'.base_url().'adminStatic/editor/kindeditor.js"></script>';
                $sd .= '<script charset="utf-8" src="'.base_url().'adminStatic/editor/lang/zh_CN.js"></script>';
                $sd .= '<script type="text/javascript">';
                $sd .= 'var editor;';
                $sd .= 'KindEditor.ready(function(K) {';
                $sd .= "editor = K.create('textarea[name=\"{$this->id}\"]', {
					resizeType : 1,
					allowPreviewEmoticons : true,
					allowImageUpload : true
				})";
                $sd .= '});';
                $sd .= '</script>';
                return $sd;
        }
		/*
		items : [
						'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
						'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
						'insertunorderedlist', '|', 'emoticons', 'image', 'link']
						*/

 
}
