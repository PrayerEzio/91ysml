<!--左侧导航开始-->
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="nav-close"><i class="fa fa-times-circle"></i>
    </div>
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span><img alt="image" class="img-circle" style="height: 75px;width: 75px;" src="{{ session('admin_info.avatar') }}" /></span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs"><strong class="font-bold">{{ session('admin_info.nickname') }}</strong></span>
                            <span class="text-muted text-xs block">超级管理员<b class="caret"></b></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{ url('Admin/index/logout') }}">安全退出</a>
                        </li>
                    </ul>
                </div>
                <div class="logo-element">Crucis
                </div>
            </li>
            <li>
                <a class="J_menuItem" href="{{ url('Admin/Statistics/index',[],config('crucis.http_secure')) }}"
                   data-id="{{ url('Admin/Statistics/index',[],config('crucis.http_secure')) }}">
                    <i class="fa fa-chart-pie"></i>
                    <span class="nav-label">统计</span>
                </a>
            </li>
            <li>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="J_menuItem" href="" data-index="0">访问统计</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="" data-index="0">商品统计</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="" data-index="0">交易统计</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-toggle-on"></i>
                    <span class="nav-label">设置</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="J_menuItem" href="">基础设置</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-newspaper"></i> <span class="nav-label">文章 </span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="J_menuItem" href="{{ url('Admin/Article/cateList') }}">分类列表</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="{{ url('Admin/Article/index') }}">文章列表</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="{{ url('Admin/Article/add') }}">新增文章</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fab fa-adversal"></i> <span class="nav-label">广告</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="J_menuItem" href="{{ url('Admin/Advertisement') }}">广告列表</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-weight-hanging"></i> <span class="nav-label">商品</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="J_menuItem" href="{{ url('Admin/Goods/goodsCategoryList') }}">分类列表</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="{{ url('Admin/Attribute/attributeCategoryList') }}">属性列表</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="{{ url('Admin/Goods/goodsList') }}">商品列表</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-money-bill"></i> <span class="nav-label">交易</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a class="J_menuItem" href="{{ url('Admin/Order/orderList') }}">订单列表</a>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fab fa-expeditedssl"></i> <span class="nav-label">权限</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a class="J_menuItem" href="{{ url('Admin/Auth/admin_list') }}">管理员列表</a>
                    </li>
                    <li><a class="J_menuItem" href="{{ url('Admin/Auth/role_list') }}">管理组列表</a>
                    </li>
                    <li><a class="J_menuItem" href="{{ url('Admin/Auth/permission_list') }}">权限列表</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-user"></i> <span class="nav-label">会员</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="J_menuItem" href="{{ url('Admin/User') }}">会员列表</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-image"></i> <span class="nav-label">相册</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="J_menuItem" href="{{ url('Admin/Album') }}">相册列表</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="{{ url('Admin/Album/create') }}">创建相册</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-bug"></i> <span class="nav-label">系统</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="J_menuItem" href="{{ url('Admin/SystemLog/index') }}">系统日志</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="{{ url('Admin/System/phpinfo') }}">phpinfo</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="{{ url('Admin/System/tz') }}">服务器状态</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<!--左侧导航结束-->