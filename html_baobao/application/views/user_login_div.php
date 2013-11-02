<!--user_login-->
<link href="/css/user_login_div.css" rel="stylesheet" type="text/css" />
<div class="overlay"></div>
<div id="modalA" class="modal">
    <p class="closeBtn" title="关闭">X</p>
        <div class="reg clearfloat">
        <?php echo form_open(site_url('/user_login/?ref='.urlencode($ref)), array('name'=>'user_login','id'=>'login_form'));?>
            <h3>登录蜡笔画</h3>
            <div class="field_input">
                <input type="email" value="" placeholder="邮箱" tabindex="1" class="input email" name="email" id="email">
                <input type="password" value="" placeholder="密码" tabindex="2" class="input passwd" name="password" autocomplete="off" id="password">
            </div>
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
</div>
<script type='text/javascript' src='/js/jquery.modal.min.js'></script>
<script type='text/javascript' src='/js/jquery.modal.conf.js'></script>
<!--user_login-->

