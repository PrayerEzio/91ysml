<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>H+ 后台主题UI框架 - 数据表格</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="favicon.ico">
    <link href="{{ asset('Admin') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('Admin') }}/css/font-awesome.min.css" rel="stylesheet">
    <!-- Data Tables -->
    <link href="{{ asset('Admin') }}/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="{{ asset('Admin') }}/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="{{ asset('Admin') }}/css/animate.min.css" rel="stylesheet">
    <link href="{{ asset('Admin') }}/css/style.min.css" rel="stylesheet">
    <!-- toastr Alert -->
    <link href="{{ asset('Admin') }}/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <base target="_self">
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>会员列表
                        <small></small>
                    </h5>
                    <div class="ibox-tools">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="table_data_tables.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li>
                                <a href="{{ url('/Admin/User/create') }}"><i class="fa fa-plus"></i> 新增</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="ibox-content">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>昵称</th>
                            <th>邮箱</th>
                            <th>手机</th>
                            <th>余额</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($list as $item)
                            <tr>
                                <td class="center">{{ $item->id }}</td>
                                <td>{{ $item->nickname or '' }}</td>
                                <td>{{ $item->email or '' }}</td>
                                <td>{{ $item->phone or '' }}</td>
                                <td>{{ $item->amount }}</td>
                                <td>{{ $item->status == 1 ? '正常' : '冻结' }}</td>
                                <td>
                                    <a class="btn btn-info" href="{{ url("/Admin/User/{$item->id}/edit" ) }}"><i class="fa fa-edit"></i> 编辑</a>
                                    {{--<a class="btn btn-danger" onclick="delete_attribute_category({{ $item->id }})"><i class="fa fa-trash"></i> 删除</a>--}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>昵称</th>
                            <th>邮箱</th>
                            <th>手机</th>
                            <th>余额</th>
                            <th>状态</th>
                            <th>操作</th>
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
<script src="{{ asset('Admin') }}/js/plugins/toastr/toastr.min.js"></script>
<script src="{{ asset('Admin') }}/js/plugins/sweetalert/sweetalert.min.js"></script>
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
</script>
<script type="text/javascript">
    $(function(){
        var shortCutFunction = '{{ session('alert.0') }}';
        var title = '{{ session('alert.1') }}';
        var msg = '{{ session('alert.2') }}';
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "400",
            "hideDuration": "1000",
            "timeOut": "7000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        toastr[shortCutFunction](msg,title);
    });
</script>
<script>
        $(document).ready(function(){$(".dataTables-example").dataTable()});
</script>
<script>
    function delete_attribute_category(id)
    {
        swal({
            title: "您确定要删除这条信息吗",
            text: "删除后将无法恢复，请谨慎操作！",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "删除",
            cancelButtonText: "取消",
            closeOnConfirm: false
        }, function () {
            var URL = '{{ url('Admin/Attribute/deleteAttributeCategory') }}';
            var data = {_method:"DELETE",id:id};
            $.post(URL, data, function (result) {
                if (result.status == 200)
                {
                    swal("删除成功！", result.message, "success");
                }else {
                    swal("删除失败！", result.message, "error");
                }
            });
        })
    }
</script>
</body>
</html>