<!--左侧导航开始-->
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="nav-close"><i class="fa fa-times-circle"></i>
    </div>
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span><img alt="image" class="img-circle" style="height: 75px;" src="{{ session('admin_info.avatar') }}" /></span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs"><strong class="font-bold">{{ session('admin_info.nickname') }}</strong></span>
                            <span class="text-muted text-xs block">超级管理员{{--<b class="caret"></b>--}}</span>
                        </span>
                    </a>
                    {{--<ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="J_menuItem" href="form_avatar.html">修改头像</a>
                        </li>
                        <li><a class="J_menuItem" href="profile.html">个人资料</a>
                        </li>
                        <li><a class="J_menuItem" href="contacts.html">联系我们</a>
                        </li>
                        <li><a class="J_menuItem" href="mailbox.html">信箱</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{ url('Admin/index/logout') }}">安全退出</a>
                        </li>
                    </ul>--}}
                </div>
                <div class="logo-element">Crucis
                </div>
            </li>
            {{--<li>
                <a href="#">
                    <i class="fa fa-home"></i>
                    <span class="nav-label">统计</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="J_menuItem" href="{{ url('Admin/Index/about_us') }}" data-index="0">主页示例一</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="{{ url('Admin/Index/billboard') }}">主页示例二</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="index_v3.html">主页示例三</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="index_v4.html">主页示例四</a>
                    </li>
                    <li>
                        <a href="index_v5.html" target="_blank">主页示例五</a>
                    </li>
                </ul>
            </li>--}}
            {{--<li>
                <a class="J_menuItem" href="layouts.html"><i class="fa fa-columns"></i> <span class="nav-label">设置</span></a>
            </li>--}}
            {{--<li>
                <a href="#">
                    <i class="fa fa-bar-chart"></i>
                    <span class="nav-label">设置</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="J_menuItem" href="graph_echarts.html">百度ECharts</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="graph_flot.html">Flot</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="graph_morris.html">Morris.js</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="graph_rickshaw.html">Rickshaw</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="graph_peity.html">Peity</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="graph_sparkline.html">Sparkline</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="graph_metrics.html">图表组合</a>
                    </li>
                </ul>
            </li>--}}
            <li>
                <a href="#"><i class="fa fa-cutlery"></i> <span class="nav-label">文章 </span><span class="fa arrow"></span></a>
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
                <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">广告</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="J_menuItem" href="{{ url('Admin/Advertisement') }}">广告列表</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">商品</span><span class="fa arrow"></span></a>
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
                <a href="#"><i class="fa fa-flask"></i> <span class="nav-label">交易</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a class="J_menuItem" href="{{ url('Admin/Order/orderList') }}">订单列表</a>
                </ul>
            </li>
            {{--<li>
                <a href="#"><i class="fa fa-table"></i> <span class="nav-label">数据</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a class="J_menuItem" href="table_basic.html">基本表格</a>
                    </li>
                    <li><a class="J_menuItem" href="table_data_tables.html">DataTables</a>
                    </li>
                    <li><a class="J_menuItem" href="table_jqgrid.html">jqGrid</a>
                    </li>
                    <li><a class="J_menuItem" href="table_foo_table.html">Foo Tables</a>
                    </li>
                    <li><a class="J_menuItem" href="table_bootstrap.html">Bootstrap Table
                            <span class="label label-danger pull-right">推荐</span></a>
                    </li>
                </ul>
            </li>--}}
            <li>
                <a href="#"><i class="fa fa-picture-o"></i> <span class="nav-label">权限</span><span class="fa arrow"></span></a>
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
                <a href="#"><i class="fa fa-cutlery"></i> <span class="nav-label">会员 </span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="J_menuItem" href="{{ url('Admin/User') }}">会员列表</a>
                    </li>
                </ul>
            </li>
            {{--<li>
                <a href="mailbox.html"><i class="fa fa-envelope"></i> <span class="nav-label">邮箱 </span><span class="label label-warning pull-right">16</span></a>
                <ul class="nav nav-second-level">
                    <li><a class="J_menuItem" href="{{ url('Admin/Mail/inbox') }}">收件箱</a>
                    </li>
                    <li><a class="J_menuItem" href="{{ url('Admin/Mail/mail_detail') }}">查看邮件</a>
                    </li>
                    <li><a class="J_menuItem" href="{{ url('Admin/Mail/mail_compose') }}">写信</a>
                    </li>
                </ul>
            </li>--}}
            {{--<li>
                <a href="#"><i class="fa fa-cutlery"></i> <span class="nav-label">任务 </span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a class="J_menuItem" href="form_builder.html">表单构建器</a>
                    </li>
                </ul>
            </li>--}}
            {{--<li>
                <a href="#"><i class="fa fa-cutlery"></i> <span class="nav-label">社交 </span><span class="fa arrow"></span></a>
            </li>--}}
        </ul>
    </div>
</nav>
<!--左侧导航结束-->