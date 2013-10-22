<?php $this->load->view('header')?>
<div id="wraper" class="clearfloat">
	<div class="bread_nav">
        您的位置 : <?=$this->nav?>
    </div>
    <div class="wraper_left">
        <dl class="timeline">
            <?php if(!empty($timeline) && is_array($timeline)) {?>
            <?php foreach($timeline as $row){ ?>
            <dt<?=($on==$row->id) ? ' class="on"' : ''?>><a href="<?=site_url('mmshuo_art_list/?timeline='.$row->id)?>"><?=$row->name?></a></dt>
            <?php }} ?>
        </dl>
        <div class="section clearfloat">
            <?php if(!empty($section) && is_array($section)) {?>
            <?php foreach($section as $row){ ?>
            <!--loop start-->
            <div class="item">
                <div class="name"><?=$row->name?></div>
                <a class="pb_overflow" href="#">孕前保健</a>
                <a class="pb_overflow" href="#">备孕营养</a>
            </div>
            <!--loop end-->
            <?php }} ?>
        </div>
        <div class="ask">
            <dl>
                <?php if(!empty($ask) || is_array($ask)) {?>
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
                            <?php foreach($row->tags as $tag){ ?>
                            <a href="#"><?=$tag?></a>
                            <?php } ?>
                        </div>
                    </div>
                </dt> 
                <!--loop end-->
                <?php }} ?>
            </dl>
            <div class="page clearfloat"><a href="<?=$this->pageNext?>">下一页</a><a href="<?=$this->pagePrev?>">上一页</a></div>
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

