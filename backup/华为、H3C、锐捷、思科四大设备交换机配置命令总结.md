**一、华为交换机基础配置命令

1、创建vlan：

<Quidway> //用户视图，也就是在Quidway模式下运行命令。
<Quidway>system-view //进入配置视图
[Quidway] vlan 10 //创建vlan 10，并进入vlan10配置视图，如果vlan10存在就直接进入vlan10配置视图
[Quidway-vlan10] quit //回到配置视图
[Quidway] vlan 100 //创建vlan 100，并进入vlan100配置视图，如果vlan10存在就直接进入vlan100配置视图

[Quidway-vlan100] quit //回到配置视图



2、将端口加入到vlan中：

[Quidway] interface GigabitEthernet2/0/1 (10G光口)
[Quidway- GigabitEthernet2/0/1] port link-type access //定义端口传输模式
[Quidway- GigabitEthernet2/0/1] port default vlan 100 //将端口加入vlan100
[Quidway- GigabitEthernet2/0/1] quit //回到配置视图

[Quidway] interface GigabitEthernet1/0/0 //进入1号插槽上的第一个千兆网口配置视图中。0代表1号口
[Quidway- GigabitEthernet1/0/0] port link-type access //定义端口传输模式
[Quidway- GigabitEthernet2/0/1] port default vlan 10 //将这个端口加入到vlan10中
[Quidway- GigabitEthernet2/0/1] quit

3、将多个端口加入到VLAN中

<Quidway>system-view
[Quidway]vlan 10
[Quidway-vlan10]port GigabitEthernet 1/0/0 to 1/0/29 //将0到29号口加入到vlan10中
[Quidway-vlan10]quit



4、交换机配置IP地址

[Quidway] interface Vlanif100 // 进入vlan100接口视图与vlan 100命令进入的地方不同
[Quidway-Vlanif100] ip address 119.167.200.90 255.255.255.252 // 定义vlan100管理IP三层交换网关路由
[Quidway-Vlanif100] quit //返回视图
[Quidway] interface Vlanif10 // 进入vlan10接口视图与vlan 10命令进入的地方不同
[Quidway-Vlanif10] ip address 119.167.206.129 255.255.255.128 // 定义vlan10管理IP三层交换网关路由

[Quidway-Vlanif10] quit



5、配置默认网关：

[Quidway]ip route-static 0.0.0.0 0.0.0.0 119.167.200.89//配置默认网关。



6、 交换机保存设置和重置命令

<Quidway>save //保存配置信息
<Quidway>reset saved-configuration //重置交换机的配置
<Quidway>reboot //重新启动交换机



7、交换机常用的显示命令

用户视图模式下：
<Quidway>display current-configuration //显示现在交换机正在运行的配置明细
<Quidway>display device //显示各设备状态
<Quidway>display interface ？ //显示个端口状态，用？可以查看后边跟的选项
<Quidway>display version //查看交换机固件版本信息
<Quidway>display vlan ？ // 查看vlan的配置信息



8、恢复交换机出厂设置

<Quidway>reset saved-configuration //重置交换机的配置



二、H3C交换机的基本配置

我们先来了解下h3c的配置命令与功能，都是常用的，基本上大部分网络配置都少不了这些命令。



1、基本配置

<H3C> //用户直行模式提示符,用户视图

<H3C>system-view //进入配置视图
[H3C] sysname xxx //设置主机名成为xxx这里使用修改特权用户密码



2、用户配置

<H3C>system-view

[H3C]super password H3C //设置用户分级密码

[H3C]undo superpassword //删除用户分级密码

[H3C]localuser bigheap 1234561 //Web网管用户设置,1为管理级用户

[H3C]undo localuser bigheap //删除Web网管用户

[H3C]user-interface aux 0 //只支持0

[H3C-Aux]idle-timeout 250 //设置超时为2分50秒,若为0则表示不超时,默认为5分钟



[H3C-Aux]undoidle-timeout //恢复默认值

[H3C]user-interface vty 0 //只支持0和1

[H3C-vty]idle-timeout 250 //设置超时为2分50秒,若为0则表示不超时,默认为5分钟

[H3C-vty]undoidle-timeout //恢复默认值

[H3C-vty]set authentication password123456 //设置telnet密码,必须设置

[H3C-vty]undo set authenticationpassword //取消密码

[H3C]displayusers //显示用户

[H3C]displayuser-interface //用户界面状态



