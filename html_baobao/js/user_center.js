/* uesr register */
//点击编辑按钮出发函数
function trigger_edit()
{
    $("#edit").attr({ id:"submit" , value:"提 交", onclick:"goSubmit()"});
    $("#textarea").removeAttr("readonly");
    var content = $("#textarea").val();
    $("#textarea").val("").focus().val(content);
    return false;
}

//提交操作，修改个人信息
function goSubmit()
{
    var info = $("#textarea").val();
    if('' != info)
    {
        $("#form").submit();
    }else
    {
        alert("请认真填写您的个人信息");
        $("#textarea").focus();
    }
}
