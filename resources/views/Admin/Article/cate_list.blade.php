<!DOCTYPE html><html><head>    <meta charset="utf-8">    <meta name="viewport" content="width=device-width, initial-scale=1.0">        <title>H+ 后台主题UI框架 - 文章列表</title>    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">    <meta name="csrf-token" content="{{ csrf_token() }}">    <link rel="shortcut icon" href="favicon.ico"> <link href="{{ asset('Admin') }}/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">    <link href="{{ asset('Admin') }}/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">    <link href="{{ asset('Admin') }}/css/plugins/jsTree/style.min.css" rel="stylesheet">    <link href="{{ asset('Admin') }}/css/animate.min.css" rel="stylesheet">    <link href="{{ asset('Admin') }}/css/style.min.css?v=4.0.0" rel="stylesheet"><base target="_blank"></head><body class="gray-bg">    <div class="wrapper wrapper-content  animated fadeInRight">        <div class="col-sm-12">            <div class="ibox float-e-margins">                <div class="ibox-title">                    <h5>文章分类 <small></small></h5>                </div>                <div class="ibox-content">                    <div id="jstree1">                    </div>                </div>            </div>        </div>    </div>    <script src="{{ asset('Admin') }}/js/jquery.min.js?v=2.1.4"></script>    <script src="{{ asset('Admin') }}/js/bootstrap.min.js?v=3.3.5"></script>    <script src="{{ asset('Admin') }}/js/content.min.js?v=1.0.0"></script>    <script src="{{ asset('Admin') }}/js/plugins/jsTree/jstree.min.js"></script>    <script>        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});    </script>    <script>        $(document).ready(            getArticleCategoryList()        );        $('#jstree1').on('changed.jstree', function (e, data) {            var i, j, r = [];            for(i = 0, j = data.selected.length; i < j; i++) {                r.push(data.instance.get_node(data.selected[i]).text);            }            console.log(r.join(', '));        });        function getArticleCategoryList() {            var URL = '{{ url('Ajax/getArticleCategoryList') }}';            var data = {};            $.post(URL, data, function (result) {                if (result.status == 200) {                    for(item in result.data)                    {                        if (result.data[item]['parent_id'] == 0)                        {                            result.data[item]['parent'] = '#';                        }else {                            result.data[item]['parent'] = result.data[item]['parent_id'];                        }                        result.data[item]['text'] = result.data[item]['name'];                        result.data[item]['state'] = {                            opened    : true  // is the node open                        };                    }                    $("#jstree1").jstree({ 'core' : {                            'data' : result.data,                            "check_callback" : true                        },                        "plugins" : ["contextmenu"],                        "contextmenu":{                            "items":{                                "create":null,                                "rename":null,                                "remove":null,                                "ccp":null,                                "新建分类":{                                    "label":"新建分类",                                    "icon" :"fa fa-plus",                                    "action":function(data){                                        var inst = jQuery.jstree.reference(data.reference),                                            obj = inst.get_node(data.reference);                                        dialog.show({"title":"新建“"+obj.text+"”的子菜单",url:"/accountmanage/createMenu?id="+obj.id,height:280,width:400});                                    }                                },                                "删除菜单":{                                    "label":"删除菜单",                                    "icon" :"fa fa-trash",                                    "action":function(data){                                        var inst = jQuery.jstree.reference(data.reference),                                            obj = inst.get_node(data.reference);                                        if(confirm("确定要删除此菜单？删除后不可恢复。")){                                            jQuery.get("/accountmanage/deleteMenu?id="+obj.id,function(dat){                                                if(dat == 1){                                                    alert("删除菜单成功！");                                                    jQuery("#"+treeid).jstree("refresh");                                                }else{                                                    alert("删除菜单失败！");                                                }                                            });                                        }                                    }                                },                                "编辑菜单":{                                    "label":"编辑菜单",                                    "icon" :"fa fa-edit",                                    "action":function(data){                                        var inst = jQuery.jstree.reference(data.reference),                                            obj = inst.get_node(data.reference);                                        dialog.show({"title":"编辑“"+obj.text+"”菜单",url:"/accountmanage/editMenu?id="+obj.id,height:280,width:400});                                    }                                }                            }                        },                    });                } else {                    return false;                }            }, 'json');        }    </script></body></html>