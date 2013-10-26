<?php $this->load->view('header');?>
<div id="wraper" class="clearfloat">
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
    <?php $this->load->view('comment', array('type'=>1,'target_id'=>$art['id'], 'ref'=>$this->_uri)); ?>
    </div><!--wraper_left-->
    <div class="wraper_right">
        <div class="recommend">
            <h3>相关经历</h3>
            <dl class="list">
            <!--loop start-->
            <?php foreach($relation as $item) { ?>
                <dt><a href="<?php echo $item['id'];?>" class="pb_overflow"><?php echo $item['title'];?></a><span><?php echo $item['pv'];?></span></dt>
            <?php } ?>
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
</div>
<?php $this->load->view('user_login_div')?>
<?php $this->load->view('footer')?>