3、vlan配置

[H3C]vlan 2 //创建VLAN2

[H3C]undo vlanall //删除除缺省VLAN外的所有VLAN,缺省VLAN不能被删除

[H3C-vlan2]port Ethernet 0/4 to Ethernet0/7 //将4到7号端口加入到VLAN2中,此命令只能用来加access端口,不能用来增加trunk或者hybrid端口



[H3C-vlan2]port-isolate enable//打开VLAN内端口隔离特性，不能二层转发,默认不启用该功能



[H3C-Ethernet0/4]port-isolate uplink-portvlan 2 //设置4为VLAN2的隔离上行端口，用于转发二层数据,只能配置一个上行端口,若为trunk,则建议允许所有VLAN通过,隔离不能与汇聚同时配置



[H3C]display vlan all //显示所有VLAN的详细信息



[H3C]user-group 20 //创建user-group 20，默认只存在user-group 1



[H3C-UserGroup20]port Ethernet 0/4 toEthernet 0/7 //将4到7号端口加入到VLAN20中，初始时都属于user-group 1中

[H3C]display user-group 20 //显示user-group 20的相关信息





四、交换机ip配置

[H3C]vlan 20 //创建vlan

[H3C]management-vlan 20 //管理vlan

[H3C]interface vlan-interface 20 //进入并管理vlan20

[H3C]undo interface vlan-interface 20 //删除管理VLAN端口

[H3C-Vlan-interface20]ip address192.168.1.2 255.255.255.0 //配置管理VLAN接口静态IP地址



[H3C-Vlan-interface20]undo ipaddress //删除IP地址

[H3C-Vlan-interface20]ip gateway 192.168.1.1 //指定缺省网关(默认无网关地址)

[H3C-Vlan-interface20]undo ip gateway

[H3C-Vlan-interface20]shutdown //关闭接口

[H3C-Vlan-interface20]undo shutdown //开启

[H3C]display ip //显示管理VLAN接口IP的相关信息

[H3C]display interface vlan-interface20 //查看管理VLAN的接口信息

<H3C>debugging ip //开启IP调试功能

<H3C>undo debugging ip





5、DHCP客户端配置

[H3C-Vlan-interface20]ip address dhcp-alloc // 管理VLAN接口通过DHCP方式获取IP地址

[H3C-Vlan-interface20]undo ip address dhcp-alloc // 取消

[H3C]display dhcp //显示DHCP客户信息

<H3C>debugging dhcp-alloc //开启DHCP调试功能

<H3C>undo debugging dhcp-alloc





6、端口配置

[H3C]interface Ethernet0/3 //进入端口

[H3C-Ethernet0/3]shutdown //关闭端口

[H3C-Ethernet0/3]speed 100 //速率可为10,100,1000和auto(缺省)

[H3C-Ethernet0/3]duplexfull //双工,可为half,full和auto，光口和汇聚后不能配置

[H3C-Ethernet0/3]flow-control //开启流控，默认为关闭

[H3C-Ethernet0/3]broadcast-suppression 20 //设置抑制广播百分比为20%,可取5,10,20,100,缺省为100,同时组播和未知单播也受此影响

[H3C-Ethernet0/3]loopback internal //内环测试

[H3C-Ethernet0/3]port link-type trunk //设置链路的类型为trunk

[H3C-Ethernet0/3]port trunk pvid vlan 20 //设置20为该trunk的缺省VLAN，默认为1(trunk线路两端的PVID必须一致)

[H3C-Ethernet0/3]port access vlan 20 //将当前access端口加入指定的VLAN

[H3C-Ethernet0/3]port trunk permit vlanall //允许所有的VLAN通过当前的trunk端口,可多次使用该命令

[H3C-Ethernet0/3]mdiauto //设置以太端口为自动监测,normal为直通线,across为交叉线

[H3C]link-aggregation Ethernet 0/1 toEthernet 0/4 //将1-4口加入汇聚组,1为主端口,两端需要同时配置,设置了端口镜像以及端口隔离的端口无法汇聚



[H3C]undo link-aggregation Ethernet 0/1 //删除该汇聚组

[H3C]link-aggregation mode egress //配置端口汇聚模式为根据目的MAC地址进行负荷分担,可选为 ingress,egress和both,缺省为both

[H3C]monitor-port Ethernet 0/2 //将该端口设置为镜像端口,必须先设置镜像端口,删除时必须先删除被镜像端口,而且它们不能同在一个端口,该端口不能在汇聚组中,设置新镜像端口时,新取代旧,被镜像不变



