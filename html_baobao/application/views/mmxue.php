<?php $this->load->view('header')?>
<div id="wraper" class="clearfloat">
    <div class="site_route">
        您的位置 : 妈妈学
    </div>
    <div class="wraper_left">
       <div class="left">
            <div class="pic_hot clearfloat" id="pic_hot">
                <?php foreach($specArr as $k=>$v) {?>
                <div class="item">
                    <a href="/specpage/index/<?php echo $v['id'];?>/">
                        <img class="pic<?php echo $k+1?> pic_height" src="<?php echo $this->spec_path,$v['cover'];?>" title="<?php echo $v['title']?>"/>
                    </a>
                    <div class="cover pb_opacity" rel="cover"> </div>
                </div>
                <?php } ?>
            </div>

            <div class="wiki">
                <div class="head clearfloat">
                    <h3>育儿百科 ( 专业名词的解释 , 即百科标签 )</h3>
                    <a href="/wiki_dict/index/" class="more">更多百科</a>
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
                    <a href="/wiki/index/<?php echo $v['id']?>/" class="pb_overflow"><?php echo $v['wiki_key']?></a>
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
                        <?php foreach( $timelineArr as $key=>$val ) { ?>
                        <div class="item">
                            <div class="week">
                                <img src="/img/week_num/<?php echo sprintf('%02d',$key);?>.jpg" />
                                <span>周</span>
                            </div>
                            <div class="art clearfloat">
                                <?php foreach( $val as $k=>$v ) { ?>
                                <div class="clearfloat">
                                    <a href="/mmxue_art_detail/index/<?php echo $v['id']?>/" class="pb_overflow"><?php echo $v['title']?></a>
                                    <span>[<a href="/mmxue_art_list/index/<?php echo $v['keyword']?>"><?php echo $v['keywordName']?></a>]</span>
                                </div>
                                <?php } ?>
                            </div>
                            <a href="/mmxue_art_list/index/<?php echo $key?>/" class="more">了解更多</a>
                        </div>
                        <?php } ?>
                    </div><!-- art_list -->
                    <?php if( $this->limit_num < count($timelineArr) ) { ?>
                    <div class="next_page">
                        还在翻页吗?直接选择时间轴吧<a href="#">下一页</a>
                    </div>
                    <?php } ?>
                </div><!-- panel -->
                <div class="panel_3" id="panel_3" style="display:none;">
                    <div class="art_list">
                        <!-- loop start -->
                        <?php if( isset($panel[3]) ) foreach($panel[3] as $k=>$v) {?>
                        <div class="item clearfloat">
                            <div class="title1">产前心理</div>
                            <div class="art clearfloat">
                                <div>
                                    <a href="#" class="pb_overflow">女性养生警惕：怀孕前4件事情不能做</a>
                                </div>
                            </div>
                            <a href=#" class="more">了解更多</a>
                        </div>
                        <?php } ?>
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
                        <img src="/img/week_num/02.jpg" />
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
                        <img src="/img/week_num/02.jpg" />
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
                        <img src="/img/week_num/02.jpg" />
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
                        <img src="/img/week_num/02.jpg" />
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
                        <img src="/img/week_num/02.jpg" />
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
                        <img src="/img/week_num/02.jpg" />
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
                            <img src="/img/week_num/02.jpg" title=""/>
                        </a>
                        <a href="#" class="name">宝宝体重健康计算工具</a>
                    </dt>
                </dl>
                <!-- loop end -->
                <!-- loop start -->
                <dl class="item">
                    <dt>
                        <a href="#">
                            <img src="/img/week_num/02.jpg" title=""/>
                        </a>
                        <a href="#" class="name">宝宝体重健康计算工具</a>
                    </dt>
                </dl>
                <!-- loop end -->
                <!-- loop start -->
                <dl class="item">
                    <dt>
                        <a href="#">
                            <img src="/img/week_num/02.jpg" title=""/>
                        </a>
                        <a href="#" class="name">宝宝体重健康计算工具</a>
                    </dt>
                </dl>
                <!-- loop end -->
                <!-- loop start -->
                <dl class="item">
                    <dt>
                        <a href="#">
                            <img src="/img/week_num/02.jpg" title=""/>
                        </a>
                        <a href="#" class="name">宝宝体重健康计算工具</a>
                    </dt>
                </dl>
                <!-- loop end -->
                <!-- loop start -->
                <dl class="item">
                    <dt>
                        <a href="#">
                            <img src="/img/week_num/02.jpg" title=""/>
                        </a>
                        <a href="#" class="name">宝宝体重健康计算工具</a>
                    </dt>
                </dl>
                <!-- loop end -->
                <!-- loop start -->
                <dl class="item">
                    <dt>
                        <a href="#">
                            <img src="/img/week_num/02.jpg" title=""/>
                        </a>
                        <a href="#" class="name">宝宝体重健康计算工具</a>
                    </dt>
                </dl>
                <!-- loop end -->
            </div><!-- tool -->

        </div><!-- left -->
    </div><!-- wraper_left -->

    <?php $this->load->view('mmxue_right')?>
</div><!-- wraper -->
<script type="text/javascript">
<!--
//定义百科区域，拼音检索的默认显示拼音
var showKey = '<?php echo $showKey?>';
//-->
</script>
<?php $this->load->view('footer')?>
