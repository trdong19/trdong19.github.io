一、拉取wordpress镜像(默认最新)
这一步和代理仓库有关，可能拉取时间偏久一点(出错时多拉取一次)
docker pull wordpress
![image](https://github.com/trdong19/trdong19.github.io/assets/84180727/b0ae217a-a9f0-4c6c-a7e6-53b27c7711fe)


二、启动wordpress容器
启动容器，设置容器名为mywordpress2并把80端口映射到宿主机的9999端口
docker run -it --name mywordpress2 -p 9999:80 -d wordpress
![image](https://github.com/trdong19/trdong19.github.io/assets/84180727/fa636b2f-9014-49b8-ab45-f85d5bb864ec)


要添加挂载硬盘，可以使用 -v 参数来指定挂载点。例如，假设你有一个硬盘 /data ，你可以将它挂载到 WordPress容器内的 /var/www/html 目录上，命令如下所示：
docker run -it --name mywordpress2 -p 9999:80 -v /data:/var/www/html -d wordpress
 
这样，容器内的 WordPress 网站就会使用 /data 目录作为持久存储，你可以将数据保存在该目录下，即使容器被删除或重新创建，数据也不会丢失。请确保在运行此命令之前，已经在主机上创建了目标挂载点。

三、查看容器状态
docker ps

如果看到这个容器存在说明启动成功了
![image](https://github.com/trdong19/trdong19.github.io/assets/84180727/d3ec876e-3a73-4305-b6dc-9f22a36e4050)

四、安装wordpress博客程序
在docker面板启动wordpress容器
![image](https://github.com/trdong19/trdong19.github.io/assets/84180727/031540ff-f4b8-49da-8605-38856f15e792)


此时在浏览器访问http://localhost:9999/wp-admin/setup-config.php进行安装，这时的ip地址是宿主机的IP，因为我的宿主机就是本机，所以访问地址为：http://localhost:9999。
![image](https://github.com/trdong19/trdong19.github.io/assets/84180727/2d1c7369-a5eb-4c0d-9427-b88b744882c3)


傻瓜式安装步骤，得到以下配置页面，此时需要配置数据库信息，但是这个容器中并没有安装Mysql服务，所以我再安装了一个Mysql容器。
![image](https://github.com/trdong19/trdong19.github.io/assets/84180727/ec33c95b-3e9b-4181-99bc-843707584254)


拉取mysql镜像(5.7)
docker pull mysql:5.7
![image](https://github.com/trdong19/trdong19.github.io/assets/84180727/5a69bef7-15b0-41f9-a0a0-7a85df2728a5)


启动mysql容器
启动容器，设置容器名为mysql5.7并把3306端口映射到宿主机的3305端口上，同时设置root初始化密码为123456
docker run -it --name=mysql5.7 -p 3305:3306 -e MYSQL_ROOT_PASSWORD=123456 -e TZ=Asia/Shanghai -d mysql:5.7 --character-set-server=utf8mb4 --collation-server=utf8mb4_general_ci  --lower_case_table_names=1
 
挂载卷可以参考如下（将路径修改为你想要挂载的位置）：
![image](https://github.com/trdong19/trdong19.github.io/assets/84180727/e95d12e1-4165-483c-862b-b43ec6475000)

docker run -it --name=mysql5.7 -p 3305:3306 -e MYSQL_ROOT_PASSWORD=123456 -e TZ=Asia/Shanghai -e MYSQL_INITDB_ARGS="--character-set-server=utf8mb4 --collation-server=utf8mb4_general_ci --lower_case_table_names=1" -v S:\mysqlbak:/var/lib/mysql -d mysql:5.7
 


配置mysql容器 此时的mysql已经运行起来了，但是需要配置允许外部访问才可使用。
 #进入容器
docker exec -it mysql5.7 bash
#进入mysql数据库--123456
mysql -u root -p
#设置mysql允许访问
GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' WITH GRANT OPTION;
FLUSH PRIVILEGES;
![image](https://github.com/trdong19/trdong19.github.io/assets/84180727/1627d45b-211d-4dd1-bb2c-5dddbe7645ef)


利用navicat一类的Mysql管理工具创建数据wordpress
![image](https://github.com/trdong19/trdong19.github.io/assets/84180727/0df1f02e-4f52-482d-a204-4ed6441f5a99)

也可以命令行形式创建
create database wordpress;
![image](https://github.com/trdong19/trdong19.github.io/assets/84180727/bbb48b84-d794-4835-8398-f5cd46f6f07b)

再次进入配置页面(http://ip:9999) 这里的mysql地址不能为回送地址(127.0.0.1)，而是应该为宿主机地址，配置如下
![image](https://github.com/trdong19/trdong19.github.io/assets/84180727/df477322-2296-40de-b931-4550f444977c)


docker链接本地的数据库主机用host.docker.internal

用docker下载的mysql则用数据库ip进行连接

如果您已经在 Docker 容器中分别安装了 WordPress 和 MySQL，并且想要让它们链接起来，可以按照以下步骤进行操作
1、查找 MySQL 容器的 IP 地址
首先，需要查找正在运行的 MySQL 容器的 IP 地址。可以使用以下命令：

docker inspect <mysql-container-name> | grep IPAddress
 
其中 <mysql-container-name> 是 MySQL 容器的名称。这将输出 MySQL 容器的 IP 地址。
如果用了直接报错grep : 无法将“grep”项识别为 cmdlet、函数、脚本文件或可运行程序的名称。请检查名称的拼写，如果包括路径，请确保路径正确 ，然后再试一次。
如果在运行查询 MySQL 容器 IP 地址的命令时出现“grep:无法将 ‘grep’ 识别为
cmdlet、函数、脚本文件或可运行程序的名称。”错误，这可能是因为您在 Windows PowerShell 中使用了 grep 命令。
在 Windows PowerShell 中，类似于 grep 的命令是 Select-String。您可以尝试以下命令：
 docker inspect <mysql-container-name> | Select-String IPAddress
 
其中 <mysql-container-name> 是 MySQL 容器的名称。
请注意，在 Windows PowerShell 中，命令和参数之间使用空格而不是分号。此外，Docker 在 Windows 上运行在
Docker Desktop 中，它使用的是 Linux 虚拟机，所以您应该使用基于 Unix 的命令（如 grep），而不是
Windows 命令提示符（cmd）中使用的命令。
![image](https://github.com/trdong19/trdong19.github.io/assets/84180727/fb29ad5d-5766-4677-a4a8-dd2ff3724d0d)

至此你就获取了docker容器中的mysql的ip地址
2、连接 WordPress 到 MySQL
回到容器内，在网站目录下，修改wp-config-sample.php文件
![image](https://github.com/trdong19/trdong19.github.io/assets/84180727/06ff4178-2634-4392-bba9-f0f43dba43d5)
或者用命令进入容器中
docker exec -it wordpress bash
找到目录文件用vim进行修改

回到配置页面将数据库主机填上你获取的数据库ip地址
![image](https://github.com/trdong19/trdong19.github.io/assets/84180727/14e62f80-5073-47dd-9f54-e2ac9f2f9755)


3、运行安装程序
![image](https://github.com/trdong19/trdong19.github.io/assets/84180727/4d5bc31b-2be8-4cc9-a4e4-76bdc5e35df9)


剩下的就是傻瓜式安装步骤
![image](https://github.com/trdong19/trdong19.github.io/assets/84180727/86168340-066b-4da4-958e-61831e045594)

到此就可以登陆啦~
![image](https://github.com/trdong19/trdong19.github.io/assets/84180727/b12e2910-2d88-482d-a0fe-9727b9f8bf09)
