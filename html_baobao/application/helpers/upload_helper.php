<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * desc : 上传文件函数
 * author : zg
 * date : 2013/09/03
 */

/*
 * 上传图片, $wiki_id用于生成散列目录
 * 
 * @author : zg
 * @param : $upimg，文件空间的name
 *          $id，上传目录的id，如：/uploads/img/article/$id/
 * @return : boolean/intager
 */

function upload_img($upimg, $id, $img_type='article')
{
    //未上传图片
    if( empty($_FILES[$upimg]['name']) ) return 1;
    //重命名图片, 防止了.php.jpg
    $img_ext = substr($_FILES[$upimg]['name'],0, strpos($_FILES[$upimg]['name'],'.'));
    $myImg = date('YmdHis').'_'.rand(10000,99999);
    $config['file_name'] = $myImg.$img_ext;
    $config['upload_path'] = './uploads/img/'.$img_type.'/'.(int)$id;
    //var_dump($config,getcwd());
    //生成散列目录
    if( !file_exists($config['upload_path']) ) mkdir($config['upload_path']);
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size'] = '93600';
    $config['max_width']  = '3000';
    $config['max_height']  = '3000';
    $CI =& get_instance();
    //载入文件上传类，加入配置
    $CI->load->library('upload', $config);
    $up_success = $CI->upload->do_upload($upimg);
    if ( true!=$up_success )//上传失败
    {
        return -1;
    }
    unset($config);
    $uploadData = $CI->upload->data();
    //生成缩略图
    $CI->load->library('image_lib');
    $config['source_image'] = $uploadData['full_path'];
    $config['width'] = 120;
    $config['height'] = 120;
    $config['quality'] = 90;
    $new_image = $myImg.$img_ext.'_s'.$uploadData['file_ext'];
    $config['new_image'] = $new_image;
    $CI->image_lib->initialize($config);
    if (!$CI->image_lib->resize()) 
    {     
        $data['msg'] = '缩略图生成失败';
        $data['url'] = '/admin/wiki/showlist/';
        $CI->load->view('admin/info', $data);
        return -2;
    }
    unset($config);
    $CI->image_lib->clear();
    return $CI->upload->data();
}