[H3C]mirroring-port Ethernet 0/3 toEthernet 0/4 both //将端口3和4设置为被镜像端口,both为同时监控接收和发送的报文,inbound表示仅监控接收的报文,outbound表示仅监控发送的报文



[H3C]display mirror

[H3C]display interface Ethernet 0/3

<H3C>resetcounters //清除所有端口的统计信息

[H3C]display link-aggregation Ethernet0/3 //显示端口汇聚信息

[H3C-Ethernet0/3]virtual-cable-test //诊断该端口的电路状况



7、qos优先级配置

QoS配置步骤：设置端口的优先级,设置交换机信任报文的优先级方式,队列调度,端口限速

[H3C-Ethernet0/3]priority 7 //设置端口优先级为7，默认为0

[H3C]priority-trustcos //设置交换机信任报文的优先级方式为cos(802.1p优先级,缺省值),还可以设为dscp方式



[H3C]queue-scheduler hq-wrr 2 4 6 8 //设置队列调度算法为HQ-WRR(默认为WRR),权重为2,4,6,8

[H3C-Ethernet0/3]line-rate inbound 29 //将端口进口速率限制为2Mbps,取1-28时,速率为rate*8*1024/125,即64,128,192...1.792M；

29-127时,速率为(rate-27)*1024,即2M,3M,4M...100M。



[H3C]displayqueue-scheduler //显示队列调度模式及参数

[H3C]displaypriority-trust //显示优先级信任模式





三、锐捷交换机基础命令配置



连接上交换机后，肯定是需要进行命令配置，我们来看下基础命令配置。



1、准备命令

>Enable //进入特权模式
#Exit //返回上一级操作模式
#End //返回到特权模式
#copy running-config startup-config//保存配置文件
#del flash:config.text//删除配置文件(交换机及1700系列路由器)
#erase startup-config//删除配置文件(2500系列路由器)
#del flash:vlan.dat //删除Vlan配置信息（交换机）
#Configure terminal //进入全局配置模式
(config)# hostname switchA//配置设备名称为switchA
(config)#banner motd &//配置每日提示信息 &为终止符
(config)#enable secret level 1 0 star//配置远程登陆密码为star
(config)#enable secret level 15 0 star//配置特权密码为star
Level 1为普通用户级别，可选为1~15，15为最高权限级别；0表示密码不加密
(config)#enable services web-server//开启交换机WEB管理功能
Services 可选以下：web-server(WEB管理)、telnet-server(远程登陆)等



2、查看信息

#show running-config //查看当前生效的配置信息
#show interface fastethernet 0/3 //查看F0/3端口信息
#show interface serial 1/2//查看S1/2端口信息
#show interface //查看所有端口信息
#show ip interface brief //以简洁方式汇总查看所有端口信息
#show ip interface //查看所有端口信息
#show version //查看版本信息
#show mac-address-table //查看交换机当前MAC地址表信息
#show running-config //查看当前生效的配置信息
#show vlan //查看所有VLAN信息
#show vlan id 10 //查看某一VLAN (如VLAN10)的信息
#show interface fastethernet 0/1 //查看某一端口模式(如F 0/1)
#show aggregateport 1 summary//查看聚合端口AG1的信息
#show spanning-tree //查看生成树配置信息
#show spanning-tree interface fastethernet 0/1 //查看该端口的生成树状态
#show port-security//查看交换机的端口安全配置信息
#show port-security address //查看地址安全绑定配置信息
#show ip access-lists listname //查看名为listname的列表的配置信息



3、端口的基本配置
(config)#Interface fastethernet 0/3 //进入F0/3的端口配置模式
(config)#interface range fa 0/1-2,0/5,0/7-9 //进入F0/1、F0/2、F0/5、F0/7、F0/8、F0/9的端口配置模式
(config-if)#speed 10 //配置端口速率为10M,可选10,100,auto
(config-if)#duplex full //配置端口为全双工模式,可选full(全双工),half(半双式),auto(自适应)
(config-if)#no shutdown //开启该端口
(config-if)#switchport access vlan 10 //将该端口划入VLAN10中,用于VLAN
(config-if)#switchport mode trunk //将该端口设为trunk模式,可选模式为access , trunk
(config-if)#port-group 1 //将该端口划入聚合端口AG1中,用于聚合端口



