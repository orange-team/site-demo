<?php $this->load->view('header1');?>
<div id="wraper">
    <div class="site_route">
        您的位置 : <a href="/mmshuo/">妈妈说</a> &gt; <?php echo $art['section_name'];?>
    </div>
    <div class="wraper_left">
        <div class="panel">
            <div class="info">
                <a href="#"><img class="avator" src="<?php echo base_url();?>page/img/gift.png"></a>
                <a class="user_name" href="#"><?php echo $art['author'];?></a>
                <span><?php echo $art['add_time'];?></span>
                <span class="section">[<?php echo $art['section_name'];?>]</span>
            </div>
            <h1><?php echo $art['title'];?></h1>
            <div class="content">
            <?php echo $art['content'];?>
            </div>
            <div class="tag">
                <?php
                foreach($art['tag'] as $item)
                {
                ?>
                    <a href="<?php echo $item['id'];?>"><?php echo $item['name'];?></a>
                <?php
                }
                ?>
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
            <?php
            foreach($relation as $item)
            {
            ?>
                <dt><a href="<?php echo $item['id'];?>" class="pb_overflow"><?php echo $item['title'];?></a><span><?php echo $item['pv'];?></span></dt>
            <?php
            }
            ?>
            <!--loop end-->
            </dl>
        </div>
        <div class="recommend">
            <h3>相关百科</h3>
            <div class="list">
                <!--<div class="name">备孕期百科</div>-->
                <!--loop start-->
                <?php 
                foreach($wiki as $item)
                {
                ?>
                    <a href="<?php echo $item['id'];?>" class="pb_overflow"><?php echo $item['wiki_key'];?></a>
                <?php
                }
                ?>
                <!--loop end-->
            </div>
        </div><!--recommend-->
    </div><!--wraper_right-->
</body>
</html>
