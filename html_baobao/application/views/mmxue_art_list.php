<div id="wraper" class="clearfloat">
	<div class="bread_nav">
        您的位置 : <?php echo $nav?>
    </div>
    <div class="wraper_left">
        <div class="left">
            <div class="art_hot clearfloat">
                <div class="item first">
                    <img src="http://pic2.nipic.com/20090414/386228_104922058_2.jpg" title="图片名称"/>
                    <a href="#" class="pb_overflow pb_opacity" title="显示整个标题">热门推荐文章热门推荐文章热门推荐文章热门推荐文章</a>
                </div>
                <div class="item">
                    <img src="http://pic2.nipic.com/20090414/386228_104922058_2.jpg" title="图片名称"/>
                    <a href="#" class="pb_overflow pb_opacity" title="显示整个标题">热门推荐文章</a>
                </div>
                <div class="item">
                    <img src="http://pic2.nipic.com/20090414/386228_104922058_2.jpg" title="图片名称"/>
                    <a href="#" class="pb_overflow pb_opacity">热门推荐文章热门推荐文章</a>
                </div>
            </div>
            <div class="art_list" id="art_list">
                <!-- loop start -->
                <?php if( !empty($articleArr) ) {foreach($articleArr as $k=>$row) { ?>
                <div class="item" onmouseover="show_tag(this)" onmouseout="hide_tag(this)">
                    <div class="item_title clearfloat">
                        <a href="/mmxue_art_detail/index/<?php echo $row['id']?>" class="pb_overflow"><?php echo $row['title']?></a>
                        <span>关注度：<em>78</em></span>
                    </div>
                    <div class="item_desc">
                        <?php 
                        echo mb_substr(strip_tags($row['content']),0,100,'utf-8');
                        if( mb_strlen($row['content'])>100 )echo '...';
                        ?>
                        <span>[ <a href="/mmxue_art_detail/index/<?php echo $row['id']?>">详情</a> ]</span>
                    </div>
                    <div class="item_tag pb_opacity" rel="tag">
                        标签：<a href="#">宝宝</a> <a href="#">早教</a> <a href="#">睡觉</a>
                    </div>
                </div>
                <?php }} ?>
                <!-- loop end -->
            </div><!-- art_list -->
            <div class="page" >
            <span class="num">共 <?php echo $total_rows;?> 篇<?php echo $section?></span>
                <div class="page_list">
                <form action='/mmxue_art_list/index/<?php echo $section;?>' method="post">
                    <?php echo (!empty($page)) ? $page : '';?>
                    <!--<span>跳转<input type="text" name="go_page" value="<?php echo $go_page;?>"  onblur="search_go(this.value)"/></span>-->
                    &nbsp;&nbsp;<span>跳至第
                        <select name="go_page" onchange="search_go(this.value)" style="cursor: pointer;">
                            <?php for($i=1; $i<=$total_rows; $i++){?>
                            <option value="<?php echo $i;?>" <?php echo $go_page==$i? 'selected' : '' ?> style="cursor: pointer;"><?php echo $i;?></option>
                            <?php }?>
                        </select>
                    页</span>
                </form>
                </div>
            </div><!-- page -->

        </div><!-- left -->
    </div><!-- wraper_left -->