4、聚合端口的创建

(config)# interface aggregateport 1 //创建聚合接口AG1
(config-if)# switchport mode trunk //配置并保证AG1为 trunk 模式
(config)#int f0/23-24
(config-if-range)#port-group 1 //将端口（端口组）划入聚合端口AG1中



5、生成树

配置多生成树协议:

switch(config)#spanning-tree //开启生成树协议

switch(config)#spanning-tree mst configuration //建立多生成树协议
switch(config-mst)#name ruijie //命名为ruijie
switch(config-mst)#revision 1 //设定校订本为1
switch(config-mst)#instance 0 vlan 10,20 //建立实例0
switch(config-mst)#instance 1 vlan 30,40 //建立实例1
switch(config)#spanning-tree mst 0 priority 4096 //设置优先级为4096
switch(config)#spanning-tree mst 1 priority 8192 //设置优先级为8192
switch(config)#interface vlan 10
switch(config-if)#vrrp 1 ip 192.168.10.1 //此为vlan 10的IP地址
switch(config)#interface vlan 20
switch(config-if)#vrrp 1 ip 192.168.20.1 //此为vlan 20的IP地址
switch(config)#interface vlan 30
switch(config-if)#vrrp 2 ip 192.168.30.1 //此为vlan 30的IP地址(另一三层交换机)
switch(config)#interface vlan 40
switch(config-if)#vrrp 2 ip 192.168.40.1 //此为vlan 40的IP地址(另一三层交换机)



6、VLAN的基本配置

(config)#vlan 10 //创建VLAN10
(config-vlan)#name vlanname // 命名VLAN为vlanname
(config-if)#switchport access vlan 10 //将该端口划入VLAN10中
某端口的接口配置模式下进行
(config)#interface vlan 10 //进入VLAN 10的虚拟端口配置模式
(config-if)# ip address 192.168.1.1 255.255.255.0 //为VLAN10的虚拟端口配置IP及掩码，二层交换机只能配置一个IP，此IP是作为管理IP使用，例如，使用Telnet的方式登录的IP地址
(config-if)# no shutdown //启用该端口





7、端口安全

(config)# interface fastethernet 0/1 //进入一个端口
(config-if)# switchport port-security //开启该端口的安全功能



a、配置最大连接数限制

(config-if)# switchport port-secruity maxmum 1 //配置端口的最大连接数为1，最大连接数为128
(config-if)# switchport port-secruity violation shutdown
//配置安全违例的处理方式为shutdown，可选为protect (当安全地址数满后，将未知名地址丢弃)、restrict(当违例时，发送一个Trap通知)、shutdown(当违例时将端口关闭，并发送Trap通知，可在全局模式下用errdisable recovery来恢复)



b、IP和MAC地址绑定

(config-if)#switchport port-security mac-address xxxx.xxxx.xxxx ip-address 172.16.1.1
//接口配置模式下配置MAC地址xxxx.xxxx.xxxx和IP172.16.1.1进行绑定(MAC地址注意用小写)





8、三层路由功能(针对三层交换机)

(config)# ip routing //开启三层交换机的路由功能
(config)# interface fastethernet 0/1
(config-if)# no switchport//开启端口的三层路由功能(这样就可以为某一端口配置IP)
(config-if)# ip address 192.168.1.1 255.255.255.0
(config-if)# no shutdown
　　

9、三层交换机路由协议

(config)# ip route 172.16.1.0 255.255.255.0 172.16.2.1//配置静态路由

注:172.16.1.0 255.255.255.0 //为目标网络的网络号及子网掩码
172.16.2.1 为下一跳的地址，也可用接口表示,如ip route 172.16.1.0 255.255.255.0 serial 1/2(172.16.2.0所接的端口)



(config)# router rip //开启RIP协议进程
(config-router)# network 172.16.1.0//申明本设备的直连网段信息
(config-router)# version 2//开启RIP V2，可选为version 1(RIPV1)、version 2(RIPV2)
(config-router)# no auto-summary//关闭路由信息的自动汇总功能(只有在RIPV2支持)

(config)# router ospf//开启OSPF路由协议进程（针对1762，无需使用进程ID）
(config)# router ospf 1//开启OSPF路由协议进程（针对2501，需要加OSPF进程ID）
(config-router)# network 192.168.1.0 0.0.0.255 area 0
//申明直连网段信息，并分配区域号(area0为骨干区域)



