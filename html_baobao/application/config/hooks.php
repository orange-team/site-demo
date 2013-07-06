<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/

//权限认证钩子
$hook['post_controller_constructor'] = array( 'class'=> 'AdminAuth','function'=> 'auth',
											'filename' => 'AdminAuth.php','filepath' => 'hooks');

$hook['pre_controller'] = array(
                                'class'    => 'LangClass',
                                'function' => 'set_lang',
                                'filename' => 'Langclass.php',
                                'filepath' => 'hooks',
                                );

/* End of file hooks.php */
/* Location: ./application/config/hooks.php */