<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>H+ 后台主题UI框架 - 基本表单</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">
    <link rel="shortcut icon" href="favicon.ico">
    <link href="{{ asset('Admin') }}/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="{{ asset('Admin') }}/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="{{ asset('Admin') }}/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="{{ asset('Admin') }}/css/animate.min.css" rel="stylesheet">
    <link href="{{ asset('Admin') }}/css/style.min.css?v=4.0.0" rel="stylesheet">
    <link href="{{ asset('Admin') }}/css/plugins/switchery/switchery.css" rel="stylesheet">
    <link href="{{ asset('Vendor') }}/layui/css/layui.css" rel="stylesheet">
    <base target="_self">
</head>
<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight blog">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{{ isset($data->id) ? '编辑' : '新增' }}会员 <small></small></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form method="{{ isset($data->id) ? 'PUT' : 'post' }}" action="{{ url('Admin/User') }}" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $data->id or 0 }}">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">昵称</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nickname" value="{{ $data->nickname or '' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">头像</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="avatar">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">邮箱</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="email" value="{{ $data->email or '' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">手机</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="phone" value="{{ $data->phone or '' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">余额</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="amount" value="{{ $data->amount or '' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">密码</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="password" value="{{ $data->passwrod or '' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">状态</label>
                                <div class="col-sm-10">
                                    <div class="col-sm-10">
                                        <input type="checkbox" id="status" name="status"
                                        @if(isset($data->status))
                                            @if($data->status == 1)
                                                'checked'
                                            @endif
                                        @else
                                            'checked'
                                        @endif
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary" type="submit">保存内容</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('Admin') }}/js/jquery.min.js?v=2.1.4"></script>
    <script src="{{ asset('Admin') }}/js/bootstrap.min.js?v=3.3.5"></script>
    <script src="{{ asset('Admin') }}/js/content.min.js?v=1.0.0"></script>
    <script src="{{ asset('Admin') }}/js/plugins/iCheck/icheck.min.js"></script>
    <script src="{{ asset('Admin') }}/js/plugins/switchery/switchery.js"></script>
    <script src="{{ asset('Admin') }}/js/plugins/datapicker/bootstrap-datepicker.js"></script>
    <script src="{{ asset('Admin') }}/js/plugins/cropper/cropper.min.js"></script>
    <script src="{{ asset('Vendor') }}/layui/layui.js"></script>
    <script src="{{ asset('Admin') }}/js/plugins/prettyfile/bootstrap-prettyfile.js" type="text/javascript" charset="utf-8"></script>
    <script>
        layui.use('upload', function(){
            layui.upload({
                url: '{{ url('Admin/Auth/admin_avatar_upload') }}',
                method:'post',
                success: function(src){
                    console.log(src)
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $(".i-checks").iCheck({checkboxClass: "icheckbox_square-green", radioClass: "iradio_square-green",});
            initSwitchery("status","#1AB394");
        });
        function initSwitchery(id,color)
        {
            var i = document.querySelector("#"+id), t = (new Switchery(i, {color: color}));
        }
    </script>
    <script>
        $( 'input[type="file"]' ).prettyFile();
    </script>
</body>
</html>