KindEditor.plugin('replace', function(K) {
        var self = this, name = 'replace';
        // 点击图标时执行
        self.clickToolbar(name, function() {
            var lang = self.lang(name + '.'),
                html = ['<div style="padding:10px 20px;">',
                    '<div class="ke-dialog-row">',
                    '<input id="oldStr" style="width:100px;" value="" />',
                    ' => ',
                    '<input id="newStr" style="width:100px;" value="" />',
                    '</div>',
                    '</div>'].join(''),
                dialog = self.createDialog({
                    name : name,
                    width : 450,
                    title : self.lang(name),
                    body : html,
                    yesBtn : {
                        name : self.lang('yes'),
                        click : function(e) {
                            var type = K('.ke-code-type', dialog.div).val(),
                                oldStr = K.trim(K('#oldStr', dialog.div).val()),
                                newStr = K.trim(K('#newStr', dialog.div).val());
                            self.html(self.html().replace(RegExp(oldStr,'g'),newStr)).hideDialog().focus();
                        }
                    }
                });
                $('#oldStr').focus();

        });
});
