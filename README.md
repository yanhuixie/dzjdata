# dzjdata

## 安装和初始化步骤（假定使用Windows和xampp，基于PHP7.0）
1. 安装好git、xampp、配置php.ini，注意要启用php_pdo_pgsql.dll 和 php_intl.dll  
2. 安装好PostgreSQL 10 并启动，创建数据库 dzjdata，假定 用户名密码都是 postgres，本机安装，缺省端口  
3. 选择一个目录容纳该工程，比如 C:/develop/，然后 git clone https://github.com/lqsaiitc/dzjdata.git  
4. 下载 https://pan.baidu.com/s/1MvzL9inQYcZ8LnRl125HXw 并解压缩vendor 到 dzjdata 工程目录下  
5. 复制 .env.dst 为 .env，然后修改如下内容  
```shell
LINK_ASSETS=false

DB_DSN           = pgsql:host=127.0.0.1;port=5432;dbname=dzjdata
DB_USERNAME      = postgres
DB_PASSWORD      = postgres

FRONTEND_HOST_INFO    = http://dzjdata.locl
BACKEND_HOST_INFO     = http://backend.dzjdata.locl
STORAGE_HOST_INFO     = http://storage.dzjdata.locl
```
6. 修改hosts文件，加入一行：
```shell
127.0.0.1    dzjdata.locl  backend.dzjdata.locl  storage.dzjdata.locl
```
7. 打开git bash或Windows控制台，进入工程目录然后执行以下命令并按照提示操作  
```shell
console/yii app/setup

Apply the above migrations? (yes|no) [no]:yes
```
8. 打开浏览器分别访问 http://dzjdata.locl 和 http://backend.dzjdata.locl 演示帐号如下：
```shell
Login: webmaster
Password: webmaster

Login: manager
Password: manager

Login: user
Password: user
```