可以明显看出，三家命令大同小异，其实华为与H3C更加类似。



四、思科交换机基本配置命令

除了上面三家命令之外，我们平时做项目，也有可能会遇到思科的交换机，我们就一起来详细的了解思科交换机的配置命令。

1：进入特权模式 enable

switch> enable

switch#



2：进入全局配置模式 configure terminal

switch> enable

switch＃c onfigure terminal

switch(conf)#



3：交换机命名 hostname aptech2950 以 aptech2950 为例

switch> enable

switch＃c onfigure terminal

switch(conf)#hostname aptch-2950

aptech2950(conf)#



4：配置使能口令 enable password cisco 以 cisco 为例

switch> enable

switch＃c onfigure terminal

switch(conf)#hostname aptch2950

aptech2950(conf)# enable password cisco



5：配置使能密码 enable secret ciscolab 以 cicsolab 为例

switch> enable

switch＃c onfigure terminal

switch(conf)#hostname aptch2950

aptech2950(conf)# enable secret ciscolab



6：创建多个vlan

1、创建多个VLAN

Switch>enable（进入特权模式）

Switch#vlan data （进入vlan配置模式）

Switch(vlan)#vlan 10 nameIT （划分vlan10，名称为IT）

Switch(vlan)#vlan 20 nameHR （划分vlan20，名称为HR）

Switch(vlan)#vlan 30 name FIN （划分vlan30，名称为FIN）

Switch(vlan)#vlan 40 nameLOG （划分vlan40，名称为LOG）

Switch(vlan)#exit



7：设置 vlan 1

switch> enable

switch＃c onfigure terminal

switch(conf)#hostname aptch2950

aptech2950(conf)# interface vlan 1

aptech2950(conf-if)#ip address 192.168.1.1 255.255.255.0 配置交换机端口 ip 和子网掩码



aptech2950(conf-if)#no shut 是配置处于运行中

aptech2950(conf-if)#exit

aptech2950(conf)#ip default-gateway 192.168.254 设置网关地址



8：进入交换机某一端口 interface fastehernet 0/17 以 17 端口为例

switch> enable

switch＃c onfigure terminal

switch(conf)#hostname aptch2950

aptech2950(conf)# interface fastehernet 0/17

aptech2950(conf-if)#



9：查看命令 show

switch> enable

switch# show version 察看系统中的所有版本信息

show interface vlan 1 查看交换机有关 ip 协议的配置信息

show running-configure 查看交换机当前起作用的配置信息

show interface fastethernet 0/1 察看交换机 1 接口具体配置和统计信息

show mac-address-table 查看 mac 地址表

show mac-address-table aging-time 查看 mac 地址表自动老化时间



10：交换机恢复出厂默认恢复命令

switch> enable

switch# erase startup-configure

switch# reload



11：双工模式设置

switch> enable

switch＃c onfigure terminal

switch2950(conf)#hostname aptch-2950

aptech2950(conf)# interface fastehernet 0/17 以 17 端口为例

aptech2950(conf-if)#duplex full/half/auto 有 full , half, auto 三个可选

项



11：cdp 相关命令

switch> enable

switch# show cdp 查看设备的 cdp 全局配置信息

show cdp interface fastethernet 0/17 查看 17 端口的 cdp 配置信息

show cdp traffic 查看有关 cdp 包的统计信息

show cdp nerghbors 列出与设备相连的 cisco 设备





12：交换机 telnet 远程登录设置：

switch>en

switch＃c onfigure terminal

switch(conf)#hostname aptech-2950

aptech2950(conf)#enable password cisco 以 cisco 为特权模式密码

aptech2950(conf)#interface fastethernet 0/1 以 17 端口为 telnet 远程登录端口

aptech2950(conf-if)#ip address 192.168.1.1 255.255.255.0

aptech2950(conf-if)#no shut

aptech2950(conf-if)#exit

aptech2950(conf)line vty 0 4 设置 0-4 个用户可以 telnet 远程登陆

aptech2950(conf-line)#login

aptech2950(conf-line)#password edge 以 edge 为远程登录的用户密码

主机设置：

ip 192.168.1.2 主机的 ip 必须和交换机端口的地址在同一网络

段

netmask 255.255.255.0

gate-way 192.168.1.1 网关地址是交换机端口地址

运行：

telnet 192.168.1.1

进入 telnet 远程登录界面

password : edge

aptech2950>en

password: cisco

aptech#**