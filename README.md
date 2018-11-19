# PHP-BIAOQINGBAO-GIF  
示例站：https://a8o.org/ 、 https://8ot.net/   
本项目基于php-sorry-gif进行重写。   
原项目链接：https://github.com/PrintNow/php-sorry-gif    
制作核心：ffmpeg（ https://www.ffmpeg.org/ ）   
注意！在不可访问外网的环境下搭建会出现无法上传到搜狗CDN的情况，请在config.php关闭上传选项，也会出现预览图无法出现的问题（能访问OSS就可以显示）   
使用方式：前往release下载ZIP，并自行配置或下载Install.sh自动安装（需要保证服务端完全纯净，没有安装（过）Apache、Nginx等Web Server.  
Install.sh 将会进行：安装Apache2、PHP7.2，下载ZIP，解压并安装所需字体。  
作者博客: https://zihangu.com  
## 安装（请使用root用户执行以下命令）   
PHP-BIAOQINGBAO-GIF可以在PHP 5.6及以上运行。但是个人推荐使用PHP 7.2，使用其他版本可能需要配置php.ini来解禁system函数。本教程使用Apache2+PHP7.2+Ubuntu作为安装示例。
不建议小白手动安装，建议使用release附带的install.sh进行安装。教程：   
~~~
wget https://github.com/TheZihanGu/php-biaoqingbao-gif/releases/download/V1.0/install.sh
chmod u+x install.sh
./install.sh
~~~
### 安装Apache2、PHP 7.2（已安装的可跳过）   
~~~
apt-get install apache2 -y
apt-get install php7.2 -y
apt-get install php7.2-fpm php7.2-mysql php7.2-curl php7.2-json php7.2-mbstring php7.2-xml  php7.2-intl -y
~~~
### 安装PHP-BIAOQINGBAO-GIF   
~~~
apt-get install unzip -y
cd /var/www/html
rm -rf *
wget https://github.com/TheZihanGu/php-biaoqingbao-gif/releases/download/V1.0/v1.0.zip
chmod -R 777 /var/www/html
chmod -R 777 /var/www/html/*
~~~
### 安装中文字体   
~~~
apt-get install ffmpeg -y
apt-get install fontconfig -y
apt-get install xfonts-utils -y
mkdir /usr/share/fonts/myfonts
cp /var/www/html/fonts/fonts.ttf /usr/share/fonts/myfonts
cd /usr/share/fonts/myfonts
mkfontscale
mkfontdir
fc-cache
fc-list :lang=zh
~~~
### Done!   
访问 http://[你的IP] 开始使用吧！  
## 反馈   
如果你发现了一些Bug，请在Issues中提交，我将尽快修复。   
## 赞赏   
如果你想要打赏一下我，请前往我的博客获取赞赏二维码。https://zihangu.com/donation/
