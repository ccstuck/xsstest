﻿=======================================================================================
====Name:Xssing 1.0 -- Funny and easy xss platform                                  ====
========================================================================================
====QQ GROUP : 209546692                                                             ====
====Project:http://code.google.com/p/xssing/    http://yaseng.me/xssing.html      ====
========================================================================================
====Author: Yaseng  『WwW.Yaseng.Me』     Yaseng@UAUC.NET                            ====
====Date: 2012-10-22 01:35:00                                                       ====
========================================================================================
 基于 php+mysql 的 xss 利用平台 http://xssing.sinaapp.com

项目发布地址 http://yaseng.me/xssing.html
介绍文章 http://yaseng.me/bind-xss-tutorial.html
Google 托管 http://code.google.com/p/xssing/
演示视频 http://v.youku.com/v_show/id_XNDYzODM5MDcy.html
交流qq群 209546692

安装

在下载http://code.google.com/p/xssing/ 或 http://yaseng.me/xssing.html 导入 xssing.sql 到mysql 配置 config/mysql.php 删除 /apps/running/uauc.php 可以运行
在sae部署

    新版本的xssing 完全兼容 sae 请修改配置总入口文件 /uauc/uauc.php 

define('SAE',1); // 1 在sae部署
常见问题

    q:安装之后一片空白
    a:更新至最新版 开启php错误提示

    q:怎么添加用户
    a:查看 apps/index/user/User.Action.php 里面的生成邀请码算法 请改变token值

    q:怎么把?m=xing&a=info&bid=29 又长又臭的url 改成 想 /xing/info/bid
    a:这个是mvc框架的典型特征 请自行编写url rewrite

    q:打开之后没有 样式 css 图片没加载就来
    a:手动定义一下 uauc/define.php define('SITE_ROOT',"网站url 带http")

    q:擦 你在源码里面留了后门吧 看 /demo/test.php 一句话 echo htmlentities($GET['a']);
    a:好吧 你赢了 这TM能用菜刀连接我就自宫 

使用
http://yaseng.me/xssing-1.html 详细使用方法

开发
概述

    Xssing 基于Php+Mysql 采用轻量级快速框架UAUC, 框架代码下 uauc 下面 入口文件 为 uauc.php,框架核心采用缓存编译 机制,修改uauc 目录和 config 目录下的文件都要删除缓存重新编译(/apps/running/uauc.php) 项目开发主要于 apps 下面的文件 mvc 架构的 action 和 model 的编写,已经view 视图前台设计

开发规范

    目前采取qq 群的形式 请加qq群 209546692也可以联系作者 yaseng@uauc.net 

项目目录结构

 ├─apps   
 │  └─index                     /*项目*/
 │      ├─action                /*动作*/
 │      ├─lib
 │      ├─model
 │      ├─running
 │      └─view                 /*模板视图文件*/
 │          ├─index
 │          ├─project
 │          ├─public
 │          │  ├─js
 │          │  └─style
 │          │      └─toolbar
 │          ├─user
 │          └─xing
 ├─config                     /*系统配置*/
 ├─demo                       /*简单的留言加后台系统*/       
 │  ├─admin
 │  └─static
 │      ├─css
 │      │  └─images
 │      │      └─source
 │      ├─images
 │      │  ├─panel
 │      │  └─toolbar
 │      └─js
 ├─release
 ├─static                    /*图片  css  js 等静态文件*/
 │  ├─js
 │  └─style 
 └─uauc                      /*核心框架库*/
     ├─class
     ├─common
     ├─core
     └─lib 

更新记录

    xssing 1.0

完成xss 平台基本框架

    xssing 1.1

修复几个bug 完善在 linux 环境下的兼容性

    xssing 1.2

修改几个逻辑bug和 自身的xss (伪造USER_AGENT) ps:感谢法克论坛的灰太狼 完全兼容sae平台 

 