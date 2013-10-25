<?php $this->load->view('header')?>
<div id="wraper" class="clearfloat">
	<div class="bread_nav">
        您的位置 : <?=$this->nav?>
    </div>
    <div class="wraper_left">
        <dl class="timeline">
            <?php if(!empty($timeline) && is_array($timeline)) {?>
            <?php foreach($timeline as $row){ ?>
            <dt<?=($on==$row->id) ? ' class="on"' : ''?>><a href="<?=site_url($this->_uri.'mmshuo_art_list/?timeline='.$row->id)?>"><?=$row->name?></a></dt>
            <?php }} ?>
        </dl>
        <div class="section clearfloat">
            <?php if(!empty($section) && is_array($section)) {?>
            <?php foreach($section as $row){ ?>
            <!--loop start-->
            <div class="item">
                <div class="name"><?=$row->name?></div>
                <a class="pb_overflow" href="">孕前保健</a>
                <a class="pb_overflow" href="#">备孕营养</a>
            </div>
            <!--loop end-->
            <?php }} ?>
            <div class="item">
                <div class="name">备孕期</div>
                <a class="pb_overflow" href="<?=site_url($this->_uri.'2686')?>">孕前保健</a>
                <a class="pb_overflow" href="<?=site_url($this->_uri.'3901')?>">孕前检查</a>
                <a class="pb_overflow" href="<?=site_url($this->_uri.'85')?>">备孕营养</a>
                <a class="pb_overflow" href="<?=site_url($this->_uri.'1423')?>">不孕不育</a>
            </div>
            <div class="item">
                <div class="name">孕前期</div>
                <a class="pb_overflow" href="<?=site_url($this->_uri.'18')?>">孕期减肥</a>
                <a class="pb_overflow" href="<?=site_url($this->_uri.'883')?>">孕期营养</a>
                <a class="pb_overflow" href="<?=site_url($this->_uri.'1828')?>">孕期疾病</a>
                <a class="pb_overflow" href="<?=site_url($this->_uri.'523')?>">胎儿发育</a>
            </div>
            <div class="item">
                <div class="name">孕中期</div>
                <a class="pb_overflow" href="<?=site_url($this->_uri.'27')?>">胎教指南</a>
                <a class="pb_overflow" href="<?=site_url($this->_uri.'1937')?>">待产分娩</a>
                <a class="pb_overflow" href="<?=site_url($this->_uri.'85')?>">备孕营养</a>
                <a class="pb_overflow" href="<?=site_url($this->_uri.'1495')?>">准爸爸</a>
            </div>
            <div class="item">
                <div class="name">孕后期</div>
                <a class="pb_overflow" href="<?=site_url($this->_uri.'1099')?>">孕期健身</a>
                <a class="pb_overflow" href="<?=site_url($this->_uri.'1937')?>">待产分娩</a>
                <a class="pb_overflow" href="<?=site_url($this->_uri.'523')?>">胎儿发育</a>
            </div>
            <div class="item">
                <div class="name">0至1岁</div>
                <a class="pb_overflow" href="<?=site_url($this->_uri.'2899')?>">婴儿护理</a>
                <a class="pb_overflow" href="<?=site_url($this->_uri.'1541')?>">婴儿喂养</a>
                <a class="pb_overflow" href="<?=site_url($this->_uri.'1247')?>">婴儿心理</a>
                <a class="pb_overflow" href="<?=site_url($this->_uri.'1056')?>">产后保健</a>
            </div>
            <div class="item">
                <div class="name">1至3岁</div>
                <a class="pb_overflow" href="<?=site_url($this->_uri.'451')?>">早期教育</a>
                <a class="pb_overflow" href="<?=site_url($this->_uri.'390')?>">幼儿护理</a>
                <a class="pb_overflow" href="<?=site_url($this->_uri.'574')?>">幼儿疾病</a>
            </div>
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
                            <a class="pb_overflow" href="<?=site_url('mmshuo_detail').'/'.$row->id?>"><?=$row->title?></a><span><?=$row->pv?></span>
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
            </dl><!--<a href="<?=$this->pageNext?>">下一页</a><a href="<?=$this->pagePrev?>">上一页</a>-->
            <?php if(isset($this->pagination) && !empty($this->pagination)) { ?>
            <div class="page clearfloat">
                <?=$pagination?>
            </div>
            <?php } ?>
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

