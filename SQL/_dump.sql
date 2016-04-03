
#
# Table structure for table 'admin'
#

CREATE TABLE admin (
  admID int(10) unsigned NOT NULL auto_increment,
  type tinyint(3) unsigned NOT NULL default '0',
  login varchar(50) NOT NULL default '',
  password varchar(50) NOT NULL default '',
  email varchar(100) NOT NULL default '',
  question varchar(255) NOT NULL default '',
  answer varchar(255) NOT NULL default '',
  sessID bigint(20) unsigned NOT NULL default '0',
  time int(10) unsigned NOT NULL default '0',
  IP varchar(15) NOT NULL default '',
  PRIMARY KEY  (admID),
  UNIQUE KEY login (login),
  KEY sessID (sessID),
  KEY time (time)
) TYPE=MyISAM;

#
# Dumping data for table 'admin'
#

INSERT INTO admin VALUES (1,0,'root','root','admin@domain.com','','',0,0,'');

#
# Table structure for table 'config'
#

CREATE TABLE config (
  confID int(10) unsigned NOT NULL auto_increment,
  meta_title varchar(100) NOT NULL default '',
  meta_keywords text NOT NULL,
  meta_description text NOT NULL,
  meta_author varchar(100) NOT NULL default '',
  signature text NOT NULL,
  shop_id int(10) unsigned NOT NULL default '0',
  get_utf8 tinyint(3) unsigned NOT NULL default '0',
  no_external tinyint(3) unsigned NOT NULL default '0',
  use_https tinyint(3) unsigned NOT NULL default '0',
  http_site_folder varchar(255) NOT NULL default '',
  https_site_folder varchar(255) NOT NULL default '',
  num_products_feat int(10) unsigned NOT NULL default '0',
  num_articles int(10) unsigned NOT NULL default '0',
  num_stories int(10) unsigned NOT NULL default '0',
  num_news int(10) unsigned NOT NULL default '0',
  num_news_feat int(10) unsigned NOT NULL default '0',
  site_name varchar(100) NOT NULL default '',
  contact_email varchar(100) NOT NULL default '',
  auto_update_period int(10) unsigned NOT NULL default '0',
  last_time_updating int(10) unsigned NOT NULL default '0',
  last_time_updated int(10) unsigned NOT NULL default '0',
  show_nav_line tinyint(3) unsigned NOT NULL default '0',
  show_nav_line_last tinyint(3) unsigned NOT NULL default '0',
  cat_link_style tinyint(3) unsigned NOT NULL default '0',
  prd_link_style tinyint(3) unsigned NOT NULL default '0',
  cat_name_to_url tinyint(3) unsigned NOT NULL default '0',
  prd_name_to_url tinyint(3) unsigned NOT NULL default '0',
  menu_prd_count tinyint(3) unsigned NOT NULL default '0',
  show_empty_cats tinyint(3) unsigned NOT NULL default '0',
  img_cat_cols tinyint(3) unsigned NOT NULL default '0',
  img_cat_rows tinyint(3) unsigned NOT NULL default '0',
  img_cat_mid tinyint(3) unsigned NOT NULL default '0',
  img_prd_big tinyint(3) unsigned NOT NULL default '0',
  img_not_load tinyint(3) unsigned NOT NULL default '0',
  use_wysiwyg tinyint(3) unsigned NOT NULL default '0',
  show_related_prds tinyint(3) unsigned NOT NULL default '0',
  cat_show_spec tinyint(3) unsigned NOT NULL default '0',
  cat_show_feat tinyint(3) unsigned NOT NULL default '0',
  first_page_prods tinyint(3) unsigned NOT NULL default '0',
  left_menu_style tinyint(3) unsigned NOT NULL default '0',
  export_portion int(10) unsigned NOT NULL default '0',
  not_export_cats tinyint(3) unsigned NOT NULL default '0',
  show_add_but tinyint(3) unsigned NOT NULL default '0',
  additional_percent tinyint(3) unsigned NOT NULL default '0',
  image_logo varchar(50) NOT NULL default '',
  image_logo_old varchar(50) NOT NULL default '',
  order_email varchar(100) NOT NULL default '',
  descr_preview_num int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (confID)
) TYPE=MyISAM;

#
# Dumping data for table 'config'
#

INSERT INTO config VALUES (1,'Cool Shop','cool products','very cool shop','','',0,1,0,0,'','',10,20,20,20,5,'External Example Shop','contact@domain.com',72,0,0,1,0,1,0,1,1,0,0,3,5,0,0,0,0,1,0,1,1,0,0,0,1,5,'Cool Shop','Cool Shop','',0);

