@extends('Admin.main')
@section('title', "首页-Sramer")
@section('css')
    <link href="{{ asset('Admin') }}/css/plugins/chosen/chosen.css" rel="stylesheet">
@endsection()
@section('body')
    <div class="wrapper wrapper-content  animated fadeInRight blog">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>新增商品 <small></small></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商品分类</label>
                                <div class="col-sm-10">
                                    <select class="form-control m-b" name="category_id">
                                        @foreach ($cate_list as $cate)
                                            <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                            @foreach($cate->child as $sec_cate)
                                                <option value="{{ $sec_cate->id }}">&nbsp;&nbsp;&nbsp;&nbsp;{{ $sec_cate->name }}</option>
                                                @foreach($sec_cate->child as $tri_cate)
                                                    <option value="{{ $tri_cate->id }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $tri_cate->name }}</option>
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商品编号</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="goods_no" id="goods_no" value="{{ $goods_info->goods_no or '' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商品标题</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" value="{{ $goods_info->name or '' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商品副标题</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="sub_title" value="{{ $goods_info->sub_title or '' }}"> <span class="help-block m-b-none"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">图片</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="picture" value="{{ $goods_info->picture or '' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">标签</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="tag" value="{{ $goods_info->tag or '' }}"> <span class="help-block m-b-none">多个标签之间用,分割</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">描述</label>
                                <div class="col-sm-10">
                                    <input type="text" placeholder="描述" class="form-control" name="description" value="{{ $goods_info->description or '' }}">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">SEO标题</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="seo_title" value="{{ $goods_info->seo_title or '' }}"> <span class="help-block m-b-none"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">SEO关键字</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="seo_keywords" value="{{ $goods_info->seo_keywords or '' }}"> <span class="help-block m-b-none"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">SEO描述</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="seo_description" value="{{ $goods_info->seo_description or '' }}"> <span class="help-block m-b-none"></span>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" onclick="">属性分类</label>
                                <div class="col-sm-10">
                                    @foreach ($attribute_category_list as $attribute_category)
                                    <label class="checkbox-inline i-checks">
                                        <input type="checkbox" class="attribute_category" value="{{ $attribute_category->id }}">{{ $attribute_category->name }}</label>
                                    @endforeach
                                </div>
                            </div>
                            <div id="attribute_label">

                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">产品列表</label>
                                <div class="col-sm-10">
                                    <button class="btn btn-info btn-sm" type="button" onclick="generateProductList();">批量生成产品</button>
                                    <div id="product_list">

                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商品详情</label>
                                @include('vendor.UEditor.head')
                                <div class="col-sm-10"><script id="container" name="detail" type="text/plain" style="width:1024px;height:500px;">{!! isset($goods_info->detail) ? html_entity_decode($goods_info->detail) : '' !!}</script></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">排序</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="sort" value="{{ $goods_info->sort or 0 }}"> <span class="help-block m-b-none"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">状态</label>
                                <div class="col-sm-10">
                                    <div class="col-sm-10">
                                        <input type="checkbox" id="status" name="status"
                                        @if(isset($goods_info->status))
                                            @if($goods_info->status == 1)
                                                'checked'
                                            @endif
                                        @endif
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary" type="submit">保存</button>
                                </div>
                            </div>
                        </form>
                        <!-- Modal -->
                        <div class="modal fade" id="selectAttributes" tabindex="-1" role="dialog" aria-labelledby="selectAttributesLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">选择属性</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row form-horizontal">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">商品标题</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="name" value="{{ $goods_info->name or '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">商品副标题</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="sub_title" value="{{ $goods_info->sub_title or '' }}"> <span class="help-block m-b-none"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="{{ asset('Admin') }}/js/plugins/chosen/chosen.jquery.js"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        ue.ready(function(){
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
        });
    </script>
    <script>
        var config = {
            ".chosen-select": {},
            ".chosen-select-deselect": {allow_single_deselect: !0},
            ".chosen-select-no-single": {disable_search_threshold: 10},
            ".chosen-select-no-results": {no_results_text: "Oops, nothing found!"},
            ".chosen-select-width": {width: "95%"}
        };
        for (var selector in config)$(selector).chosen(config[selector]).change(function(){$(selector).trigger("liszt:updated")});
        var attributeCategoryArray = new Array(); // 盛放每组选中的attributeCategory值的对象
        var attributeCategoryList,attributeList;
        attributeCategoryList = {
        @foreach ($attribute_category_list as $attribute_category)
            {{ $attribute_category->id }} : '{{ $attribute_category->name }}',
        @endforeach
        };
        attributeList = {
        @foreach ($attribute_list as $attribute)
            {{ $attribute->id }} : {!! $attribute->toJson() !!},
        @endforeach
        };
        $('input').on('ifChecked', function(event){
            var type = event.target.className;
            var value = event.target.value;
            if (type == 'attribute_category')
            {
                var URL = '{{ url('Admin/Ajax/getAttributesList') }}';
                var data = {id:event.target.value};
                $.post(URL,data,function (result) {
                    var html = '<div class="form-group '+type+'_'+value+'">\n' +
                        '                                    <label class="col-sm-2 control-label" onclick="">'+result.data.name+'</label>\n' +
                        '                                    <div class="col-sm-10">\n' +
                        '                                        <div class="input-group">\n' +
                        '                                            <select data-placeholder="选择'+result.data.name+'" id="attribute_'+result.data.id+'" class="chosen-select" multiple style="width:350px;"\n' +
                        '                                                    tabindex="4">\n';
                    for (var x in result.data.attributes) html += '<option value="'+result.data.attributes[x]['id']+'">['+result.data.attributes[x]['value_code']+']   '+result.data.attributes[x]['value']+'</option>';
                    html +=                         '                                            </select>\n' +
                        '                                        </div>\n' +
                        '                                    </div>\n' +
                        '                                </dv>';
                    $('#attribute_label').append(html);
                    var attribute_selector = '#attribute_'+result.data.id;
                    $(attribute_selector).chosen(config['.chosen-select']).change(function(){$(attribute_selector).trigger("liszt:updated")});
                    attributeCategoryArray.push(result.data.id);
                    attributeCategoryArray.sort();
                });
            }
        });
        $('input').on('ifUnchecked', function(event){
            var type = event.target.className;
            var value = event.target.value;
            if (type == 'attribute_category') {
                $('.' + type + '_' + value).remove();
                attributeCategoryArray = $.grep(attributeCategoryArray, function(item) {
                    return item != value;
                });
                attributeCategoryArray.sort();
            }
        });
    </script>
    <script type="text/javascript">
        //select value获取
        function chose_get_value(select){
            return $(select).val();
        }

        function generateProductList() {
            var goods_no = $('#goods_no').val();
            var arr = [];
            $.each(attributeCategoryArray,function(index,value){
                var attribute_selector = '#attribute_'+value;
                arr.push(chose_get_value(attribute_selector));
            });
            var sarr = [[]];
            for (var i = 0; i < arr.length; i++) {
                var tarr = [];
                for (var j = 0; j < sarr.length; j++)
                    for (var k = 0; k < arr[i].length; k++)
                        tarr.push(sarr[j].concat(arr[i][k]));
                sarr = tarr;
            }
            var product_list_table_html = '<table class="table">\n' +
                '                            <thead>\n' +
                '                                <tr>\n' +
                '                                    <th>货号</th>\n';
            $.each(attributeCategoryArray,function(index,value){
                product_list_table_html += '             <th>'+attributeCategoryList[value]+'</th>\n';
            });
            product_list_table_html += '             <th>标牌价</th>\n' +
                '                                    <th>销售价</th>\n' +
                '                                    <th>库存</th>\n' +
                '                                    <th>仓位</th>\n' +
                '                                    <th>操作</th>\n' +
                '                                </tr>\n' +
                '                            </thead>\n' +
                '                            <tbody>\n';
            $.each(sarr,function(index,value){
                var attribute_value_code = '';
                var attribute_list_table_html = '';
                $.each(attributeCategoryArray,function(attr_key,attr_item){
                    attribute_list_table_html += '         <td><input type="hidden" name="product['+index+'][attribute]['+attr_key+']" value="'+attributeList[value[attr_key]]['id']+'">'+attributeList[value[attr_key]]['value']+'</td>\n';
                    attribute_value_code += attributeList[value[attr_key]]['value_code'];
                });
                product_list_table_html += '         <tr>\n' +
                    '                                    <td><input type="" value="'+goods_no+attribute_value_code+'" name="product['+index+'][product_no]"></td>\n';
                product_list_table_html += attribute_list_table_html;
                product_list_table_html +=
                    '                                    <td><input type="" name="product['+index+'][mkt_price]"></td>\n' +
                    '                                    <td><input type="" name="product['+index+'][price]"></td>\n' +
                    '                                    <td><input type="" name="product['+index+'][stock]"></td>\n' +
                    '                                    <td><input type="" name="product['+index+'][position]"></td>\n' +
                    '                                    <td><button class="btn btn-danger btn-sm" type="button" onclick="delete_product(this)">删除</button></td>\n' +
                    '                                </tr>';
            });
            product_list_table_html += '     </tbody>\n' +
                '                        </table>';
            $("#product_list").html(product_list_table_html)
        }

        function delete_product(obj)
        {
            $(obj).parent().parent().remove();
        }
    </script>
@endsection