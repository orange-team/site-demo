<?php $this->load->view('header')?>
<div id="wraper">
    <div class="site_route">
        您的位置 : <a href="/mmxue/">妈妈学</a> > 用户注册
    </div>
    <div class="content clearfloat">
    <style>
    .reg ,.reg h1{ font-size:20px;color:#ccc;}
    .reg { float:left;display:inline-block;width:505px;height:auto;font-size:20px;color:#ccc;font-weight:bold;margin:70px 80px;}
    .reg .field { float:left;width:305px;height:38px;margin:12px 0 0 0;border:2px solid #ccc;}
    .reg .field label { float:left;width:36px;height:36px; }
    .reg .input { float:left;width:260px;height:38px;font-size:16px;margin:0 0 0 10px;}
    .reg .authcode { width:99%; }
    .reg .authcode .field { width:200px; }
    .reg .authcode .input { width:190px; }
    .reg .authcode .img_authcode { display:inline-block;float:left;width:92px;height:40px;margin:12px 0 0 10px;background:#fcf;}
    .reg .authcode .img_authcode img { display:inline-block;border:none;width:92px;height:40px;}
    .reg .btn_blue { width:98px;height:36px; }
    .reg .btn_orange { width:98px;height:36px; }
    .btn { -moz-border-radius: 4px; -moz-box-shadow: inset 0 1px 0 rgba(255,255,255,.28),0 -1px 1px rgba(0,0,0,.28); -webkit-border-radius: 4px; -webkit-box-shadow: inset 0 1px 0 rgba(255,255,255,.28),inset 0 -1px 1px rgba(0,0,0,.28); background-color: #1bcdcf; border: 1px solid #00acad; border-color: rgba(0,0,0,.1)rgba(0,0,0,.1)rgba(0,0,0,.1)rgba(0,0,0,.1); border-radius: 4px; box-shadow: inset 0 1px 0 rgba(255,255,255,.28),inset 0 -1px 1px rgba(0,0,0,.28); color: #fff; cursor: pointer; display: inline-block; font-family: "Helvetica Neue",helvetica,arial,sans-serif; font-size: 18px; font-weight: 700; line-height: 1; margin: 0; padding: 8px 17px 11px; text-align: center; text-decoration: none; text-shadow: 0 1px 0 rgba(0,0,0,.2); vertical-align: middle; }
    .reg .orange { background-color: #f37049;}
    
    .reg .form_submit {height:60px;line-height:75px;}
    .reg .yes {border:2px solid #6c0;}
    .reg .err {border:2px solid red;}
    .reg .err_txt {float:left;display:inline-block;width:190px;height:42px;line-height:42px;margin:12px 0 0 5px;color:red;font-size:14px;font-weight:normal;}
    .reg .authcode .err_txt { width:90px; }
    .reg .field_protocal { margin:10px 0;font-size:14px;color:#333;font-weight:normal;height:40px;}
    .reg .field_protocal a { text-decoration:none;color:#076699;}
    /*其他登录方式*/
    .other_reg { float:left;display:inline-block;margin:70px 0;padding:0 0 0  65px;border-left:1px solid #c8c8c8;width:205px;height:320px;font-size:20px;color:#585858; }
    .other_reg dl img { float:left;display:inline-block;border:none;width:36px;height:36px;}
    .other_reg dt { color:#666;font-weight:normal;margin:20px 0;}
    .other_reg label {float:left;display:inline-block;height:36px;line-height:36px;margin:0 0 0 10px;}
    .other_reg .to_reg { display:block;width:170;height:26px;margin:40px 0 0 0;padding:8px 0 0 0;font-weight:600;}
    .other_reg a.to_reg:hover { color:#fff; }
    .other_reg a.to_reg { color:#fff; }
    </style>
        <div class="reg clearfloat">
        <?php echo form_open(site_url($this->_info['cls'].'/reg/'.urlencode($this->_ref), array('name'=>'reg',"onsubmit"=>"return chk_reg()")));?>
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
                    <span class="img_authcode"><img src="#" alt="点击获取或换一张" title="点击获取或换一张"/></span>
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
<?php $this->load->view('footer')?>

