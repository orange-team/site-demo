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
$where = array('c_status'=>1,'target_id'=>$target_id);
$commentArr = $CI->comment->getList(20, 0, $where);
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
        <?php
        foreach($commentArr as $key=>$val) {
        $user = $CI->user->getFieldBy_id($val['user_id'],'user_nickname');
        ?>
        <dt class="clearfloat">
            <a href="#"><img class="avator" src="img/gift.png"></a>
            <div class="right">
                <div class="first">
                    <a class="user_name" href="#"><?php echo $user['user_nickname']?></a>：<?php echo $val['content']?>
                </div>
                <div class="info">来自 新浪微博  <?php echo $val['add_time']?>
                    <a class="reply" href="#">回复</a>
                </div>
                <div class="reply_content" style="display:block;">
                    <textarea id="reply_txt_<?php echo $val['id']?>"></textarea>
                    <span class="tip">请输入不超出200字的评论</span>
                    <button type="button" onclick="javascript:comment.reply(this,<?php echo $val['id']?>">发表</button>
                </div>
                <!--reply part-->
                <?php
                if(0<$val['reply_num']) { 
                //获取回复
                $reply[] = $CI->reply->getList('','',array('audit_status'=>1,'comment_id'=>$val['id']));
                if( 0>=count($reply) ) continue;
                //var_dump(count($reply));exit;
                ?>
                <dl class="reply_part">
                    <?php foreach($reply as $k=>$v) {
                    if( 0>=count($v) ) continue;
                    $user = array();
                    $user = $CI->user->getFieldBy_id($v['user_id'],'user_nickname');
                    ?>
                    <dt>
                        <a href="#"><img class="avator_tiny" src="img/gift.png"></a>
                        <div class="reply_right">
                            <a class="user_name" href="#"><?php echo $user['user_nickname']?></a>
                            <div class="reply_txt">
                            <?php echo $v['content']?>
                            </div>
                            <div class="info">来自 新浪微博  <?php echo $v['add_time']?>
                                <a class="reply" href="javascript:;" onclick="javascript:comment.praise(this,<?php echo $v['id']?>)">赞</a>
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
    <div class="num clearfloat"><span>共4条评论</span></div>
    <div class="reply_bottom">
        <span>发表评论</span>
        <?php echo form_open(site_url('comment/saveAdd/?type=1&target_id='.(int)$target_id.'&ref='.$ref), array("onsubmit"=>"return comment.chk()"));?>
        <textarea name="content" id="comment_txt"></textarea>
        <span class="tip">请输入不超出200字的评论</span>
        <button type="submit">发表</button>
        <a class="login" href="#">登录</a>
        </form>
    </div>
</div><!--/discuss-->
<script type="text/javascript">
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
                //window.location.reload();
            }
        });
    },
    praise : function(handle, reply_id) {
        $(handle).attr('onclick','javascript:;');
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
};
</script>
