// 导航栏配置文件
var outlookbar=new outlook();
var t;
t=outlookbar.addtitle('后台管理','系统设置',1)
outlookbar.additem('添加管理员',t,'/admin/user/add')
outlookbar.additem('管理员列表',t,'/admin/user/adminlist')

/*
t=outlookbar.addtitle('网站设置','系统设置',1)
outlookbar.additem('站点配置',t,'siteconfig.php')
outlookbar.additem('点击退出登录',t,'loginout.php')
outlookbar.additem('展商信息同步',t,'../Corpsync/ ')



outlookbar.additem('开通新企业',t,'../Corp/add')
outlookbar.additem('管理企业基本信息',t,'../Corp/corplist')
outlookbar.additem('开通个人会员',t,'../Personal/add')
outlookbar.additem('个人会员管理',t,'../Personal/personalList')
outlookbar.additem('企业会员管理',t,'../Corp/memberlist')
outlookbar.additem('匹配类别管理',t,'../Index/category')
*/

t=outlookbar.addtitle('栏目管理','妈妈学习',1)
outlookbar.additem('栏目管理',t,'/admin/section/showlist/')

t=outlookbar.addtitle('文章管理','妈妈学习',1)
outlookbar.additem('文章管理',t,'/admin/article/showlist/')
outlookbar.additem('添加文章',t,'/admin/article/add')

t=outlookbar.addtitle('关键词管理','妈妈学习',1)
outlookbar.additem('关键词管理',t,'/admin/keyword/showlist/')
outlookbar.additem('添加关键词',t,'/admin/keyword/add/')

t=outlookbar.addtitle('百科管理','妈妈学习',1)
outlookbar.additem('百科管理',t,'/admin/wiki/showlist/')
outlookbar.additem('添加百科',t,'/admin/wiki/add/')

t=outlookbar.addtitle('专栏管理','妈妈学习',1)
outlookbar.additem('专栏管理',t,'/admin/specpage/showlist/')
outlookbar.additem('添加专栏',t,'/admin/specpage/add/')


/*

t=outlookbar.addtitle('线下展会服务','妈妈学习',1)
outlookbar.additem('开通线下展商',t,'../Offlineex/addready')
outlookbar.additem('参展企业名录',t,'../Offlineex/manage')
outlookbar.additem('展会管理',t,'../Exproject/manage')
outlookbar.additem('员工管理',t,'../Employee/manage')


t=outlookbar.addtitle('妈妈说说','妈妈学习',1)
outlookbar.additem('添加观众',t,'un_pass.php')
outlookbar.additem('审核/管理观众',t,'al_pass.php')
outlookbar.additem('VIP邀请数据管理',t,'../Vipvisitor/manage')
outlookbar.additem('在线咨询管理',t,'../Consulting/manage')


t=outlookbar.addtitle('资讯管理','其他设置',1)
outlookbar.additem('妈妈学习',t,'../news/categorylist')
outlookbar.additem('资讯发布',t,'../news/artadd')
outlookbar.additem('资讯妈妈学习',t,'../news/artlist')
t=outlookbar.addtitle('妈妈说说','妈妈说说',1)
*/
