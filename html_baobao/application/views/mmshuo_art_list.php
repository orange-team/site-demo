<?php $this->load->view('header')?>
<div id="wraper" class="clearfloat">
	<div class="bread_nav">
        您的位置 : <?=$this->nav?>
    </div>
    <div class="wraper_left">
        <dl class="timeline">
            <?php foreach($timeline as $row){ ?>
            <dt<?=($on==$row->id) ? ' class="on"' : ''?>><a href="<?=site_url('mmshuo_art_list/?timeline='.$row->id)?>"><?=$row->name?></a></dt>
            <?php } ?>
        </dl>
        <div class="section clearfloat">
            <?php foreach($section as $section){ ?>
            <!--loop start-->
            <div class="item">
                <div class="name"><?=$section->name?></div>
                <a class="pb_overflow" href="#">孕前保健</a>
                <a class="pb_overflow" href="#">备孕营养</a>
            </div>
            <!--loop end-->
            <?php } ?>
            <div class="item">
                <div class="name">怀孕期</div>
                <a class="pb_overflow" href="#">孕早期</a>
                <a class="pb_overflow" href="#">孕中期</a>
                <a class="pb_overflow" href="#">孕晚期</a>
            </div>
            <div class="item">
                <div class="name">备孕期</div>
                <a class="pb_overflow" href="#">孕前保健</a>
                <a class="pb_overflow" href="#">备孕营养</a>
            </div>
        </div>
        <div class="ask">
            <dl>
                <?php foreach($ask as $row){ ?>
                <!--loop start-->
                <dt class="clearfloat">
                    <a href="#"><img class="avator" src="/img/defaultAvator.png"></a>
                    <div class="right">
                        <div class="title">
                            <a class="pb_overflow" href="#"><?=$row->title?></a><span><?=$row->pv?></span>
                        </div>
                        <div class="summary clearfloat">
                            <div class="icon" onmouseout="$(this).next().hide();" onmouseover="$(this).next().show();">...</div>
                            <div class="txt" onmouseout="$(this).hide();" onmouseover="$(this).show();"><?=$row->abstract?></div>
                        </div>
                        <div class="tag">
                            <a href="#">尿布</a><a href="#">细菌</a><a href="#">遗传基因</a>
                        </div>
                    </div>
                </dt> 
                <!--loop end-->
                <?php } ?>
                <dt class="clearfloat">
                    <a href="#"><img class="avator" src="img/defaultAvator.png"></a>
                    <div class="right">
                        <div class="title">
                            <a class="pb_overflow" href="#">0岁开始培养宝宝阅读习惯</a><span>10</span>
                        </div>
                        <div class="summary clearfloat">
                            <div class="icon" onmouseout="$(this).next().hide();" onmouseover="$(this).next().show();">...</div>
                            <div class="txt">Bootstrap 是基于 HTML，CSS 和 JavaScript 的简洁灵活的流行前端框架及交互组件集，由微博的先驱 Twitter 在2011年8月开源的整套前端解决解决方案。Bootstrap 有非常完备和详尽的开发文档，Web 开发人员能够轻松搭建出清爽风格的界面以及实现良好的交互效果。
                            </div>
                        </div>
                        <div class="tag">
                            <a href="#">尿布</a><a href="#">细菌</a><a href="#">遗传基因</a>
                        </div>
                    </div>
                </dt>
                <dt class="clearfloat">
                    <a href="#"><img class="avator" src="img/defaultAvator.png"></a>
                    <div class="right">
                        <div class="title">
                            <a class="pb_overflow" href="#">0岁开始培养宝宝阅读习惯,0岁开始培养宝宝阅读习惯0岁开始培养宝宝阅读习惯0岁开始培养宝宝阅读习惯</a><span>10</span>
                        </div>
                        <div class="summary clearfloat">
                            <div class="icon" onmouseout="$(this).next().hide();" onmouseover="$(this).next().show();">...</div>
                            <div class="txt">Bootstrap 是基于 HTML，CSS 和 JavaScript 的简洁灵活的流行前端框架及交互组件集，由微博的先驱 Twitter 在2011年8月开源的整套前端解决解决方案。Bootstrap 有非常完备和详尽的开发文档，Web 开发人员能够轻松搭建出清爽风格的界面以及实现良好的交互效果。
                            </div>
                        </div>
                        <div class="tag">
                            <a href="#">尿布</a><a href="#">细菌</a><a href="#">遗传基因</a>
                        </div>
                    </div>
                </dt> 
            </dl>
            <div class="page clearfloat"><a href="#">下一页</a><a href="#">上一页</a></div>
        </div>
    </div><!-- wraper_left -->
    <div class="wraper_right">
        <div class="guide">
            <div class="to_top"> </div>
            <div class="txt">
            这里可以搜索您想要查的问题！！！
            </div>
        </div>
        <div class="recommend">
            <h3>知识推荐</h3>
            <dl class="list">
            <!--loop start-->
                <dt><a href="#" class="pb_overflow">孕期的饮食是保证健康的首要孕期的饮食是保证健康的首要</a></dt>
            <!--loop end-->
                <dt><a href="#" class="pb_overflow">孕期的饮食备孕推荐文</a></dt>
                <dt><a href="#" class="pb_overflow">孕期的饮食是保证健康的首要</a></dt>
                <dt><a href="#" class="pb_overflow">孕期的饮食是保证健康的首要</a></dt>
            </dl>
        </div><!--recommend-->
    </div><!--wraper_right-->
</div>
<?php $this->load->view('footer')?>

