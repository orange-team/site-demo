<?php $this->load->view('header1');?>
<div id="wraper">
    <div class="site_route">
        您的位置 : <a href="/mmshuo/">妈妈说</a> &gt; 怀孕期
    </div>
    <div class="wraper_left">
        <div class="panel">
            <div class="info">
                <a href="#"><img class="avator" src="<?php echo base_url();?>page/img/gift.png"></a>
                <a class="user_name" href="#"><?php echo $art['author'];?></a>
                <span><?php echo $art['add_time'];?></span>
                <span class="section">[<?php echo $art['section_type'];?>]</span>
            </div>
            <h1><?php echo $art['title'];?></h1>
            <div class="content">
            <?php echo $art['content'];?>
            </div>
            <div class="tag">
                <a href="#">尿布</a><a href="#">细菌</a><a href="#">遗传基因</a>
            </div>
        </div>
        <div class="discuss">
            <h2>网友评论</h2>
            <dl>
                <dt class="clearfloat">
                    <a href="#"><img class="avator" src="<?php echo base_url();?>page/img/gift.png"></a>
                    <div class="right">
                        <div class="first">
                            <a class="user_name" href="#">范范范玮琪</a>：宝宝牙齿发育，从孕期开始
                        </div>
                        <div class="info">来自 新浪微博  2013-06-19  12:30:00
                            <a class="reply" href="#">回复</a>
                        </div>
                        <div class="reply_content" style="display:block;">
                            <textarea></textarea>
                            <span class="tip">请输入不超出200字的评论</span>
                            <button type="button">发表</button>
                        </div>
                    </div>
                </dt> 
                <dt class="clearfloat">
                    <a href="#"><img class="avator" src="<?php echo base_url();?>page/img/gift.png"></a>
                    <div class="right">
                        <div class="user_of_reply">
                            <a class="user_name" href="#">￥#~漫漫~#￥</a>回复：<a class="user_name" href="#">范范范玮琪</a>
                        </div>
                        <div class="first_have_reply">宝宝牙齿发育，从孕期开始。宝宝牙齿发育，从孕期开始</div>
                        <div class="the_reply">现代简约风就适合现在的80后，神马卖萌可爱还是比较适合90后的女生们。</div>
                        <div class="info">来自 新浪微博  2013-06-19  12:30:00
                            <a class="reply" href="#">回复</a>
                        </div>
                        <div class="reply_content" style="display:block;">
                            <textarea></textarea>
                            <span class="tip">请输入不超出200字的评论</span>
                            <button type="button">发表</button>
                        </div>
                    </div>
                </dt> 
                <dt class="clearfloat">
                    <a href="#"><img class="avator" src="<?php echo base_url();?>page/img/gift.png"></a>
                    <div class="right">
                        <div class="first">
                            <a class="user_name" href="#">范范范玮琪</a>：宝宝牙齿发育，从孕期开始
                        </div>
                        <div class="info">来自 新浪微博  2013-06-19  12:30:00
                            <a class="reply" href="#">回复</a>
                        </div>
                        <div class="reply_content">
                            <textarea></textarea>
                            <span class="tip">请输入不超出200字的评论</span>
                            <button type="button">发表</button>
                        </div>
                    </div>
                </dt> 
                <dt class="clearfloat">
                    <a href="#"><img class="avator" src="<?php echo base_url();?>page/img/gift.png"></a>
                    <div class="right">
                        <div class="first">
                            <a class="user_name" href="#">范范范玮琪</a>：宝宝牙齿发育，从孕期开始
                        </div>
                        <div class="info">来自 新浪微博  2013-06-19  12:30:00
                            <a class="reply" href="#">回复</a>
                        </div>
                        <div class="reply_content">
                            <textarea></textarea>
                            <span class="tip">请输入不超出200字的评论</span>
                            <button type="button">发表</button>
                        </div>
                    </div>
                </dt> 
            </dl>
            <div class="num clearfloat"><span>共4条评论</span></div>
            <div class="reply_bottom">
                <span>发表评论</span>
                <textarea></textarea>
                <span class="tip">请输入不超出200字的评论</span>
                <button type="button">发表</button>
                <a class="login" href="#">登录</a>
            </div>
        </div>
    </div><!--wraper_left-->
    <div class="wraper_right">
        <div class="recommend">
            <h3>相关经历</h3>
            <dl class="list">
            <!--loop start-->
                <dt><a href="#" class="pb_overflow">孕期的饮食是保证健康的首要孕期的饮食是保证健康的首要</a><span>98</span></dt>
            <!--loop end-->
                <dt><a href="#" class="pb_overflow">孕期的饮食备孕推荐文</a><span>1</span></dt>
                <dt><a href="#" class="pb_overflow">孕期的饮食是保证健康的首要</a><span>1</span></dt>
                <dt><a href="#" class="pb_overflow">孕期的饮食是保证健康的首要</a><span>1</span></dt>
            </dl>
        </div>
        <div class="recommend">
            <h3>相关百科</h3>
            <div class="list">
                <div class="name">备孕期百科</div>
                <!--loop start-->
                <a href="#" class="pb_overflow">热度高-低</a>
                <!--loop end-->
                <a href="#" class="pb_overflow">专业术语</a>
                <a href="#" class="pb_overflow">百科专业术语</a>
                <a href="#" class="pb_overflow">专业术语</a>
            </div>
        </div><!--recommend-->
    </div><!--wraper_right-->
</body>
</html>
