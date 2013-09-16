<?php $this->load->view('header')?>
<div id="wraper">
    <div class="site_route">
        您的位置 : <a href="/mmxue/">妈妈学</a> > 用户登录
    </div>
    <div class="content clearfloat">
    <style>
    .user_login ,.user_login h1{ font-size:20px;color:#ccc;}
    .user_login { float:left;display:inline-block;width:505px;height:auto;font-size:20px;color:#ccc;font-weight:bold;margin:70px 80px;}
    .user_login .field { float:left;width:305px;height:38px;margin:12px 0 0 0;border:2px solid #ccc;}
    .user_login .field label { float:left;width:36px;height:36px; }
    .user_login .input { float:left;width:260px;height:38px;font-size:16px;}
    .user_login .field_autologin { margin:15px 0 0 0;font-size:14px;color:#333;font-weight:normal;height:40px;}
    .user_login .btn_blue { width:98px;height:36px; }
    .btn_blue { -moz-border-radius: 4px; -moz-box-shadow: inset 0 1px 0 rgba(255,255,255,.28),0 -1px 1px rgba(0,0,0,.28); -webkit-border-radius: 4px; -webkit-box-shadow: inset 0 1px 0 rgba(255,255,255,.28),inset 0 -1px 1px rgba(0,0,0,.28); background-color: #1bcdcf; border: 1px solid #00acad; border-color: rgba(0,0,0,.1)rgba(0,0,0,.1)rgba(0,0,0,.1)rgba(0,0,0,.1); border-radius: 4px; box-shadow: inset 0 1px 0 rgba(255,255,255,.28),inset 0 -1px 1px rgba(0,0,0,.28); color: #fff; cursor: pointer; display: inline-block; font-family: "Helvetica Neue",helvetica,arial,sans-serif; font-size: 18px; font-weight: 700; line-height: 1; margin: 0; padding: 8px 17px 11px; text-align: center; text-decoration: none; text-shadow: 0 1px 0 rgba(0,0,0,.2); vertical-align: middle; }
    .user_login .yes {border:2px solid #6c0;}
    .user_login .err {border:2px solid red;}
    .user_login .err_txt {float:left;display:inline-block;width:190px;height:42px;line-height:42px;margin:12px 0 0 5px;color:red;font-size:14px;font-weight:normal;}

    .other_login { float:left;display:inline-block;margin:70px 0;padding:0 0 0  65px;border-left:1px solid #c8c8c8;width:205px;height:320px;font-size:20px;color:#585858; }
    .other_login dl img { float:left;display:inline-block;border:none;width:36px;height:36px;}
    .other_login dt { color:#666;font-weight:normal;margin:20px 0;}
    .other_login label {float:left;display:inline-block;height:36px;line-height:36px;margin:0 0 0 10px;}
    .other_login .to_reg { display:block;width:170;height:26px;margin:40px 0 0 0;padding:8px 0 0 0;font-weight:600;}
    .other_login a.to_reg:hover { color:#fff; }
    </style>
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
				<button type="submit" class="btn_blue"><span>登录</span></button>
			</div>
        </form>
        </div><!-- user_login -->
        <div class="other_login clearfloat">
            其他登录方式
            <dl>
            <dt class="clearfloat"><img src="#" id="weibo"/><label for="weibo">用微博账号登录</label></dt>
            <dt class="clearfloat"><img src="#" id="weibo"/><label for="weibo">用微博账号登录</label></dt>
            </dl>
            <a href="#" class="to_reg btn_orange">还没有账号,注册</a>
        </div>
  </div><!-- content -->
</div>
<?php $this->load->view('footer')?>

