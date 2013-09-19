<?php $this->load->view('header')?>
    <style>
    .user_center { padding-top:10px;}
    .user_center .color_1 { color:#6D6D6D }
    .user_center .color_2 { color:#929292;}
    .user_center .color_3 { color:#B6B6B6;}
    .user_center .title{ position:relative;}
    .user_center h1{ font-size:20px;color:#6D6D6D;}
    .user_center .email{ color:#929292; display:block; position:absolute; left:65px; bottom:0;}
    .user_center p { padding:15px 0 15px 0; }
    .user_center .user_info {  height:110px; margin-bottom:15px;}
    .user_center .user_info textarea { width:803px;  height:88px; border:1px solid #B6B6B6; padding:10px; display:block; float:left; overflow:auto; }
    .user_center .user_info .button { border:1px solid #B6B6B6; float:left; border-left:0;}
    .user_center .user_info input.submit{ height:108px; width:173px; border:0; display:block; background-color:#DDF4D5; cursor:pointer; font-size:14px;}
    .user_center .head { height:25px; line-height:25px;border-bottom: 4px #ffcc99 solid; color: #585858; }
    .user_center .head h3 { margin:0 0 0 10px; }
    .user_center .tag_list { height:auto; width:auto; padding:20px 0; border-bottom:1px dashed #B6B6B6; margin-bottom:160px;}
    .user_center .tag_list .tag_box { width:auto; height:36px; float:left; margin:0 15px 15px 15px;}
    .user_center .tag_list .tag { height:36px; background:#D7D7D7; text-align: center; float:left; line-height:36px; padding:0 15px; color:#FF7B6B; font-size:14px;}
    .user_center .tag_list .tag_box img { float:left; display:block; }
    .user_center .tag_list a,a:visited { color:#FF7B6B;}
    .user_center .tag_list a:hover { color:#494949; }
    </style>
<div id="wraper">
    <div class="site_route">
        您的位置 : 个人中心
    </div>
    <div class="content clearfloat">
        <div class="user_center clearfloat">
            <div class="title">
                <h1 class="color_1">嘎嘎嘎</h1>
                <span class='email color_2'>（<?php echo isset($row['user_name']) ? $row['user_name'] : '';?>）</span>
            </div>
            <p class="color_2">欢迎妈妈，您已经在蜡笔画留下了足迹，不做懵懂的妈妈，在这里学习、分享、买东西...</p>
            <div class="user_info">
                <form id="form" action="/user/edit_info" method="post">
                    <textarea class="color_3" name="user_info" readonly="readonly" id="textarea" > <?php echo isset($row['user_info']) ? $row['user_info'] : '这是一位懒妈妈...还没有编辑个人介绍哦... ' ;?> </textarea>
                    <div class="button">
                        <input type="submit" class="submit color_1" name="doSubmit" id="edit" onclick=" return trigger_edit()" value="编辑个人介绍">
                    </div>
                </form>
            </div>
            <div class="clear"></div>
            <div class="head">
                <h3>妈妈关注标签</h3>
            </div>
            <div class="tag_list">
               <!-- loop start -->
               <?php foreach($tagNameArr as $v){ ?>
               <div class="tag_box">
                   <div class="tag"><a href="#"><?php echo $v['name'];?></a></div><img src="/img/love.jpg" />
               </div> 
               <?php } ?>
               <!-- loop end -->
               <div class="clear"></div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('footer')?>
<script type="text/javascript">
    function trigger_edit()
    {
        $("#edit").attr({ id:"submit" , value:"提 交", onclick:"goSubmit()"});
        $("#textarea").removeAttr("readonly");
        var content = $("#textarea").val();
        $("#textarea").val("").focus().val(content);
        return false;
    }

    function goSubmit()
    {
        var info = $("#textarea").val();
        if('' != info)
        {
            $("#form").submit();
        }else
        {
            alert("请认真填写您的个人信息");
            $("#textarea").focus();
        }
    }
</script>

