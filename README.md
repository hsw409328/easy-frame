# easy-frame

easy-frame 遵循composer psr4规范

#依赖

php >= 5.4

php-pdo 扩展
    
#运行

git clone https://github.com/hsw409328/easy-frame.git

cd easy-frame 

composer install
    
#ngingx

配置vhost

配置host

开启nginx rewrite
    

在server中添加：
  
    if (!-e $request_filename) { 
     rewrite ^(.*)$ /index.php?$1 last; break; 
    }

#注意：

    apps\config有两种环境的配置，dev为开发环境，pro为线上环境，请自行修改
    
#作者

Shuaiwei Hao

homepage: www.51hsw.com

email:409328820@qq.com
    
#目录文档

webroot\
   
   apps（项目目录）  
                 
    config（配置项）
    
        dev
        
            config.php
            
            mysql.php
            
            redis.php
            
        pro
        
    controller（控制器）
    
        Test.php
        
    model（模型）
    
        Test.php
        
    view（视图）
    
        hello
        
            index.php
            
   cache（模板缓存）
   
    template
    
        *.php
        
   console（日志）
   
    log
    
        *.log
        
   core（核心）
   
    *.php
    
   ext（扩展）
  
   
   index.php（项目入口）
   
   composer.json（自动加载及依赖）

#Update History
    支持lamp
    支持lnmp
    支持wnmp
    支持wamp
    支持Redis扩展，配置文件Apps\Config\dev or \Apps\Config\pro里的redis.php
    新增图片操作类，支持远程图片下载到本地，图片流上传，验证码
    添加.htaccess，需要开启rewrite模块

#后续
待定