<?php $this->load->view('header')?>
<div id="wraper">
    <div class="site_route">
        您的位置：<?php echo $nav?>
    </div>
    <div class="wraper_left">
        <div class="w_left_top">
            <h1><?php echo $title ?> <img class="title_b" src="<?php echo base_url();?>img/title_button.jpg" onmouseover="showTitle()" onmouseout="hideTitle()"></h1>
            <div id="info" > 日期：<?php echo $add_time;?> &nbsp;&nbsp; 作者：<?php echo $author?> &nbsp;&nbsp; 来源：<?php echo $source;?> </div>
        </div>    
        <div class="art_detail">
            <?php echo $content;?>
        </div>
        <div class="share"> 分享位置： </div>
        <div class="detail_page">
        <a href="<?php echo base_url()?>mmxue_art_detail/index/<?php echo $pre?>" >上一篇</a> &nbsp;&nbsp;
        <a href="<?php echo base_url()?>mmxue_art_detail/index/<?php echo $next?>" >下一篇</a>
        </div>
        <div class="clear"></div>
        <h2>相关文章推荐</h2>
        <div class="art_detail_list">
            <ul> 
                <?php foreach($artList_1 as $v){?>
                <li><span><a href="/mmxue_art_detail/index/<?php echo $v['id']?>"><?php echo $v['title']?></a></span></li>
                <?php }?>
            </ul>
            <ul> 
                <?php foreach($artList_2 as $v){?>
                <li><span><a href="/mmxue_art_detail/index/<?php echo $v['id']?>"><?php echo $v['title']?></a></span></li>
                <?php }?>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
    <?php $this->load->view('mmxue_right');?>
</div>
<?php $this->load->view('footer')?>
