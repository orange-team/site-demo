<?php $this->load->view('header')?>
<div id="wraper">
    <div class="content clearfloat">
        <div class="user_login clearfloat">
        <?php echo form_open(site_url($this->_info['cls'].'/login/'.urlencode($this->_ref), array('name'=>'user_login',"onsubmit"=>"return chk_login()")));?>
            <h1>登录蜡笔画</h1>
            <div class="field-input clearfloat">
                <div id="customer_email_wrap" class="field err">
                    <label for="user_email"> </label>
                    <input type="email" value="" placeholder="邮箱" tabindex="1" class="input" name="user_email" maxlength="255" id="user_email">
                </div>
                <span class="err_txt clearfloat">邮箱格式错误</span>
                <div id="customer_password_wrap" class="field yes">
                    <label for="user_password"> </label>
                    <input type="password" value="" placeholder="密码" tabindex="2" class="input" name="user_password" autocomplete="off" id="user_password">
                </div>
                <span class="err_txt clearfloat">用户名或密码错误</span>
            </div>
            <div id="remember_wrap" class="field_autologin">
				<label for="remember">
					<input type="checkbox" value="true" class="chk_box_middle" name="remember" id="remember">
					记住我,一周之内自动登录
				</label>
			</div>
            <div class="form_footer">
				<button type="submit" class="btn"><span>登录</span></button>
			</div>
        </form>
        </div><!-- user_login -->
        <div class="other_login clearfloat">
            其他登录方式
            <dl>
            <dt class="clearfloat"><img src="#" id="weibo"/><label for="weibo">用微博账号登录</label></dt>
            <dt class="clearfloat"><img src="#" id="weibo"/><label for="weibo">用微博账号登录</label></dt>
            </dl>
            <a href="#" class="to_reg btn orange">还没有账号,注册</a>
        </div>
  </div><!-- content -->
</div>
<?php $this->load->view('footer')?>