#
# Table structure for table 'customer'
#

CREATE TABLE customer (
  cstID int(10) unsigned NOT NULL auto_increment,
  time int(10) unsigned NOT NULL default '0',
  email varchar(100) NOT NULL default '',
  name varchar(50) NOT NULL default '',
  PRIMARY KEY  (cstID),
  UNIQUE KEY email (email),
  KEY time (time)
) TYPE=MyISAM;

#
# Dumping data for table 'customer'
#


#
# Table structure for table 'file_size'
#

CREATE TABLE file_size (
  obj_type int(10) unsigned NOT NULL default '0',
  objID int(10) unsigned NOT NULL default '0',
  num tinyint(3) unsigned NOT NULL default '0',
  size int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (obj_type,objID,num)
) TYPE=MyISAM;

#
# Dumping data for table 'file_size'
#


#
# Table structure for table 'links'
#

CREATE TABLE links (
  lnkID int(10) unsigned NOT NULL auto_increment,
  active tinyint(3) unsigned NOT NULL default '0',
  priority tinyint(3) unsigned NOT NULL default '0',
  uplID int(10) unsigned NOT NULL default '0',
  name varchar(100) NOT NULL default '',
  url varchar(255) NOT NULL default '',
  url_js tinyint(3) unsigned NOT NULL default '0',
  content text NOT NULL,
  PRIMARY KEY  (lnkID)
) TYPE=MyISAM;

#
# Dumping data for table 'links'
#


#
# Table structure for table 'mailing_emails'
#

CREATE TABLE mailing_emails (
  emlID int(10) unsigned NOT NULL auto_increment,
  time int(10) unsigned NOT NULL default '0',
  active tinyint(3) unsigned NOT NULL default '0',
  unsubscribed tinyint(3) unsigned NOT NULL default '0',
  email varchar(100) NOT NULL default '',
  name varchar(50) NOT NULL default '',
  code int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (emlID),
  UNIQUE KEY email (email),
  KEY time (time,active,unsubscribed)
) TYPE=MyISAM;

#
# Dumping data for table 'mailing_emails'
#


#
# Table structure for table 'mailing_templates'
#

CREATE TABLE mailing_templates (
  tplID int(10) unsigned NOT NULL auto_increment,
  name varchar(100) NOT NULL default '',
  html tinyint(3) unsigned NOT NULL default '0',
  subject varchar(100) NOT NULL default '',
  template text NOT NULL,
  PRIMARY KEY  (tplID)
) TYPE=MyISAM;

#
# Dumping data for table 'mailing_templates'
#

INSERT INTO mailing_templates VALUES (1,'templ1',1,'Hello','Hello, <%NAME%>.<br />\r\nI want your money<br />\r\n<br />\r\n<%LINK%>');

#
# Table structure for table 'news'
#

CREATE TABLE news (
  nwsID int(10) unsigned NOT NULL auto_increment,
  archive tinyint(3) unsigned NOT NULL default '0',
  time int(10) unsigned NOT NULL default '0',
  title varchar(255) NOT NULL default '',
  content text NOT NULL,
  source varchar(255) NOT NULL default '',
  PRIMARY KEY  (nwsID),
  KEY time (time)
) TYPE=MyISAM;

#
# Dumping data for table 'news'
#


#
# Table structure for table 'sc_category'
#

CREATE TABLE sc_category (
  catID int(10) unsigned NOT NULL auto_increment,
  parID int(10) unsigned NOT NULL default '0',
  active tinyint(3) unsigned NOT NULL default '1',
  priority tinyint(3) unsigned NOT NULL default '0',
  name varchar(100) NOT NULL default '',
  comment varchar(255) NOT NULL default '',
  meta_title text NOT NULL,
  meta_keywords text NOT NULL,
  meta_description text NOT NULL,
  url_name varchar(255) NOT NULL default '',
  uplID int(10) unsigned NOT NULL default '0',
  title varchar(100) NOT NULL default '',
  description text NOT NULL,
  PRIMARY KEY  (catID),
  KEY parID (parID,priority,catID),
  KEY active (active),
  KEY url_name (url_name)
) TYPE=MyISAM;

#
# Dumping data for table 'sc_category'
#


#
# Table structure for table 'sc_category_newval'
#

