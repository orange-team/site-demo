<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//常用工具函数

//百度分享代码
function bdshare()
{
    $content = <<<EOT
   <div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">
            <span class="bds_more">分享到：</span>
            <a class="bds_qzone"></a>
            <a class="bds_tsina"></a>
            <a class="bds_tqq"></a>
            <a class="bds_renren"></a>
            <a class="shareCount"></a>
        </div>
        <script type="text/javascript" id="bdshare_js" data="type=tools" ></script>
        <script type="text/javascript" id="bdshell_js"></script>
        <script type="text/javascript">
        document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + new Date().getHours();
        </script>
EOT;
    echo $content;
}
