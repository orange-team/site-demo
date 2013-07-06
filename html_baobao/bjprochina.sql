CREATE TABLE article_cn (
  artiicle_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  category_cate_id TINYINT UNSIGNED NOT NULL,
  title VARCHAR(255) NOT NULL,
  content TEXT NOT NULL,
  public_date DATETIME NOT NULL,
  cate_id TINYINT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY(artiicle_id)
)engine=innodb default charset=utf8;

CREATE TABLE category_cn (
  cate_id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
  cate_name VARCHAR(255) NOT NULL,
  cate_fid TINYINT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY(cate_id)
)engine=innodb default charset=utf8;

CREATE TABLE company_cn (
  company_name VARCHAR(255) NOT NULL AUTO_INCREMENT,
  company_address VARCHAR(255) NULL,
  company_phone VARCHAR(255) NULL,
  company_tel VARCHAR(255) NULL,
  company_max VARCHAR(255) NULL,
  company_introduction TEXT NULL,
  company_ceo VARCHAR(255) NULL,
  PRIMARY KEY(company_name)
)engine=innodb default charset=utf8;

CREATE TABLE dealer_cn (
  dea_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  dea_name VARCHAR(255) NULL,
  dea_address VARCHAR(255) NULL,
  dea_phone VARCHAR(255) NULL,
  dea_tel VARCHAR(255) NULL,
  dea_max VARCHAR(255) NULL,
  dea_man VARCHAR(255) NULL,
  dea_passwd VARCHAR(255) NULL,
  dea_username VARCHAR(255) NULL,
  PRIMARY KEY(dea_id)
)engine=innodb default charset=utf8;

CREATE TABLE link_cn (
  link_id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
  link_name VARCHAR(255) NOT NULL,
  link_href VARCHAR(255) NULL,
  PRIMARY KEY(link_id)
)engine=innodb default charset=utf8;

CREATE TABLE menu_cn (
  menu_id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
  menu_name VARCHAR(255) NOT NULL,
  menu_fid TINYINT UNSIGNED NOT NULL DEFAULT 0,
  lft INTEGER UNSIGNED NOT NULL DEFAULT 0,
  rgt INTEGER UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY(menu_id)
)engine=innodb default charset=utf8;

CREATE TABLE post_cn (
  post_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  post_title VARCHAR(255) NULL,
  post_content TEXT NULL,
  post_date DATE NULL,
  PRIMARY KEY(post_id)
)engine=innodb default charset=utf8;

CREATE TABLE product_cn (
  pro_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  pro_name VARCHAR(255) NULL,
  pro_addtime DATE NULL,
  pro_health_num VARCHAR(255) NULL,
  pro_ingredient VARCHAR(255) NULL,
  pro_application VARCHAR(255) NULL,
  pro_indate VARCHAR(255) NULL,
  pro_function VARCHAR(255) NULL,
  pro_content TEXT NULL,
  PRIMARY KEY(pro_id)
)engine=innodb default charset=utf8;

CREATE TABLE product_image_cn (
  img_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  product_pro_id INTEGER UNSIGNED NOT NULL,
  img_burl VARCHAR(255) NULL,
  img_surl VARCHAR(255) NULL,
  PRIMARY KEY(img_id)
)engine=innodb default charset=utf8;


