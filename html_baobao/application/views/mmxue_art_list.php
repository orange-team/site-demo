<?php $this->load->view('header')?>
<div id="wraper" class="clearfloat">
	<div class="bread_nav">
        您的位置 : <?php echo $nav?>
    </div>
    <div class="wraper_left">
        <div class="left">
            <div class="art_hot clearfloat">
                <?php foreach($specpage as $k=>$v){ ?>
                <?php if(0==$k){?>
                <div class="item first">
                <?php }else{?>
                <div class="item">
                <?php }?>
                    <img src="<?php echo $v['cover']?>" title="<?php echo $v['title']?>"/>
                    <a href="/specpage/index/<?php echo $v['id'];?>/" class="pb_overflow pb_opacity" title="<?php echo $v['title'];?>"><?php echo $v['title']?></a>
                </div>
                <?php }?>
            </div>
            <div class="art_list" id="art_list">
                <!-- loop start -->
                <?php if( !empty($articleArr) ) {foreach($articleArr as $k=>$row) { ?>
                <div class="item" onmouseover="show_tag(this)" onmouseout="hide_tag(this)">
                    <div class="item_title clearfloat">
                        <a href="/mmxue_art_detail/index/<?php echo $row['id']?>" class="pb_overflow"><?php echo $row['title']?></a>
                        <span>关注度：<em><?php echo $row['attention']?></em></span>
                    </div>
                    <div class="item_desc">
                        <?php 
                        echo mb_substr(strip_tags($row['content']),0,100,'utf-8');
                        if( mb_strlen($row['content'])>100 )echo '...';
                        ?>
                        <span>[ <a href="/mmxue_art_detail/index/<?php echo $row['id']?>">详情</a> ]</span>
                    </div>
                    <div class="item_tag pb_opacity" rel="tag">
                        标签：<?php foreach($row['tags'] as $v){?>
                                <a href="#"><?php echo $v['name']?></a>
                              <?php } ?>
                    </div>
                </div>
                <?php }} ?>
                <!-- loop end -->
            </div><!-- art_list -->
            <div class="page" >
            <span class="num">共 <?php echo $total_rows;?> 篇</span>
                <div class="page_list">
                <form action='/mmxue_art_list/index/<?php echo $section;?>' method="post">
                    <?php echo (!empty($page)) ? $page : '';?>
                    <!--<span>跳转<input type="text" name="go_page" value="<?php echo $go_page;?>"  onblur="search_go(this.value)"/></span>-->
                    &nbsp;&nbsp;<span>跳至第
                        <select name="go_page" onchange="search_go(this.value)" style="cursor: pointer;">
                            <?php for($i=1; $i<=$countPage; $i++){?>
                            <option value="<?php echo $i;?>" <?php echo $go_page==$i? 'selected' : '' ?> style="cursor: pointer;"><?php echo $i;?></option>
                            <?php }?>
                        </select>
                    页</span>
                </form>
                </div>
            </div><!-- page -->

        </div><!-- left -->
    </div><!-- wraper_left -->
    <?php $this->load->view('mmxue_static_right');?>
</div>
<?php $this->load->view('footer')?>

