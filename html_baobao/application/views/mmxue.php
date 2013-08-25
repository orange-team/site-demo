<?php $this->load->view('header')?>
<div id="wraper" class="clearfloat">
    <div class="site_route">
        您的位置 : <a href="#">妈妈学</a> > <a href="#">怀孕期</a> > 母乳喂养
    </div>
    <div class="wraper_left">
       <div class="left">
            <div class="pic_hot clearfloat" id="pic_hot">
                <?php foreach($specArr as $k=>$v) {?>
                <div class="item">
                    <a href="#">
                        <img class="pic<?php echo $k+1?> pic_height" src="<?php echo $this->spec_path,$v['cover'];?>" title="<?php echo $v['title']?>"/>
                    </a>
                    <div class="cover pb_opacity" rel="cover"> </div>
                </div>
                <?php } ?>
            </div>

            <div class="wiki">
                <div class="head clearfloat">
                    <h3>育儿百科 ( 专业名词的解释 , 即百科标签 )</h3>
                    <a href="#" class="more">更多百科</a>
                </div>
                <div class="note">按字母检索：</div>
                <div class="letter" id="letter_nav">
                    <?php foreach($A_Z as $v) {?><a id="letter_<?php echo $v?>" <?php if($showKey==$v) echo 'class="on"'?>><?php echo $v?></a><?php } ?>
                    <div class="to_top" id="to_top"> </div>
                </div>

                <?php foreach($keyArr as $key=>$val) {?>
                <div class="tag <?php if($showKey == $key) echo 'show';?>" id="key_<?php echo $key?>">
                    <?php if(0>=count($val)) echo '<p>抱歉，该字母索引下暂时还没有百科关键词</p>';
                    foreach($val as $k=>$v) {?>
                    <a href="/wiki/<?php echo $v['id']?>" class="pb_overflow"><?php echo $v['wiki_key']?></a>
                    <?php } ?>
                </div>
                <?php } ?>
            </div><!-- wiki -->
            
            <div class="time">
                <dl class="head clearfloat">
                    <dt onclick="show_panel(this)" sort="1">备孕期</dt>
                    <dt onclick="show_panel(this)" sort="2" class="on">怀孕期</dt>
                    <dt onclick="show_panel(this)" sort="3">分娩</dt>
                    <dt onclick="show_panel(this)" sort="4">0-1岁</dt>
                    <dt onclick="show_panel(this)" sort="5">1-3岁</dt>
                    <dt onclick="show_panel(this)" sort="6">3-6岁</dt>
                </dl>
                <div class="panel_2" id="panel_2">
                    <div class="line clearfloat">
                        <div class="part">
                            <span>孕早期(1-12周)</span>
                            <div class="dot"></div>
                            <a href="#"></a>
                            <a href="#"></a>
                            <a href="#"></a>
                            <a href="#"></a>
                            <a href="#"></a>
                            <a href="#"></a>
                            <a href="#"></a>
                            <a href="#"></a>
                            <a href="#"></a>
                            <a href="#"></a>
                            <a href="#"></a>
                            <a href="#"></a>
                        </div>
                        <div class="part">
                            <span>孕中期(13-27周)</span>
                            <div class="dot"></div>
                            <a href="#"></a>
                            <a href="#"></a>
                            <a href="#"></a>
                            <a href="#"></a>
                            <a href="#"></a>
                            <a href="#"></a>
                            <a href="#"></a>
                            <a href="#"></a>
                            <a href="#"></a>
                            <a href="#"></a>
                            <a href="#"></a>
                            <a href="#"></a>
                        </div>
                        <div class="part">
                            <span>孕晚期(28-40周)</span>
                            <div class="dot"></div>
                            <a href="#"></a>
                            <a href="#"></a>
                            <a href="#"></a>
                            <a href="#"></a>
                            <a href="#"></a>
                            <a href="#"></a>
                            <a href="#"></a>
                            <a href="#"></a>
                            <a href="#"></a>
                            <a href="#"></a>
                            <a href="#"></a>
                            <a href="#"></a>
                        </div>
                    </div>
                    <div class="art_list">
                        <!-- loop start -->
                        <div class="item">
                            <div class="week">
                                <img src="/img/week_num.jpg" />
                                <span>周</span>
                            </div>
                            <div class="art clearfloat">
                                <div class="clearfloat">
                                    <a href="#" class="pb_overflow">女性养生警惕：怀孕前4件事情不能做</a>
                                    <span>[<a href="#">饮食</a>]</span>
                                </div>
                                <div class="clearfloat">
                                    <a href="#" class="pb_overflow">谁的基因 决定宝宝单双眼皮？</a>
                                    <span>[<a href="#">饮食</a>]</span>
                                </div>
                                <div class="clearfloat">
                                    <a href="#" class="pb_overflow">遗传与血型 父母血型遗传孩子的规律女性养生警惕：怀孕前4件事情不能做</a>
                                    <span>[<a href="#">饮饮食食</a>]</span>
                                </div>
                            </div>
                            <a href=#" class="more">了解更多</a>
                        </div>
                        <!-- loop end -->
                        <!-- loop start -->
                        <div class="item">
                            <div class="week">
                                <img src="/img/week_num.jpg" />
                                <span>周</span>
                            </div>
                            <div class="art clearfloat">
                                <div class="clearfloat">
                                    <a href="#" class="pb_overflow">女性养生警惕：怀孕前4件事情不能做</a>
                                    <span>[<a href="#">饮食</a>]</span>
                                </div>
                                <div class="clearfloat">
                                    <a href="#" class="pb_overflow">谁的基因 决定宝宝单双眼皮？</a>
                                    <span>[<a href="#">饮食</a>]</span>
                                </div>
                                <div class="clearfloat">
                                    <a href="#" class="pb_overflow">遗传与血型 父母血型遗传孩子的规律女性养生警惕：怀孕前4件事情不能做</a>
                                    <span>[<a href="#">饮饮食食</a>]</span>
                                </div>
                            </div>
                            <a href=#" class="more">了解更多</a>
                        </div>
                        <!-- loop end -->
                        <!-- loop start -->
                        <div class="item">
                            <div class="week">
                                <img src="/img/week_num.jpg" />
                                <span>周</span>
                            </div>
                            <div class="art clearfloat">
                                <div class="clearfloat">
                                    <a href="#" class="pb_overflow">女性养生警惕：怀孕前4件事情不能做</a>
                                    <span>[<a href="#">饮食</a>]</span>
                                </div>
                                <div class="clearfloat">
                                    <a href="#" class="pb_overflow">谁的基因 决定宝宝单双眼皮？</a>
                                    <span>[<a href="#">饮食</a>]</span>
                                </div>
                                <div class="clearfloat">
                                    <a href="#" class="pb_overflow">遗传与血型 父母血型遗传孩子的规律女性养生警惕：怀孕前4件事情不能做</a>
                                    <span>[<a href="#">饮饮食食</a>]</span>
                                </div>
                            </div>
                            <a href=#" class="more">了解更多</a>
                        </div>
                        <!-- loop end -->
                    </div><!-- art_list -->
                    <div class="next_page">
                        还在翻页吗?直接选择时间轴吧<a href="#">下一页</a>
                    </div>
                </div><!-- panel -->
                <div class="panel_3" id="panel_3" style="display:none;">
                    <div class="art_list">
                        <!-- loop start -->
                        <div class="item clearfloat">
                            <div class="title1">产前心理</div>
                            <div class="art clearfloat">
                                <div>
                                    <a href="#" class="pb_overflow">女性养生警惕：怀孕前4件事情不能做</a>
                                </div>
                                <div>
                                    <a href="#" class="pb_overflow">谁的基因 决定宝宝单双眼皮？</a>
                                </div>
                                <div>
                                    <a href="#" class="pb_overflow">遗传与血型 父母血型遗传孩子的规律女性养生警惕：怀孕前4件事情不能做</a>
                                </div>
                                <div>
                                    <a href="#" class="pb_overflow">遗传与血型 父母血型遗传孩子的规律女性养生警惕：怀孕前4件事情不能做</a>
                                </div>
                                <div>
                                    <a href="#" class="pb_overflow">遗传与血型 父母血型遗传孩子的规律女性养生警惕：怀孕前4件事情不能做</a>
                                </div>
                            </div>
                            <a href=#" class="more">了解更多</a>
                        </div>
                        <!-- loop end -->
                        <!-- loop start -->
                        <div class="item clearfloat">
                            <div class="title2">临盆待产</div>
                            <div class="art clearfloat">
                                <div class="clearfloat">
                                    <a href="#" class="pb_overflow">女性养生警惕：怀孕前4件事情不能做</a>
                                </div>
                                <div class="clearfloat">
                                    <a href="#" class="pb_overflow">谁的基因 决定宝宝单双眼皮？</a>
                                </div>
                                <div class="clearfloat">
                                    <a href="#" class="pb_overflow">遗传与血型 父母血型遗传孩子的规律女性养生警惕：怀孕前4件事情不能做</a>
                                </div>
                            </div>
                            <a href=#" class="more">了解更多</a>
                        </div>
                        <!-- loop end -->
                    </div><!-- art_list -->
                </div><!-- panel_3 -->
            </div><!-- time -->
            
            <div class="focus clearfloat">
                <div class="head clearfloat">
                    <h3>妈妈关注</h3>
                </div>
                <!-- loop start -->
                <div class="item">
                    <a href="#">
                        <img src="http://pic2.nipic.com/20090414/386228_104922058_2.jpg" />
                    </a>
                    <dl class="info">
                        <dt>
                            <a href="#">某某某</a>: 备孕期
                        </dt>
                        <dt>
                            <span class="focus_wd">关注</span>:
                            <a href="#" class="tag">饮食</a><a href="#" class="tag">检查</a>
                        </dt>
                    </dl>
                </div>
                <!-- loop end -->
                <!-- loop start -->
                <div class="item">
                    <a href="#">
                        <img src="http://pic2.nipic.com/20090414/386228_104922058_2.jpg" />
                    </a>
                    <dl class="info">
                        <dt>
                            <a href="#">某某某</a>: 备孕期
                        </dt>
                        <dt>
                            <span class="focus_wd">关注</span>:
                            <a href="#" class="tag">饮食</a><a href="#" class="tag">检查</a><a href="#" class="tag">饮食</a><a href="#" class="tag">检查</a>
                        </dt>
                    </dl>
                </div>
                <!-- loop end -->
                <!-- loop start -->
                <div class="item">
                    <a href="#">
                        <img src="http://pic2.nipic.com/20090414/386228_104922058_2.jpg" />
                    </a>
                    <dl class="info">
                        <dt>
                            <a href="#">某某某</a>: 备孕期
                        </dt>
                        <dt>
                            <span class="focus_wd">关注</span>:
                            <a href="#" class="tag">饮食</a><a href="#" class="tag">检查</a>
                        </dt>
                    </dl>
                </div>
                <!-- loop end -->
                <!-- loop start -->
                <div class="item">
                    <a href="#">
                        <img src="http://pic2.nipic.com/20090414/386228_104922058_2.jpg" />
                    </a>
                    <dl class="info">
                        <dt>
                            <a href="#">某某某</a>: 备孕期
                        </dt>
                        <dt>
                            <span class="focus_wd">关注</span>:
                            <a href="#" class="tag">饮食</a><a href="#" class="tag">检查</a><a href="#" class="tag">饮食</a><a href="#" class="tag">检查</a>
                        </dt>
                    </dl>
                </div>
                <!-- loop end -->
                <!-- loop start -->
                <div class="item">
                    <a href="#">
                        <img src="http://pic2.nipic.com/20090414/386228_104922058_2.jpg" />
                    </a>
                    <dl class="info">
                        <dt>
                            <a href="#">某某某</a>: 备孕期
                        </dt>
                        <dt>
                            <span class="focus_wd">关注</span>:
                            <a href="#" class="tag">饮食</a><a href="#" class="tag">检查</a>
                        </dt>
                    </dl>
                </div>
                <!-- loop end -->
                <!-- loop start -->
                <div class="item">
                    <a href="#">
                        <img src="http://pic2.nipic.com/20090414/386228_104922058_2.jpg" />
                    </a>
                    <dl class="info">
                        <dt>
                            <a href="#">某某某</a>: 备孕期
                        </dt>
                        <dt>
                            <span class="focus_wd">关注</span>:
                            <a href="#" class="tag">饮食</a><a href="#" class="tag">检查</a>
                        </dt>
                    </dl>
                </div>
                <!-- loop end -->
            </div><!-- focus -->

            <div class="tool clearfloat">
                <div class="head clearfloat">
                    <h3>实用小工具</h3>
                </div>
                <!-- loop start -->
                <dl class="item">
                    <dt>
                        <a href="#">
                            <img src="http://pic2.nipic.com/20090414/386228_104922058_2.jpg" title=""/>
                        </a>
                        <a href="#" class="name">宝宝体重健康计算工具</a>
                    </dt>
                </dl>
                <!-- loop end -->
                <!-- loop start -->
                <dl class="item">
                    <dt>
                        <a href="#">
                            <img src="http://pic2.nipic.com/20090414/386228_104922058_2.jpg" title=""/>
                        </a>
                        <a href="#" class="name">宝宝体重健康计算工具</a>
                    </dt>
                </dl>
                <!-- loop end -->
                <!-- loop start -->
                <dl class="item">
                    <dt>
                        <a href="#">
                            <img src="http://pic2.nipic.com/20090414/386228_104922058_2.jpg" title=""/>
                        </a>
                        <a href="#" class="name">宝宝体重健康计算工具</a>
                    </dt>
                </dl>
                <!-- loop end -->
                <!-- loop start -->
                <dl class="item">
                    <dt>
                        <a href="#">
                            <img src="http://pic2.nipic.com/20090414/386228_104922058_2.jpg" title=""/>
                        </a>
                        <a href="#" class="name">宝宝体重健康计算工具</a>
                    </dt>
                </dl>
                <!-- loop end -->
                <!-- loop start -->
                <dl class="item">
                    <dt>
                        <a href="#">
                            <img src="http://pic2.nipic.com/20090414/386228_104922058_2.jpg" title=""/>
                        </a>
                        <a href="#" class="name">宝宝体重健康计算工具</a>
                    </dt>
                </dl>
                <!-- loop end -->
                <!-- loop start -->
                <dl class="item">
                    <dt>
                        <a href="#">
                            <img src="http://pic2.nipic.com/20090414/386228_104922058_2.jpg" title=""/>
                        </a>
                        <a href="#" class="name">宝宝体重健康计算工具</a>
                    </dt>
                </dl>
                <!-- loop end -->
            </div><!-- tool -->

        </div><!-- left -->
    </div><!-- wraper_left -->

    <div class="wraper_right">
        <div class="border_area r_img">
            <a href="#"><img src="/img/art_detail_right.png" width="298" height="198" border="0"></a>
        </div>
        <h3>阶段选择</h3>
        <div class="border_area r_height">
            <div class="text_list">
                <span class="font_1">备怀孕</span>
                <img id="img_1" src="/img/top.jpg" onclick="showHide(1)">
                <div id="show_1">
                    <p>[&nbsp;<a>饮食</a>&nbsp;]&nbsp;&nbsp;&nbsp; [&nbsp;<a>保健</a>&nbsp;]&nbsp;&nbsp;&nbsp; 
                    [&nbsp;<a>好运</a>&nbsp;]&nbsp;&nbsp;&nbsp;<span class="right">[&nbsp;<a>遗传优生</a>&nbsp;]</span>
                    [&nbsp;<a>不孕不育</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;<a>夫妻生活</a>&nbsp;]&nbsp;&nbsp;<span class="right">[&nbsp;<a>避孕流产</a>&nbsp;]</span>
                    </p>
                </div>
            </div>
            <div class="text_list">
                <span class="font_1">怀孕期</span>
                <img id="img_2" src="/img/top.jpg" onclick="showHide(2)">
                <div id="show_2">
                    <span class="font_2"><a>孕早期</a></span>
                    <p>
                        [&nbsp;<a>母乳喂养</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;<a>人工喂养</a>&nbsp;]&nbsp;&nbsp;<span class="right">[&nbsp;<a>遗传优生</a>&nbsp;]</span>
                        [&nbsp;<a>不孕不育</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;<a>夫妻生活</a>&nbsp;]&nbsp;&nbsp;<span class="right">[&nbsp;<a>避孕流产</a>&nbsp;]</span>
                    </p>
                    <span class="font_2"><a>孕中期</a></span>
                    <p>
                        [&nbsp;<a>产前心理</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;<a>临盆待产</a>&nbsp;]&nbsp;&nbsp;<span class="right">[&nbsp;<a>分娩时刻</a>&nbsp;]</span>
                        [&nbsp;<a>月子护理</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;<a>产后关注</a>&nbsp;]&nbsp;&nbsp;<span class="right">[&nbsp;<a>遗传优生</a>&nbsp;]</span>
                        [&nbsp;<a>饮食</a>&nbsp;]&nbsp;&nbsp;&nbsp; [&nbsp;<a>保健</a>&nbsp;]&nbsp;&nbsp;&nbsp; 
                        [&nbsp;<a>好运</a>&nbsp;]&nbsp;&nbsp;<span class="right">[&nbsp;<a>遗传优生</a>&nbsp;]</span>
                        [&nbsp;<a>不孕不育</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;<a>夫妻生活</a>&nbsp;]&nbsp;&nbsp;<span class="right">[&nbsp;<a>避孕流产</a>&nbsp;]</span>
                    </p>
                    <span class="font_2"><a>孕晚期</a></span>
                    <p>
                        [&nbsp;<a>饮食</a>&nbsp;]&nbsp;&nbsp;&nbsp; [&nbsp;<a>保健</a>&nbsp;]&nbsp;&nbsp;&nbsp; 
                        [&nbsp;<a>好运</a>&nbsp;]&nbsp;&nbsp;<span class="right">[&nbsp;<a>遗传优生</a>&nbsp;]</span>
                        [&nbsp;<a>不孕不育</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;<a>夫妻生活</a>&nbsp;]&nbsp;&nbsp;<span class="right">[&nbsp;<a>避孕流产</a>&nbsp;]</span>
                        [&nbsp;<a>幼儿喂养</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;<a>宝宝食谱</a>&nbsp;]&nbsp;&nbsp;<span class="right">[&nbsp;<a>幼儿喂养</a>&nbsp;]</span>
                        [&nbsp;<a>不孕不育</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;<a>夫妻生活</a>&nbsp;]  
                    </p>
                </div>
            </div>
            <div class="text_list">
                <span class="font_1">分娩期</span>
                <img id="img_3" src="/img/top.jpg" onclick="showHide(3)">
                <div id="show_3">
                    <p>
                        [&nbsp;<a>产前心理</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;<a>临盆待产</a>&nbsp;]&nbsp;&nbsp;<span class="right">[&nbsp;<a>分娩时刻</a>&nbsp;]</span>
                        [&nbsp;<a>月子护理</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;<a>产后关注</a>&nbsp;]
                    </p>
                </div>
            </div>
            <div class="text_list">
                <span class="font_1">0-1岁</span>
                <img id="img_4" src="/img/top.jpg" onclick="showHide(4)">
                <div id="show_4">
                    <span class="font_2"><a>0-3个月</a></span>
                    <p>
                        [&nbsp;<a>母乳喂养</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;<a>人工喂养</a>&nbsp;]&nbsp;&nbsp;<span class="right">[&nbsp;<a>微量元素</a>&nbsp;]</span>
                        [&nbsp;<a>体检免疫</a>&nbsp;]&nbsp;&nbsp; [<a>新生儿护理</a>]&nbsp;<span class="right">[<a>新生儿疾病</a>]</span>
                    </p>
                    <span class="font_2"><a>3-1岁</a></span>
                    <p>
                        [&nbsp;<a>母乳喂养</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;<a>人工喂养</a>&nbsp;]&nbsp;&nbsp;<span class="right">[&nbsp;<a>辅食添加</a>&nbsp;]</span>
                        [&nbsp;<a>微量元素</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;<a>体检免疫</a>&nbsp;]&nbsp;&nbsp;<span class="right">[&nbsp;<a>婴儿护理</a>&nbsp;]</span>
                        [&nbsp;<a>婴儿疾病</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;<a>智力开发</a>&nbsp;]&nbsp;&nbsp;<span class="right">[&nbsp;<a>游戏玩具</a>&nbsp;]</span>
                    </p>
                </div>
            </div>
            <div class="text_list">
                <span class="font_1">1-3岁</span>
                <img id="img_5" src="/img/top.jpg" onclick="showHide(5)">
                <div id="show_5">
                    <span class="font_2"><a>幼早期</a></span>
                    <p>
                        [&nbsp;<a>母乳喂养</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;<a>人工喂养</a>&nbsp;]&nbsp;&nbsp;<span class="right">[&nbsp;<a>宝宝食谱</a>&nbsp;]</span>
                        [&nbsp;<a>微量元素</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;<a>体检免疫</a>&nbsp;]&nbsp;&nbsp;<span class="right">[&nbsp;<a>幼儿护理</a>&nbsp;]</span>
                        [&nbsp;<a>幼儿疾病</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;<a>智力开发</a>&nbsp;]&nbsp;&nbsp;<span class="right">[&nbsp;<a>游戏玩具</a>&nbsp;]</span>
                        [&nbsp;<a>生长发育</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;<a>行为教养</a>&nbsp;]
                    </p>
                    <span class="font_2"><a>幼儿期</a></span>
                    <p>
                        [&nbsp;<a>母乳喂养</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;<a>人工喂养</a>&nbsp;]&nbsp;&nbsp;<span class="right">[&nbsp;<a>辅食添加</a>&nbsp;]</span>
                        [&nbsp;<a>微量元素</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;<a>体检免疫</a>&nbsp;]&nbsp;&nbsp;<span class="right">[&nbsp;<a>婴儿护理</a>&nbsp;]</span>
                        [&nbsp;<a>婴儿疾病</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;<a>智力开发</a>&nbsp;]&nbsp;&nbsp;<span class="right">[&nbsp;<a>游戏玩具</a>&nbsp;]</span>
                        [&nbsp;<a>生长发育</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;<a>行为教养</a>&nbsp;]
                    </p>
                </div>
            </div>
            <div class="text_list no_border">
                <span class="font_1">3-6岁</span>
                <img id="img_6" src="/img/top.jpg" onclick="showHide(6)">
                <div id="show_6">
                    <p>
                        [&nbsp;<a>幼儿喂养</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;<a>宝宝食谱</a>&nbsp;]&nbsp;&nbsp;<span class="right">[&nbsp;<a>生长发育</a>&nbsp;]</span>
                        [&nbsp;<a>体检免疫</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;<a>儿童疾病</a>&nbsp;]&nbsp;&nbsp;<span class="right">[&nbsp;<a>儿童心理</a>&nbsp;]</span>
                        [&nbsp;<a>智力开发</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;<a>生长发育</a>&nbsp;]&nbsp;&nbsp;<span class="right">[&nbsp;<a>行为教养</a>&nbsp;]</span>
                        [&nbsp;<a>才艺培养</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;<a>入园入托</a>&nbsp;]&nbsp;&nbsp;<span class="right">[&nbsp;<a>安全防范</a>&nbsp;]</span>
                        [&nbsp;<a>儿童性教育</a>&nbsp;]
                    </p>
                </div>
            </div>
        </div>
        <h3>标签推荐</h3>
        <div class="border_area r_height">
            <div class="text_list no_border">
                <p>结果快速路    标签1   知识尝试    怀孕 热门标签    举例    关键字    子    优生优
                结果快速路    标签1   知识尝试     生子
                热门标签    举例    关键字     老刘专场
                结果快速路    标签1   知识尝试     尝试
                热门标签    举例    关键字     关键词
                结果快速路    标签1   知识尝试     尝试
                热门标签    举例    关键字     关键词</p>
            </div>
        </div>
    </div><!-- wraper_right -->
</div><!-- wraper -->
<script type="text/javascript">
<!--
//定义百科区域，拼音检索的默认显示拼音
var showKey = '<?php echo $showKey?>';
//-->
</script>
<?php $this->load->view('footer')?>
