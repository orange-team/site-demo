<?php $this->load->view('header')?>
<div id="wraper">
    <div class="content clearfloat">
        <div class="reg clearfloat">
        <?php echo form_open(site_url('user_act/reg/'.urlencode($this->_ref), array('name'=>'reg',"onsubmit"=>"return chk_reg()")));?>
            <h1>注册蜡笔画</h1>
            <div class="field-input clearfloat">
                <div id="customer_email_wrap" class="field err">
                    <input type="text" value="" placeholder="昵称" tabindex="1" class="input" name="nickname" maxlength="255" id="email">
                </div>
                <div id="customer_email_wrap" class="field err">
                    <input type="email" value="" placeholder="邮箱" tabindex="2" class="input" name="email" maxlength="255" id="email">
                </div>
                <span class="err_txt clearfloat">邮箱格式错误</span>
                <div id="customer_password_wrap" class="field yes">
                    <input type="password" value="" placeholder="密码" tabindex="3" class="input" name="password" autocomplete="off" id="password">
                </div>
                <span class="err_txt clearfloat">用户名或密码错误</span>
                <div class="authcode">
                    <div id="customer_authcode_wrap" class="field clearfloat">
                        <input type="text" value="" placeholder="验证码" tabindex="4" class="input" name="authcode" autocomplete="off" id="authcode">
                    </div>
                    <span class="img_authcode">
                    <img src="/authcode/" style="cursor:pointer" onclick="ReIMG(this,'/authcode/')" alt="点击获取或换一张" title="点击获取或换一张"/>
                    </span>
                    <span class="err_txt">验证码</span>
                </div>
            </div>
            <div class="form_submit">
				<button type="submit" class="btn"><span>注册</span></button>
			</div>
            <div id="remember_wrap" class="field_protocal">
				<label for="remember">
					<input type="checkbox" value="true" checked class="chk_box_middle" name="remember" id="remember">
					我已阅读并接受<a href="#">《使用协议》</a>
				</label>
			</div>
        </form>
        </div><!-- reg -->
        <div class="other_reg clearfloat">
            快速注册登录
            <a href="#" class="to_reg btn orange">已有账号登录</a>
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
</script>

<?php $this->load->view('footer')?>

