<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>H+ 后台主题UI框架 - 数据表格</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">
    <link rel="shortcut icon" href="favicon.ico">
    <link href="{{ asset('Admin') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('Admin') }}/css/font-awesome.min.css" rel="stylesheet">
    <!-- Data Tables -->
    <link href="{{ asset('Admin') }}/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="{{ asset('Admin') }}/css/animate.min.css" rel="stylesheet">
    <link href="{{ asset('Admin') }}/css/style.min.css" rel="stylesheet">
    <base target="_blank">
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>商品列表
                        <small></small>
                    </h5>
                    <div class="ibox-tools">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="table_data_tables.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li>
                                <a onclick="fnClickAddRow();" href="javascript:void(0);"><i class="fa fa-plus"></i> 新增</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="ibox-content">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>商品名称</th>
                            <th>所属分类</th>
                            <th>图片</th>
                            <th>上传时间</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($goods_list as $goods)
                            <tr>
                                <td class="center">{{ $goods->id }}</td>
                                <td>{{ $goods->name }}</td>
                                <td>{{ $permission->category->name }}</td>
                                <td>{{ $permission->created_at }}</td>
                                <td>
                                    <a class="btn btn-info"><i class="fa fa-edit"></i> 编辑</a>
                                    <a class="btn btn-danger"><i class="fa fa-trash"></i> 删除</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>商品名称</th>
                            <th>所属分类</th>
                            <th>图片</th>
                            <th>上传时间</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('Admin') }}/js/jquery.min.js"></script>
<script src="{{ asset('Admin') }}/js/bootstrap.min.js"></script>
<script src="{{ asset('Admin') }}/js/plugins/jeditable/jquery.jeditable.js"></script>
<script src="{{ asset('Admin') }}/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="{{ asset('Admin') }}/js/plugins/dataTables/dataTables.bootstrap.js"></script>
{{--<script src="{{ asset('Admin') }}/js/content.min.js?v=1.0.0"></script>--}}
<script>
        $(document).ready(function(){$(".dataTables-example").dataTable()});
</script>
</body>
</html>