CREATE TABLE sc_category_newval (
  catID int(10) unsigned NOT NULL default '0',
  active tinyint(3) unsigned NOT NULL default '1',
  priority tinyint(3) unsigned NOT NULL default '0',
  name varchar(100) NOT NULL default '',
  comment varchar(255) NOT NULL default '',
  meta_title text NOT NULL,
  meta_keywords text NOT NULL,
  meta_description text NOT NULL,
  url_name varchar(255) NOT NULL default '',
  title varchar(100) NOT NULL default '',
  description text NOT NULL,
  PRIMARY KEY  (catID),
  KEY url_name (url_name)
) TYPE=MyISAM;

#
# Dumping data for table 'sc_category_newval'
#


#
# Table structure for table 'sc_category_prod'
#

CREATE TABLE sc_category_prod (
  catID int(10) unsigned NOT NULL default '0',
  prdID int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (catID,prdID),
  KEY prdID (prdID)
) TYPE=MyISAM;

#
# Dumping data for table 'sc_category_prod'
#


#
# Table structure for table 'sc_category_stat'
#

CREATE TABLE sc_category_stat (
  catID int(10) unsigned NOT NULL default '0',
  n_prod int(10) unsigned NOT NULL default '0',
  n_prod_all int(10) unsigned NOT NULL default '0',
  last_time int(10) unsigned NOT NULL default '0',
  has_new tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (catID)
) TYPE=MyISAM;

#
# Dumping data for table 'sc_category_stat'
#


#
# Table structure for table 'sc_list'
#

CREATE TABLE sc_list (
  lstID int(10) unsigned NOT NULL auto_increment,
  name varchar(50) NOT NULL default '',
  products text NOT NULL,
  active tinyint(3) unsigned NOT NULL default '0',
  col tinyint(3) unsigned NOT NULL default '0',
  all_pages tinyint(3) unsigned NOT NULL default '0',
  categories text,
  PRIMARY KEY  (lstID)
) TYPE=MyISAM;

#
# Dumping data for table 'sc_list'
#


#
# Table structure for table 'sc_manufacturer'
#

CREATE TABLE sc_manufacturer (
  mnfID int(10) unsigned NOT NULL auto_increment,
  uplID int(10) unsigned NOT NULL default '0',
  name varchar(100) NOT NULL default '',
  url varchar(255) NOT NULL default '',
  content text NOT NULL,
  meta_title text NOT NULL,
  meta_keywords text NOT NULL,
  meta_description text NOT NULL,
  PRIMARY KEY  (mnfID)
) TYPE=MyISAM;

#
# Dumping data for table 'sc_manufacturer'
#


#
# Table structure for table 'sc_manufacturer_newval'
#

CREATE TABLE sc_manufacturer_newval (
  mnfID int(10) unsigned NOT NULL default '0',
  name varchar(100) NOT NULL default '',
  content text NOT NULL,
  meta_title text NOT NULL,
  meta_keywords text NOT NULL,
  meta_description text NOT NULL,
  url_name varchar(255) NOT NULL default '',
  PRIMARY KEY  (mnfID),
  KEY url_name (url_name)
) TYPE=MyISAM;

#
# Dumping data for table 'sc_manufacturer_newval'
#


#
# Table structure for table 'sc_product'
#

