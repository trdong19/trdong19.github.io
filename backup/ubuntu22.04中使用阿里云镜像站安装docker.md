安装一些依赖。
sudo apt update
sudo apt install apt-transport-https ca-certificates curl gnupg lsb-release
 
在国内的网络环境下，如果使用官方的源来安装docker，下载安装包的过程就非常慢，所以这里使用阿里云源安装

添加阿里云 GPG 密钥
curl -fsSL http://mirrors.aliyun.com/docker-ce/linux/ubuntu/gpg | sudo apt-key add -
 
设置 stable 仓库
sudo add-apt-repository "deb [arch=amd64] http://mirrors.aliyun.com/docker-ce/linux/ubuntu $(lsb_release -cs) stable"
 
安装 Docker
sudo apt-get install docker-ce docker-ce-cli containerd.io
 
设置非root用户的权限
sudo usermod -aG docker $USER
 
如果你直接使用root用户这一步可以不做，如果是其他用户，如果不做这一步，后面操作docker命令就都带上sudo，也是可以的；另外，需要重新登录用户才能生效。

启动服务：
systemctl start docker
 
验证一下
sudo docker run hello-world
 
输出：

[huan@8500t ~]# docker run hello-world
Unable to find image 'hello-world:latest' locally
latest: Pulling from library/hello-world
c1ec31eb5944: Pull complete 
Digest: sha256:ac69084025c660510933cca701f615283cdbb3aa0963188770b54c31c8962493
Status: Downloaded newer image for hello-world:latest

Hello from Docker!
This message shows that your installation appears to be working correctly.

To generate this message, Docker took the following steps:
 1. The Docker client contacted the Docker daemon.
 2. The Docker daemon pulled the "hello-world" image from the Docker Hub.
    (amd64)
 3. The Docker daemon created a new container from that image which runs the
    executable that produces the output you are currently reading.
 4. The Docker daemon streamed that output to the Docker client, which sent it
    to your terminal.

To try something more ambitious, you can run an Ubuntu container with:
 $ docker run -it ubuntu bash

Share images, automate workflows, and more with a free Docker ID:
 https://hub.docker.com/

For more examples and ideas, visit:
 https://docs.docker.com/get-started/
 
安装 Docker Compose（可选）
sudo curl -L "https://github.com/docker/compose/releases/download/v2.23.
3/docker-compose-linux-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
 
实际上就是从github的releases中下载对应系统版本的docker-compose程序文件，授予执行权限即可。