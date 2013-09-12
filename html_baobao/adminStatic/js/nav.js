// 导航栏配置文件
var outlookbar=new outlook();
var t;
t=outlookbar.addtitle('后台管理','系统设置',1)
outlookbar.additem('添加管理员',t,'/admin/user/add')
outlookbar.additem('管理员列表',t,'/admin/user/adminlist')

t=outlookbar.addtitle('栏目管理','妈妈学习',1)
outlookbar.additem('栏目管理',t,'/admin/section/showlist/')

t=outlookbar.addtitle('文章管理','妈妈学习',1)
outlookbar.additem('文章管理',t,'/admin/article/showlist/')
outlookbar.additem('添加文章',t,'/admin/article/add/')

t=outlookbar.addtitle('原创管理','妈妈学习',1)
outlookbar.additem('原创管理',t,'/admin/original/showlist/')
outlookbar.additem('深度原创',t,'/admin/original/add/')

t=outlookbar.addtitle('图库管理','妈妈学习',1)
outlookbar.additem('图库管理',t,'/admin/img_lib/showlist/')
outlookbar.additem('添加图片',t,'/admin/img_lib/add/')

t=outlookbar.addtitle('关键词管理','妈妈学习',1)
outlookbar.additem('关键词管理',t,'/admin/keyword/showlist/')
outlookbar.additem('添加关键词',t,'/admin/keyword/add/')

t=outlookbar.addtitle('百科管理','妈妈学习',1)
outlookbar.additem('百科管理',t,'/admin/wiki/showlist/')
outlookbar.additem('添加百科',t,'/admin/wiki/add/')

t=outlookbar.addtitle('专栏管理','妈妈学习',1)
outlookbar.additem('专栏管理',t,'/admin/specpage/showlist/')
outlookbar.additem('添加专栏',t,'/admin/specpage/add/')

t=outlookbar.addtitle('标签管理','妈妈学习',1)
outlookbar.additem('标签管理',t,'/admin/tag/showlist/')
outlookbar.additem('添加标签',t,'/admin/tag/add/')

t=outlookbar.addtitle('其他','妈妈学习',1)
outlookbar.additem('生成右侧公用',t,'/admin/create_html/create_right/')