CREATE TABLE sc_product (
  prdID int(10) unsigned NOT NULL auto_increment,
  active tinyint(3) unsigned NOT NULL default '1',
  priority tinyint(3) unsigned NOT NULL default '0',
  time_available int(10) unsigned NOT NULL default '0',
  in_stock tinyint(3) unsigned NOT NULL default '1',
  is_new tinyint(3) unsigned default NULL,
  mnfID int(10) unsigned NOT NULL default '0',
  model varchar(50) NOT NULL default '',
  url varchar(255) NOT NULL default '',
  price_type tinyint(3) unsigned NOT NULL default '0',
  price_type_new tinyint(3) unsigned NOT NULL default '0',
  spec_time1 int(10) unsigned NOT NULL default '0',
  spec_time2 int(10) unsigned NOT NULL default '0',
  price decimal(10,2) unsigned NOT NULL default '0.00',
  spec_price decimal(10,2) unsigned NOT NULL default '0.00',
  opt1 int(10) unsigned NOT NULL default '0',
  price1 decimal(10,2) unsigned NOT NULL default '0.00',
  spec_price1 decimal(10,2) unsigned NOT NULL default '0.00',
  opt2 int(10) unsigned NOT NULL default '0',
  price2 decimal(10,2) unsigned NOT NULL default '0.00',
  spec_price2 decimal(10,2) unsigned NOT NULL default '0.00',
  measure varchar(50) NOT NULL default '',
  dimensions varchar(100) NOT NULL default '',
  weight decimal(10,3) unsigned NOT NULL default '0.000',
  meta_title text NOT NULL,
  meta_keywords text NOT NULL,
  meta_description text NOT NULL,
  uplID1 int(10) unsigned NOT NULL default '0',
  uplID2 int(10) unsigned NOT NULL default '0',
  uplID3 int(10) unsigned NOT NULL default '0',
  uplID4 int(10) unsigned NOT NULL default '0',
  uplID5 int(10) unsigned NOT NULL default '0',
  uplID6 int(10) unsigned NOT NULL default '0',
  doc1 varchar(50) NOT NULL default '',
  docID1 int(10) unsigned NOT NULL default '0',
  doc2 varchar(50) NOT NULL default '',
  docID2 int(10) unsigned NOT NULL default '0',
  doc3 varchar(50) NOT NULL default '',
  docID3 int(10) unsigned NOT NULL default '0',
  name varchar(100) NOT NULL default '',
  comment varchar(255) NOT NULL default '',
  description text NOT NULL,
  attributes text NOT NULL,
  quantity int(10) unsigned NOT NULL default '0',
  num_choosed int(10) unsigned NOT NULL default '0',
  last_modified int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (prdID),
  KEY active (active,time_available),
  KEY active_2 (active,is_new),
  KEY price_type_new (price_type_new,priority,is_new),
  KEY priority (priority),
  KEY num_choosed (num_choosed,price_type_new,priority),
  KEY is_new (is_new)
) TYPE=MyISAM;

#
# Dumping data for table 'sc_product'
#


#
# Table structure for table 'sc_product_newval'
#

CREATE TABLE sc_product_newval (
  prdID int(10) unsigned NOT NULL default '0',
  active tinyint(3) unsigned NOT NULL default '1',
  priority tinyint(3) unsigned NOT NULL default '0',
  price_type tinyint(3) unsigned NOT NULL default '0',
  meta_title text NOT NULL,
  meta_keywords text NOT NULL,
  meta_description text NOT NULL,
  url_name varchar(255) NOT NULL default '',
  name varchar(100) NOT NULL default '',
  comment varchar(255) NOT NULL default '',
  description text NOT NULL,
  last_modified int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (prdID)
) TYPE=MyISAM;

#
# Dumping data for table 'sc_product_newval'
#


#
# Table structure for table 'session'
#

CREATE TABLE session (
  ID varchar(32) NOT NULL default '',
  time int(10) unsigned NOT NULL default '0',
  data text NOT NULL,
  PRIMARY KEY  (ID),
  KEY time (time)
) TYPE=MyISAM;

#
# Dumping data for table 'session'
#


#
# Table structure for table 'site_gallery'
#

CREATE TABLE site_gallery (
  imgID int(10) unsigned NOT NULL auto_increment,
  time int(10) unsigned NOT NULL default '0',
  uplID int(10) unsigned NOT NULL default '0',
  comment varchar(50) NOT NULL default '',
  alt varchar(50) NOT NULL default '',
  width int(11) NOT NULL default '0',
  height int(11) NOT NULL default '0',
  PRIMARY KEY  (imgID),
  KEY time (time)
) TYPE=MyISAM;

#
# Dumping data for table 'site_gallery'
#


#
# Table structure for table 'site_menu'
#

CREATE TABLE site_menu (
  menuID int(10) unsigned NOT NULL auto_increment,
  parID int(10) unsigned NOT NULL default '0',
  static tinyint(3) unsigned NOT NULL default '0',
  priority tinyint(3) unsigned NOT NULL default '0',
  title varchar(100) NOT NULL default '',
  pageID int(10) unsigned NOT NULL default '0',
  url varchar(255) NOT NULL default '',
  newwin tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (menuID),
  KEY parID (parID,priority,menuID)
) TYPE=MyISAM;

#
# Dumping data for table 'site_menu'
#


#
# Table structure for table 'site_pages'
#

