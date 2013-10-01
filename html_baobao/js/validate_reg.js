$(document).ready(function() {
    $("#reg_form").validate({
        rules: {
            "nickname":{"required":true,"minlength":"2"},
            "email":{
                "required":true,
                "email":true,
                "remote": {
                    "url": "/user_reg/chk_email/",
                    "type": "post",
                    "data": {
                        "type":1,"email": function() { return $("#email").val(); }
                    }
                }
            },
            "password":{"required":true,"minlength":"6"},
            "authcode":{
                "required":true,
                "minlength":"4",
                "maxlength":"4",
                "remote": {
                    "url": "/user_reg/chk_authcode/",
                    "type": "post",
                    "data": {
                        "authcode": function() { return $("#authcode").val(); }
                    }
                }
            },
            "agreement":{"required":true}
            },
        messages: {
            "nickname":{"required":"昵称不能为空","minlength":"昵称至少要2个字符"},
            "email":{"required":"邮箱不能为空","email":"邮箱格式不正确","remote":"该邮箱已被注册"},
            "password":{"required":"密码不能为空","minlength":"密码至少要6个字符"},
            "authcode":{"required":"验证码不能为空","minlength":"验证码是4位的","maxlength":"验证码是4位的","remote":"验证码不正确"},
            "agreement":{"required":"请阅读并接受使用协议"}
            }
        });
    }); 
        
