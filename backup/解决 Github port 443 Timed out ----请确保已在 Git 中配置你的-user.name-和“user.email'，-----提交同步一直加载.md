### 解决 Github port 443 Timed out
一、问题描述
如下图所示，无法 git clone 来自 Github 上的仓库，报端口 443 错误
![image](https://github.com/trdong19/trdong19.github.io/assets/84180727/08f9d52f-fd66-42e3-81c9-b99288dc9f26)

二、问题分析
Git 所设端口与系统代理不一致，需重新设置

三、解决方法
3-1、打开代理页面
打开 设置 --> 网络与Internet --> 查找代理
 
![image-1](https://github.com/trdong19/trdong19.github.io/assets/84180727/b7a62a98-cde4-42da-92cc-072a0216c178)

动图
记录下当前系统代理的 IP 地址和端口号

如上图所示，地址与端口号为：127.0.0.1:7890

3-2、修改 Git 的网络设置
# 注意修改成自己的IP和端口号

1. git config --global http.proxy http://127.0.0.1:7890 
2. git config --global https.proxy http://127.0.0.1:7890

 
四、完结撒花
可以重新 clone 尝试了（其实主要解决的是为啥搭建了梯子依旧不好使的问题，哈哈哈）

五、后记
当我们访问GitHub的时候一般都会使用梯子，所以往上推代码的时候也是需要梯子，没有梯子推送成功概率很低，一般都会报错超时，所以设置梯子提高访问成功率；

取消代理是因为，访问 Gitee 或其它是不需要梯子，所以要取消代理；或者后悔设置代理了，也可以利用此取消

# 取消代理

1. git config --global --unset http.proxy
2. git config --global --unset https.proxy



# 查看代理

1. git config --global --get http.proxy
2. git config --global --get https.proxy



### 请确保已在 Git 中配置你的"user.name"和“user.email'解决方法

修改完项目代码，准备提交到git上，结果提交失败，弹框提示：请确保已在Git中配置您的“user.name”和“user.email”
打开终端Git Bash，配置运行一下命令

1. $ git config --global user.name "your_username"  # 配置用户名
3. $ git config --global user.email "your_email"  # 配置邮箱

以上是全局配置“user.name”和“user.email”的命令，如果想要配置单个项目git的“user.name”和“user.email”，打开终端Git Bash，进到该项目目录下，运行命令：

1. $ git config user.name "your_username"
3. $ git config user.email "your_email"

配置完，查看git中配置的用户名和邮箱，看看是否配置成功

1. $ git config user.name
3. $ git config user.email


### 提交同步一直加载
解决办法是在你提交的时候填写一下提交信息