CREATE TABLE site_pages (
  pageID int(10) unsigned NOT NULL auto_increment,
  type tinyint(3) unsigned NOT NULL default '0',
  static_page varchar(100) NOT NULL default '',
  active tinyint(3) unsigned NOT NULL default '0',
  priority tinyint(3) unsigned NOT NULL default '0',
  in_map tinyint(3) unsigned NOT NULL default '0',
  url_name varchar(255) NOT NULL default '',
  meta_title text NOT NULL,
  meta_keywords text NOT NULL,
  meta_description text NOT NULL,
  meta_author varchar(100) NOT NULL default '',
  title varchar(100) NOT NULL default '',
  content1 text NOT NULL,
  content2 text NOT NULL,
  bottom_links varchar(255) NOT NULL default '',
  uplID int(10) unsigned NOT NULL default '0',
  pageID1 int(10) unsigned NOT NULL default '0',
  pageID2 int(10) unsigned NOT NULL default '0',
  pageID3 int(10) unsigned NOT NULL default '0',
  pageID4 int(10) unsigned NOT NULL default '0',
  pageID5 int(10) unsigned NOT NULL default '0',
  last_modified int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (pageID),
  KEY type (type,priority)
) TYPE=MyISAM;

#
# Dumping data for table 'site_pages'
#

INSERT INTO site_pages VALUES (1,0,'index.php',1,0,0,'','','','','','Welcome to Cool Shop','Welcome to You!','','',0,0,0,0,0,0,0);
INSERT INTO site_pages VALUES (6,0,'map.php',1,0,0,'','','','','','Site Map','','','',0,0,0,0,0,0,0);
INSERT INTO site_pages VALUES (8,0,'search.php',1,0,1,'','','','','','Search','','','',0,0,0,0,0,0,0);
INSERT INTO site_pages VALUES (9,0,'search_prod.php',1,0,0,'','','','','','Search Products','','','',0,0,0,0,0,0,0);
INSERT INTO site_pages VALUES (77,0,'sc.php',1,0,0,'','','','','','Shopping Cart Content','','','',0,0,0,0,0,0,1146608747);
INSERT INTO site_pages VALUES (11,0,'edit_item.php',1,0,0,'','','','','','Edit Product\'s Options','<b>Here you may correct choosed product\'s options</b>','','',0,0,0,0,0,0,0);
INSERT INTO site_pages VALUES (12,0,'login_form.php',1,0,0,'','','','','','Customer Login','','','',0,0,0,0,0,0,0);
INSERT INTO site_pages VALUES (65,0,'addresses.php',1,0,0,'','','','','','Enter shipping & billing info','','','',0,0,0,0,0,0,1146608206);
INSERT INTO site_pages VALUES (68,0,'shipping_process.php',1,0,0,'','','','','','Choose shipping method (Error)','','','',0,0,0,0,0,0,1146608307);
INSERT INTO site_pages VALUES (15,0,'login.php',1,0,0,'','','','','','Customer Login (Error)','','','',0,0,0,0,0,0,1146608428);
INSERT INTO site_pages VALUES (66,0,'addresses_process.php',1,0,0,'','','','','','Enter shipping & billing info (Error)','','','',0,0,0,0,0,0,1146608214);
INSERT INTO site_pages VALUES (67,0,'shipping.php',1,0,0,'','','','','','Choose shipping method','','','',0,0,0,0,0,0,1146608300);
INSERT INTO site_pages VALUES (70,0,'payment_process.php',1,0,0,'','','','','','Enter payment info (Error)','','','',0,0,0,0,0,0,1146608359);
INSERT INTO site_pages VALUES (20,0,'OK.php',1,0,0,'','','','','','Your order is processed','','','',0,0,0,0,0,0,0);
INSERT INTO site_pages VALUES (22,0,'contact_us.php',1,0,1,'','','','','','Contact Us','','','',0,0,0,0,0,0,0);
INSERT INTO site_pages VALUES (30,0,'links.php',1,0,0,'','','','','','Partners','','','',0,0,0,0,0,0,0);
INSERT INTO site_pages VALUES (26,0,'articles.php',1,0,0,'','','','','','Articles','','','',0,0,0,0,0,0,0);
INSERT INTO site_pages VALUES (31,0,'stories.php',1,0,0,'','','','','','Live Stories','','','',0,0,0,0,0,0,0);
INSERT INTO site_pages VALUES (28,0,'news.php',1,0,1,'','','','','','News','','','',0,0,0,0,0,0,0);
INSERT INTO site_pages VALUES (29,0,'news_view.php',1,0,0,'','','','','','View News','','','',0,0,0,0,0,0,0);
INSERT INTO site_pages VALUES (32,0,'story.php',1,0,0,'','','','','','View Live Story','','','',0,0,0,0,0,0,0);
INSERT INTO site_pages VALUES (71,0,'register_form.php',1,0,0,'','','','','','Customer Registration','','','',0,0,0,0,0,0,1146608486);
INSERT INTO site_pages VALUES (73,0,'account.php',1,0,0,'','','','','','Customer Account','','','',0,0,0,0,0,0,1146608595);
INSERT INTO site_pages VALUES (41,0,'choice.php',1,0,0,'','','','','','Are You Returned Customer?','','','',0,0,0,0,0,0,0);
INSERT INTO site_pages VALUES (46,0,'category.php',1,0,0,'','','','','','View Category','','','',0,0,0,0,0,0,0);
INSERT INTO site_pages VALUES (47,0,'product.php',1,0,0,'','','','','','View Product','','','',0,0,0,0,0,0,0);
INSERT INTO site_pages VALUES (48,0,'manufacturer.php',1,0,0,'','','','','','View Manufacturer','','','',0,0,0,0,0,0,0);
INSERT INTO site_pages VALUES (75,0,'item_edit.php',1,0,0,'','','','','','Edit Item in Shopping Cart','','','',0,0,0,0,0,0,1146608699);
INSERT INTO site_pages VALUES (58,0,'order_view.php',1,0,0,'','','','','','View Order Detail','','','',0,0,0,0,0,0,0);
INSERT INTO site_pages VALUES (61,0,'prod_bestseller.php',1,0,1,'','','','','','Bestsellers','','','',0,0,0,0,0,0,0);
INSERT INTO site_pages VALUES (62,0,'prod_special.php',1,0,1,'','','','','','Specials','','','',0,0,0,0,0,0,0);
INSERT INTO site_pages VALUES (63,0,'prod_new.php',1,0,1,'','','','','','New Products','','','',0,0,0,0,0,0,0);
INSERT INTO site_pages VALUES (64,0,'prod_featured.php',1,0,1,'','','','','','Featured Products','','','',0,0,0,0,0,0,0);
INSERT INTO site_pages VALUES (69,0,'payment.php',1,0,0,'','','','','','Enter payment info','','','',0,0,0,0,0,0,1146608350);
INSERT INTO site_pages VALUES (72,0,'register.php',1,0,0,'','','','','','Customer Registration (Error)','','','',0,0,0,0,0,0,1146608494);
INSERT INTO site_pages VALUES (74,0,'account_a.php',1,0,0,'','','','','','Customer Account (Updating Error)','','','',0,0,0,0,0,0,1146608603);
INSERT INTO site_pages VALUES (76,0,'item_update.php',1,0,0,'','','','','','Edit Item in Shopping Cart (Updating Error)','','','',0,0,0,0,0,0,1146608706);
INSERT INTO site_pages VALUES (78,0,'cart_update.php',1,0,0,'','','','','','Shopping Cart Content (Updating Error)','','','',0,0,0,0,0,0,1146608760);

