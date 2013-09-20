<?php $this->load->view('header')?>
<style>
.select_tag .color_1 { color:#40AA52; letter-spacing:1px;font-family: Arial; font-size: 18px; font-weight:900; }
.select_tag .color_2 { color:#929292;}
.select_tag .color_3 { color:#B6B6B6;}
.select_tag .title{ position:relative;}
.select_tag .title img { position:relative; top:10px; }
.select_tag .time_line { padding:15px 0 15px 0; }
.select_tag .color_2 img {  vertical-align:middle; }
.select_tag p { padding:15px 0 15px 0; }
.select_tag .tag_list { height:auto; width:1000px; padding-left:2px;}
.select_tag .tag_list li { list-style-type:none; width:157px; height:36px; float:left; margin-right:53px; margin-bottom:15px; cursor:pointer; }
.select_tag .tag_list li span { height:36px; width:117px; display:block; background:#D7D7D7; text-align:center; line-height:36px; color:white; font-size:14px; float:left; overflow:hidden;}
.select_tag .tag_list li img { float:left; display:block; }
.select_tag .ok_box { text-align:center; padding:20px 0 50px 0;}
.select_tag .ok_box .ok_button { background-color:#9FD0DB; }



.select_tag .tag_list .tag { height:36px; background:#D7D7D7; text-align: center; float:left; line-height:36px; padding:0 15px; color:#FF7B6B; font-size:14px;}
.select_tag .tag_list .tag_box img { float:left; display:block; }
.select_tag .tag_list a,a:visited { color:#FF7B6B;}
.select_tag .tag_list a:hover { color:#494949; }

#biaoge { width:405px; border:1px solid red; margin:50px auto; }

</style>
<div id="wraper">
    <div class="content clearfloat">
        <div class="select_tag clearfloat">
            <div class="title">
                <img src="/img/ok.jpg" />
                <span class="color_1">嘎嘎嘎 （<?php echo isset($row['user_name']) ? $row['user_name'] : '';?>）创建成功！</span>
            </div>
            <p class="color_2">请选择您现在所处的阶段，我们将为您提供贴心个性化的推荐... </p>
            <div class="time_line">
                时间周
            </div>
            <p class="color_2">顺便选择一些您关注的标签吧 &nbsp;&nbsp;<img src="/img/love_red.jpg" /> <img src="/img/love_grap.jpg" /></p>
            <div class="clear"></div>
            <div class="tag_list">
               <!-- loop start -->
               <ul>
               <?php foreach($tagNameArr as $k=>$v){ $k++;?>
                    <li <?php if( 0 ==$k%5 ){ echo 'style="margin-right:0;"'; }?>>
                        <span><?php echo $v['name'];?></span><img src="/img/love_grap_ground.jpg" />
                    </li>
               <?php } ?>
               </ul>
               <!-- loop end -->
               <div class="clear"></div>
            </div>
            <div class="ok_box">
                <form action="/user/select_tag_action" method="post">
                    <input type="hidden" name="tags" />
                    <input type="submit" class="ok_button" name="ok" value="ok" /> 
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('footer')?>

