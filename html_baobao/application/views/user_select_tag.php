<?php $this->load->view('header')?>
<style>
.select_tag .color_1 { color:#40AA52; letter-spacing:1px;font-family: Arial; font-size: 18px; font-weight:900; }
.select_tag .color_2 { color:#929292;}
.select_tag .color_3 { color:#B6B6B6;}
.select_tag .title{ position:relative;}
.select_tag .title img { position:relative; top:10px; }
.select_tag .time_line { padding:8px 0 25px 0; height:20px; width:auto;}
.select_tag .time_line a{ float:left; margin-left:1px;}
.select_tag .time_line .section{ width:165px; float:left; margin-left:1px; height:10px; cursor:pointer; }}
.select_tag .time_line .section h6{ font-style:normal; }
.select_tag .time_line .section div{  width:165px; float:left;  height:10px; margin-top:5px;}
.select_tag .time_line .beiyun{ background-color:#FFCCCC; }
.select_tag .time_line .huaiyun{ background-color:#FF99FF; }
.select_tag .time_line .fenmian{ background-color:#FFCC00; }
.select_tag .time_line .zerone{ background-color:#BEF0B7; }
.select_tag .time_line .onethree{ background-color:#BFE8E6; }
.select_tag .time_line .threesix{ background-color:#42A855; }

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
                <span class="color_1">嘎嘎嘎 （<?php echo isset($row['user_nickname']) ? $row['user_nickname'] : '';?>）创建成功！</span>
            </div>
            <p class="color_2">请选择您现在所处的阶段，我们将为您提供贴心个性化的推荐... </p>
            <div class="time_line">
                <?php foreach($time as $key=>$v){ $key++;?>
                <div class="section" id="secBox_<?php echo $key;?>" onmouseover="showSection('<?php echo $key; ?>')">
                    <span><?php echo $v['name'];?></span>
                    <div id="sec_<?php echo $key;?>" class="<?php switch($v['name']){ 
                                            case '备孕':  echo 'beiyun';break;
                                            case '怀孕':  echo 'huaiyun';break;
                                            case '分娩':  echo 'fenmian';break;
                                            case '0-1岁': echo 'zerone';break;
                                            case '1-3岁': echo 'onethree';break;
                                            default: echo 'threesix'; };?>">
                    </div>
                </div>
                <?php } ?>
            </div>
            <p class="color_2">顺便选择一些您关注的标签吧 &nbsp;&nbsp;<span id="selected"></span>
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
                    <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id;?>" />
                    <input type="submit" class="ok_button" name="ok" value="ok" onclick="return goSubmit()" /> 
                    <a href="/user/user_select_tag">换一组看看</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('footer')?>
<script type="text/javascript">
var tag_arr = new Array();//定义标签id数组
//点选标签触发的方法
function select_tag(id)
{

    var showBox = $("#li_"+id);         //ul li 的id
    var nameBox = $("#name_"+id);       //标签名称的id
    var imgBox = $("#img_"+id);         //心形图片的id
    var tags_val = $("#tags").val("");  //隐藏域存储选择好的标签id
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
        $("#selected").append("<img src=\"/img/love_red.jpg\" id=\"imgSel_"+id+"\" />")

    }else
    {
        nameBox.css('color','white');
        imgBox.attr('src','/img/love_grap_ground.jpg'); 
        tag_arr.splice($.inArray(id,tag_arr),1);
        $("#imgSel_"+id).remove();
    }
    $("#tags").val(tag_arr);
}
//点击OK按钮触发的方法
function goSubmit()
{
    var tags_val = $("#tags").val();  //隐藏域存储选择好的标签id
    if('' == tags_val)
    {
        alert('请选择您关注的标签！');
        return false;
    }else
    {
        return true;
    }
    
}
//鼠标悬停在时间轴上
function showSection(sec)
{
    if(2 == sec)
    {
        $("#sec_"+2).css("width","630px");
        $("#secBox_"+2).css("width","630px");
        for(i=1; i<=6; i++)
        {
            if(2!=i)
            {
                $("#sec_"+i).css("width","72px");
                $("#secBox_"+i).css("width","72px");
            }
        }
    }
}
</script>

