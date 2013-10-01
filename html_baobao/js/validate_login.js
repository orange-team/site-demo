$(document).ready(function() {
    $("#login_form").validate({
        rules: {
            "email":{
                "required":true,
                "email":true,
                "remote": {
                    "url": "/user_login/chk_email/",
                    "type": "post",
                    "data": {
                        "type":2,"email": function() { return $("#email").val(); }
                    }
                }
            },
            "password":{"required":true,"minlength":"6"},
        },
        messages: {
            "email":{"required":"邮箱不能为空","email":"邮箱格式不正确","remote":"该邮箱还未注册"},
            "password":{"required":"密码不能为空","minlength":"密码至少要6个字符"},
        }
    });
}); 
        
