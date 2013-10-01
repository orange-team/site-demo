<?php $this->load->view('header')?>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/validate_reg.js?v=<?php echo rand()?>"></script>
<div id="wraper">
    <div class="content clearfloat">
        <div class="reg clearfloat">
        <?php echo form_open(site_url('user_reg/?ref='.urlencode($ref)), array('name'=>'reg_form','id'=>'reg_form'));?>
            <h1>注册蜡笔画</h1>
            <div class="field_input">
                <input type="text" value="" placeholder="昵称" tabindex="1" class="input" name="nickname" maxlength="255" id="nickname">
                <input type="email" value="" placeholder="邮箱" tabindex="2" class="input" name="email" maxlength="255" id="email">
                <input type="password" value="" placeholder="密码" tabindex="3" class="input" name="password" autocomplete="off" id="password">
                <input type="text" value="" placeholder="验证码" tabindex="4" class="authcode input" name="authcode" autocomplete="off" id="authcode">
                <img src="<?php echo site_url('/authcode/')?>" class="img_authcode" onclick="ReIMG(this,'/authcode/')" alt="点击获取或换一张" title="点击获取或换一张"/>
            </div>
            <dl class="field_label clearfloat">
                <dt class="label">&nbsp;<label for="nickname" class="error"> </label></dt>
                <dt class="label">&nbsp;<label for="email" class="error"> </label></dt>
                <dt class="label">&nbsp;<label for="password" class="error"> </label></dt>
                <dt class="label">&nbsp;<label for="authcode" class="error"> </label></dt>
            </dl>
            <div class="form_submit">
				<button type="submit" class="btn" id="submit_btn"><span>注册</span></button>
			</div>
            <div class="field_agreement">
				<label for="agreement">
					<input type="checkbox" value="true" checked class="chk_box_middle" name="agreement" id="agreement">
					我已阅读并接受<a href="#">《使用协议》</a>
				</label>
                <label for="agreement" class="error"> </label>
			</div>
        </form>
        </div><!-- reg -->
        <div class="other_reg clearfloat">
            快速注册登录
            <a href="<?php echo site_url('/user_login/')?>" class="to_reg btn orange">已有账号登录</a>
            <dl>
            <dt class="clearfloat"><img src="#" id="weibo"/><label for="weibo">用微博账号登录</label></dt>
            <dt class="clearfloat"><img src="#" id="weibo"/><label for="weibo">用微博账号登录</label></dt>
            </dl>
        </div>
  </div><!-- content -->
</div>
<script type="text/javascript">
//刷新验证码
function ReIMG(obj,url){
    obj.src = url + "?t="+100*Math.random();
}
$('#nickname').focus();
</script>
<?php $this->load->view('footer')?>

