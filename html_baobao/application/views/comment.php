<?php
$CI = &get_instance();
$CI->load->helper('form');
$CI->load->model('comment_model','comment');
$CI->load->model('reply_model','reply');
$CI->load->model('user_model','user');
//检查参数是否完整
//type, target_id, ref
//初始化参数,由controller传入
$CI->comment->_get_table($type);
$CI->reply->_get_table($type);
//判断用户是否登录
$login = true;
if(!isset($this->_user['id']) || 0>=$this->_user['id'])
{
    $login = false;
}
$where = array('c_status'=>1,'target_id'=>$target_id);
$commentArr = $CI->comment->getList(20, 0, $where);
$commentNum = $CI->comment->getTotal($where);
$replyArr = $userArr = array();
/*
foreach($commentArr as $key=>$val)
{
    //获取用户名
    if(!isset($userArr[$val['user_id']]))
    {
        $arr = $CI->user->getFieldBy_id($val['user_id'],'user_nickname');
        $userArr[$val['user_id']] = $arr['user_nickname'];
    }
    if(0>=$val['reply_num']) continue;
    //获取回复
    $replyArr[$val['id']][] = $CI->reply->getList('','',array('audit_status'=>1,'comment_id'=>$val['id']));
}
var_dump($commentArr,$replyArr);
*/
?>
<link href="/css/comment.css" rel="stylesheet" type="text/css" />
<div class="discuss">
    <h2>网友评论</h2>
    <dl>
        <?php if(0>=count($commentArr)) echo '<span style="display:block;height:35px;line-height:35px;text-align:center;">暂无评论</span>';?>
        <?php
        foreach($commentArr as $key=>$val) {
        $user = $CI->user->getFieldBy_id($val['user_id'],'user_nickname');
        ?>
        <dt class="clearfloat" id="comment_<?php echo $val['id']?>" onmouseover="javascript:$(this).find('a.reply').first().show();" onmouseout="javascript:$(this).find('a.reply').first().hide();">
            <a href="#"><img class="avator" src="/img/defaultAvator.png"></a>
            <div class="right">
                <div class="first">
                    <a class="user_name" href="#"><?php echo $user['user_nickname']?></a>：<?php echo $val['content']?>
                </div>
                <div class="info"><?php echo $val['add_time']?>
                    <?php if($login == false){ ?>
                    <a rel="modalLink" class="reply" href="#modalA">回复</a>
                    <?php }else{ ?>
                    <a class="reply" href="javascript:comment.toggleReplyDiv(<?php echo $val['id']?>);">回复</a>
                    <?php } ?>
                </div>
                <div class="reply_content">
                    <textarea id="reply_txt_<?php echo $val['id']?>"></textarea>
                    <span class="tip">请输入不超出200字的评论</span>
                    <button type="button" onclick="javascript:comment.reply(this,<?php echo $val['id']?>)">发表</button>
                </div>
                <!--reply part-->
                <?php
                if(0<$val['reply_num']) { 
                //获取回复
                $reply = $CI->reply->getList('','',array('audit_status'=>1,'comment_id'=>$val['id']));
                if( 0>=count($reply) ) continue;
                //var_dump(count($reply), $reply);exit;
                ?>
                <dl class="reply_part">
                    <?php foreach($reply as $k=>$v) {
                    if( 0>=count($v) ) continue;
                    $user = array();
                    $user = $CI->user->getFieldBy_id($v['user_id'],'user_nickname');
                    ?>
                    <dt onmouseover="javascript:$(this).find('a.reply').first().show();" onmouseout="javascript:$(this).find('a.reply').first().hide();">
                        <a href="#"><img class="avator_tiny" src="/img/defaultAvator.png"></a>
                        <div class="reply_right">
                            <a class="user_name" href="#"><?php echo $user['user_nickname']?></a>
                            <div class="reply_txt">
                            <?php echo $v['content']?>
                            </div>
                            <div class="info"><?php echo $v['add_time']?> 赞 <em><?php echo $v['recommand']?></em>
                                <?php if($login == false){ ?>
                                <a rel="modalLink" class="reply" href="#modalA">赞</a>
                                <?php }else{ ?>
                                <a class="reply" href="javascript:;" onclick="javascript:comment.praise(this,<?php echo $v['id']?>)">赞</a>
                                <?php } ?>
                            </div>
                        </div>
                    </dt>
                    <?php } ?>
                </dl>
                <?php } ?>
                <!--/reply part-->
            </div>
        </dt> 
        <?php } ?>
    </dl>
    <?php if(0<$commentNum) {?><div class="num clearfloat"><span>共<?php echo $commentNum?>条评论</span></div><?php } ?>
    <div class="reply_bottom">
        <span>发表评论</span>
        <?php if($login == false) { ?>
        <div class="need_login">
        您需要登录后才能评论 <a rel="modalLink" href="#modalA">登录</a> | <a href="javascript:reg();">入住</a> 蜡笔画
        </div>
        <?php } else { ?>
        <?php echo form_open(site_url('comment/saveAdd/?type=1&target_id='.(int)$target_id.'&ref='.$ref), array("onsubmit"=>"return comment.chk()"));?>
        <textarea name="content" id="comment_txt"></textarea>
        <span class="tip">请输入不超出200字的评论</span>
        <button type="submit">发表</button>
        <a class="login" href="javascript:logout();">退出</a>
        </form>
        <?php } ?>
    </div>
</div><!--/discuss-->
<script type='text/javascript' src='/js/jquery.modal.min.js'></script>
<script type="text/javascript" src="/js/jquery.jqEasyCharCounter.min.js"></script>
<script type="text/javascript">
// jquery-character-counter
$('#comment_txt').jqEasyCounter({
    'maxChars': 200,
    'maxCharsWarning': 190,
    'msgFontSize': '12px',
    'msgFontColor': '#000',
    'msgFontFamily': 'Arial',
    'msgTextAlign': 'left',
    'msgWarningColor': '#F00',
    //'msgAppendMethod': 'insertBefore'              
});
var comment = {
    //对象id，如：一个问题
    target_id : 1,
    reply : function(handle, comment_id) {
        var reply_txt = $('#reply_txt_'+comment_id);
        if(''==reply_txt.val()) {
            return reply_txt.addClass('err').focus();
        }
        $(handle).text('发布中...').attr('onclick','javascript:;');
        $.post('/comment/reply/?type=1',{comment_id:comment_id,content:reply_txt.val()},function(data){
            if(1==data) {
                //回复成功刷新页面
                window.location.reload();
            }
        });
    },
    praise : function(handle, reply_id) {
        $(handle).attr('onclick','javascript:;');
        var zan = $(handle).prev().text();
        $(handle).prev().text(++zan);
        $.post('/comment/praise/?type=1',{reply_id:reply_id},function(data){
            if(1==data) {
                //赞，成功
            }
        });
    },
    chk : function() {
        var txt = $.trim($('#comment_txt').val());
        if(''==txt) {
            this.err();
            return false;
        }
    },
    //提示信息
    err : function() {
        $('#comment_txt').addClass('err').focus();
    },
    //显示回复区域
    toggleReplyDiv : function(id) {
        var area = $('#comment_'+id).find('textarea');
        var replyDiv = $('#comment_'+id).find('div.reply_content');
        replyDiv.fadeToggle('200','linear');
        if(replyDiv.css('display')=='block') area.focus();
    },
};
</script>
