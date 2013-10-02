<?php $this->load->view('header')?>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/validate_login.js?v=<?php echo rand()?>"></script>
<div id="wraper">
    <div class="content clearfloat">
        <div class="reg clearfloat">
        <?php echo form_open(site_url('/user_login/?ref='.urlencode($ref)), array('name'=>'user_login','id'=>'login_form'));?>
            <h1>登录蜡笔画</h1>
            <div class="field_input">
                <input type="email" value="<?php echo $email?>" placeholder="邮箱" tabindex="1" class="input email" name="email" id="email">
                <input type="password" value="" placeholder="密码" tabindex="2" class="input passwd" name="password" autocomplete="off" id="password">
            </div>
            <dl class="field_label clearfloat">
                <dt class="label">&nbsp;<label for="email" class="error"> </label></dt>
                <dt class="label">&nbsp;<label for="password" class="error"></label></dt>
            </dl>
            <label for="remember" class="remember">
                        <input type="checkbox" value="true" checked class="chk_box_middle" name="remember" id="remember">
                        记住我,一周之内自动登录
                    </label>
                    <label for="remember" class="error"> </label>
            <div class="form_submit">
				<button type="submit" class="btn"><span>登录</span></button>
			</div>
        </form>
        </div><!-- user_login -->
        <div class="other_reg clearfloat">
            其他登录方式
            <dl>
            <dt class="clearfloat">
                <a href="#" id="sina"><img src="/img/login_sina.png"/><span>用微博账号登录</span></a>
            </dt>
            <dt class="clearfloat">
                <a href="#" id="qq"><img src="/img/login_qq.png"/><span>用QQ账号登录</span></a>
            </dt>
            <dt class="clearfloat">
                <a href="#" id="taobao"><img src="/img/login_taobao.png"/><span>用淘宝账号登录</span></a>
            </dt>
            </dl>
            <a href="<?php echo site_url('/user_reg/')?>" class="to_reg btn orange">还没有账号,注册</a>
        </div>
  </div><!-- content -->
</div>
<script type="text/javascript">
$('#email').focus();
 <?php if(isset($msg)){ ?>
 $('#password').focus().attr('class','input passwd error');
 $('label[for=password]').css('display','inline').text('<?php echo $msg?>');
 <?php } ?>
</script>
<?php $this->load->view('footer')?>