#
# Table structure for table 'site_uploads'
#

CREATE TABLE site_uploads (
  suplID int(10) unsigned NOT NULL auto_increment,
  time int(10) unsigned NOT NULL default '0',
  uplID int(10) unsigned NOT NULL default '0',
  comment varchar(50) NOT NULL default '',
  PRIMARY KEY  (suplID),
  KEY time (time)
) TYPE=MyISAM;

#
# Dumping data for table 'site_uploads'
#


#
# Table structure for table 'stories'
#

CREATE TABLE stories (
  strID int(10) unsigned NOT NULL auto_increment,
  active tinyint(3) unsigned NOT NULL default '0',
  priority tinyint(3) unsigned NOT NULL default '0',
  title varchar(255) NOT NULL default '',
  content text NOT NULL,
  PRIMARY KEY  (strID)
) TYPE=MyISAM;

#
# Dumping data for table 'stories'
#


#
# Table structure for table 'uploads'
#

CREATE TABLE uploads (
  uplID int(10) unsigned NOT NULL auto_increment,
  path varchar(255) default NULL,
  name varchar(255) default NULL,
  save_name tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (uplID)
) TYPE=MyISAM;

#
# Dumping data for table 'uploads'
#


#
# Table structure for table 'uploads1'
#

CREATE TABLE uploads1 (
  uplID int(10) unsigned NOT NULL auto_increment,
  path varchar(255) default NULL,
  name varchar(255) default NULL,
  width int(10) unsigned NOT NULL default '0',
  height int(10) unsigned NOT NULL default '0',
  img_not_loaded tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (uplID)
) TYPE=MyISAM;

#
# Dumping data for table 'uploads1'
#
