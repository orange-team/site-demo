<?php $this->load->view('header')?>
<div id="wraper">
    <div class="site_route">
        您的位置 : <a href="/mmxue/">妈妈学</a> &gt; <a href="#">专栏</a> &gt; <?php echo $specpageArr['title'];?>
    </div>
    <div class="wraper_left">
        <div class="w_left_top">
            <h1><?php echo $specpageArr['title'];?> <img class="title_b" src="<?php echo base_url();?>img/title_button.jpg" onmouseover="showTitle()" onmouseout="hideTitle()"></h1>
            <div id="info" > 日期：<?php echo $specpageArr['add_time'];?> &nbsp;&nbsp; 作者：张三 &nbsp;&nbsp; 来源：<?php echo $specpageArr['source'];?> </div>
        </div>    
        <div class="art_detail">
            <?php echo $specpageArr['content'];?>
        </div>
        <?php
        $this->load->helper('tool');
        bdshare();
        ?>
        <div class="detail_page">
            <?php if( 0<count($prev) && isset($prev['id']) ) {?>
            <a href="<?php echo base_url()?>specpage/index/<?php echo $prev['id']?>/">上一篇</a><?php } ?>&nbsp;&nbsp;
            <?php if( 0<count($next) && isset($next['id']) ) {?>
            <a href="<?php echo base_url()?>specpage/index/<?php echo $next['id']?>/">下一篇</a>
            <?php } ?>
        </div>
        <div class="clear"></div>
        <h2>相关文章推荐</h2>
        <div class="art_detail_list">
            <ul> 
                <?php foreach($recommend as $k=>$v) { if( 4==$k ) return; ?>
                <li><span><a href="/mmxue_art_detail/index/<?php echo $v['id']?>"><?php echo $v['title']?></a></span></li>
                <?php } ?>
            </ul>
            <ul> 
                <?php foreach($recommend as $k=>$v) { if( 4<$k ) { ?>
                <li><span><a href="/mmxue_art_detail/index/<?php echo $v['id']?>"><?php echo $v['title']?></a></span></li>
                <?php }} ?>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
    <?php $this->load->view('mmxue_right')?>

<?php $this->load->view('footer')?>
