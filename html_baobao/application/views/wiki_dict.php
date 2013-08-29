<?php $this->load->view('header')?>
<div id="wraper">
    <div class="site_route">
        您的位置 : <a href="#">妈妈学</a> > 百科知识
    </div>
    <div class="content">
        <div class="wiki clearfloat" id="myTop">
            <div class="letter">
                <div class="note">按字母检索</div>
                <div id="letter_nav">
                    <a rel="#A">A</a><a rel="#B">B</a><a rel="#C">C</a><a rel="#D">D</a><a rel="#E">E</a><a rel="#F">F</a><a rel="#G">G</a><a rel="#H">H</a><a rel="#I">I</a><a rel="#J">J</a><a rel="#K">K</a><a rel="#L">L</a> <a rel="#M">M</a><a rel="#N">N</a><a rel="#O">O</a><a rel="#P">P</a><a rel="#Q">Q</a><a rel="#R">R</a><a rel="#S">S</a><a rel="#T">T</a><a rel="#U">U</a><a rel="#V">V</a><a rel="#W">W</a><a rel="#X">X</a><a rel="#Y">Y</a><a rel="#Z">Z</a>
                </div>
            </div>
            <?php foreach($keyArr as $key=>$val) {?>
            <div class="item clearfloat">
                <b class="key" id="<?php echo $key?>" title="点击返回字母检索区域"><?php echo $key?></b>
                <div class="tag">
                <?php if(0>=count($val)) echo '<p>抱歉，该字母索引下暂时还没有百科关键词</p>';
                foreach($val as $k=>$v) {?>
                    <a href="/wiki/index/<?php echo $v['id']?>/" <?php if(0==$k) echo 'class="first"';?>><?php echo $v['wiki_key']?></a>
                <?php } ?>
                </div>
            </div>
            <?php } ?>
  </div><!-- content -->
</div>
<?php $this->load->view('footer')?>

