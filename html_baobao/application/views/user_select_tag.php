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
.select_tag .tag_list li span { height:36px; width:117px; display:block; background:#B6B6B6; text-align:center; line-height:36px; color:#FFFFFF; font-weight:900; font-size:14px; float:left; overflow:hidden;}
.select_tag .tag_list li img { float:left; display:block; }
.select_tag .ok_box { text-align:center; padding:20px 0 50px 0; }
.select_tag .ok_box .ok_button { background-color:#9FD0DB; height:40px; width:100px; cursor:pointer; -webkit-border-radius:10px; -moz-border-radius:10px; -o-border-radius:10px; border-radius:10px; -webkit-box-shadow:5px 5px 10px #6699FF; font-size:23px; font-weight:bold; color:#FFFFFF; letter-spacing: 4px;}
.select_tag .ok_box a { position:relative;  font-size:16px; left:20px; color:#1DA1E7;}
<!--[if IE]>
.ok_button{behavior: url(http://yourdomain.com/js/ie-css3.htc);}
<![endif]-->
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
                    <li <?php if( 0 ==$k%5 ){ echo 'style="margin-right:0;"'; }?> id="li_<?php echo $v['id'];?>" onclick="select_tag(<?php echo $v['id'];?>)">
                        <span id="name_<?php echo $v['id'];?>" ><?php echo $v['name'];?></span>
                        <img id="img_<?php echo $v['id'];?>" src="/img/love_grap_ground.jpg" />
                    </li>
               <?php } ?>
               </ul>
               <!-- loop end -->
               <div class="clear"></div>
            </div>
            <div class="ok_box">
                <form action="/user/select_tag_action" method="post">
                    <input type="hidden" id="tags" name="tags" />
                    <input type="submit" class="ok_button" name="ok" value="ok" /> 
                    <a href="/user/user_select_tag">换一组看看</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('footer')?>
<script type="text/javascript">
var tag_arr = new Array();//定义标签id数组
function select_tag(id)
{

    var showBox = $("#li_"+id);   //ul li 的id
    var nameBox = $("#name_"+id); //标签名称的id
    var imgBox = $("#img_"+id);   //心形图片的id
    var tags_val = $("#tags").val();
    if('' == tags_val)
    {
        $("#tags").val(id);
    }else
    {
        $("#tags").val(tags_val+','+id);
    }

    var col = imgBox.attr('src');
    if( col == '/img/love_grap_ground.jpg')
    {
        nameBox.css('color','#FF763D');
        imgBox.attr('src','/img/love.jpg'); 
        tag_arr.push(id);
    }else
    {
        nameBox.css('color','white');
        imgBox.attr('src','/img/love_grap_ground.jpg'); 
        tag_arr.splice($.inArray(id,arr),1);
    }
    alert(tag_arr);
}
</script>

